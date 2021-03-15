<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>IPDonate</title>
    <link rel="stylesheet" href="/assets/css/widget.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300&subset=latin,cyrillic-ext,cyrillic,latin-ext' rel='stylesheet' type='text/css'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
</head>

<style>
    .goal_title {
        font-family: "{{ $widget['widget_config']->goal->title->font_family }}";
        font-size: {{ $widget['widget_config']->goal->title->font_size }}px;
        color: {{ $widget['widget_config']->goal->title->color }};
        font-weight: @if($widget['widget_config']->goal->title->weight) bold @else normal @endif;
        font-style: @if($widget['widget_config']->goal->title->italic) italic @else none @endif;
        text-decoration: @if($widget['widget_config']->goal->title->underline) underline @else none @endif;
        text-transform: {{ $widget['widget_config']->goal->title->transformation }};
        text-shadow: 0px 0px {{ $widget['widget_config']->goal->title->shadow_size }}px {{ $widget['widget_config']->goal->title->shadow_color }}, 0px 0px {{ $widget['widget_config']->goal->title->shadow_size + 1 }}px {{ $widget['widget_config']->goal->title->shadow_color }}, 0px 0px {{ $widget['widget_config']->goal->title->shadow_size + 2 }}px {{ $widget['widget_config']->goal->title->shadow_color }}, 0px 0px {{ $widget['widget_config']->goal->title->shadow_size + 3 }}px {{ $widget['widget_config']->goal->title->shadow_color }};
        text-align: center;
        vertical-align: middle;
    }

    .container {
        opacity: 1;
        display: table;
        width: 100%;
        height: 100%;
        vertical-align: middle;
    }

    .goal-widget {
        width: 100%;
        height: 100%;
        display: table-cell;
        vertical-align: middle;
        overflow: hidden;
    }

    .bar {
        height: 55px;
        background: {{ $widget['widget_config']->bar_color_bg }};
        border: 1px solid #b9b9b9;
        position: relative;
        overflow: hidden;
        box-shadow: 0 0 7px rgba(0,0,0,0.5);
        display: table;
        width: 100%;
    }

    .bar-progress {
        width: 50%;
        background: linear-gradient(transparent, rgba(0, 0, 0, 0.15)) {{ $widget['widget_config']->bar_color }};
        border: 1px solid {{ $widget['widget_config']->bar_color }};
        max-width: 100% !important;
        position: absolute;
        left: 0;
        top: 0;
        box-sizing: border-box;
        height: 100%;
    }

    .bar-text {
        font-family: "{{ $widget['widget_config']->goal->sum->font_family }}";
        font-size: {{ $widget['widget_config']->goal->sum->font_size }}px;
        color: {{ $widget['widget_config']->goal->sum->color }};
        font-weight: @if($widget['widget_config']->goal->sum->weight) bold @else normal @endif;
        font-style: @if($widget['widget_config']->goal->sum->italic) italic @else none @endif;
        text-decoration: @if($widget['widget_config']->goal->sum->underline) underline @else none @endif;
        text-transform: {{ $widget['widget_config']->goal->sum->transformation }};
        text-shadow: 0px 0px {{ $widget['widget_config']->goal->sum->shadow_size }}px {{ $widget['widget_config']->goal->sum->shadow_color }}, 0px 0px {{ $widget['widget_config']->goal->sum->shadow_size + 1 }}px {{ $widget['widget_config']->goal->sum->shadow_color }}, 0px 0px {{ $widget['widget_config']->goal->sum->shadow_size + 2 }}px {{ $widget['widget_config']->goal->sum->shadow_color }}, 0px 0px {{ $widget['widget_config']->goal->sum->shadow_size + 3 }}px {{ $widget['widget_config']->goal->sum->shadow_color }};

        height: 100%;
        width: 100%;
        display: table-cell;
        position: relative;
        vertical-align: middle;
        text-align: center;
    }

    .goal-start {
        float: left;
    }

    .goal-end {
        float: right;
    }

    #goal_sum, #goal_percent {
        display: inline-block;
    }
</style>
<body>
    <div class="container" style="opacity: 1;">
        <div class="goal-widget">
            <div class="goal_title">{{ base64_decode($widget['widget_config']->goal_title) }}</div>
            <div class="bar">
            	@if ($widget['widget_money'] == 0)
                <div class="bar-progress" style="width: 0%"></div>
            	@else 
                <div class="bar-progress" style="width: {{ 100 / ($widget['widget_config']->goal_sum_end / $widget['widget_money']) }}%"></div>
                @endif
                <div class="bar-text">
                    <div id="goal_sum">{{ $widget['widget_money'] }}</div> RUB
                    @if ($widget['widget_money'] == 0)
                    	(<div id="goal_percent">0%</div>)
                    @else 
                    	(<div id="goal_percent">{{ 100 / ($widget['widget_config']->goal_sum_end / $widget['widget_money']) }}%</div>)
                    @endif
                </div>
            </div>

            <div class="goal-info">
                <div class="goal-start goal_title" id="animate_title_two">0</div>
                <div class="goal-end goal_title" id="animate_title_three">{{ $widget['widget_config']->goal_sum_end }}</div>
                @if (empty($widget['widget_config']->goal_time_end))
                <div class="goal_title"></div>
                @else
                <div class="goal-time goal_title"></div>
                @endif                
                <div style="clear: both"></div>
            </div>        
        </div>
    </div>
