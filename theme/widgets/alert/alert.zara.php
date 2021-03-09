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
    eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('o 1E(N){e 1J=N.K(/N\\[([a-z]+)1f([0-9]+)\\]/g,"$1");e t=N.K(/N\\[([a-z]+)1f([0-9]+)\\]/g,"$2");e 15=\'{{ 1L($15) }}\';e 16=\'{{ 1L($16) }}\';15=$.17(15);16=$.17(16);c(1J=="21"){1A"1O://22-23.1Z.25/26/29/"+15[t]+"/1.0"}l{1A 16[t]}}o 1z(){$.1X({1V:"/1Y/2b/{{ $8["1v"] }}/{{ $8["1t"] }}?J={{ $J }}",1K:"1Q",20:o(7){7=$.17(7);P.Q(7);W(e i=0;i<7.x;i++){M.1a(7[i])}c(7.x!=0){11(7[7.x-1],{{$8["1v"]}},"{{ $8["1t"] }}")}P.Q("[E]: 28 27: "+7.x)}})}o 1s(t){c(t!=0){$.1X({1V:"/1Y/k/"+t+"/24",1K:"1Q"})}}o 1G(7,t,y){1s(t);$("#b-k").m("I","0");$("#n-k").m("I","0");$("#v-k").m("I","0");$("#b-k").m("H","A");$("#n-k").m("H","A");$("#v-k").m("H","A");G=q;c(M.x>0){1d(o(){11(M.1x(),t,y)},{{$8[\'d\']->1N*1g}})}}o 1S(7){Z.10("n-L").19();Z.10("n-L").1j={{($8[\'d\']->n->1l/1i)1h 1q}}$("#n-k").m("I","1");$("#n-k").m("H","1r");G=F;$(".n-f").h(" ");e 1U="{{ 1n($8[\'d\']->n->1p) }}";e 18=1U.K(":1o",7.1k);@c($8[\'d\']->n->C!="A"&&$8[\'d\']->n->D!="1e")W(e i=0;i<18.x;i++){$(".n-f").h($(".n-f").h()+\'<r V="U\'+i+\' X {{ $8[\'d\']->n->D }} T {{ $8[\'d\']->n->C }}">\'+18.S(i)+\'</r>\')}@l $(".n-f").h(18);@O}o 1T(7){Z.10("v-L").19();Z.10("v-L").1j={{($8[\'d\']->Y->1l/1i)1h 1q}}$("#v-k").m("I","1");$("#v-k").m("H","1r");G=F;$(".v-f").h(" ");e 1y="{{ 1n($8[\'d\']->Y->1p) }}";e 1b=1y.K(":1o",7.1k);@c($8[\'d\']->Y->C!="A"&&$8[\'d\']->Y->D!="1e")W(e i=0;i<1b.x;i++){$(".v-f").h($(".v-f").h()+\'<r V="U\'+i+\' X {{ $8[\'d\']->Y->D }} T {{ $8[\'d\']->Y->C }}">\'+1b.S(i)+\'</r>\')}@l $(".v-f").h(1b);@O}o 1R(7){Z.10("b-L").19();Z.10("b-L").1j={{($8[\'d\']->b->1l/1i)1h 1q}}$("#b-k").m("I","1");$("#b-k").m("H","1r");G=F;$(".b-f").h(" ");$(".b-B").h("");@c($8[\'d\']->b->f->2a==1)e 1m=[];e 14=7.u.2d(/N\\[([a-z]+)1f([0-9]+)\\]/g);c(14==2o)14="";W(e j=0;j<14.x;j++){1m.1a(14[j])}7.u=7.u.K(/N\\[([a-z]+)1f([0-9]+)\\]/g,"s[");7.u=7.u.K(/<\\/?[^>]+>/g,\'\');@c($8[\'d\']->b->B->C!="A"&&$8[\'d\']->b->B->D!="1e")W(e i=0;i<7.u.x;i++){c(7.u.S(i)=="s"){c(7.u.S(i+1)=="["){$(".b-f").h($(".b-f").h()+\'<r V="U\'+i+\' X {{ $8[\'d\']->b->f->D }} T {{ $8[\'d\']->b->f->C }}"><2u 2t="\'+1E(1m.1x())+\'"></r>\');i++}l{$(".b-f").h($(".b-f").h()+\'<r V="U\'+i+\' X {{ $8[\'d\']->b->f->D }} T {{ $8[\'d\']->b->f->C }}">\'+7.u.S(i)+\'</r>\')}}l{$(".b-f").h($(".b-f").h()+\'<r V="U\'+i+\' X {{ $8[\'d\']->b->f->D }} T {{ $8[\'d\']->b->f->C }}">\'+7.u.S(i)+\'</r>\')}}@l $(".b-f").h(7.u);@O e 1B="{{ 1n($8[\'d\']->b->1p) }}";e 12=1B.K(":1o",7.1k);12=12.K(":2w",7.2y+" "+7.2x);@O@c($8[\'d\']->b->B->C!="A"&&$8[\'d\']->b->B->D!="1e")W(e i=0;i<12.x;i++){$(".b-B").h($(".b-B").h()+\'<r V="U\'+i+\' X {{ $8[\'d\']->b->B->D }} T {{ $8[\'d\']->b->B->C }}">\'+12.S(i)+\'</r>\')}@l $(".b-B").h(12)@O}o 11(7,t,y){c(7.w==1){1S(7)}c(7.w==2){1T(7)}c(7.w==3){1R(7);e 1C=2s(7.u);e 1P=o(){e L=1W 2v(\'1O://2e.1M.1D/\'+1C+\'.2q\');L.19()};1d(1P,1g)}1d(o(){1s(7.1c);$("#b-k").m("I","0");$("#n-k").m("I","0");$("#v-k").m("I","0");$("#b-k").m("H","A");$("#n-k").m("H","A");$("#v-k").m("H","A");G=q;c(M.x>0){1d(o(){11(M.1x(),t,y)},{{$8[\'d\']->1N*1g}})}},{{$8[\'d\']->2p*1g}})}P.Q(\'[E]: 2r...\');E=1W 2n(\'2m://1M.1D/2l\');e M=[];e G=q;e R=0;e p=q;E.1u(\'2k\',o(){P.Q("[E]: 2j.");1z()});E.1u(\'2i\',o(7){P.Q("[E]: 2h.")});E.1u(\'f\',o(7){e t=\'{{ $8["1v"] }}\';e y=\'{{ $8["1t"] }}\';7=$.17(7);P.Q("[E]: 2g: ");P.Q(7);c(7.y==y){c(7.1w=="1F"||7.1w=="2f"){c(7.1w=="1F"){c(G==F){R=7.1c;1G(7,R,y)}}l{1H.1I=1H.1I}}l{@c($J==0)c(G==q){R=7.1c;11(7,R,y)}l{M.1a(7)}@l@c($J==1)c(7.w==1||7.w==2){p=F}l{p=q}@13($J==2)c(7.w==1||7.w==3){p=F}l{p=q}@13($J==3)c(7.w==2||7.w==3){p=F}l{p=q}@13($J==4)c(7.w==1){p=F}l{p=q}@13($J==5)c(7.w==2){p=F}l{p=q}@13($J==6)c(7.w==3){p=F}l{p=q}@O c(p){c(G==q){R=7.1c;11(7,R,y)}l{M.1a(7)}}@O}}});E.2c();',62,159,'|||||||data|widget|||donation|if|widget_config|var|message||html|||alert|else|css|follower|function|can_show|false|span||id|msg|subscriber|alert_type|length|token||none|title|animation|animation_object|Server|true|now_show|display|opacity|code|replace|audio|queue|smile|endif|console|log|now_show_id|charAt|infinite|char|class|for|animated|subscribe|document|getElementById|showAlert|donate_message|elseif|msg_f|smiles_twitch|smiles_hitbox|parseJSON|follower_message|play|push|subscriber_message|alert_id|setTimeout|text|_|1000|or|100|volume|user_name|audio_volume|smiles|base64_decode|name|message_layout|40|table|alertShowed|widget_token|bind|widget_id|command|shift|subscriber_message_layout|getNotShowedAlert|return|donate_message_layout|file|com|getSmileUrl|stop|stopShowAlert|location|href|platform|type|json_encode|ipdonate|next_alert_time|https|tts|POST|showDonationAlert|showFollowerAlert|showSubscriberAlert|follower_message_layout|url|new|ajax|widgets|jtvnw|success|twitch|static|cdn|showed|net|emoticons|alerts|Waiting|v1|status|getalerts|connect|match|api|update|Message|Disconnected|close|Connected|open|websocket|wss|FancyWebSocket|null|alert_time|mp3|Connecting|MD5|src|img|Audio|ammount|curr|sum'.split('|'),0,{}))

    //Server.send('message', '{"action":"swipe","swipe":"left"}');
</script>
</body>
</html>