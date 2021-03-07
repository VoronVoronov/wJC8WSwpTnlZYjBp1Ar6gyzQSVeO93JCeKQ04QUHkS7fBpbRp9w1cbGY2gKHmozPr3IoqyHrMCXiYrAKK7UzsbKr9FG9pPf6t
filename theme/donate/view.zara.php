<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="Cache-Control" content="no-cache" />

    <title>IPDonate</title>

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">

    @yield("styles")

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

@if($settings->bg_type == 1)
<body id="wrapper" style="background: {{ $settings->bg_color }};">
@else
<body id="wrapper" style="background-image: url('{{ $settings->bg_image }}'); background-size: {{ $settings->bg_size }}; background-position: {{ $settings->bg_position }}; background-repeat: {{ $settings->bg_repeat }};">
@endif

<div>
    <div class="content row container">
        <div class="donate-container">
            @if($settings->bg_header_type == 1)
            <div class="header" style="background: {{ $settings->bg_header_color }};">
            @else
            <div class="header" style="background-image: url('{{ $settings->bg_header_image }}'); background-size: {{ $settings->bg_header_size }}; background-position: {{ $settings->bg_header_position }}; background-repeat: {{ $settings->bg_header_repeat }};">
                @endif
                <img src="{{ $user->user_avatar }}" alt="">
                <i class="status-offline"></i>
                <h3>{{ $user->user_login_show }}</h3>
            </div>

            <div id="payment-redirect">
                <hr>
                Переадресация...
            </div>

            <form class="donate-form" id="donate-form" method="POST" action="">
                @if(!empty($settings->text))
                {{ base64_decode($settings->text) }}
                <hr>
                @endif
                <div class="input-block">
                    <label for="">Ваше имя</label>
                    <input type="text" name="user_name" class="form-control" value="{{ cookie("user_name")->getValue() }}">
                </div>
                <div class="input-block">
                    <label for="">Сумма доната</label>
                    <div class="input-group">
                        <input type="number" name="donate_sum" id="donate_sum" class="form-control" value="{{ $settings->rec_sum }}">
                        <span class="input-group-addon">руб.</span>
                    </div>
                </div>
                <div class="input-block">
                    <label for="">Ваше сообщение</label>
                    <span class="text-counter">
                    <p id="text-symbols">0</p> / 300
                </span>
                    <i class="icon icon-smiles" data-template='<div class="popover" style="max-height: 200px; min-width: 297px; overflow-y: auto;" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>' data-container="body" data-toggle="popover" data-placement="top" data-html="true" data-content=""></i>
                    <div contenteditable="true" class="form-control" style="height: 120px; overflow: auto; padding-right: 26px;" id="text-input"></div>
                    <textarea class="form-control" name="donate_text" id="donate_text" style="display:none;"></textarea>
                </div>
                <hr>
                @if(count($goals) > 1)
                <div class="input-block">
                    <label for="">Сбор средств</label>
                    <span class="tip">У пользователя организован сбор средств на различные цели, отправляя сообщение,
                    Вы можете выбрать одну из них.</span>
                    @foreach($goals as $goal)
                    <label class="radio-inline">
                        <input type="radio" name="goal_id" value="{{ $goal['widget_id'] }}" checked> {{ base64_decode($goal['widget_config']->goal_title) }}
                    </label>
                    @endforeach
                </div>
                <hr>
                @else
                <input type="hidden" name="goal_id" value="{{ $goals[0]['widget_id'] }}">
                @endif
                @if(isset($vote))
                <div class="input-block">
                    <label for="">{{ base64_decode($vote->widget_config->title) }}</label>
                    @foreach($vote->widget_config->variants as $key => $variant)
                    <label class="radio-inline vote-bar" style="background-position-x: -{{ $variant['bar_percent'] }}px;">
                        <input type="radio" name="vote" value="{{ $vote->widget_id }}_{{ $key }}"> {{ $variant['name'] }}
                        <span class="vote-variant-percent">{{ $variant['percent'] }}%</span>
                    </label>
                    @endforeach
                </div>
                <hr>
                @endif
                <div class="input-block agreement-text">
                    Нажимая на кнопку "<b>Отправить</b>", Вы принимаете <a href="https://ipdonate.com/oferta">Условия предоставления услуг</a>
                </div>

                <div class="input-block send-btn-block">
                    <button type="submit" class="btn btn-warning" style="background: {{ $settings->btn_color }}; border-color: {{ $settings->btn_color }}; color: {{ $settings->btn_text_color }};">Отправить</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="notifier-box"></div>
<!-- /#wrapper -->

<script src="https://use.fontawesome.com/1d342aabb8.js"></script>
<script src="/assets/js/jquery.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/jquery.form.js"></script>
<script src="/assets/js/common.js"></script>
    <script type="text/javascript" src="https://vk.com/js/api/openapi.js?168"></script>
    <div id="vk_community_messages"></div>
    <script type="text/javascript">
        VK.Widgets.CommunityMessages("vk_community_messages", 174659405, {expanded: "1",tooltipButtonText: "Есть вопрос?"});
    </script>
<script>
    $(document).ready(function () {

        $(".icon-smiles").attr("data-content", '' +
            @foreach($smiles as $smile)
                @if(!empty($smile["smile_image_id"]))
                '<a href="#"><img class="smile" data-platform="twitch" data-smile-id="{{ $smile['smile_id'] }}" src="https://static-cdn.jtvnw.net/emoticons/v1/{{ $smile["smile_image_id"] }}/1.0"></a>' +
                @else
                '<a href="#"><img class="smile" data-platform="hitbox" data-smile-id="{{ $smile['smile_id'] }}" src="{{ $smile["smile_image"] }}"></a>' +
                @endif
            @endforeach
            '</div>');

        $('body').on('click', 'a .smile', function(){
            $("#text-input").html($("#text-input").html() + '<img class="smile-text" platform="'+ $(this).attr("data-platform") +'" smile-id="'+ $(this).attr("data-smile-id") +'" src="'+ $(this).attr("src") +'">');
            $("#donate_text").val($("#text-input").html());
            return false;
        });

        setInterval(function () {
            var text = $("#text-input").html();
            text = text.replace(/<\/?[^>]+>/g,'');
            text = $.trim(text);
            text = text.replace("&nbsp;", " ");

            $("#text-symbols").html(text.length);
        }, 100);

        $('#text-input').on('keydown', function(e) {
            $("#donate_text").val($(this).html());
        });

        $('#donate-form').ajaxForm({
            url: location.href,
            dataType: 'text',
            success: function(data) {
                console.log(data);
                data = $.parseJSON(data);
                switch(data.status) {
                    case 'error':
                        fly_p('danger', data.error);
                        $('button[type=submit]').prop('disabled', false);
                        break;
                    case 'success':
                        $("#donate-form").hide();
                        $("#payment-redirect").show();
                        setTimeout (function (){
                            location.href = "/payment/"+ data.id;
                        }, 1000);
                        break;
                }
            },
            beforeSubmit: function(arr, $form, options) {
                $('button[type=submit]').prop('disabled', true);
            }
        });
    });
</script>

</body>
</html>
