@extends("_common/main")
@section("content")
<div class="page-name">
    <h2>Внутристримовая статистика</h2>
    <div class="clear"></div>
</div>

<div class="row">
    <div class="col-md-9" style="margin-bottom: 20px;">
        <div class="input-group">
            <div class="widget-url-guard-alert-box form-control">
                <i class="fa fa-lock"></i> Нажмите для просмотра адреса виджета
            </div>
            <input class="form-control widget-url-alert" value="{{ config()->url }}widget/{{ $widget['widget_token'] }}" style="display: none;">
            <div class="input-group-btn">
                <button type="button" class="btn btn-default windget-start-btn" onclick="window.open('{{ config()->url }}widget/{{ $widget['widget_token'] }}?bg=true', 'alert-widget', 'menubar=0,resizable=1,width=1000,height=600').focus();">
                    Запустить
                </button>
            </div>
        </div>
    </div>
</div>

<form action="" method="POST">
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#main" aria-controls="main" role="tab" data-toggle="tab">Основные настройки</a></li>
                <li role="presentation"><a href="#design" aria-controls="design" role="tab" data-toggle="tab">Оформление виджета</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content" style="padding-top: 15px">
                <div role="tabpanel" class="tab-pane active" id="main">

                    <div class="row" style="margin-top: 10px"> <!-- Шаблон текста -->
                        <div class="col-md-3 text-right" style="padding-top: 3px;">
                            Шаблон текста:
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="stats_layout_message" name="config[stats_layout]" value="{{ base64_decode($widget['widget_config']->stats_layout) }}" data-toggle="tooltip" data-placement="top" title="Доступные теги: :name, :ammount, :message">
                        </div>
                        <div class="col-md-1" style="padding-top: 6px;">
                            <i class="fa fa-question-circle fa-fw" data-toggle="tooltip" data-placement="top" title="Вы можете изменить шаблон выводимого текста"></i>
                        </div>
                    </div> <!-- /Шаблон текста -->

                    <div class="row" style="margin-top: 10px"> <!-- Тип статистики -->
                        <div class="col-md-3 text-right" style="padding-top: 3px;">
                            Тип статистики:
                        </div>
                        <div class="col-md-5">
                            <select class="form-control" id="stats_type" name="config[stats_type]">
                                <option value="0" disabled selected>Выберите тип</option>
                                <option value="1" @if($widget['widget_config']->stats_type == 1) selected @endif>Последние сообщения</option>
                                <option value="2" @if($widget['widget_config']->stats_type == 2) selected @endif>Самые дорогие сообщения</option>
                                <option value="3" @if($widget['widget_config']->stats_type == 3) selected @endif>Самые крупные отправители сообщений</option>
                                <option value="4" @if($widget['widget_config']->stats_type == 4) selected @endif>Собранная сумма</option>
                            </select>
                        </div>
                    </div> <!-- /Тип статистики -->

                    <div class="row" style="margin-top: 10px"> <!-- Временной отрезок -->
                        <div class="col-md-3 text-right" style="padding-top: 3px;">
                            Временной отрезок:
                        </div>
                        <div class="col-md-5">
                            <select class="form-control" name="config[stats_time]">
                                <option value="1" @if($widget['widget_config']->stats_time == 1) selected @endif>За текущий стрим</option>
                                <option value="2" @if($widget['widget_config']->stats_time == 2) selected @endif>За прошлый стрим</option>
                                <option value="3" @if($widget['widget_config']->stats_time == 3) selected @endif>За всё время</option>
                                <option value="4" @if($widget['widget_config']->stats_time == 4) selected @endif>За текущий день</option>
                                <option value="5" @if($widget['widget_config']->stats_time == 5) selected @endif>За текущую неделю</option>
                                <option value="6" @if($widget['widget_config']->stats_time == 6) selected @endif>За текущий месяц</option>
                                <option value="7" @if($widget['widget_config']->stats_time == 7) selected @endif>За текущи год</option>
                            </select>
                        </div>
                    </div> <!-- /Временной отрезок -->
                </div>
                <div role="tabpanel" class="tab-pane" id="design">
                    <div class="form-horizontal">
                        <hr>
                        <div class="row" id="stats_view_type" style="margin-top: 10px"> <!-- Временной отрезок -->
                            <div class="col-md-3 text-right" style="padding-top: 3px;">
                                Режим отображения:
                            </div>
                            <div class="col-md-5">
                                <select class="form-control" name="config[stats_view_type]">
                                    <option value="1" @if($widget['widget_config']->stats_view_type == 1) selected @endif>Бегущая строка</option>
                                    <option value="2" @if($widget['widget_config']->stats_view_type == 2) selected @endif>Слайдер</option>
                                    <option value="3" @if($widget['widget_config']->stats_view_type == 3) selected @endif>Список</option>
                                </select>
                            </div>
                        </div> <!-- /Режим отображения -->

                        <div class="row" id="stats_elements" style="margin-top: 10px;"> <!-- Количетво элементов -->
                            <div class="col-md-3 text-right">
                                Количество элементов:
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" style="padding: 0px 15px;">
                                    <input type="range" class="form-control" id="stats_elements_range" name="config[stats_elements]" style="width: 100%">
                                </div>
                            </div>
                        </div> <!-- /Количетво элементов -->
                        <hr>
                        <div class="row" style="margin-top: 10px"> <!-- Стиль текста -->
                            <div class="col-md-3 text-right" style="padding-top: 3px;">
                                Стиль текста:
                            </div>
                            <div class="col-md-5">
                                <a href="#" class="btn btn-default btn-sm styleStatsBtn" onclick="$('#styleStatsModal').modal('show'); return false;"><i class="fa fa-font"></i> Изменить</a>
                            </div>
                        </div> <!-- /Стиль текста -->
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 30px">
                <div class="form-group col-lg-12 text-center">
                    <hr>
                    <input type="submit" class="btn btn-success" value="Сохранить">
                </div>
            </div>
        </div>
    </div>