<script src="/assets/js/jquery.js"></script>
<script src="/assets/js/fancywebsocket.js"></script>

<script>

    var now_sum = {{ $widget['widget_money'] }};
    var percent;

    function getTimeRemaining(endtime){
        var t = Date.parse(endtime) - Date.parse(new Date());
        var seconds = Math.floor( (t/1000) % 60 );
        var minutes = Math.floor( (t/1000/60) % 60 );
        var hours = Math.floor( (t/(1000*60*60)) % 24 );
        var days = Math.floor( t/(1000*60*60*24) );
        return {
            'total': t,
            'days': days,
            'hours': hours,
            'minutes': minutes,
            'seconds': seconds
        };
    }

    function formatTime(time, type) {
        if(type == 1) {
            if((time % 10) == 1) {
                if(time != 11) {
                    $(".goal-time").html("Остался "+ time +" день");
                } else {
                    $(".goal-time").html("Остался 11 дней");
                }

            }
            if((time % 10) >= 2 && (time % 10) <= 4) {
                if(time >= 12 && time <= 14) {
                    $(".goal-time").html("Осталось " + time + " дней");
                } else {
                    $(".goal-time").html("Осталось " + time + " дня");
                }
            }
            if((time % 10) >= 5 && (time % 10) <= 9) {
                $(".goal-time").html("Осталось "+ time +" дней");
            }
            if((time % 10) == 0) {
                $(".goal-time").html("Осталось "+ time +" дней");
            }
        }
        if(type == 2) {
            if((time % 10) == 1) {
                if(time != 11) {
                    $(".goal-time").html("Остался "+ time +" час");
                } else {
                    $(".goal-time").html("Осталось 11 минут");
                }

            }
            if((time % 10) >= 2 && (time % 10) <= 4) {
                if(time >= 12 && time <= 14) {
                    $(".goal-time").html("Осталось " + time + " часов");
                } else {
                    $(".goal-time").html("Осталось " + time + " часа");
                }
            }
            if((time % 10) >= 5 && (time % 10) <= 9) {
                $(".goal-time").html("Осталось "+ time +" часов");
            }
            if((time % 10) == 0) {
                $(".goal-time").html("Осталось "+ time +" часов");
            }
        }
        if(type == 3) {
            if((time % 10) == 1) {
                if(time != 11) {
                    $(".goal-time").html("Осталась "+ time +" минута");
                } else {
                    $(".goal-time").html("Осталось 11 минут");
                }

            }
            if((time % 10) >= 2 && (time % 10) <= 4) {
                if(time >= 12 && time <= 14) {
                    $(".goal-time").html("Осталось " + time + " минут");
                } else {
                    $(".goal-time").html("Осталась " + time + " минута");
                }
            }
            if((time % 10) >= 5 && (time % 10) <= 9) {
                $(".goal-time").html("Осталось "+ time +" минут");
            }
            if((time % 10) == 0) {
                $(".goal-time").html("Осталось "+ time +" минут");
            }
        }
        if(type == 4) {
            if((time % 10) == 1) {
                if(time != 11) {
                    $(".goal-time").html("Осталась "+ time +" секунда");
                } else {
                    $(".goal-time").html("Осталось 11 секунд");
                }

            }
            if((time % 10) >= 2 && (time % 10) <= 4) {
                if(time >= 12 && time <= 14) {
                    $(".goal-time").html("Осталось " + time + " секунд");
                } else {
                    $(".goal-time").html("Осталась " + time + " секунда");
                }
            }
            if((time % 10) >= 5 && (time % 10) <= 9) {
                $(".goal-time").html("Осталось "+ time +" секунд");
            }
            if((time % 10) == 0) {
                $(".goal-time").html("Осталось "+ time +" секунд");
            }
        }
    }

    function updateGoalTime() {
        var lefttime = getTimeRemaining("{{ $widget['widget_config']->goal_time_end }}");
        if(lefttime.days != 0 && lefttime.days > 0) {
            formatTime(lefttime.days, 1);
        } else {
            if(lefttime.hours != 0 && lefttime.hours > 0) {
                formatTime(lefttime.hours, 2);
            } else {
                if(lefttime.minutes != 0 && lefttime.minutes > 0) {
                    formatTime(lefttime.minutes, 3);
                } else {
                    if(lefttime.seconds != 0 && lefttime.seconds > 0) {
                        formatTime(lefttime.seconds, 4);
                    } else {
                        $(".goal-time").html("Сбор завершен");
                    }
                }
            }
        }
    }

    function addToGoal(data)
    {
        now_sum += parseInt(data.sum);
        $("#goal_sum").html(now_sum);
        percent = 100 / ({{ $widget['widget_config']->goal_sum_end }} / parseInt(now_sum));
        $("#goal_percent").html(percent.toFixed(2) + "%");
        $(".bar-progress").animate({"width": percent + "%"}, 2000);
    }

    console.log('[Server]: Connecting...');
    Server = new FancyWebSocket('wss://ipdonate.com/ipdonate');

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
        var token = '{{ $widget["widget_token"] }}';

        console.log(data);
        data = $.parseJSON(data);
        console.log("[Server]: Message: ");
        console.log(data);

        if(data.token == token) {
            if(data.command != "update") {
                addToGoal(data);
            } else {
                location.href = location.href;
            }
        }
    });

    Server.connect();

    setInterval(function () {
        updateGoalTime();
    }, 1000);
</script>
</body>
</html>