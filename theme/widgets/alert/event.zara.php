<html lang="ru">
	<head>
		<meta charset="utf-8">
        <title>IPDonate</title>
		<link rel="stylesheet" href="/assets/css/widget.css">
		<link rel="stylesheet" href="/assets/css/bootstrap.min.css">
		<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300&subset=latin,cyrillic-ext,cyrillic,latin-ext' rel='stylesheet' type='text/css'>
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	</head>

	<style>
        body {
            background: #2b2b2b;
        }

        .event {
            background: #2b2b2b;
            width: 100%;
            min-height: 50px;
            color: #9d9d9d;
            padding: 10px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.32);
        }

        .event .event-desc {
            display: inline-block;
        }

        .event .event-info {
            display: inline-block;
        }

        .event .event-info {
            color: #fff;
        }

        .event .event-message {
            color: #fff;
            margin: -10px;
            margin-top: 10px;
            padding: 10px;
            background: #1e1e1e;
        }

        .event .event-time {
            float: right;
        }

		.smile-text {
			width: 16px;
			height: 16px;
		}
	</style>

	<body>
		<div id="events"></div>
		<script src="/assets/js/jquery.js"></script>
        <script src="/assets/js/fancywebsocket.js"></script>

        <script>
            var curr_num = 0;
            var curr_id = 0;
            var last_id = 1;
            var code = {{ $code }};

            function getTime(){
                var date = new Date();

                return {
                    'hours': date.getHours(),
                    'minutes': date.getMinutes(),
                    'seconds': date.getSeconds(),
                };
            }

            var time = "{{ date("Y-m-d\T") }}";


            function showFollowerAlert(id, data)
            {
                var alert_time = new Date();
                $("#events").prepend('<div id="event-'+ id +'" class="event"><time datetime="'+ alert_time +'" class="event-time timeago">только что</time><div class="event-desc">- Подписка</div> <div class="event-info">'+ data.user_name +'</div></div>');
            }

            function showSubscriberAlert(id, data)
            {
                var alert_time = new Date();
                $("#events").prepend('<div id="event-'+ id +'" class="event"><time datetime="'+ alert_time +'" class="event-time timeago">только что</time><div class="event-desc">- Платная подписка</div> <div class="event-info">'+ data.user_name +'</div></div>');
            }

            function showDonationAlert(id, data)
            {
                var alert_time = new Date();
                $("#events").prepend('<div id="event-'+ id +'" class="event"><time datetime="'+ alert_time +'" class="event-time timeago">только что</time><div class="event-desc">- Пожертвование</div> <div class="event-info">'+ data.user_name +' (<b>'+ data.sum +' '+ data.curr +'</b>)</div><div class="event-message">'+ data.msg +'</div></div>');
                $("a").html("[ссылка]");
                
                var synth = window.speechSynthesis,
                message = new SpeechSynthesisUtterance();
                message.lang = 'ru-RU';
                message.text = data.msg;
                synth.speak(message);
            }

			function showAlert(data, id, token) {
			    curr_num++;
			    curr_id++;

                console.log(curr_num);
			    if(curr_num >= 15) {
                    console.log(curr_id);
                    console.log(last_id);

                    $("#event-" + last_id).remove();
                    last_id++;
                }

			    if(data.alert_type == 1 && (code == 0 || code == 1 || code == 2 || code == 4)) {
			        showFollowerAlert(curr_id, data);
                }
                if(data.alert_type == 2 && (code == 0 || code == 1 || code == 3 || code == 5)) {
                    showSubscriberAlert(curr_id, data);
                }
                if(data.alert_type == 3 && (code == 0 || code == 2 || code == 3 || code == 6)) {
                    showDonationAlert(curr_id, data);
                }
			}

			console.log('[Server]: Connecting...');
			Server = new FancyWebSocket('wss://ipdonate.com/websocket');

			//Let the user know we're connected
			Server.bind('open', function() {
				console.log("[Server]: Connected.");
			});

			//OH NOES! Disconnection occurred.
			Server.bind('close', function(data) {
				console.log("[Server]: Disconnected.");
			});

			//Log any messages sent from server
			Server.bind('message', function(data) {
				var id = '{{ $widget["widget_id"] }}';
				var tokens = [
                    @foreach($widgets as $w)
                    "{{ $w['widget_token'] }}",
                    @endforeach
                ];

                console.log(data);
				data = $.parseJSON(data);
				console.log("[Server]: Message: ");
				console.log(data);

				if(tokens.indexOf(data.token) != -1) {
                    showAlert(data, id, data.token);
				}
			});

			Server.connect();

            function getTimeRemaining(endtime){
                var t = Date.parse(endtime) - Date.parse(new Date());
                var seconds = Math.floor( (t/1000) % 60 );
                var minutes = Math.floor( (t/1000/60) % 60 );
                var hours = Math.floor( (t/(1000*60*60)) % 24 );
                var days = Math.floor( t/(1000*60*60*24) );
                return {
                    'total': t * -1,
                    'days': days * -1,
                    'hours': hours * -1,
                    'minutes': minutes * -1,
                    'seconds': seconds * -1
                };
            }

            function formatTime(time, type) {
                if(type == 1) {
                    if((time % 10) == 1) {
                        if(time != 11) {
                            return time +" день назад";
                        } else {
                            return "11 дней назад";
                        }

                    }
                    if((time % 10) >= 2 && (time % 10) <= 4) {
                        if(time >= 12 && time <= 14) {
                            return time + " дней назад";
                        } else {
                            return time + " дня назад";
                        }
                    }
                    if((time % 10) >= 5 && (time % 10) <= 9) {
                        return time +" дней назад";
                    }
                    if((time % 10) == 0) {
                        $(".goal-time").html("Осталось "+ time +" дней");
                        return time +" дней назад";
                    }
                }
                if(type == 2) {
                    if((time % 10) == 1) {
                        if(time != 11) {
                            return time +" час назад";
                        } else {
                            return "11 часов назад";
                        }

                    }
                    if((time % 10) >= 2 && (time % 10) <= 4) {
                        if(time >= 12 && time <= 14) {
                            return time + " часов назад";
                        } else {
                            return time + " часа назад";
                        }
                    }
                    if((time % 10) >= 5 && (time % 10) <= 9) {
                        return time +" часов назад";
                    }
                    if((time % 10) == 0) {
                        return time +" часов назад";
                    }
                }
                if(type == 3) {
                    if((time % 10) == 1) {
                        if(time != 11) {
                            return time +" минута назад";
                        } else {
                            return "11 минут назад";
                        }

                    }
                    if((time % 10) >= 2 && (time % 10) <= 4) {
                        if(time >= 12 && time <= 14) {
                            return time + " минут назад";
                        } else {
                            return time + " минуты назад";
                        }
                    }
                    if((time % 10) >= 5 && (time % 10) <= 9) {
                        return time +" минут назад";
                    }
                    if((time % 10) == 0) {
                        return time +" минут назад";
                    }
                }
                if(type == 4) {
                    if((time % 10) == 1) {
                        if(time != 11) {
                            return time +" секунда назад";
                        } else {
                            return "11 секунд назад";
                        }

                    }
                    if((time % 10) >= 2 && (time % 10) <= 4) {
                        if(time >= 12 && time <= 14) {
                            return time + " секунд назад";
                        } else {
                            return time + " секунды назад";
                        }
                    }
                    if((time % 10) >= 5 && (time % 10) <= 9) {
                        return time +" секунд назад";
                    }
                    if((time % 10) == 0) {
                        return time +" секунд назад";
                    }
                }
            }

            setInterval(function () {
                $(".event").each(function () {
                    var time_ago = getTimeRemaining($(this).children("time").attr("datetime"));

                    if(time_ago.days != 1 && time_ago.days != 0) {
                        $(this).children("time").html(formatTime(time_ago.days, 1));
                    } else {
                        if(time_ago.hours != 1 && time_ago.hours != 0) {
                            $(this).children("time").html(formatTime(time_ago.hours, 2));
                        } else {
                            if(time_ago.minutes != 1 && time_ago.minutes != 0) {
                                $(this).children("time").html(formatTime(time_ago.minutes, 3));
                            } else {
                                if(time_ago.seconds != 1 && time_ago.seconds != 0) {
                                    $(this).children("time").html(formatTime(time_ago.seconds, 4));
                                }
                            }
                        }
                    }
                    console.log(time_ago);
                });
            }, 1000);
		</script>
	</body>
</html>