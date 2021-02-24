<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>IPDonate</title>
    <link rel="stylesheet" href="/assets/css/widget.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300&subset=latin,cyrillic-ext,cyrillic,latin-ext' rel='stylesheet' type='text/css'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
</head>

	<style>

        body {
            overflow: hidden;
            @if($bg)
            background: {{ $widget['widget_config']->background }};
            @endif
        }

		.text {
			font-family: "{{ $widget['widget_config']->stats->text->font_family }}";
			font-size: {{ $widget['widget_config']->stats->text->font_size }}px;
			color: {{ $widget['widget_config']->stats->text->color }};
			font-weight: @if($widget['widget_config']->stats->text->weight) bold @else normal @endif;
			font-style: @if($widget['widget_config']->stats->text->italic) italic @else none @endif;
			text-decoration: @if($widget['widget_config']->stats->text->underline) underline @else none @endif;
			text-transform: {{ $widget['widget_config']->stats->text->transformation }};
			text-shadow: 0px 0px {{ $widget['widget_config']->stats->text->shadow_size }}px {{ $widget['widget_config']->stats->text->shadow_color }}, 0px 0px {{ $widget['widget_config']->stats->text->shadow_size + 1 }}px {{ $widget['widget_config']->stats->text->shadow_color }}, 0px 0px {{ $widget['widget_config']->stats->text->shadow_size + 2 }}px {{ $widget['widget_config']->stats->text->shadow_color }}, 0px 0px {{ $widget['widget_config']->stats->text->shadow_size + 3 }}px {{ $widget['widget_config']->stats->text->shadow_color }};
			text-align: {{ $widget['widget_config']->stats->text->aling }};
			vertical-align:middle;
		}

		.donation-title {
			display: inline-block;
		}

		.container {
			width: 100%;
    		height: 100%;
    		display: table;
		}

        .text {
            width: auto;
            display: table-cell;
            vertical-align: middle;
            white-space: nowrap;
        }

        .moving-text {
            display: inline-block;
            padding-left: 200px;
        }

        .slide-text {
            opacity: 0;
        }

        .list-text {
            opacity: 1;
        }

	</style>

	<body>
		<div class="container" id="stats" style="opacity: 1; display: table;">
			<div class="text">

			</div>
		</div>

		<script src="/assets/js/jquery.js"></script>
		<script src="/assets/js/fancywebsocket.js"></script> 

		<script>
            var list_ready = false;
            var list_el = [];
            var count_el = 0;

			function getLastMessages() {
				$.ajax({
					url: "/widgets/getlastmsg/{{ $widget["widget_id"] }}/{{ $widget["widget_token"] }}",
					type: "POST",
					success: function (data) {
						data = $.parseJSON(data);

                        $(".text").html("");

                        @if($widget['widget_config']->stats_view_type == 1)
                            var el_class = "moving-text";
                        @elseif($widget['widget_config']->stats_view_type == 2)
                            var el_class = "slide-text";
                        @elseif($widget['widget_config']->stats_view_type == 3)
                            var el_class = "list-text";
                        @endif

                        for(var i = 0; i < data.length; i++) {
                            var text = "{{ base64_decode($widget['widget_config']->stats_layout) }}";
                            text = text.replace(":name", data[i].user_name);
                            text = text.replace(":ammount", data[i].sum + " " + data[i].curr);
                            text = text.replace(":message", data[i].msg);
                            $(".text").append('<div class="'+ el_class +'">'+ text +'</div>');
                        }

                        list_ready = true;
                        console.log("[Server]: Count of messages: " + data.length);
                        @if($widget['widget_config']->stats_view_type == 2)
                        slideWidget();
                        @endif
					}
				});
			}

            function getMooreCostsMessages() {
                $.ajax({
                    url: "/widgets/getcostsmsg/{{ $widget["widget_id"] }}/{{ $widget["widget_token"] }}",
                    type: "POST",
                    success: function (data) {
                        console.log(data);
                        data = $.parseJSON(data);

                        $(".text").html("");

                        @if($widget['widget_config']->stats_view_type == 1)
                            var el_class = "moving-text";
                        @elseif($widget['widget_config']->stats_view_type == 2)
                        var el_class = "slide-text";
                        @elseif($widget['widget_config']->stats_view_type == 3)
                        var el_class = "list-text";
                        @endif

                        for(var i = 0; i < data.length; i++) {
                            var text = "{{ base64_decode($widget['widget_config']->stats_layout) }}";
                            text = text.replace(":name", data[i].user_name);
                            text = text.replace(":ammount", data[i].sum + " " + data[i].curr);
                            text = text.replace(":message", data[i].msg);
                            $(".text").append('<div class="'+ el_class +'">'+ text +'</div>');
                        }

                        list_ready = true;
                        console.log("[Server]: Count of messages: " + data.length);
                        @if($widget['widget_config']->stats_view_type == 2)
                            slideWidget();
                        @endif
                    }
                });
            }

            function getUserCostsMessages() {
                $.ajax({
                    url: "/widgets/getucostsmsg/{{ $widget["widget_id"] }}/{{ $widget["widget_token"] }}",
                    type: "POST",
                    success: function (data) {
                        console.log(data);
                        data = $.parseJSON(data);

                        $(".text").html("");

                        @if($widget['widget_config']->stats_view_type == 1)
                            var el_class = "moving-text";
                        @elseif($widget['widget_config']->stats_view_type == 2)
                        var el_class = "slide-text";
                        @elseif($widget['widget_config']->stats_view_type == 3)
                        var el_class = "list-text";
                        @endif

                        for(var i = 0; i < data.length; i++) {
                            var text = "{{ base64_decode($widget['widget_config']->stats_layout) }}";
                            text = text.replace(":name", data[i].user_name);
                            text = text.replace(":ammount", data[i].sum + " " + data[i].curr);
                            text = text.replace(":message", data[i].msg);
                            $(".text").append('<div class="'+ el_class +'">'+ text +'</div>');
                        }

                        list_ready = true;
                        console.log("[Server]: Count of messages: " + data.length);
                        @if($widget['widget_config']->stats_view_type == 2)
                            slideWidget();
                        @endif
                    }
                });
            }

            function getBalance() {
                $.ajax({
                    url: "/widgets/getbalance/{{ $widget["widget_id"] }}/{{ $widget["widget_token"] }}",
                    type: "POST",
                    success: function (data) {
                        console.log(data);
                        data = $.parseJSON(data);
                        $(".text").html("");
                        $(".text").append('<div class="list-text">'+ data.sum + ' ' + data.curr +'</div>');
                        console.log("[Server]: Balance: " + data.sum + " " + data.curr);

                        setTimeout(initWidget, 20000); //Каждые 20 сек. обновляем баланс
                    }
                });
            }

            function moveLine() {
                $("#stats").css("margin-left", "100%");
                $("#stats").animate({ "margin-left": "-100%" }, 20000, 'linear', initWidget);
            }

            function slideElement() {
                if(list_el.length > 0) {
                    $(".slide-text").animate({"opacity": "0"}, 500, 'linear');
                    setTimeout(function () {
                        $(".slide-text").css("display", "none");

                        //$(list_el.shift()).css("opacity", 1);
                        var curr_el = list_el.shift();
                        $(curr_el).css("display", "block");
                        $(curr_el).animate({"opacity": "1"}, 500, 'linear');

                        setTimeout(function () {
                            slideElement();
                        }, 5000);
                    }, 500);
                } else {
                    initWidget();
                }
            }

            function slideWidget() {
                if(list_ready == true) {
                    console.log("[Client]: Elements ready! Showing...");

                    $(".slide-text").each(function (i, element) {
                        list_el.push(element);
                        count_el = i;
                    });

                    slideElement();
                } else {
                    setTimeout(slideWidget, 5000);
                }
            }

			function initWidget() {
			    @if($widget["widget_config"]->stats_type == 1)
                getLastMessages();
                @elseif($widget["widget_config"]->stats_type == 2)
                getMooreCostsMessages();
                @elseif($widget["widget_config"]->stats_type == 3)
                getUserCostsMessages();
                @elseif($widget["widget_config"]->stats_type == 4)
                getBalance();
                @endif

                @if($widget['widget_config']->stats_view_type == 1 && $widget["widget_config"]->stats_type != 4)
                moveLine();
                @endif
			}

			console.log('[Server]: Connecting...');
			Server = new FancyWebSocket('wss://ipdonate.com/websocket');

			//Let the user know we're connected
			Server.bind('open', function() {
				console.log("[Server]: Connected.");
                initWidget();
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
                        //
                    } else {
                        location.href = location.href;
                    }
				}
			});

			Server.connect();
		</script>
	</body>
</html>