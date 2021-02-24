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
        font-family: "{{ $widget['widget_config']->style->title->font_family }}";
        font-size: {{ $widget['widget_config']->style->title->font_size }}px;
        color: {{ $widget['widget_config']->style->title->color }};
        font-weight: @if($widget['widget_config']->style->title->weight) bold @else normal @endif;
        font-style: @if($widget['widget_config']->style->title->italic) italic @else none @endif;
        text-decoration: @if($widget['widget_config']->style->title->underline) underline @else none @endif;
        text-transform: {{ $widget['widget_config']->style->title->transformation }};
        text-shadow: 0px 0px {{ $widget['widget_config']->style->title->shadow_size }}px {{ $widget['widget_config']->style->title->shadow_color }}, 0px 0px {{ $widget['widget_config']->style->title->shadow_size + 1 }}px {{ $widget['widget_config']->style->title->shadow_color }}, 0px 0px {{ $widget['widget_config']->style->title->shadow_size + 2 }}px {{ $widget['widget_config']->style->title->shadow_color }}, 0px 0px {{ $widget['widget_config']->style->title->shadow_size + 3 }}px {{ $widget['widget_config']->style->title->shadow_color }};
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
        margin-top: 10px;
        margin-bottom: 15px;
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
        font-family: "{{ $widget['widget_config']->style->variant->font_family }}";
        font-size: {{ $widget['widget_config']->style->variant->font_size }}px;
        color: {{ $widget['widget_config']->style->variant->color }};
        font-weight: @if($widget['widget_config']->style->variant->weight) bold @else normal @endif;
        font-style: @if($widget['widget_config']->style->variant->italic) italic @else none @endif;
        text-decoration: @if($widget['widget_config']->style->variant->underline) underline @else none @endif;
        text-transform: {{ $widget['widget_config']->style->variant->transformation }};
        text-shadow: 0px 0px {{ $widget['widget_config']->style->variant->shadow_size }}px {{ $widget['widget_config']->style->variant->shadow_color }}, 0px 0px {{ $widget['widget_config']->style->variant->shadow_size + 1 }}px {{ $widget['widget_config']->style->variant->shadow_color }}, 0px 0px {{ $widget['widget_config']->style->variant->shadow_size + 2 }}px {{ $widget['widget_config']->style->variant->shadow_color }}, 0px 0px {{ $widget['widget_config']->style->variant->shadow_size + 3 }}px {{ $widget['widget_config']->style->variant->shadow_color }};

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

    #goal_sum, .goal_percent {
        display: inline-block;
    }
</style>
<body>
    <div class="container" id="goal-widget" style="opacity: 0;">
        <div class="goal-widget">
            <div class="goal_title">{{ base64_decode($widget['widget_config']->title) }}</div>
            <div id="bars">

            </div>
        </div>
    </div>
<script src="/assets/js/jquery.js"></script>
<script src="/assets/js/fancywebsocket.js"></script>

<script>

    function initWidget()
    {
        $.ajax({
            url: "/widgets/getvotevariants/{{ $widget["widget_id"] }}/{{ $widget["widget_token"] }}",
            type: "POST",
            success: function (data) {
                console.log(data);
                data = $.parseJSON(data);

                $("#bars").html("");

                for(var i = 0; i < data.length; i++) {
                    $("#bars").append('<div class="bar" id="bar-'+ i +'"><div class="bar-progress" id="bar-progress-'+ i +'" style="width: 0%;"></div><div class="bar-text"><div id="goal_sum">'+ data[i].name +' </div> (<div class="goal_percent" id="goal_percent-'+ i +'">'+ data[i].percent +'%</div>)</div></div>');
                }

                $("#goal-widget").animate({"opacity": 1}, 1000, "linear");

                for(var i = 0; i < data.length; i++) {
                    $("#bar-progress-"+ i).animate({"width": $("#goal_percent-" + i).html()}, 1200, "linear");
                }

                console.log("[Server]: Count of variants: " + data.length);

                @if($widget['widget_config']->time != 1)
                setTimeout(function () {
                    for(var i = 0; i < data.length; i++) {
                        $("#bar-progress-"+ i).animate({"width": "0"}, 700, "linear");
                    }

                    $("#goal-widget").animate({"opacity": 0}, 1000, "linear");

                    @if($widget['widget_config']->time == 2)
                    setTimeout(initWidget, 30000);
                    @elseif($widget['widget_config']->time == 3)
                    setTimeout(initWidget, 60000);
                    @elseif($widget['widget_config']->time == 4)
                    setTimeout(initWidget, 180000);
                    @elseif($widget['widget_config']->time == 5)
                    setTimeout(initWidget, 180000);
                    @elseif($widget['widget_config']->time == 6)
                    setTimeout(initWidget, 600000);
                    @elseif($widget['widget_config']->time == 7)
                    setTimeout(initWidget, 1800000);
                    @elseif($widget['widget_config']->time == 8)
                    setTimeout(initWidget, 3600000);
                    @endif

                }, {{ $widget['widget_config']->time_show * 1000 }});
                @endif
            }
        });
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
                initWidget();
            } else {
                location.href = location.href;
            }
        }
    });

    Server.connect();
</script>
</body>
</html>