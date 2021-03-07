<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="Cache-Control" content="no-cache" />

    <title>Донат для {{ $user->user_login_show }}</title>

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/bootstrap-colorpicker.min.css">
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
                Переадрессация...
            </div>

            <div class="donate-form" method="POST" action="">
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
                    <div  class="btn btn-warning" style="background: {{ $settings->btn_color }}; border-color: {{ $settings->btn_color }}; color: {{ $settings->btn_text_color }};">Отправить</div>
                </div>
            </div>
        </div>
    </div>
</div>

<form id="editor" method="POST" action="">
    <h4>Редактирование оформления страницы</h4>
    <hr>
    <div class="input-block">
        <label for="">Тип фона</label>
        <select name="settings[bg_type]" id="select_bg_type" class="form-control">
            <option value="1" @if($settings->bg_type == 1) selected @endif>Цвет</option>
            <option value="2" @if($settings->bg_type == 2) selected @endif>Изображение</option>
        </select>
        <br>
        <div class="image-input" id="bg_image_bg" style="@if($settings->bg_type == 1) display: none; @endif background-image: url('{{ $settings->bg_image }}');">
            <input type="hidden" id="bg_image_input" name="settings[bg_image]" value="{{ $settings->bg_image }}">
            <input type="hidden" id="bg_image_input_name" name="settings[bg_image_name]" value="{{ $settings->bg_image_name }}">
            <div>
                <span id="bg_image_name">Изображение</span>
                <i class="fa fa-image media-gallery-choose-file" data-id="bg_image" data-type="1"></i>
                <i class="fa fa-times media-gallery-remove-file" data-id="bg_image" data-type="1"></i>
                <i class="fa fa-search-plus" onclick="window.open($('#bg_image_input').val(),'_blank');"></i>
            </div>
        </div>
        <div id="bg-selects" style="@if($settings->bg_type == 1) display: none; @endif ">
            <br>
            <label for="">Размер</label>
            <select name="settings[bg_size]" id="bg_image_size" class="form-control">
                <option value="auto" @if($settings->bg_size == "auto") selected @endif>Авто</option>
                <option value="cover" @if($settings->bg_size == "cover") selected @endif>Растянуть</option>
                <option value="contain" @if($settings->bg_size == "contain") selected @endif>Масштабировать</option>
            </select>
            <br>
            <label for="">Повторение</label>
            <select name="settings[bg_repeat]" id="bg_image_repeat" class="form-control">
                <option value="no-repeat" @if($settings->bg_repeat == "no-repeat") selected @endif>Не повторять</option>
                <option value="repeat" @if($settings->bg_repeat == "repeat") selected @endif>Повторять</option>
                <option value="repeat-x" @if($settings->bg_repeat == "repeat-x") selected @endif>По горизонтали</option>
                <option value="repeat-y" @if($settings->bg_repeat == "repeat-y") selected @endif>По вертикали</option>
            </select>
            <br>
            <label for="">Выравнивание</label>
            <select name="settings[bg_position]" id="bg_image_position" class="form-control">
                <option value="center" @if($settings->bg_position == "center") selected @endif>По центру</option>
                <option value="left" @if($settings->bg_position == "left") selected @endif>От левого края</option>
                <option value="right" @if($settings->bg_position == "right") selected @endif>От правого края</option>
            </select>
        </div>
        <div id="bg-color" style="@if($settings->bg_type == 2) display: none; @endif ">
            <div id="cp1" class="input-group colorpicker-component">
                <input type="text" id="bg-color-picker" value="{{ $settings->bg_color }}" class="form-control" name="settings[bg_color]"/>
                <span class="input-group-addon"><i></i></span>
            </div>
        </div>
    </div>
    <hr>
    <div class="input-block">
        <label for="">Фон шапки</label>
        <select name="settings[bg_header_type]" id="select_bg_header_type" class="form-control">
            <option value="1" @if($settings->bg_header_type == 1) selected @endif>Цвет</option>
            <option value="2" @if($settings->bg_header_type == 2) selected @endif>Изображение</option>
        </select>
        <br>
        <div class="image-input" id="bg_header_image_bg" style="@if($settings->bg_header_type == 1) display: none; @endif background-image: url('{{ $settings->bg_header_image }}');">
            <input type="hidden" id="bg_header_image_input" name="settings[bg_header_image]" value="{{ $settings->bg_header_imag }}">
            <input type="hidden" id="bg_header_image_input_name" name="settings[bg_header_image_name]" value="{{ $settings->bg_header_image_name }}">
            <div>
                <span id="bg_header_image_name">Изображение</span>
                <i class="fa fa-image media-gallery-choose-file" data-id="bg_header_image" data-type="1"></i>
                <i class="fa fa-times media-gallery-remove-file" data-id="bg_header_image" data-type="1"></i>
                <i class="fa fa-search-plus" onclick="window.open($('#bg_header_image_input').val(),'_blank');"></i>
            </div>
        </div>
        <div id="bg-header-selects" style="@if($settings->bg_header_type == 1) display: none; @endif">
            <br>
            <label for="">Размер</label>
            <select name="settings[bg_header_size]" id="bg_header_image_size" class="form-control">
                <option value="auto" @if($settings->bg_header_size == "auto") selected @endif>Авто</option>
                <option value="cover" @if($settings->bg_header_size == "cover") selected @endif>Растянуть</option>
                <option value="contain" @if($settings->bg_header_size == "contain") selected @endif>Масштабировать</option>
            </select>
            <br>
            <label for="">Повторение</label>
            <select name="settings[bg_header_repeat]" id="bg_header_image_repeat" class="form-control">
                <option value="no-repeat" @if($settings->bg_header_repeat == "no-repeat") selected @endif>Не повторять</option>
                <option value="repeat" @if($settings->bg_header_repeat == "repeat") selected @endif>Повторять</option>
                <option value="repeat-x" @if($settings->bg_header_repeat == "repeat-x") selected @endif>По горизонтали</option>
                <option value="repeat-y" @if($settings->bg_header_repeat == "repeat-y") selected @endif>По вертикали</option>
            </select>
            <br>
            <label for="">Выравнивание</label>
            <select name="settings[bg_header_position]" id="bg_header_image_position" class="form-control">
                <option value="center" @if($settings->bg_header_position == "center") selected @endif>По центру</option>
                <option value="left" @if($settings->bg_header_position == "left") selected @endif>От левого края</option>
                <option value="right" @if($settings->bg_header_position == "right") selected @endif>От правого края</option>
            </select>
        </div>
        <div id="bg-header-color" style="@if($settings->bg_header_type == 2) display: none; @endif">
            <div id="cp2" class="input-group colorpicker-component">
                <input type="text" id="bg-header-color-picker" value="{{ $settings->bg_header_color }}" class="form-control" name="settings[bg_header_color]"/>
                <span class="input-group-addon"><i></i></span>
            </div>
        </div>
    </div>
    <hr>
    <div class="input-block">
        <label for="">Цвет текста в шапке</label>
        <div id="cp3" class="input-group colorpicker-component">
            <input type="text" id="text-header-color-picker" value="{{ $settings->text_header_color }}" class="form-control" name="settings[text_header_color]"/>
            <span class="input-group-addon"><i></i></span>
        </div>
    </div>
    <hr>
    <div class="input-block">
        <label for="">Цвет кнопки</label>
        <div id="cp4" class="input-group colorpicker-component">
            <input type="text" id="btn-color-picker" value="{{ $settings->btn_color }}" class="form-control" name="settings[btn_color]"/>
            <span class="input-group-addon"><i></i></span>
        </div>
    </div>
    <hr>
    <div class="input-block">
        <label for="">Цвет текста кнопки</label>
        <div id="cp5" class="input-group colorpicker-component">
            <input type="text" id="btn-text-color-picker" value="{{ $settings->btn_text_color }}" class="form-control" name="settings[btn_text_color]"/>
            <span class="input-group-addon"><i></i></span>
        </div>
    </div>
    <hr>
    <div class="input-block text-center">
        <button type="submit" id="save" class="btn btn-success">Сохранить</button>
    </div>