<!-- Модальные окна настроек стилей сообщений -->
<div id="styleStatsModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Стиль текста</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="previewsDemo well well-sm" id="styleStatsPreview">
                        <div id="styleStatsPreviewText"></div>
                    </div>
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label for="style_stats_font_family" class="col-sm-3 control-label">Шрифт</label>
                            <div class="col-sm-9">
                                <select name="config[stats][text][font_family]" class="form-control" id="style_stats_font_family">
                                    <option value="0" selected disabled>Выберите шрифт</option>
                                    <option value="Roboto Condensed" @if($widget['widget_config']->stats->text->font_family == "Roboto Condensed") selected @endif>Roboto Condensed</option>
                                    <option value="Open Sans" @if($widget['widget_config']->stats->text->font_family == "Open Sans") selected @endif>Open Sans</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Размер шрифта</label>
                            <div class="col-sm-9">
                                <div class="form-group" style="padding: 0px 15px;">
                                    <input type="range" class="form-control" id="style_stats_font_size" name="config[stats][text][font_size]" style="width: 100%">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Цвет текста</label>
                            <div class="col-sm-4">
                                <div id="cp4" class="input-group colorpicker-component">
                                    <input type="text" id="style_stats_color" value="{{ $widget['widget_config']->stats->text->color }}" class="form-control" name="config[stats][text][color]"/>
                                    <span class="input-group-addon"><i></i></span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Жирный</label>
                            <div class="col-sm-9">
                                <div class="checkbox">
                                    <input type="checkbox" id="style_stats_weight" name="config[stats][text][weight]" value="true" @if($widget['widget_config']->stats->text->weight) checked @endif>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Курсив</label>
                            <div class="col-sm-9">
                                <div class="checkbox">
                                    <input type="checkbox" id="style_stats_italic" name="config[stats][text][italic]" value="true" @if($widget['widget_config']->stats->text->italic) checked @endif>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Подчеркивание</label>
                            <div class="col-sm-9">
                                <div class="checkbox">
                                    <input type="checkbox" id="style_stats_underline" name="config[stats][text][underline]" value="true" @if($widget['widget_config']->stats->text->underline) checked @endif>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="style_stats_transformation" class="col-sm-3 control-label">Трансформация</label>
                            <div class="col-sm-9">
                                <select name="config[stats][text][transformation]" class="form-control" id="style_stats_transformation">
                                    <option value="none" @if($widget['widget_config']->stats->text->transformation == "none") selected @endif>Нет</option>
                                    <option value="uppercase" @if($widget['widget_config']->stats->text->transformation == "uppercase") selected @endif>Все буквы прописные</option>
                                    <option value="lowercase" @if($widget['widget_config']->stats->text->transformation == "lowercase") selected @endif>Все буквы строчные</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Размер тени</label>
                            <div class="col-sm-9">
                                <div class="form-group" style="padding: 0px 15px;">
                                    <input type="range" class="form-control" id="style_stats_shadow_size" name="config[stats][text][shadow_size]" style="width: 100%">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Цвет тени</label>
                            <div class="col-sm-4">
                                <div id="cp5" class="input-group colorpicker-component">
                                    <input type="text" id="style_stats_shadow_color" value="{{ $widget['widget_config']->stats->text->shadow_color }}" class="form-control" name="config[stats][text][shadow_color]"/>
                                    <span class="input-group-addon"><i></i></span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="style_stats_aling" class="col-sm-3 control-label">Выравнивание текста</label>
                            <div class="col-sm-9">
                                <select name="config[stats][text][aling]" class="form-control" id="style_stats_aling">
                                    <option value="left" @if($widget['widget_config']->stats->text->aling == "left") selected @endif>По левому краю</option>
                                    <option value="right" @if($widget['widget_config']->stats->text->aling == "right") selected @endif>По правому краю</option>
                                    <option value="center" @if($widget['widget_config']->stats->text->aling == "center") selected @endif>По центру</option>
                                    <option value="justify" @if($widget['widget_config']->stats->text->aling == "justify") selected @endif>По всей ширине</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <button type="submit" class="btn btn-xs btn-default" data-dismiss="modal" aria-label="Close">Закрыть редактор</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- /Модальные окна настроек стилей сообщений -->
