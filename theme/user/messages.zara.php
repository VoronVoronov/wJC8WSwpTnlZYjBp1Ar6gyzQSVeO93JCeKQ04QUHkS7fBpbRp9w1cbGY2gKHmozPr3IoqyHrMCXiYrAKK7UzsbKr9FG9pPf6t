@extends("_common/main")
@section("content")
<div class="page-name">
    <h2>Мои сообщения</h2>
    <div class="clear"></div>
</div>

<div class="row">
    <div class="col-md-12">
        <table class="messages">
            @foreach($messages as $item)
            <tr>
                <td>{{ $item['message_text'] }}</td>
                <td>
                    <b>{{ date("H:i", strtotime($item['message_time'])) }}</b>
                    <p>{{ date("d/m/Y", strtotime($item['message_time'])) }}</p>
                </td>
            </tr>
            @endforeach
            @if(empty($messages))
            <center>Сообщений нет</center>
            @endif
        </table>

        {{ $pagination }}
    </div>
</div>
@stop

@section("plugins-scripts")
<script src="/assets/js/timeago.min.js"></script>
@stop
@section("scripts")
@stop