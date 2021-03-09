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
<script src="/assets/js/md5.js"></script>

<script>
    function getSmileUrl(smile){var platform=smile.replace(/smile\[([a-z]+)_([0-9]+)\]/g,"$1");var id=smile.replace(/smile\[([a-z]+)_([0-9]+)\]/g,"$2");var smiles_twitch='{{ json_encode($smiles_twitch) }}';var smiles_hitbox='{{ json_encode($smiles_hitbox) }}';smiles_twitch=$.parseJSON(smiles_twitch);smiles_hitbox=$.parseJSON(smiles_hitbox);if(platform=="twitch"){return"https://static-cdn.jtvnw.net/emoticons/v1/"+smiles_twitch[id]+"/1.0"}else{return smiles_hitbox[id]}}function getNotShowedAlert(){$.ajax({url:"/widgets/getalerts/{{ $widget["widget_id"] }}/{{ $widget["widget_token"] }}?code={{ $code }}",type:"POST",success:function(data){data=$.parseJSON(data);console.log(data);for(var i=0;i<data.length;i++){queue.push(data[i])}if(data.length!=0){showAlert(data[data.length-1],{{$widget["widget_id"]}},"{{ $widget["widget_token"] }}")}console.log("[Server]: Waiting alerts: "+data.length)}})}function alertShowed(id){if(id!=0){$.ajax({url:"/widgets/alert/"+id+"/showed",type:"POST"})}}function stopShowAlert(data,id,token){alertShowed(id);$("#donation-alert").css("opacity","0");$("#follower-alert").css("opacity","0");$("#subscriber-alert").css("opacity","0");$("#donation-alert").css("display","none");$("#follower-alert").css("display","none");$("#subscriber-alert").css("display","none");now_show=false;if(queue.length>0){setTimeout(function(){showAlert(queue.shift(),id,token)},{{$widget['widget_config']->next_alert_time*1000}})}}function showFollowerAlert(data){document.getElementById("follower-audio").play();document.getElementById("follower-audio").volume={{($widget['widget_config']->follower->audio_volume/100)or 40}}$("#follower-alert").css("opacity","1");$("#follower-alert").css("display","table");now_show=true;$(".follower-message").html(" ");var follower_message_layout="{{ base64_decode($widget['widget_config']->follower->message_layout) }}";var follower_message=follower_message_layout.replace(":name",data.user_name);@if($widget['widget_config']->follower->animation!="none"&&$widget['widget_config']->follower->animation_object!="text")for(var i=0;i<follower_message.length;i++){$(".follower-message").html($(".follower-message").html()+'<span class="char'+i+' animated {{ $widget['widget_config']->follower->animation_object }} infinite {{ $widget['widget_config']->follower->animation }}">'+follower_message.charAt(i)+'</span>')}@else $(".follower-message").html(follower_message);@endif}function showSubscriberAlert(data){document.getElementById("subscriber-audio").play();document.getElementById("subscriber-audio").volume={{($widget['widget_config']->subscribe->audio_volume/100)or 40}}$("#subscriber-alert").css("opacity","1");$("#subscriber-alert").css("display","table");now_show=true;$(".subscriber-message").html(" ");var subscriber_message_layout="{{ base64_decode($widget['widget_config']->subscribe->message_layout) }}";var subscriber_message=subscriber_message_layout.replace(":name",data.user_name);@if($widget['widget_config']->subscribe->animation!="none"&&$widget['widget_config']->subscribe->animation_object!="text")for(var i=0;i<subscriber_message.length;i++){$(".subscriber-message").html($(".subscriber-message").html()+'<span class="char'+i+' animated {{ $widget['widget_config']->subscribe->animation_object }} infinite {{ $widget['widget_config']->subscribe->animation }}">'+subscriber_message.charAt(i)+'</span>')}@else $(".subscriber-message").html(subscriber_message);@endif}function showDonationAlert(data){document.getElementById("donation-audio").play();document.getElementById("donation-audio").volume={{($widget['widget_config']->donation->audio_volume/100)or 40}}$("#donation-alert").css("opacity","1");$("#donation-alert").css("display","table");now_show=true;$(".donation-message").html(" ");$(".donation-title").html("");@if($widget['widget_config']->donation->message->status==1)var smiles=[];var msg_f=data.msg.match(/smile\[([a-z]+)_([0-9]+)\]/g);if(msg_f==null)msg_f="";for(var j=0;j<msg_f.length;j++){smiles.push(msg_f[j])}data.msg=data.msg.replace(/smile\[([a-z]+)_([0-9]+)\]/g,"s[");data.msg=data.msg.replace(/<\/?[^>]+>/g,'');@if($widget['widget_config']->donation->title->animation!="none"&&$widget['widget_config']->donation->title->animation_object!="text")for(var i=0;i<data.msg.length;i++){if(data.msg.charAt(i)=="s"){if(data.msg.charAt(i+1)=="["){$(".donation-message").html($(".donation-message").html()+'<span class="char'+i+' animated {{ $widget['widget_config']->donation->message->animation_object }} infinite {{ $widget['widget_config']->donation->message->animation }}"><img src="'+getSmileUrl(smiles.shift())+'"></span>');i++}else{$(".donation-message").html($(".donation-message").html()+'<span class="char'+i+' animated {{ $widget['widget_config']->donation->message->animation_object }} infinite {{ $widget['widget_config']->donation->message->animation }}">'+data.msg.charAt(i)+'</span>')}}else{$(".donation-message").html($(".donation-message").html()+'<span class="char'+i+' animated {{ $widget['widget_config']->donation->message->animation_object }} infinite {{ $widget['widget_config']->donation->message->animation }}">'+data.msg.charAt(i)+'</span>')}}@else $(".donation-message").html(data.msg);@endif var donate_message_layout="{{ base64_decode($widget['widget_config']->donation->message_layout) }}";var donate_message=donate_message_layout.replace(":name",data.user_name);donate_message=donate_message.replace(":ammount",data.sum+" "+data.curr);@endif@if($widget['widget_config']->donation->title->animation!="none"&&$widget['widget_config']->donation->title->animation_object!="text")for(var i=0;i<donate_message.length;i++){$(".donation-title").html($(".donation-title").html()+'<span class="char'+i+' animated {{ $widget['widget_config']->donation->title->animation_object }} infinite {{ $widget['widget_config']->donation->title->animation }}">'+donate_message.charAt(i)+'</span>')}@else $(".donation-title").html(donate_message)@endif}function showAlert(data,id,token){if(data.alert_type==1){showFollowerAlert(data)}if(data.alert_type==2){showSubscriberAlert(data)}if(data.alert_type==3){showDonationAlert(data);var file=MD5(data.msg);var tts=function(){var audio=new Audio('https://api.ipdonate.com/'+file+'.mp3');audio.play()};setTimeout(tts,1000)}setTimeout(function(){alertShowed(data.alert_id);$("#donation-alert").css("opacity","0");$("#follower-alert").css("opacity","0");$("#subscriber-alert").css("opacity","0");$("#donation-alert").css("display","none");$("#follower-alert").css("display","none");$("#subscriber-alert").css("display","none");now_show=false;if(queue.length>0){setTimeout(function(){showAlert(queue.shift(),id,token)},{{$widget['widget_config']->next_alert_time*1000}})}},{{$widget['widget_config']->alert_time*1000}})}console.log('[Server]: Connecting...');Server=new FancyWebSocket('wss://ipdonate.com/websocket');var queue=[];var now_show=false;var now_show_id=0;var can_show=false;Server.bind('open',function(){console.log("[Server]: Connected.");getNotShowedAlert()});Server.bind('close',function(data){console.log("[Server]: Disconnected.")});Server.bind('message',function(data){var id='{{ $widget["widget_id"] }}';var token='{{ $widget["widget_token"] }}';data=$.parseJSON(data);console.log("[Server]: Message: ");console.log(data);if(data.token==token){if(data.command=="stop"||data.command=="update"){if(data.command=="stop"){if(now_show==true){now_show_id=data.alert_id;stopShowAlert(data,now_show_id,token)}}else{location.href=location.href}}else{@if($code==0)if(now_show==false){now_show_id=data.alert_id;showAlert(data,now_show_id,token)}else{queue.push(data)}@else@if($code==1)if(data.alert_type==1||data.alert_type==2){can_show=true}else{can_show=false}@elseif($code==2)if(data.alert_type==1||data.alert_type==3){can_show=true}else{can_show=false}@elseif($code==3)if(data.alert_type==2||data.alert_type==3){can_show=true}else{can_show=false}@elseif($code==4)if(data.alert_type==1){can_show=true}else{can_show=false}@elseif($code==5)if(data.alert_type==2){can_show=true}else{can_show=false}@elseif($code==6)if(data.alert_type==3){can_show=true}else{can_show=false}@endif if(can_show){if(now_show==false){now_show_id=data.alert_id;showAlert(data,now_show_id,token)}else{queue.push(data)}}@endif}}});Server.connect();
</script>
</body>
</html>