</form>
@stop

@section("styles")
<link rel="stylesheet" href="/assets/css/bootstrap-colorpicker.min.css">
<link rel="stylesheet" href="/assets/css/bootstrap-slider.min.css">
<link rel="stylesheet" href="/assets/css/widget.css">

<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300&subset=latin,cyrillic-ext,cyrillic,latin-ext' rel='stylesheet' type='text/css'>
@stop
<script type="text/javascript" src="https://vk.com/js/api/openapi.js?162"></script>

<!-- VK Widget -->
<div id="vk_community_messages"></div>
<script type="text/javascript">
VK.Widgets.CommunityMessages("vk_community_messages", 190202028, {tooltipButtonText: "Здравствуйте,чем могу вам помочь?"});
</script>
@section("plugins-scripts")
<script src="/assets/js/bootstrap-colorpicker.min.js"></script>
<script src="/assets/js/bootstrap-slider.min.js"></script>
@stop

@section("scripts")
<script>
    $(".widget-url-guard-alert-box").click(function() {
        $(this).hide();
        $(".widget-url-alert").show();
    });

    $(function() {
        $('#cp4').colorpicker();
        $('#cp5').colorpicker();
    });

    $('#stats_elements_range').slider({
        min: 1,
        max: 100,
        value: {{ $widget['widget_config']->stats_elements or 10 }},
        formatter: function(value) {
            return value;
        }
    });

    $('#style_stats_font_size').slider({
        min: 8,
        max: 110,
        value: {{ $widget['widget_config']->stats->text->font_size or 64 }},
        formatter: function(value) {
            return value + "px";
        }
    });

    $('#style_stats_shadow_size').slider({
        min: 0,
        max: 100,
        value: {{ $widget['widget_config']->stats->text->shadow_size or 1 }},
        formatter: function(value) {
            return value + "px";
        }
    });

    //Фунции
    function changePreviewStyle(type)
    {
        var bigType;
        var demoText;
        if(type == "stats") {
            bigType = "Stats";

            if($("#stats_type").val() != 4) {
                demoText = $("#stats_layout_message").val();
                demoText = demoText.replace(":name", "{{ $user->user_login_show }}");
                demoText = demoText.replace(":ammount", "{{ rand(10, 100) }} USD");
                demoText = demoText.replace(":message", "Сообщение");
            } else {
                demoText = "{{ rand(10, 100) }} USD";
            }
        }

        $("#style" + bigType + "PreviewText").html(demoText);

        $("#style" + bigType + "PreviewText").css("font-family", $("#style_" + type + "_font_family").val());
        $("#style" + bigType + "PreviewText").css("font-size", $("#style_" + type + "_font_size").val() + "px");
        $("#style" + bigType + "PreviewText").css("color", $("#style_" + type + "_color").val());
        if($("#style_" + type + "_weight").prop('checked')) {
            $("#style" + bigType + "PreviewText").css("font-weight", "bold");
        } else {
            $("#style" + bigType + "PreviewText").css("font-weight", "normal");
        }
        if($("#style_" + type + "_italic").prop('checked')) {
            $("#style" + bigType + "PreviewText").css("font-style", "italic");
        } else {
            $("#style" + bigType + "PreviewText").css("font-style", "normal");
        }
        if($("#style_" + type + "_underline").prop('checked')) {
            $("#style" + bigType + "PreviewText").css("text-decoration", "underline");
        } else {
            $("#style" + bigType + "PreviewText").css("text-decoration", "none");
        }
        $("#style" + bigType + "PreviewText").css("text-shadow", "0px 0px " + $("#style_" + type + "_shadow_size").val() + "px rgb(0, 0, 0), 0px 0px " +
            (parseInt($("#style_" + type + "_shadow_size").val()) + 1) + "px "+ $("#style_" + type + "_shadow_color").val() +", 0px 0px " +
            (parseInt($("#style_" + type + "_shadow_size").val()) + 2) + "px "+ $("#style_" + type + "_shadow_color").val() +", 0px 0px " +
            (parseInt($("#style_" + type + "_shadow_size").val()) + 3) + "px "+ $("#style_" + type + "_shadow_color").val());
        $("#style" + bigType + "PreviewText").css("text-transform", $("#style_" + type + "_transformation").val());
        $("#style" + bigType + "PreviewText").css("text-align", $("#style_" + type + "_aling").val());
    }

    $("#style_stats_font_family, #style_stats_font_size, #style_stats_color, #style_stats_weight, " +
        "#style_stats_italic, #style_stats_underline, #style_stats_shadow_size, " +
        "#style_stats_transformation, #style_stats_shadow_color, " +
        "#style_stats_aling, #style_stats_font_size_input, #style_stats_shadow_size_input").change(function() {
        changePreviewStyle("stats");
    });

    $(".styleStatsBtn").click(function() {
        changePreviewStyle("stats");
    });

    $("#stats_type").change(function() {

        if($(this).val() == 4) {
            $("#stats_view_type").hide();
            $("#stats_elements").hide();
        } else {
            $("#stats_view_type").show();
            $("#stats_elements").show();
        }
    });
</script>
@stop