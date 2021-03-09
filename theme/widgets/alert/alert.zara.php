<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>IPDonate</title>
    <link rel="stylesheet" href="/assets/css/widget.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300&subset=latin,cyrillic-ext,cyrillic,latin-ext' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
</head>

<style>

    @if($bg)
    body {
        background: {{ $widget['widget_config']->background }};
    }
    @endif

    .name_and_sum {
        font-family: "{{ $widget['widget_config']->donation->title->font_family }}";
        font-size: {{ $widget['widget_config']->donation->title->font_size }}px;
    color: {{ $widget['widget_config']->donation->title->color }};
    font-weight: @if($widget['widget_config']->donation->title->weight) bold @else normal @endif;
    font-style: @if($widget['widget_config']->donation->title->italic) italic @else none @endif;
    text-decoration: @if($widget['widget_config']->donation->title->underline) underline @else none @endif;
    text-transform: {{ $widget['widget_config']->donation->title->transformation }};
    text-shadow: 0px 0px {{ $widget['widget_config']->donation->title->shadow_size }}px {{ $widget['widget_config']->donation->title->shadow_color }}, 0px 0px {{ $widget['widget_config']->donation->title->shadow_size + 1 }}px {{ $widget['widget_config']->donation->title->shadow_color }}, 0px 0px {{ $widget['widget_config']->donation->title->shadow_size + 2 }}px {{ $widget['widget_config']->donation->title->shadow_color }}, 0px 0px {{ $widget['widget_config']->donation->title->shadow_size + 3 }}px {{ $widget['widget_config']->donation->title->shadow_color }};
    text-align: {{ $widget['widget_config']->donation->title->aling }};
    vertical-align:middle;
    }

    .donation-title {
        display: inline-block;
    }

    .donation-message {
        font-family: "{{ $widget['widget_config']->donation->message->font_family }}";
    font-size: {{ $widget['widget_config']->donation->message->font_size }}px;
    color: {{ $widget['widget_config']->donation->message->color }};
    font-weight: @if($widget['widget_config']->donation->message->weight) bold @else normal @endif;
    font-style: @if($widget['widget_config']->donation->message->italic) italic @else none @endif;
    text-decoration: @if($widget['widget_config']->donation->message->underline) underline @else none @endif;
    text-transform: {{ $widget['widget_config']->donation->message->transformation }};
    text-shadow: 0px 0px {{ $widget['widget_config']->donation->message->shadow_size }}px {{ $widget['widget_config']->donation->message->shadow_color }}, 0px 0px {{ $widget['widget_config']->donation->message->shadow_size + 1 }}px {{ $widget['widget_config']->donation->message->shadow_color }}, 0px 0px {{ $widget['widget_config']->donation->message->shadow_size + 2 }}px {{ $widget['widget_config']->donation->message->shadow_color }}, 0px 0px {{ $widget['widget_config']->donation->message->shadow_size + 3 }}px {{ $widget['widget_config']->donation->message->shadow_color }};
    text-align: {{ $widget['widget_config']->donation->message->aling }};
    vertical-align:middle;
    }

    .follower-message {
        font-family: "{{ $widget['widget_config']->follower->font_family }}";
    font-size: {{ $widget['widget_config']->follower->font_size }}px;
    color: {{ $widget['widget_config']->follower->color }};
    font-weight: @if($widget['widget_config']->follower->weight) bold @else normal @endif;
    font-style: @if($widget['widget_config']->follower->italic) italic @else none @endif;
    text-decoration: @if($widget['widget_config']->follower->underline) underline @else none @endif;
    text-transform: {{ $widget['widget_config']->follower->transformation }};
    text-shadow: 0px 0px {{ $widget['widget_config']->follower->shadow_size }}px {{ $widget['widget_config']->donation->message->shadow_color }}, 0px 0px {{ $widget['widget_config']->donation->message->shadow_size + 1 }}px {{ $widget['widget_config']->donation->message->shadow_color }}, 0px 0px {{ $widget['widget_config']->donation->message->shadow_size + 2 }}px {{ $widget['widget_config']->donation->message->shadow_color }}, 0px 0px {{ $widget['widget_config']->donation->message->shadow_size + 3 }}px {{ $widget['widget_config']->donation->message->shadow_color }};
    text-align: {{ $widget['widget_config']->follower->aling }};
    vertical-align:middle;
    @if($widget['widget_config']->follower->layout == 2)
    display: table-cell;
    @elseif($widget['widget_config']->follower->layout == 3)
    display: table-cell;
    width: 70%;
    @endif
    }

    .subscriber-message {
        font-family: "{{ $widget['widget_config']->subscribe->font_family }}";
    font-size: {{ $widget['widget_config']->subscribe->font_size }}px;
    color: {{ $widget['widget_config']->subscribe->color }};
    font-weight: @if($widget['widget_config']->subscribe->weight) bold @else normal @endif;
    font-style: @if($widget['widget_config']->subscribe->italic) italic @else none @endif;
    text-decoration: @if($widget['widget_config']->subscribe->underline) underline @else none @endif;
    text-transform: {{ $widget['widget_config']->subscribe->transformation }};
    text-shadow: 0px 0px {{ $widget['widget_config']->subscribe->shadow_size }}px {{ $widget['widget_config']->donation->message->shadow_color }}, 0px 0px {{ $widget['widget_config']->donation->message->shadow_size + 1 }}px {{ $widget['widget_config']->donation->message->shadow_color }}, 0px 0px {{ $widget['widget_config']->donation->message->shadow_size + 2 }}px {{ $widget['widget_config']->donation->message->shadow_color }}, 0px 0px {{ $widget['widget_config']->donation->message->shadow_size + 3 }}px {{ $widget['widget_config']->donation->message->shadow_color }};
    text-align: {{ $widget['widget_config']->subscribe->aling }};
    vertical-align: middle;
    @if($widget['widget_config']->subscribe->layout == 2)
    display: table-cell;
    @elseif($widget['widget_config']->subscribe->layout == 3)
    display: table-cell;
    width: 70%;
    @endif
    }

    .donation-image {
        @if($widget['widget_config']->donation->layout == 1)
        width: auto;
        height: 100%;
        background-position: center bottom;
        background-repeat: no-repeat;
        background-size: contain;
        display: table-row
        @elseif($widget['widget_config']->donation->layout == 2)
    width: 30%;
        height: 100%;
        background-position: center;
        background-repeat: no-repeat;
        background-size: contain;
        display: table-column;
        @elseif($widget['widget_config']->donation->layout == 3)
        width: 30%;
        height: 100%;
        background-position: center;
        background-repeat: no-repeat;
        background-size: contain;
        display: table-cell;
        @endif
    }

    .follower-image {
        @if($widget['widget_config']->follower->layout == 1)
        width: auto;
        height: 100%;
        background-position: center bottom;
        background-repeat: no-repeat;
        background-size: contain;
        display: table-row
        @elseif($widget['widget_config']->follower->layout == 2)
    width: 30%;
        height: 100%;
        background-position: center;
        background-repeat: no-repeat;
        background-size: contain;
        display: table-column;
        @elseif($widget['widget_config']->follower->layout == 3)
        width: 30%;
        height: 100%;
        background-position: center;
        background-repeat: no-repeat;
        background-size: contain;
        display: table-cell;
        @endif
    }

    .subscriber-image {
        @if($widget['widget_config']->subscribe->layout == 1)
        width: auto;
        height: 100%;
        background-position: center bottom;
        background-repeat: no-repeat;
        background-size: contain;
        display: table-row
        @elseif($widget['widget_config']->subscribe->layout == 2)
    width: 30%;
        height: 100%;
        background-position: center;
        background-repeat: no-repeat;
        background-size: contain;
        display: table-column;
        @elseif($widget['widget_config']->subscribe->layout == 3)
        width: 30%;
        height: 100%;
        background-position: center;
        background-repeat: no-repeat;
        background-size: contain;
        display: table-cell;
        @endif
    }

    .donation-image img,
    .follower-image img,
    .subscriber-image img{
        width: 1px;
        height: 1px;
        opacity: 0;
        display: table-row;
    }

    .container {
        width: 100%;
        height: 100%;
        display: table;
    }

    .text {
        @if($widget['widget_config']->donation->layout == 2)
        display: table-cell;
        vertical-align: middle;
        @endif
        @if($widget['widget_config']->donation->layout == 3)
        display: table-cell;
        vertical-align: middle;
        width: 70%;
        @endif
    }

