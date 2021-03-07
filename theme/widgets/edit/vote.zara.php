@extends("_common/main")
@section("content")
<div class="page-name">
    <h2>Голосования</h2>
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
                <li role="presentation"><a href="#variants" aria-controls="variants" role="tab" data-toggle="tab">Варианты голосования</a></li>
                <li role="presentation"><a href="#design" aria-controls="design" role="tab" data-toggle="tab">Оформление виджета</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content" style="padding-top: 15px">
                <div role="tabpanel" class="tab-pane active" id="main">
                    <div class="row"> <!-- Включить -->
                        <div class="col-md-3 text-right">
                            Голосование:
                        </div>
                        <div class="col-md-4">
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-danger @if($widget['widget_config']->status == 0) active @endif">
                                    <input type="radio" name="config[status]" autocomplete="off" @if($widget['widget_config']->status == 0) checked @endif value="0">Выключить
                                </label>
                                <label class="btn btn-success @if($widget['widget_config']->status == 1) active @endif">
                                    <input type="radio" name="config[status]" autocomplete="off" @if($widget['widget_config']->status == 1) checked @endif value="1">Включить
                                </label>
                            </div>
                        </div>
                        <div class="col-md-1" style="padding-top: 3px;">
                            <i class="fa fa-question-circle fa-fw" data-toggle="tooltip" data-placement="top" title="Отключив это голосование, пользователи не смогут проголосовать за один из вариантов"></i>
                        </div>
                    </div> <!-- Оповещение о новых подписчиках -->
                    <div class="row" style="margin-top: 10px"> <!-- Название голосования -->
                        <div class="col-md-3 text-right" style="padding-top: 3px;">
                            Название голосования:
                        </div>
                        <div class="col-md-4">
                            <input type="text" id="vote_title" class="form-control" name="config[title]" value="{{ base64_decode($widget['widget_config']->title) }}">
                        </div>
                    </div> <!-- /Название голосования -->

                    <div class="row" style="margin-top: 10px"> <!-- Тип голоования -->
                        <div class="col-md-3 text-right" style="padding-top: 3px;">
                            Тип голосования:
                        </div>
                        <div class="col-md-4">
                            <select class="form-control" name="config[type]">
                                <option value="0" disabled selected>Выберите тип</option>
                                <option value="1" @if($widget['widget_config']->type == 1) selected @endif>Отправленная сумма</option>
                                <option value="2" @if($widget['widget_config']->type == 2) selected @endif>Количество отправлений</option>
                            </select>
                        </div>
                    </div> <!-- /Тип голоования -->

                    <div class="row" id="stats_elements" style="margin-top: 10px;"> <!-- Отображать -->
                        <div class="col-md-3 text-right">
                            Отображать:
                        </div>
                        <div class="col-md-4">
                            <select class="form-control" name="config[time]">
                                <option value="1" @if($widget['widget_config']->time == 1) selected @endif>Всегда</option>
                                <option value="2" @if($widget['widget_config']->time == 2) selected @endif>Каждые 30 секунд</option>
                                <option value="3" @if($widget['widget_config']->time == 3) selected @endif>Каждую минуту</option>
                                <option value="4" @if($widget['widget_config']->time == 4) selected @endif>Каждые 3 минуты</option>
                                <option value="5" @if($widget['widget_config']->time == 5) selected @endif>Каждые 5 минут</option>
                                <option value="6" @if($widget['widget_config']->time == 6) selected @endif>Каждые 10 минут</option>
                                <option value="7" @if($widget['widget_config']->time == 7) selected @endif>Каждые 30 минут</option>
                                <option value="8" @if($widget['widget_config']->time == 8) selected @endif>Каждый час</option>
                            </select>
                        </div>
                    </div> <!-- /Отображать -->

                    <div class="row" id="stats_elements" style="margin-top: 10px;"> <!-- Продолжительность отображения -->
                        <div class="col-md-3 text-right">
                            Продолжительность отображения:
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" style="padding: 0px 15px;">
                                <input type="range" class="form-control" id="time_show_range" name="config[time_show]" style="width: 100%">
                            </div>
                        </div>
                    </div> <!-- /Продолжительность отображения -->
                </div>
                <div role="tabpanel" class="tab-pane" id="variants">
                    <div class="row" style="margin-top: 10px"> <!-- Вариант 1 -->
                        <div class="col-md-3 text-right" style="padding-top: 3px;">
                            Вариант 1:
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="config[variants][]" value="{{ base64_decode($widget['widget_config']->variants[0]) }}">
                        </div>
                    </div> <!-- /Вариант 1 -->

                    <div class="row" style="margin-top: 10px"> <!-- Вариант 2 -->
                        <div class="col-md-3 text-right" style="padding-top: 3px;">
                            Вариант 2:
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="config[variants][]" value="{{ base64_decode($widget['widget_config']->variants[1]) }}">
                        </div>
                    </div> <!-- /Вариант 2 -->

                    @for($i = 2; $i < count($widget['widget_config']->variants); $i ++)
                    <div id="variant-{{ $i + 1 }}" class="row" style="margin-top: 10px"> <!-- Вариант {{ $i + 1 }} -->
                        <div class="col-md-3 text-right" style="padding-top: 3px;">
                            Вариант {{ $i + 1 }}:
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="config[variants][]" value="{{ base64_decode($widget['widget_config']->variants[$i]) }}">
                        </div>
                        <div class="col-md-1">
                            <a href="#" data-id="{{ $i + 1 }}" class="removeVariant"><i class="fa fa-remove"></i></a>
                        </div>
                    </div> <!-- /Вариант {{ $i + 1 }} -->
                    @endfor

                    <div class="new_variants"></div>

                    <div class="row" style="margin-top: 10px"> <!-- Вариант 2 -->
                        <div class="col-md-3 text-right" style="padding-top: 3px;">

                        </div>
                        <div class="col-md-4">
                            <a href="#" id="addNewVariant" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Добавить вариант</a>
                        </div>
                    </div> <!-- /Вариант 2 -->
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
                                Цвет индикаторов:
                            </div>
                            <div class="col-md-3">
                                <div id="cp2" class="input-group colorpicker-component">
                                    <input type="text" id="vote_bar_color" value="{{ $widget['widget_config']->bar_color }}" class="form-control" name="config[bar_color]"/>
                                    <span class="input-group-addon"><i></i></span>
                                </div>
                            </div>
                        </div> <!-- /Цвет индикатора -->

                        <div class="row" style="margin-top: 10px;"> <!-- Цвет фона индикатора -->
                            <div class="col-md-3 text-right">
                                Цвет фона индикаторов:
                            </div>
                            <div class="col-md-3">
                                <div id="cp3" class="input-group colorpicker-component">
                                    <input type="text" id="vote_bar_color_bg" value="{{ $widget['widget_config']->bar_color_bg }}" class="form-control" name="config[bar_color_bg]"/>
                                    <span class="input-group-addon"><i></i></span>
                                </div>
                            </div>
                        </div> <!-- /Цвет фона индикатора -->

                        <div class="row" style="margin-top: 10px;"> <!-- /Цвет фона индикатора -->
                            <div class="col-md-3 text-right">
                                Высота индикаторов:
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" style="padding: 0px 15px;">
                                    <input type="range" class="form-control" id="vote_bar_size" name="config[bar_size]" style="width: 100%">
                                </div>
                            </div>
                        </div> <!-- /Цвет фона индикатора -->

                        <hr>
                        <div class="row" style="margin-top: 10px"> <!-- Стиль заголовка -->
                            <div class="col-md-3 text-right" style="padding-top: 3px;">
                                Стиль заголовка:
                            </div>
                            <div class="col-md-5">
                                <a href="#" class="btn btn-default btn-sm styleTitleBtn" onclick="$('#styleTitleModal').modal('show'); return false;"><i class="fa fa-font"></i> Изменить</a>
                            </div>
                        </div> <!-- /Стиль заголовка -->

                        <div class="row" style="margin-top: 10px"> <!-- Стиль текста вариантов -->
                            <div class="col-md-3 text-right" style="padding-top: 3px;">
                                Стиль текста вариантов:
                            </div>
                            <div class="col-md-5">
                                <a href="#" class="btn btn-default btn-sm styleVariantBtn" onclick="$('#styleVariantModal').modal('show'); return false;"><i class="fa fa-font"></i> Изменить</a>
                            </div>
                        </div> <!-- /Стиль заголовка -->
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
<div id="styleTitleModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Стиль заголовка</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="previewsDemo well well-sm" id="styleTitlePreview">
                        <div id="styleTitlePreviewText"></div>
                    </div>
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label for="style_title_font_family" class="col-sm-3 control-label">Шрифт</label>
                            <div class="col-sm-9">
                                <select name="config[style][title][font_family]" class="form-control" id="style_title_font_family">
                                    <option value="0" selected disabled>Выберите шрифт</option>
                                    <option value="Roboto Condensed" @if($widget['widget_config']->style->title->font_family == "Roboto Condensed") selected @endif>Roboto Condensed</option>
                                    <option value="Open Sans" @if($widget['widget_config']->style->title->font_family == "Open Sans") selected @endif>Open Sans</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Размер шрифта</label>
                            <div class="col-sm-9">
                                <div class="form-group" style="padding: 0px 15px;">
                                    <input type="range" class="form-control" id="style_title_font_size" name="config[style][title][font_size]" style="width: 100%">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Цвет текста</label>
                            <div class="col-sm-4">
                                <div id="cp4" class="input-group colorpicker-component">
                                    <input type="text" id="style_title_color" value="{{ $widget['widget_config']->style->title->color }}" class="form-control" name="config[style][title][color]"/>
                                    <span class="input-group-addon"><i></i></span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Жирный</label>
                            <div class="col-sm-9">
                                <div class="checkbox">
                                    <input type="checkbox" id="style_title_weight" name="config[style][title][weight]" value="true" @if($widget['widget_config']->style->title->weight) checked @endif>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Курсив</label>
                            <div class="col-sm-9">
                                <div class="checkbox">
                                    <input type="checkbox" id="style_title_italic" name="config[style][title][italic]" value="true" @if($widget['widget_config']->style->title->italic) checked @endif>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Подчеркивание</label>
                            <div class="col-sm-9">
                                <div class="checkbox">
                                    <input type="checkbox" id="style_title_underline" name="config[style][title][underline]" value="true" @if($widget['widget_config']->style->title->underline) checked @endif>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="style_title_transformation" class="col-sm-3 control-label">Трансформация</label>
                            <div class="col-sm-9">
                                <select name="config[style][title][transformation]" class="form-control" id="style_title_transformation">
                                    <option value="none" @if($widget['widget_config']->style->title->transformation == "none") selected @endif>Нет</option>
                                    <option value="uppercase" @if($widget['widget_config']->style->title->transformation == "uppercase") selected @endif>Все буквы прописные</option>
                                    <option value="lowercase" @if($widget['widget_config']->style->title->transformation == "lowercase") selected @endif>Все буквы строчные</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Размер тени</label>
                            <div class="col-sm-9">
                                <div class="form-group" style="padding: 0px 15px;">
                                    <input type="range" class="form-control" id="style_title_shadow_size" name="config[style][title][shadow_size]" style="width: 100%">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Цвет тени</label>
                            <div class="col-sm-4">
                                <div id="cp5" class="input-group colorpicker-component">
                                    <input type="text" id="style_title_shadow_color" value="{{ $widget['widget_config']->style->title->shadow_color }}" class="form-control" name="config[style][title][shadow_color]"/>
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
<div id="styleVariantModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Стиль текста</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="previewsDemo well well-sm" id="styleVariantPreview">
                    <div id="styleVariantPreviewText"></div>
                </div>
                <div class="form-horizontal">
                    <div class="form-group">
                        <label for="style_variant_font_family" class="col-sm-3 control-label">Шрифт</label>
                        <div class="col-sm-9">
                            <select name="config[style][variant][font_family]" class="form-control" id="style_variant_font_family">
                                <option value="0" selected disabled>Выберите шрифт</option>
                                <option value="Roboto Condensed" @if($widget['widget_config']->style->variant->font_family == "Roboto Condensed") selected @endif>Roboto Condensed</option>
                                <option value="Open Sans" @if($widget['widget_config']->style->variant->font_family == "Open Sans") selected @endif>Open Sans</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Размер шрифта</label>
                        <div class="col-sm-9">
                            <div class="form-group" style="padding: 0px 15px;">
                                <input type="range" class="form-control" id="style_variant_font_size" name="config[style][variant][font_size]" style="width: 100%">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Цвет текста</label>
                        <div class="col-sm-4">
                            <div id="cp6" class="input-group colorpicker-component">
                                <input type="text" id="style_variant_color" value="{{ $widget['widget_config']->style->variant->color }}" class="form-control" name="config[style][variant][color]"/>
                                <span class="input-group-addon"><i></i></span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Жирный</label>
                        <div class="col-sm-9">
                            <div class="checkbox">
                                <input type="checkbox" id="style_variant_weight" name="config[style][variant][weight]" value="true" @if($widget['widget_config']->style->variant->weight) checked @endif>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Курсив</label>
                        <div class="col-sm-9">
                            <div class="checkbox">
                                <input type="checkbox" id="style_variant_italic" name="config[style][variant][italic]" value="true" @if($widget['widget_config']->style->variant->italic) checked @endif>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Подчеркивание</label>
                        <div class="col-sm-9">
                            <div class="checkbox">
                                <input type="checkbox" id="style_variant_underline" name="config[style][variant][underline]" value="true" @if($widget['widget_config']->style->variant->underline) checked @endif>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="style_variant_transformation" class="col-sm-3 control-label">Трансформация</label>
                        <div class="col-sm-9">
                            <select name="config[style][variant][transformation]" class="form-control" id="style_variant_transformation">
                                <option value="none" @if($widget['widget_config']->style->variant->transformation == "none") selected @endif>Нет</option>
                                <option value="uppercase" @if($widget['widget_config']->style->variant->transformation == "uppercase") selected @endif>Все буквы прописные</option>
                                <option value="lowercase" @if($widget['widget_config']->style->variant->transformation == "lowercase") selected @endif>Все буквы строчные</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Размер тени</label>
                        <div class="col-sm-9">
                            <div class="form-group" style="padding: 0px 15px;">
                                <input type="range" class="form-control" id="style_variant_shadow_size" name="config[style][variant][shadow_size]" style="width: 100%">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Цвет тени</label>
                        <div class="col-sm-4">
                            <div id="cp7" class="input-group colorpicker-component">
                                <input type="text" id="style_variant_shadow_color" value="{{ $widget['widget_config']->style->variant->shadow_color }}" class="form-control" name="config[style][variant][shadow_color]"/>
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
<link rel="stylesheet" href="/assets/css/bootstrap-colorpicker.min.css">
<link rel="stylesheet" href="/assets/css/bootstrap-slider.min.css">
<link rel="stylesheet" href="/assets/css/widget.css">

