@extends("_common/main")
@section("content")
<div class="page-name">
    <h2>Последние действия</h2>
    <div class="clear"></div>
</div>

<div class="row">
    <div class="col-md-12" style="margin-bottom: 20px;">
        <div class="col-md-2 text-center">
            <i class="fa fa-question fa-5x"></i>
        </div>
        <div class="alert col-md-10">
            Пропустили или не успели прочитать сообщение пользователя? Не беда! С этим виджетом Вы сможете легко отследить последние 15 сообщений. Данные обновляются автоматически в режиме реального времени!<br>
            Это важно! При использовании мобильной версии браузера Google Chrome для корректной работы виджета необходимо отключить функцию экономии трафика.
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12" style="margin-bottom: 20px;">
        <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-default btn-sm active">
                <input type="checkbox" id="followers_widget_status" autocomplete="off" checked> {{ lang('main.widget_followers_label') }}
            </label>
            <label class="btn btn-default btn-sm active">
                <input type="checkbox" id="subscribers_widget_status" autocomplete="off" checked> {{ lang('main.widget_subsribers_label') }}
            </label>
            <label class="btn btn-default btn-sm active">
                <input type="checkbox" id="donations_widget_status" autocomplete="off" checked> {{ lang('main.widget_donations_label') }}
            </label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-9" style="margin-bottom: 20px;">
        <div class="input-group">
            <div class="widget-url-guard-alert-box form-control">
                <i class="fa fa-lock"></i> Нажмите для просмотра адреса виджета
            </div>
            <input class="form-control widget-url-alert" value="{{ config()->url }}widget/events" style="display: none;">
            <div class="input-group-btn">
                <button type="button" class="btn btn-default windget-start-btn" onclick="window.open('{{ config()->url }}widget/events', 'alert-widget', 'menubar=0,resizable=1,width=300,height=600').focus();">
                    Запустить
                </button>
            </div>
        </div>
    </div>
</div>
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

    function changeWidgetURL() {
        if($("#followers_widget_status").prop("checked")
            && $("#subscribers_widget_status").prop("checked")
            && $("#donations_widget_status").prop("checked")) {
            $(".widget-url-alert").val("{{ config()->url }}widget/events");
            $(".windget-start-btn").attr("onclick", "window.open('{{ config()->url }}widget//events', 'alert-widget', 'menubar=0,resizable=1,width=1000,height=600').focus();");
        }

        if($("#followers_widget_status").prop("checked")
            && $("#subscribers_widget_status").prop("checked")
            && !$("#donations_widget_status").prop("checked")) {
            $(".widget-url-alert").val("{{ config()->url }}widget/events?code=1");
            $(".windget-start-btn").attr("onclick", "window.open('{{ config()->url }}widget/events?code=1&bg=true', 'alert-widget', 'menubar=0,resizable=1,width=1000,height=600').focus();");
        }

        if($("#followers_widget_status").prop("checked")
            && !$("#subscribers_widget_status").prop("checked")
            && $("#donations_widget_status").prop("checked")) {
            $(".widget-url-alert").val("{{ config()->url }}widget/events?code=2");
            $(".windget-start-btn").attr("onclick", "window.open('{{ config()->url }}widget/events?code=2&bg=true', 'alert-widget', 'menubar=0,resizable=1,width=1000,height=600').focus();");
        }

        if(!$("#followers_widget_status").prop("checked")
            && $("#subscribers_widget_status").prop("checked")
            && $("#donations_widget_status").prop("checked")) {
            $(".widget-url-alert").val("{{ config()->url }}widget/events?code=3");
            $(".windget-start-btn").attr("onclick", "window.open('{{ config()->url }}widget/events?code=3&bg=true', 'alert-widget', 'menubar=0,resizable=1,width=1000,height=600').focus();");
        }

        if($("#followers_widget_status").prop("checked")
            && !$("#subscribers_widget_status").prop("checked")
            && !$("#donations_widget_status").prop("checked")) {
            $(".widget-url-alert").val("{{ config()->url }}widget//events?code=4");
            $(".windget-start-btn").attr("onclick", "window.open('{{ config()->url }}widget/events?code=4&bg=true', 'alert-widget', 'menubar=0,resizable=1,width=1000,height=600').focus();");
        }

        if(!$("#followers_widget_status").prop("checked")
            && $("#subscribers_widget_status").prop("checked")
            && !$("#donations_widget_status").prop("checked")) {
            $(".widget-url-alert").val("{{ config()->url }}widget//events?code=5");
            $(".windget-start-btn").attr("onclick", "window.open('{{ config()->url }}widget/events?code=5&bg=true', 'alert-widget', 'menubar=0,resizable=1,width=1000,height=600').focus();");
        }

        if(!$("#followers_widget_status").prop("checked")
            && !$("#subscribers_widget_status").prop("checked")
            && $("#donations_widget_status").prop("checked")) {
            $(".widget-url-alert").val("{{ config()->url }}widget/events?code=6");
            $(".windget-start-btn").attr("onclick", "window.open('{{ config()->url }}widget/events?code=6&bg=true', 'alert-widget', 'menubar=0,resizable=1,width=1000,height=600').focus();");
        }
    }

    $("#followers_widget_status").change(function () {
        changeWidgetURL();
    });
    $("#subscribers_widget_status").change(function () {
        changeWidgetURL();
    });
    $("#donations_widget_status").change(function () {
        changeWidgetURL();
    });
</script>
@stop