</style>

<body>
<div class="container" id="donation-alert" style="opacity: 0; display: none;">
    <audio id="donation-audio" src="{{ $widget['widget_config']->donation->audio or "/assets/audio/point.mp3" }}"></audio>
    <div class="donation-image" style="background-image: url('{{ $widget['widget_config']->donation->image or "/assets/images/zombie.gif" }}')">
    <img src="">
</div>
<div class="text">
    <div class="name_and_sum @if($widget['widget_config']->donation->title->animation_object == "text") animated infinite {{ $widget['widget_config']->donation->title->animation }} @endif">
    <div class="donation-title"></div>
</div>

@if($widget['widget_config']->donation->message->status == 1)
<div class="donation-message @if($widget['widget_config']->donation->message->animation_object == "text") animated infinite {{ $widget['widget_config']->donation->message->animation }} @endif">
Сообщение
</div>
@endif
</div>
</div>

<div class="container" id="follower-alert" style="opacity: 0; display: none;">
    <audio id="follower-audio" src="{{ $widget['widget_config']->follower->audio or "/assets/audio/point.mp3" }}"></audio>
    <div class="follower-image" style="background-image: url('{{ $widget['widget_config']->follower->image or "/assets/images/zombie.gif" }}')">
    <img src="">
</div>
<div class="follower-message">