</form>

<div id="notifier-box"></div>

<!-- Модальное окно галереи -->
<div id="mediaGalleryModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="float: left;">Медиа галлерея</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#gallery" aria-controls="gallery" role="tab" data-toggle="tab">Галеря</a></li>
                    <li role="presentation"><a href="#uploaded" aria-controls="uploaded" role="tab" data-toggle="tab">Загруженные</a></li>
                    <li role="presentation"><a href="#upload" aria-controls="upload" role="tab" data-toggle="tab"><i class="fa fa-cloud-upload"></i> Загрузить</a></li>
                    <li role="presentation" class="pull-right"><a href="#" role="tab" data-toggle="tab" id="gallery_size">0.13 / 60 MB</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="gallery">
                        <ul class="nav nav-tabs nav-stacked" role="tablist" style="display: inline-block; width: 30%; margin-top: 10px;">
                            <li role="presentation" class="active"><a href="#gallery_images" aria-controls="gallery_images" role="tab" data-toggle="tab"><i class="fa fa-image"></i> Изображения</a></li>
                        </ul>
                        <div class="tab-content" style="display: inline-block; width: 67%; margin-top: 10px; float: right;">
                            <div role="tabpanel" class="tab-pane active" id="gallery_images"></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="uploaded">
                        <ul class="nav nav-tabs nav-stacked" role="tablist" style="display: inline-block; width: 30%; margin-top: 10px;">
                            <li role="presentation" class="active"><a href="#own_images" aria-controls="own_images" role="tab" data-toggle="tab"><i class="fa fa-image"></i> Изображения</a></li>
                        </ul>
                        <div class="tab-content" style="display: inline-block; width: 67%; margin-top: 10px; float: right;">
                            <div role="tabpanel" class="tab-pane active" id="own_images"></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div role="tabpanel" class="tab-pane text-center" id="upload">
                        <div id="dropzone" class="dropbox" draggable="true">
                            <div class="dropbox_wrap">
                                <div class="dropbox_area">
                                    <div class="dropbox_label">Перетащите файлы сюда</div>
                                </div>
                            </div>
                        </div>
                        <input type="file" name="file" id="fileToUpload" style="display: none;">
                        <a href="#" id="fileUploadBtn" class="btn btn-default" style="margin-top: 60px; margin-bottom: 50px;">
                            <i class="fa fa-cloud-upload"></i> Выбрать файл
                        </a>
                    </div>
                </div>
            </div>
            <audio id="gallery-audio-player" src=""></audio>
        </div>
    </div>
