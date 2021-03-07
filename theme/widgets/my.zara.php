@extends("_common/main")
@section("content")
<div class="page-name">
    <h2>Мои виджеты</h2>
    <a href="/widgets/new?type={{ $type }}" class="btn btn-default btn-sm add-widget-btn pull-right" style="margin-top: 15px;">
        <i class="fa fa-plus"></i> Создать новый
    </a>
    <div class="clear"></div>
</div>

<div class="row">
    <div class="col-md-12" style="margin-bottom: 20px;">
        <table class="my-widgets">
            <tbody>
                @foreach($widgets as $widget)
                <tr>
                    <td>
                        {{ $widget['widget_name'] }}
                        @if(count($widgets) == 1) <span class="label label-default">По умолчанию</span> @endif
                    </td>
                    <td>
                        <a href="#" class="btn btn-default btn-xs" onclick="window.open('{{ config()->url }}widget/{{ $widget['widget_token'] }}?bg=true', 'alert-widget', 'menubar=0,resizable=1,width=1000,height=600').focus();" data-toggle="tooltip" data-placement="left" title="Запустить"><i class="fa fa-play"></i></a>
                        <a href="/widgets/edit/{{ $widget['widget_id'] }}" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i> Редактировать</a>
                        @if(count($widgets) != 1)<a href="#" data-id="{{ $widget['widget_id'] }}" class="btn btn-default btn-xs remove-widget"><i class="fa fa-remove"></i></a>@endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop

@section("styles")
<link rel="stylesheet" href="/assets/css/widget.css">

<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300&subset=latin,cyrillic-ext,cyrillic,latin-ext' rel='stylesheet' type='text/css'>
@stop

@section("scripts")
<script>

    $(document).ready(function () {
        var widgets = {{ count($widgets) }};

        $(".remove-widget").click(function () {
            var widget_id = $(this).attr("data-id");
            $.ajax({
                url: "/widgets/remove?id=" + widget_id,
                type: "POST",
                success: function (data) {
                    console.log(data);
                    data = $.parseJSON(data);

                    switch (data.status) {
                        case "success":
                            fly_p("success", "Виджет успешно удален!");
                            setTimeout(function () {
                                location.href = location.href;
                            }, 2000);
                            break;

                        case "error":
                            fly_p("danger", data.error);
                            break;
                    }
                }
            });

            return false;
        });
    });
</script>
@stop