</div>
</div>
</div>

<div class="container" id="subscriber-alert" style="opacity: 0; display: none;">
    <audio id="subscriber-audio" src="{{ $widget['widget_config']->subscribe->audio or "/assets/audio/point.mp3" }}"></audio>
    <div class="subscriber-image" style="background-image: url('{{ $widget['widget_config']->subscribe->image or "/assets/images/zombie.gif" }}')">
    <img src="">
</div>
<div class="subscriber-message">

</div>
</div>
</div>

<div id="temp-storage" styl="display: none;"></div>

<script src="/assets/js/jquery.js"></script>
<script src="/assets/js/fancywebsocket.js"></script>

<script>
    function getSmileUrl(smile)
    {
        var platform = smile.replace(/smile\[([a-z]+)_([0-9]+)\]/g, "$1");
        var id = smile.replace(/smile\[([a-z]+)_([0-9]+)\]/g, "$2");

        var smiles_twitch = '{{ json_encode($smiles_twitch) }}';
        var smiles_hitbox = '{{ json_encode($smiles_hitbox) }}';

        smiles_twitch = $.parseJSON(smiles_twitch);
        smiles_hitbox = $.parseJSON(smiles_hitbox);

        if(platform == "twitch") {
            return "https://static-cdn.jtvnw.net/emoticons/v1/" + smiles_twitch[id] + "/1.0";
        } else {
            return smiles_hitbox[id];
        }
    }

    function getNotShowedAlert() {
        $.ajax({
            url: "/widgets/getalerts/{{ $widget["widget_id"] }}/{{ $widget["widget_token"] }}?code={{ $code }}",
            type: "POST",
            success: function (data) {
                data = $.parseJSON(data);
                console.log(data);
                for(var i = 0; i < data.length; i++)
                {
                    queue.push(data[i]);
                }

                if(data.length != 0){
                    showAlert(data[data.length - 1], {{ $widget["widget_id"] }}, "{{ $widget["widget_token"] }}");
                }
                console.log("[Server]: Waiting alerts: " + data.length);
            }
        });
    }

    function alertShowed(id) {
        if(id != 0) {
            $.ajax({
                url: "/widgets/alert/" + id + "/showed",
                type: "POST"
            });
        }
    }

    function stopShowAlert(data, id, token)
    {
        alertShowed(id);
        $("#donation-alert").css("opacity", "0");
        $("#follower-alert").css("opacity", "0");
        $("#subscriber-alert").css("opacity", "0");
        $("#donation-alert").css("display", "none");
        $("#follower-alert").css("display", "none");
        $("#subscriber-alert").css("display", "none");
        now_show = false;

        if(queue.length > 0) {
            setTimeout(function() {
                showAlert(queue.shift(), id, token);
            }, {{ $widget['widget_config']->next_alert_time * 1000 }});
        }
    }

    function showFollowerAlert(data)
    {
        document.getElementById("follower-audio").play();
        document.getElementById("follower-audio").volume = {{ ($widget['widget_config']->follower->audio_volume / 100) or 40 }}

        $("#follower-alert").css("opacity", "1");
        $("#follower-alert").css("display", "table");
        now_show = true;

        $(".follower-message").html(" ");

        var follower_message_layout = "{{ base64_decode($widget['widget_config']->follower->message_layout) }}";
        var follower_message = follower_message_layout.replace(":name", data.user_name);

    @if($widget['widget_config']->follower->animation != "none" && $widget['widget_config']->follower->animation_object != "text")
        for (var i = 0; i < follower_message.length; i++) {
            $(".follower-message").html($(".follower-message").html() + '<span class="char'+ i +' animated {{ $widget['widget_config']->follower->animation_object }} infinite {{ $widget['widget_config']->follower->animation }}">'+ follower_message.charAt(i) +'</span>');
        }
    @else
        $(".follower-message").html(follower_message);
    @endif

    }

    function showSubscriberAlert(data)
    {
        document.getElementById("subscriber-audio").play();
        document.getElementById("subscriber-audio").volume = {{ ($widget['widget_config']->subscribe->audio_volume / 100) or 40 }}

        $("#subscriber-alert").css("opacity", "1");
        $("#subscriber-alert").css("display", "table");
        now_show = true;

        $(".subscriber-message").html(" ");

        var subscriber_message_layout = "{{ base64_decode($widget['widget_config']->subscribe->message_layout) }}";
        var subscriber_message = subscriber_message_layout.replace(":name", data.user_name);

    @if($widget['widget_config']->subscribe->animation != "none" && $widget['widget_config']->subscribe->animation_object != "text")
        for (var i = 0; i < subscriber_message.length; i++) {
            $(".subscriber-message").html($(".subscriber-message").html() + '<span class="char'+ i +' animated {{ $widget['widget_config']->subscribe->animation_object }} infinite {{ $widget['widget_config']->subscribe->animation }}">'+ subscriber_message.charAt(i) +'</span>');
        }
    @else
        $(".subscriber-message").html(subscriber_message);
    @endif

    }

    function showDonationAlert(data)
    {
        document.getElementById("donation-audio").play();
        document.getElementById("donation-audio").volume = {{ ($widget['widget_config']->donation->audio_volume / 100) or 40 }}


        $("#donation-alert").css("opacity", "1");
        $("#donation-alert").css("display", "table");
        now_show = true;

        $(".donation-message").html(" ");
        $(".donation-title").html("");

    @if($widget['widget_config']->donation->message->status == 1)

        var smiles = [];
        var msg_f = data.msg.match(/smile\[([a-z]+)_([0-9]+)\]/g);

        if(msg_f == null)
            msg_f = "";

        for(var j = 0; j < msg_f.length; j++)
        {
            smiles.push(msg_f[j]);
        }

        data.msg = data.msg.replace(/smile\[([a-z]+)_([0-9]+)\]/g, "s[");
        data.msg = data.msg.replace(/<\/?[^>]+>/g,'');


    @if($widget['widget_config']->donation->title->animation != "none" && $widget['widget_config']->donation->title->animation_object != "text")
        for (var i = 0; i < data.msg.length; i++) {
            if(data.msg.charAt(i) == "s") {
                if(data.msg.charAt(i + 1) == "[") {
                    $(".donation-message").html($(".donation-message").html() + '<span class="char'+ i +' animated {{ $widget['widget_config']->donation->message->animation_object }} infinite {{ $widget['widget_config']->donation->message->animation }}"><img src="'+ getSmileUrl(smiles.shift()) +'"></span>');
                    i++;
                } else {
                    $(".donation-message").html($(".donation-message").html() + '<span class="char'+ i +' animated {{ $widget['widget_config']->donation->message->animation_object }} infinite {{ $widget['widget_config']->donation->message->animation }}">'+ data.msg.charAt(i) +'</span>');
                }
            } else {
                $(".donation-message").html($(".donation-message").html() + '<span class="char'+ i +' animated {{ $widget['widget_config']->donation->message->animation_object }} infinite {{ $widget['widget_config']->donation->message->animation }}">'+ data.msg.charAt(i) +'</span>');
            }
        }
    @else
        $(".donation-message").html(data.msg);
        @endif

        var donate_message_layout = "{{ base64_decode($widget['widget_config']->donation->message_layout) }}";
        var donate_message = donate_message_layout.replace(":name", data.user_name);
        donate_message = donate_message.replace(":ammount", data.sum + " " + data.curr);
    @endif

    @if($widget['widget_config']->donation->title->animation != "none" && $widget['widget_config']->donation->title->animation_object != "text")

        for (var i = 0; i < donate_message.length; i++) {
            $(".donation-title").html($(".donation-title").html() + '<span class="char'+ i +' animated {{ $widget['widget_config']->donation->title->animation_object }} infinite {{ $widget['widget_config']->donation->title->animation }}">'+ donate_message.charAt(i) +'</span>');
        }

    @else
        $(".donation-title").html(donate_message)
    @endif

    }

    function showAlert(data, id, token) {
        if(data.alert_type == 1) {
            showFollowerAlert(data);
        }
        if(data.alert_type == 2) {
            showSubscriberAlert(data);
        }
        if(data.alert_type == 3) {
            showDonationAlert(data);
            var MD5 = function(d) {
                d = unescape(encodeURIComponent(d));
                result = M(V(Y(X(d), 8 * d.length)));
                return result.toLowerCase();
            };

            function M(d) {
                for (var _, m = "0123456789ABCDEF", f = "", r = 0; r < d.length; r++) _ = d.charCodeAt(r), f += m.charAt(_ >>> 4 & 15) + m.charAt(15 & _);
                return f
            }

            function X(d) {
                for (var _ = Array(d.length >> 2), m = 0; m < _.length; m++) _[m] = 0;
                for (m = 0; m < 8 * d.length; m += 8) _[m >> 5] |= (255 & d.charCodeAt(m / 8)) << m % 32;
                return _
            }

            function V(d) {
                for (var _ = "", m = 0; m < 32 * d.length; m += 8) _ += String.fromCharCode(d[m >> 5] >>> m % 32 & 255);
                return _
            }

            function Y(d, _) {
                d[_ >> 5] |= 128 << _ % 32, d[14 + (_ + 64 >>> 9 << 4)] = _;
                for (var m = 1732584193, f = -271733879, r = -1732584194, i = 271733878, n = 0; n < d.length; n += 16) {
                    var h = m,
                        t = f,
                        g = r,
                        e = i;
                    f = md5_ii(f = md5_ii(f = md5_ii(f = md5_ii(f = md5_hh(f = md5_hh(f = md5_hh(f = md5_hh(f = md5_gg(f = md5_gg(f = md5_gg(f = md5_gg(f = md5_ff(f = md5_ff(f = md5_ff(f = md5_ff(f, r = md5_ff(r, i = md5_ff(i, m = md5_ff(m, f, r, i, d[n + 0], 7, -680876936), f, r, d[n + 1], 12, -389564586), m, f, d[n + 2], 17, 606105819), i, m, d[n + 3], 22, -1044525330), r = md5_ff(r, i = md5_ff(i, m = md5_ff(m, f, r, i, d[n + 4], 7, -176418897), f, r, d[n + 5], 12, 1200080426), m, f, d[n + 6], 17, -1473231341), i, m, d[n + 7], 22, -45705983), r = md5_ff(r, i = md5_ff(i, m = md5_ff(m, f, r, i, d[n + 8], 7, 1770035416), f, r, d[n + 9], 12, -1958414417), m, f, d[n + 10], 17, -42063), i, m, d[n + 11], 22, -1990404162), r = md5_ff(r, i = md5_ff(i, m = md5_ff(m, f, r, i, d[n + 12], 7, 1804603682), f, r, d[n + 13], 12, -40341101), m, f, d[n + 14], 17, -1502002290), i, m, d[n + 15], 22, 1236535329), r = md5_gg(r, i = md5_gg(i, m = md5_gg(m, f, r, i, d[n + 1], 5, -165796510), f, r, d[n + 6], 9, -1069501632), m, f, d[n + 11], 14, 643717713), i, m, d[n + 0], 20, -373897302), r = md5_gg(r, i = md5_gg(i, m = md5_gg(m, f, r, i, d[n + 5], 5, -701558691), f, r, d[n + 10], 9, 38016083), m, f, d[n + 15], 14, -660478335), i, m, d[n + 4], 20, -405537848), r = md5_gg(r, i = md5_gg(i, m = md5_gg(m, f, r, i, d[n + 9], 5, 568446438), f, r, d[n + 14], 9, -1019803690), m, f, d[n + 3], 14, -187363961), i, m, d[n + 8], 20, 1163531501), r = md5_gg(r, i = md5_gg(i, m = md5_gg(m, f, r, i, d[n + 13], 5, -1444681467), f, r, d[n + 2], 9, -51403784), m, f, d[n + 7], 14, 1735328473), i, m, d[n + 12], 20, -1926607734), r = md5_hh(r, i = md5_hh(i, m = md5_hh(m, f, r, i, d[n + 5], 4, -378558), f, r, d[n + 8], 11, -2022574463), m, f, d[n + 11], 16, 1839030562), i, m, d[n + 14], 23, -35309556), r = md5_hh(r, i = md5_hh(i, m = md5_hh(m, f, r, i, d[n + 1], 4, -1530992060), f, r, d[n + 4], 11, 1272893353), m, f, d[n + 7], 16, -155497632), i, m, d[n + 10], 23, -1094730640), r = md5_hh(r, i = md5_hh(i, m = md5_hh(m, f, r, i, d[n + 13], 4, 681279174), f, r, d[n + 0], 11, -358537222), m, f, d[n + 3], 16, -722521979), i, m, d[n + 6], 23, 76029189), r = md5_hh(r, i = md5_hh(i, m = md5_hh(m, f, r, i, d[n + 9], 4, -640364487), f, r, d[n + 12], 11, -421815835), m, f, d[n + 15], 16, 530742520), i, m, d[n + 2], 23, -995338651), r = md5_ii(r, i = md5_ii(i, m = md5_ii(m, f, r, i, d[n + 0], 6, -198630844), f, r, d[n + 7], 10, 1126891415), m, f, d[n + 14], 15, -1416354905), i, m, d[n + 5], 21, -57434055), r = md5_ii(r, i = md5_ii(i, m = md5_ii(m, f, r, i, d[n + 12], 6, 1700485571), f, r, d[n + 3], 10, -1894986606), m, f, d[n + 10], 15, -1051523), i, m, d[n + 1], 21, -2054922799), r = md5_ii(r, i = md5_ii(i, m = md5_ii(m, f, r, i, d[n + 8], 6, 1873313359), f, r, d[n + 15], 10, -30611744), m, f, d[n + 6], 15, -1560198380), i, m, d[n + 13], 21, 1309151649), r = md5_ii(r, i = md5_ii(i, m = md5_ii(m, f, r, i, d[n + 4], 6, -145523070), f, r, d[n + 11], 10, -1120210379), m, f, d[n + 2], 15, 718787259), i, m, d[n + 9], 21, -343485551), m = safe_add(m, h), f = safe_add(f, t), r = safe_add(r, g), i = safe_add(i, e)
                }
                return Array(m, f, r, i)
            }

            function md5_cmn(d, _, m, f, r, i) {
                return safe_add(bit_rol(safe_add(safe_add(_, d), safe_add(f, i)), r), m)
            }

            function md5_ff(d, _, m, f, r, i, n) {
                return md5_cmn(_ & m | ~_ & f, d, _, r, i, n)
            }

            function md5_gg(d, _, m, f, r, i, n) {
                return md5_cmn(_ & f | m & ~f, d, _, r, i, n)
            }

            function md5_hh(d, _, m, f, r, i, n) {
                return md5_cmn(_ ^ m ^ f, d, _, r, i, n)
            }

            function md5_ii(d, _, m, f, r, i, n) {
                return md5_cmn(m ^ (_ | ~f), d, _, r, i, n)
            }

            function safe_add(d, _) {
                var m = (65535 & d) + (65535 & _);
                return (d >> 16) + (_ >> 16) + (m >> 16) << 16 | 65535 & m
            }

            function bit_rol(d, _) {
                return d << _ | d >>> 32 - _
            }
            var file = MD5(data.msg);
            var tts = function(){
                var audio = new Audio('https://api.ipdonate.com/' + file + '.mp3');
                audio.play();
            };
            setTimeout(tts, 1000);
        }

        setTimeout(function() {
            alertShowed(data.alert_id);
            $("#donation-alert").css("opacity", "0");
            $("#follower-alert").css("opacity", "0");
            $("#subscriber-alert").css("opacity", "0");
            $("#donation-alert").css("display", "none");
            $("#follower-alert").css("display", "none");
            $("#subscriber-alert").css("display", "none");
            now_show = false;

            if(queue.length > 0) {
                setTimeout(function() {
                    showAlert(queue.shift(), id, token);
                }, {{ $widget['widget_config']->next_alert_time * 1000 }});
            }

        }, {{ $widget['widget_config']->alert_time * 1000 }});
    }

    console.log('[Server]: Connecting...');
    Server = new FancyWebSocket('wss://ipdonate.com/websocket');
    var queue = [];
    var now_show = false;
    var now_show_id = 0;
    var can_show = false;

    //Let the user know we're connected
    Server.bind('open', function() {
        console.log("[Server]: Connected.");
        getNotShowedAlert();
    });

    //OH NOES! Disconnection occurred.
    Server.bind('close', function(data) {
        console.log("[Server]: Disconnected.");
    });

    //Log any messages sent from server
    Server.bind('message', function(data) {
        var id = '{{ $widget["widget_id"] }}';
        var token = '{{ $widget["widget_token"] }}';

        data = $.parseJSON(data);
        console.log("[Server]: Message: ");
        console.log(data);



        if(data.token == token) {
            if(data.command == "stop" || data.command == "update") {
                if(data.command == "stop") {
                    if (now_show == true) {
                        now_show_id = data.alert_id;
                        stopShowAlert(data, now_show_id, token);
                    }
                } else {
                    location.href = location.href;
                }
            } else {
            @if ($code == 0)
                if (now_show == false) {
                    now_show_id = data.alert_id;
                    showAlert(data, now_show_id, token);
                } else {
                    queue.push(data);
                }
            @else
            @if($code == 1)
                if(data.alert_type == 1 || data.alert_type == 2){
                    can_show = true;
                } else {
                    can_show = false;
                }
            @elseif($code == 2)
            if(data.alert_type == 1 || data.alert_type == 3){
                    can_show = true;
                } else {
                    can_show = false;
                }
            @elseif($code == 3)
            if(data.alert_type == 2 || data.alert_type == 3){
                    can_show = true;
                } else {
                    can_show = false;
                }
            @elseif($code == 4)
            if(data.alert_type == 1){
                    can_show = true;
                } else {
                    can_show = false;
                }
            @elseif($code == 5)
            if(data.alert_type == 2){
                    can_show = true;
                } else {
                    can_show = false;
                }
            @elseif($code == 6)
            if(data.alert_type == 3){
                    can_show = true;
                } else {
                    can_show = false;
                }
            @endif

            if(can_show) {
                    if (now_show == false) {
                        now_show_id = data.alert_id;
                        showAlert(data, now_show_id, token);
                    } else {
                        queue.push(data);
                    }
                }
            @endif
            }
        }
    });

    Server.connect();

    //Server.send('message', '{"action":"swipe","swipe":"left"}');
</script>
</body>
</html>