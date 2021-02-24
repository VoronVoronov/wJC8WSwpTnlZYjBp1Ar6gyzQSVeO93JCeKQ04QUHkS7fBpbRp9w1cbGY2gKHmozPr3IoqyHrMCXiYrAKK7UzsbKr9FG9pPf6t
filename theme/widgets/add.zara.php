@extends("_common/main")
@section("content")
<div class="page-name">
    <h2>Добавление виджета</h2>
    <div class="clear"></div>
</div>

<form action="" method="POST">
    @if(!empty($error))
    <div class="row">
        <div class="col-md-12" style="margin-bottom: 20px;">
            <div class="alert alert-danger col-md-12">
                <b>Ошибка!</b> {{ $error }}
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-md-12" style="margin-bottom: 20px;">
            <div class="col-md-2 text-center">
                <i class="fa fa-question fa-5x"></i>
            </div>
            <div class="alert col-md-10">
                Добавив новый виджет, вы сможете использовать его как одну из вариаций. <br>
                Отредактировать и настроить виджет вы сможете в разделе редактирования после создания.
            </div>
        </div>
    </div>
    <hr>
    <div class="row" style="margin-top: 10px"> <!-- Название виджета -->
        <div class="col-md-4 text-right" style="padding-top: 3px;">
            Название виджета:
        </div>
        <div class="col-md-4">
            <input type="text" class="form-control" name="widget_name" placeholder="Укажите название">
        </div>
        <div class="col-md-1" style="padding-top: 6px;">
            <i class="fa fa-question-circle fa-fw" data-toggle="tooltip" data-placement="top" title="Название нужно только для того что бы вы могли отличить виджеты"></i>
        </div>
    </div> <!-- /Название виджета -->

    <div class="row" style="margin-top: 10px"> <!-- Название виджета -->
        <div class="col-md-4 text-right" style="padding-top: 3px;">
            Тип:
        </div>
        <div class="col-md-4">
            <select name="widget_type" class="form-control">
                <option value="1" @if(Request::get("type") == "alerts") selected @endif>Оповещения</option>
                <option value="2" @if(Request::get("type") == "goals") selected @endif>Сбор средств</option>
                <option value="3" @if(Request::get("type") == "stats") selected @endif>Статистика</option>
                <option value="4" @if(Request::get("type") == "votes") selected @endif>Голосования</option>
                <option value="5" @if(Request::get("type") == "events") selected @endif>Последние действия</option>
            </select>
        </div>
        <div class="col-md-1" style="padding-top: 6px;">
            <i class="fa fa-question-circle fa-fw" data-toggle="tooltip" data-placement="top" title="После создания виджета с определённым типом, виджет появится в соотвественном разделе"></i>
        </div>
    </div> <!-- /Название виджета -->

    <div class="row" style="margin-top: 10px">
        <div class="form-group col-lg-12 text-center">
            <hr>
            <input type="submit" class="btn btn-success" value="Добавить">
        </div>
    </div>
</form>
@stop
<script type="text/javascript" src="https://vk.com/js/api/openapi.js?162"></script>
<div id="vk_community_messages"></div>
<script type="text/javascript">
VK.Widgets.CommunityMessages("vk_community_messages", 190202028, {tooltipButtonText: "Здравствуйте,чем могу вам помочь?"});
</script>

@section("scripts")
<script>

    $(document).ready(function () {

    });
</script>
@stop