@extends("_common/main")
@section("content")
<div class="page-name">
    <h2>Виджет сбора средств</h2>
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

<style>
    .goal_title {
        text-align: center;
        vertical-align: middle;
    }

    .goal-widget {
        width: 100%;
        height: 100%;
        display: table;
        vertical-align: middle;
        overflow: hidden;
    }

    .bar {
        height: 55px;
        background: linear-gradient(to top, #c4c4c4, #d8d8d8);
        border: 1px solid #b9b9b9;
        position: relative;
        overflow: hidden;
        box-shadow: 0 0 7px rgba(0,0,0,0.5);
        display: table;
        width: 100%;
    }

    .bar-progress {
        width: 50%;
        background: linear-gradient(to top, rgb(213, 119, 37), rgb(255, 161, 49));
        border: 1px solid rgb(201, 112, 34);
        max-width: 100% !important;
        position: absolute;
        left: 0;
        top: 0;
        box-sizing: border-box;
        height: 100%;
    }

    .bar-text {
        height: 100%;
        width: 100%;
        display: table-cell;
        position: relative;
        text-shadow: 0 0 1px #222;
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

<div class="row" style="margin-bottom: 20px;">
    <div class="col-md-12">
        <h4>Предпросмотр:</h4>
        <div class="previewsDemo well well-sm" id="styleGoalSumPreview">
            <div class="goal-widget">
                <div class="goal_title" id="animate_title_one">{{ base64_decode($widget['widget_config']->goal_title) }}</div>
                <div class="bar">
                    <div class="bar-progress" style="width: 72%"></div>
                    <div class="bar-text">
                        <div id="goal_sum">{{ ($widget['widget_config']->goal_sum_end / 100) * 72 }}</div> RUB
                        (<div id="goal_percent">72%</div>)
                    </div>
                </div>

                <div class="goal-info">
                    <div class="goal-start goal_title" id="animate_title_two">0</div>
                    <div class="goal-end goal_title" id="animate_title_three">{{ $widget['widget_config']->goal_sum_end }}</div>
                    <div class="goal-time goal_title">Сбор завершён!</div>
                    <div style="clear: both"></div>
                </div>
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

                    <div class="row" style="margin-top: 10px"> <!-- Назвнаие -->
                        <div class="col-md-3 text-right" style="padding-top: 3px;">
                            Название:
                        </div>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="goal_title_input" name="config[goal_title]" value="{{ base64_decode($widget['widget_config']->goal_title) }}">
                        </div>
                        <div class="col-md-1" style="padding-top: 6px;">
                            <i class="fa fa-question-circle fa-fw" data-toggle="tooltip" data-placement="top" title="Вы можете указать название которые будет отображено сверху."></i>
                        </div>
                    </div> <!-- /Назвнаие -->

                    <div class="row" style="margin-top: 10px"> <!-- Конечная сумма -->
                        <div class="col-md-3 text-right" style="padding-top: 3px;">
                            Конечная сумма:
                        </div>
                        <div class="col-md-3">
                            <input type="number" class="form-control" id="goal_end_sum_input" name="config[goal_sum_end]" value="{{ $widget['widget_config']->goal_sum_end }}">
                        </div>
                        <div class="col-md-1" style="padding-top: 6px;">
                            <i class="fa fa-question-circle fa-fw" data-toggle="tooltip" data-placement="top" title="Сумма которую нужно собрать."></i>
                        </div>
                    </div> <!-- /Конечная сумма -->

                    <div class="row" style="margin-top: 10px"> <!-- Начальная сумма -->
                        <div class="col-md-3 text-right" style="padding-top: 3px;">
                            Начальная сумма:
                        </div>
                        <div class="col-md-3">
                            <input type="number" class="form-control" id="goal_start_sum_input" name="config[goal_sum_start]" value="{{ $widget['widget_config']->goal_sum_start }}">
                        </div>
                        <div class="col-md-1" style="padding-top: 6px;">
                            <i class="fa fa-question-circle fa-fw" data-toggle="tooltip" data-placement="top" title="Сумма с которой будет начат сбор."></i>
                        </div>
                    </div> <!-- /Начальная сумма -->

                    <div class="row" style="margin-top: 10px"> <!-- Дата окончания -->
                        <div class="col-md-3 text-right" style="padding-top: 3px;">
                            Дата окончания:
                        </div>
                        <div class="col-md-3">
                            <div class="input-group date" id="dp1">
                                <input type="text" class="form-control" value="{{ $widget['widget_config']->goal_time_end }}" name="config[goal_time_end]" id="goal_time_end">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-1" style="padding-top: 6px;">
                            <i class="fa fa-question-circle fa-fw" data-toggle="tooltip" data-placement="top" title="Оставьте поле пустым если не хотите указывать сколько времени осталось до конца сбора"></i>
                        </div>
                    </div> <!-- /Дата окончания -->
                </div>
                <div role="tabpanel" class="tab-pane" id="design">
                    <div class="form-horizontal">
                        <div class="row"> <!-- Задний фон -->
                            <div class="col-md-3 text-right">
                                Цвет фона:
                            </div>
                            <div class="col-md-3">
                                <div id="cp1" class="input-group colorpicker-component">
                                    <input type="text" value="{{ $widget['widget_config']->background }}" class="form-control" name="config[background]"/>
                                    <span class="input-group-addon"><i></i></span>
                                </div>
                            </div>
                            <div class="col-md-1" style="padding-top: 6px;">
                                <i class="fa fa-question-circle fa-fw" data-toggle="tooltip" data-placement="top" title="Вы можете установить цвет который вы будете использовать как хромакей"></i>
                            </div>
                        </div> <!-- /Задний фон -->
                        <hr>
                        <div class="row"> <!-- Цвет индикатора -->
                            <div class="col-md-3 text-right">
                                Цвет индикатора:
                            </div>
                            <div class="col-md-3">
                                <div id="cp2" class="input-group colorpicker-component">
                                    <input type="text" id="goal_bar_color" value="{{ $widget['widget_config']->bar_color }}" class="form-control" name="config[bar_color]"/>
                                    <span class="input-group-addon"><i></i></span>
                                </div>
                            </div>
                        </div> <!-- /Цвет индикатора -->

                        <div class="row" style="margin-top: 10px;"> <!-- Цвет фона индикатора -->
                            <div class="col-md-3 text-right">
                                Цвет фона индикатора:
                            </div>
                            <div class="col-md-3">
                                <div id="cp3" class="input-group colorpicker-component">
                                    <input type="text" id="goal_bar_color_bg" value="{{ $widget['widget_config']->bar_color_bg }}" class="form-control" name="config[bar_color_bg]"/>
                                    <span class="input-group-addon"><i></i></span>
                                </div>
                            </div>
                        </div> <!-- /Цвет фона индикатора -->

                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-3 text-right">
                                Высота индикатора
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" style="padding: 0px 15px;">
                                    <input type="range" class="form-control" id="goal_bar_size" name="config[bar_size]" style="width: 100%">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row" style="margin-top: 10px"> <!-- Стиль текста внутри -->
                            <div class="col-md-3 text-right" style="padding-top: 3px;">
                                Стиль текста внутри:
                            </div>
                            <div class="col-md-5">
                                <a href="#" class="btn btn-default btn-sm styleGoalSumBtn" onclick="$('#styleGoalSumModal').modal('show'); return false;"><i class="fa fa-font"></i> Изменить</a>
                            </div>
                        </div> <!-- /Стиль текста внутри -->
                        <div class="row" style="margin-top: 10px"> <!-- Стиль текста снаружи -->
                            <div class="col-md-3 text-right" style="padding-top: 3px;">
                                Стиль текста снаружи:
                            </div>
                            <div class="col-md-5">
                                <a href="#" class="btn btn-default btn-sm styleGoalTitleBtn" onclick="$('#styleGoalTitleModal').modal('show'); return false;"><i class="fa fa-font"></i> Изменить</a>
                            </div>
                        </div> <!-- /Стиль текста снаружи -->
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
<div id="styleGoalSumModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Стиль текста внутри</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="previewsDemo well well-sm" id="styleGoalSumPreview">
                        <div id="styleGoalSumPreviewText">Maksa988 подписался!</div>
                    </div>
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label for="style_goal_sum_font_family" class="col-sm-3 control-label">Шрифт</label>
                            <div class="col-sm-9">
                                <select name="config[goal][sum][font_family]" class="form-control" id="style_goal_sum_font_family">
                                    <option value="0" selected disabled>Выберите шрифт</option>
                                    <option value="Roboto Condensed" @if($widget['widget_config']->goal->sum->font_family == "Roboto Condensed") selected @endif>Roboto Condensed</option>
                                    <option value="Open Sans" @if($widget['widget_config']->goal->sum->font_family == "Open Sans") selected @endif>Open Sans</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Размер шрифта</label>
                            <div class="col-sm-9">
                                <div class="form-group" style="padding: 0px 15px;">
                                    <input type="range" class="form-control" id="style_goal_sum_font_size" name="config[goal][sum][font_size]" style="width: 100%">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Цвет текста</label>
                            <div class="col-sm-4">
                                <div id="cp4" class="input-group colorpicker-component">
                                    <input type="text" id="style_goal_sum_color" value="{{ $widget['widget_config']->goal->sum->color }}" class="form-control" name="config[goal][sum][color]"/>
                                    <span class="input-group-addon"><i></i></span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Жирный</label>
                            <div class="col-sm-9">
                                <div class="checkbox">
                                    <input type="checkbox" id="style_goal_sum_weight" name="config[goal][sum][weight]" value="true" @if($widget['widget_config']->goal->sum->weight) checked @endif>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Курсив</label>
                            <div class="col-sm-9">
                                <div class="checkbox">
                                    <input type="checkbox" id="style_goal_sum_italic" name="config[goal][sum][italic]" value="true" @if($widget['widget_config']->goal->sum->italic) checked @endif>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Подчеркивание</label>
                            <div class="col-sm-9">
                                <div class="checkbox">
                                    <input type="checkbox" id="style_goal_sum_underline" name="config[goal][sum][underline]" value="true" @if($widget['widget_config']->goal->sum->underline) checked @endif>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="style_goal_sum_transformation" class="col-sm-3 control-label">Трансформация</label>
                            <div class="col-sm-9">
                                <select name="config[goal][sum][transformation]" class="form-control" id="style_goal_sum_transformation">
                                    <option value="none" @if($widget['widget_config']->goal->sum->transformation == "none") selected @endif>Нет</option>
                                    <option value="uppercase" @if($widget['widget_config']->goal->sum->transformation == "uppercase") selected @endif>Все буквы прописные</option>
                                    <option value="lowercase" @if($widget['widget_config']->goal->sum->transformation == "lowercase") selected @endif>Все буквы строчные</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Размер тени</label>
                            <div class="col-sm-9">
                                <div class="form-group" style="padding: 0px 15px;">
                                    <input type="range" class="form-control" id="style_goal_sum_shadow_size" name="config[goal][sum][shadow_size]" style="width: 100%">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Цвет тени</label>
                            <div class="col-sm-4">
                                <div id="cp5" class="input-group colorpicker-component">
                                    <input type="text" id="style_goal_sum_shadow_color" value="{{ $widget['widget_config']->goal->sum->shadow_color }}" class="form-control" name="config[goal][sum][shadow_color]"/>
                                    <span class="input-group-addon"><i></i></span>
                                </div>
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
<div id="styleGoalTitleModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Стиль текста снаружи</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="previewsDemo well well-sm" id="styleGoalTitlePreview">
                        <div id="styleGoalTitlePreviewText">Maksa988 подписался!</div>
                    </div>
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label for="style_goal_title_font_family" class="col-sm-3 control-label">Шрифт</label>
                            <div class="col-sm-9">
                                <select name="config[goal][title][font_family]" class="form-control" id="style_goal_title_font_family">
                                    <option value="0" selected disabled>Выберите шрифт</option>
                                    <option value="Roboto Condensed" @if($widget['widget_config']->goal->title->font_family == "Roboto Condensed") selected @endif>Roboto Condensed</option>
                                    <option value="Open Sans" @if($widget['widget_config']->goal->title->font_family == "Open Sans") selected @endif>Open Sans</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Размер шрифта</label>
                            <div class="col-sm-9">
                                <div class="form-group" style="padding: 0px 15px;">
                                    <input type="range" class="form-control" id="style_goal_title_font_size" name="config[goal][title][font_size]" style="width: 100%">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Цвет текста</label>
                            <div class="col-sm-4">
                                <div id="cp6" class="input-group colorpicker-component">
                                    <input type="text" id="style_goal_title_color" value="{{ $widget['widget_config']->goal->title->color }}" class="form-control" name="config[goal][title][color]"/>
                                    <span class="input-group-addon"><i></i></span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Жирный</label>
                            <div class="col-sm-9">
                                <div class="checkbox">
                                    <input type="checkbox" id="style_goal_title_weight" name="config[goal][title][weight]" value="true" @if($widget['widget_config']->goal->title->weight) checked @endif>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Курсив</label>
                            <div class="col-sm-9">
                                <div class="checkbox">
                                    <input type="checkbox" id="style_goal_title_italic" name="config[goal][title][italic]" value="true" @if($widget['widget_config']->goal->title->italic) checked @endif>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Подчеркивание</label>
                            <div class="col-sm-9">
                                <div class="checkbox">
                                    <input type="checkbox" id="style_goal_title_underline" name="config[goal][title][underline]" value="true" @if($widget['widget_config']->goal->title->underline) checked @endif>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="style_goal_title_transformation" class="col-sm-3 control-label">Трансформация</label>
                            <div class="col-sm-9">
                                <select name="config[goal][title][transformation]" class="form-control" id="style_goal_title_transformation">
                                    <option value="none" @if($widget['widget_config']->goal->title->transformation == "none") selected @endif>Нет</option>
                                    <option value="uppercase" @if($widget['widget_config']->goal->title->transformation == "uppercase") selected @endif>Все буквы прописные</option>
                                    <option value="lowercase" @if($widget['widget_config']->goal->title->transformation == "lowercase") selected @endif>Все буквы строчные</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Размер тени</label>
                            <div class="col-sm-9">
                                <div class="form-group" style="padding: 0px 15px;">
                                    <input type="range" class="form-control" id="style_goal_title_shadow_size" name="config[goal][title][shadow_size]" style="width: 100%">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Цвет тени</label>
                            <div class="col-sm-4">
                                <div id="cp7" class="input-group colorpicker-component">
                                    <input type="text" id="style_goal_title_shadow_color" value="{{ $widget['widget_config']->goal->title->shadow_color }}" class="form-control" name="config[goal][title][shadow_color]"/>
                                    <span class="input-group-addon"><i></i></span>
                                </div>
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
<link rel="stylesheet" href="/assets/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="/assets/css/bootstrap-colorpicker.min.css">
<link rel="stylesheet" href="/assets/css/bootstrap-slider.min.css">
<link rel="stylesheet" href="/assets/css/widget.css">

<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300&subset=latin,cyrillic-ext,cyrillic,latin-ext' rel='stylesheet' type='text/css'>
@stop
<script type="text/javascript" src="https://vk.com/js/api/openapi.js?162"></script>
<div id="vk_community_messages"></div>
<script type="text/javascript">
VK.Widgets.CommunityMessages("vk_community_messages", 190202028, {tooltipButtonText: "Здравствуйте,чем могу вам помочь?"});
</script>
@section("plugins-scripts")
<script src="/assets/js/bootstrap-colorpicker.min.js"></script>
<script src="/assets/js/bootstrap-slider.min.js"></script>
<script src="/assets/js/bootstrap-datepicker.min.js"></script>
<script src="/assets/locales/bootstrap-datepicker.ru.min.js"></script>
@stop

@section("scripts")
<script>
    $(".widget-url-guard-alert-box").click(function() {
        $(this).hide();
        $(".widget-url-alert").show();
    });

    $(function() {
        $('#cp1').colorpicker();
        $('#cp2').colorpicker();
        $('#cp3').colorpicker();
        $('#cp4').colorpicker();
        $('#cp5').colorpicker();
        $('#cp6').colorpicker();
        $('#cp7').colorpicker();
    });

    $('#dp1').datepicker({
        language: "ru",
        autoclose: true,
        todayHighlight: true,
        format: "mm.dd.yyyy",
    });

    $('#goal_bar_size').slider({
        min: 8,
        max: 110,
        value: {{ $widget['widget_config']->bar_size or 55 }},
        formatter: function(value) {
            return value + "px";
        }
    });

    $('#style_goal_sum_font_size').slider({
        min: 8,
        max: 110,
        value: {{ $widget['widget_config']->goal->sum->font_size or 64 }},
        formatter: function(value) {
            return value + "px";
        }
    });

    $('#style_goal_sum_shadow_size').slider({
        min: 0,
        max: 100,
        value: {{ $widget['widget_config']->goal->sum->shadow_size or 1 }},
        formatter: function(value) {
            return value + "px";
        }
    });

    $('#style_goal_title_font_size').slider({
        min: 8,
        max: 110,
        value: {{ $widget['widget_config']->goal->title->font_size or 64 }},
        formatter: function(value) {
            return value + "px";
        }
    });

    $('#style_goal_title_shadow_size').slider({
        min: 0,
        max: 100,
        value: {{ $widget['widget_config']->goal->title->shadow_size or 1 }},
        formatter: function(value) {
            return value + "px";
        }
    });

    $("#goal_bar_size, #goal_bar_color, #goal_bar_color_bg, #goal_title_input," +
        "#goal_end_sum_input, #goal_time_end").change(function () {
        changeGlobalPreviewStyle();
    });

    //Фунции
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
                    $(".goal-time").html("Осталось 11 часов");
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
        var lefttime = getTimeRemaining($("#goal_time_end").val());
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

    function changeGlobalPreviewStyle()
    {
        updateGoalTime();

        $("#animate_title_one").html($("#goal_title_input").val())
        $(".goal-end").html($("#goal_end_sum_input").val());

        var goal_sum = (parseInt($("#goal_end_sum_input").val()) / 100) * 72;

        $("#goal_sum").html(goal_sum.toFixed(2));

        $(".bar").css("height", $("#goal_bar_size").val());
        $(".bar").css("background", $("#goal_bar_color_bg").val());
        $(".bar-progress").css("background", "linear-gradient(transparent, rgba(0, 0, 0, 0.15)) " + $("#goal_bar_color").val());
        $(".bar-progress").css("border-color", $("#goal_bar_color").val());

        $(".goal_title").css("font-family", $("#style_goal_title_font_family").val());
        $(".goal_title").css("font-size", $("#style_goal_title_font_size").val() + "px");
        $(".goal_title").css("color", $("#style_goal_title_color").val());
        if($("#style_goal_title_weight").prop('checked')) {
            $(".goal_title").css("font-weight", "bold");
        } else {
            $(".goal_title").css("font-weight", "normal");
        }
        if($("#style_goal_title_italic").prop('checked')) {
            $(".goal_title").css("font-style", "italic");
        } else {
            $(".goal_title").css("font-style", "normal");
        }
        if($("#style_goal_title_underline").prop('checked')) {
            $(".goal_title").css("text-decoration", "underline");
        } else {
            $(".goal_title").css("text-decoration", "none");
        }
        $(".goal_title").css("text-shadow", "0px 0px " + $("#style_goal_title_shadow_size").val() + "px rgb(0, 0, 0), 0px 0px " +
            (parseInt($("#style_goal_title_shadow_size").val()) + 1) + "px "+ $("#style_goal_title_shadow_color").val() +", 0px 0px " +
            (parseInt($("#style_goal_title_shadow_size").val()) + 2) + "px "+ $("#style_goal_title_shadow_color").val() +", 0px 0px " +
            (parseInt($("#style_goal_title_shadow_size").val()) + 3) + "px "+ $("#style_goal_title_shadow_color").val());
        $(".goal_title").css("text-transform", $("#style_goal_title_transformation").val());

        $(".bar-text").css("font-family", $("#style_goal_sum_font_family").val());
        $(".bar-text").css("font-size", $("#style_goal_sum_font_size").val() + "px");
        $(".bar-text").css("color", $("#style_goal_sum_color").val());
        if($("#style_goal_sum_weight").prop('checked')) {
            $(".bar-text").css("font-weight", "bold");
        } else {
            $(".bar-text").css("font-weight", "normal");
        }
        if($("#style_goal_sum_italic").prop('checked')) {
            $(".bar-text").css("font-style", "italic");
        } else {
            $(".bar-text").css("font-style", "normal");
        }
        if($("#style_goal_sum_underline").prop('checked')) {
            $(".bar-text").css("text-decoration", "underline");
        } else {
            $(".bar-text").css("text-decoration", "none");
        }
        $(".bar-text").css("text-shadow", "0px 0px " + $("#style_goal_sum_shadow_size").val() + "px rgb(0, 0, 0), 0px 0px " +
            (parseInt($("#style_goal_sum_shadow_size").val()) + 1) + "px "+ $("#style_goal_sum_shadow_color").val() +", 0px 0px " +
            (parseInt($("#style_goal_sum_shadow_size").val()) + 2) + "px "+ $("#style_goal_sum_shadow_color").val() +", 0px 0px " +
            (parseInt($("#style_goal_sum_shadow_size").val()) + 3) + "px "+ $("#style_goal_sum_shadow_color").val());
        $(".bar-text").css("text-transform", $("#style_goal_sum_transformation").val());
    }

    function changePreviewStyle(type)
    {
        var bigType;
        var demoText;
        if(type == "goal_sum") {
            bigType = "GoalSum";
            demoText = "1000 USD (10%)";
        }
        if(type == "goal_title") {
            bigType = "GoalTitle";
            demoText = $("#goal_title_input").val();
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
        $("#style" + bigType + "PreviewText").css("text-align", "center");
    }

    $("#style_goal_sum_font_family, #style_goal_sum_font_size, #style_goal_sum_color, #style_goal_sum_weight, " +
        "#style_goal_sum_italic, #style_goal_sum_underline, #style_goal_sum_shadow_size, " +
        "#style_goal_sum_transformation, #style_goal_sum_shadow_color, " +
        "#style_goal_sum_aling, #style_goal_sum_font_size_input, #style_goal_sum_shadow_size_input").change(function() {
        changePreviewStyle("goal_sum");
        changeGlobalPreviewStyle();
    });

    $("#style_goal_title_font_family, #style_goal_title_font_size, #style_goal_title_color, #style_goal_title_weight, " +
        "#style_goal_title_italic, #style_goal_title_underline, #style_goal_title_shadow_size, " +
        "#style_goal_title_transformation, #style_goal_title_shadow_color, " +
        "#style_goal_title_aling, #style_goal_title_font_size_input, #style_goal_title_shadow_size_input").change(function() {
        changePreviewStyle("goal_title");
        changeGlobalPreviewStyle();
    });

    $(".styleGoalSumBtn").click(function() {
        changePreviewStyle("goal_sum");
    });

    $(".styleGoalTitleBtn").click(function() {
        changePreviewStyle("goal_title");
    });

    $(document).ready(function () {
        setInterval("updateGoalTime", 1000);
        changePreviewStyle("goal_title");
    });
</script>
@stop