<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300&subset=latin,cyrillic-ext,cyrillic,latin-ext' rel='stylesheet' type='text/css'>
@stop
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
        $('#cp1').colorpicker();
        $('#cp2').colorpicker();
        $('#cp3').colorpicker();
        $('#cp4').colorpicker();
        $('#cp5').colorpicker();
        $('#cp6').colorpicker();
        $('#cp7').colorpicker();
    });

    $('#time_show_range').slider({
        min: 1,
        max: 60,
        value: {{ $widget['widget_config']->time_show or 30 }},
        formatter: function(value) {
            return value + " сек.";
        }
    });

    $('#style_title_font_size').slider({
        min: 8,
        max: 110,
        value: {{ $widget['widget_config']->style->title->font_size or 64 }},
        formatter: function(value) {
            return value + "px";
        }
    });

    $('#style_title_shadow_size').slider({
        min: 0,
        max: 100,
        value: {{ $widget['widget_config']->style->title->shadow_size or 1 }},
        formatter: function(value) {
            return value + "px";
        }
    });

    $('#style_variant_font_size').slider({
        min: 8,
        max: 110,
        value: {{ $widget['widget_config']->style->variant->font_size or 64 }},
        formatter: function(value) {
            return value + "px";
        }
    });

    $('#style_variant_shadow_size').slider({
        min: 0,
        max: 100,
        value: {{ $widget['widget_config']->style->variant->shadow_size or 1 }},
        formatter: function(value) {
            return value + "px";
        }
    });

    $('#vote_bar_size').slider({
        min: 8,
        max: 110,
        value: {{ $widget['widget_config']->bar_size or 1 }},
        formatter: function(value) {
            return value + "px";
        }
    });

    //Фунции
    function changePreviewStyle(type)
    {
        var bigType;
        var demoText;
        if(type == "title") {
            bigType = "Title";
            demoText = $("#vote_title").val();
        }

        if(type == "variant") {
            bigType = "Variant";
            demoText = "Вариант";
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

    $("#style_title_font_family, #style_title_font_size, #style_title_color, #style_title_weight, " +
        "#style_title_italic, #style_title_underline, #style_title_shadow_size, " +
        "#style_title_transformation, #style_title_shadow_color, " +
        "#style_title_aling, #style_title_font_size_input, #style_title_shadow_size_input").change(function() {
        changePreviewStyle("title");
    });

    $("#style_variant_font_family, #style_variant_font_size, #style_variant_color, #style_variant_weight, " +
        "#style_variant_italic, #style_variant_underline, #style_variant_shadow_size, " +
        "#style_variant_transformation, #style_variant_shadow_color, " +
        "#style_variant_aling, #style_variant_font_size_input, #style_variant_shadow_size_input").change(function() {
        changePreviewStyle("variant");
    });

    $(".styleTitleBtn").click(function() {
        changePreviewStyle("title");
    });
    
    $(".styleVariantBtn").click(function() {
        changePreviewStyle("variant");
    });

    var lastID = {{ count($widget['widget_config']->variants) }};

    $("#addNewVariant").click(function () {

        if(lastID >= 10)
            return fly_p("danger", "Нельзя добавить больше 10 вариантов голосования!");

        lastID++;
        $(".new_variants").append("<div id=\"variant-"+ lastID +"\" class=\"row\" style=\"margin-top: 10px\"><div class=\"col-md-3 text-right\" style=\"padding-top: 3px;\">Вариант "+ lastID +": </div> <div class=\"col-md-4\"> <input type=\"text\" class=\"form-control\" name=\"config[variants][]\"> </div> <div class='col-md-1'><a href='#' data-id=\""+ lastID +"\" class='removeVariant'><i class='fa fa-remove'></i></a></div> </div>");

        return false;
    });

    $("body").on("click", ".removeVariant", function () {
        if(lastID == $(this).attr("data-id")) {
            lastID--;
        }

        $("#variant-" + $(this).attr("data-id")).remove();

        return false;
    });
</script>
@stop