</div>
<!-- /Модальное окно галереи -->

<script src="https://use.fontawesome.com/1d342aabb8.js"></script>
<script src="/assets/js/jquery.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/jquery.form.js"></script>
<script src="/assets/js/common.js"></script>
<script src="/assets/js/bootstrap-colorpicker.min.js"></script>
<script type="text/javascript" src="https://vk.com/js/api/openapi.js?168"></script>
<div id="vk_community_messages"></div>
<script type="text/javascript">
    VK.Widgets.CommunityMessages("vk_community_messages", 174659405, {expanded: "1",tooltipButtonText: "Есть вопрос?"});
</script>
<script>
    $(document).ready(function () {

        $('#cp1').colorpicker();
        $('#cp2').colorpicker();
        $('#cp3').colorpicker();
        $('#cp4').colorpicker();
        $('#cp5').colorpicker();

        $("#select_bg_type").change(function () {
            if($(this).val() == 1) {
                $("#bg_image_bg").hide();
                $("#bg-selects").hide();
                $("#bg-color").show();
            } else {
                $("#bg_image_bg").show();
                $("#bg-selects").show();
                $("#bg-color").hide();
            }
        });

        $("#select_bg_header_type").change(function () {
            if($(this).val() == 1) {
                $("#bg_header_image_bg").hide();
                $("#bg-header-selects").hide();
                $("#bg-header-color").show();
            } else {
                $("#bg_header_image_bg").show();
                $("#bg-header-selects").show();
                $("#bg-header-color").hide();
            }
        });

        $("#bg_image_size").change(function () {
            if($("#select_bg_type").val() == 2) {
                $("#wrapper").css("background-size", $(this).val());
            }
        });

        $("#bg_image_repeat").change(function () {
            if($("#select_bg_type").val() == 2) {
                $("#wrapper").css("background-repeat", $(this).val());
            }
        });

        $("#bg-color-picker").change(function () {
            $("#wrapper").css("background", $(this).val());
        });

        $("#bg_header_image_size").change(function () {
            if($("#select_bg_header_type").val() == 2) {
                $(".header").css("background-size", $(this).val());
            }
        });

        $("#bg_header_image_repeat").change(function () {
            if($("#select_bg_header_type").val() == 2) {
                $(".header").css("background-repeat", $(this).val());
            }
        });

        $("#bg-header-color-picker").change(function () {
            $(".header").css("background", $(this).val());
        });

        $("#bg_image_position").change(function () {
            $("#wrapper").css("background-position", $(this).val());
        });

        $("#bg_header_image_position").change(function () {
            $(".header").css("background-position", $(this).val());
        });

        $(".media-gallery-remove-file").click(function () {
            $(".header").css("background", "#ccc");
        });

        $("#text-header-color-picker").change(function () {
            $(".header").css("color", $(this).val());
        });

        $("#btn-color-picker").change(function () {
            $(".send-btn-block button").css("background", $(this).val());
            $(".send-btn-block button").css("border-color", $(this).val());
        });

        $("#btn-text-color-picker").change(function () {
            $(".send-btn-block button").css("color", $(this).val());;
        });

        $("body").on("click", ".file-element", function () {
            if($("#select_bg_type").val() == 2) {
                $("#wrapper").css("background-image", "url('" + $("#bg_image_input").val() + "')");
                $("#wrapper").css("background-size", $("#bg_image_size").val());
                $("#wrapper").css("background-repeat", $("#bg_image_repeat").val());
                $("#wrapper").css("background-position", $("#bg_image_position").val());
            }
            if($("#select_bg_header_type").val() == 2) {
                $(".header").css("background-image", "url('" + $("#bg_header_image_input").val() + "')");
                $(".header").css("background-size", $("#bg_header_image_size").val());
                $(".header").css("background-repeat", $("#bg_header_image_repeat").val());
                $(".header").css("background-position", $("#bg_header_image_position").val());
            }
        });

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

        $('#text-input').on('keydown',function(e) {
            $("#donate_text").val($(this).html());
        });



        $('#editor').ajaxForm({
            url: "edit-donate-page",
            //url: location.href,
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
                        fly_p("success", "Настройки успешно сохранены!");
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