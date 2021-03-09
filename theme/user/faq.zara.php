@extends("_common/main")
@section("content")


<div class="row">
    <div class="col-md-12">
        <table class="messages">
            @foreach($faq as $item)
            <tr>
                <td>
                    <strong>{{ $item['faq_name'] }}</strong><br>
                    {{ $item['faq_text'] }}
                </td>
                <!--<td>
                    <time datetime="{{ date("Y-m-d\TH:i:s\Z", strtotime($item['faq_time'])) }}" class="timeago"></time>
                </td>-->
                <td>
                    
                </td>
            </tr>
            @endforeach
            @if(empty($faq))
            <center>Сообщений нет</center>
            @endif
        </table>

        
    </div>
</div>
@stop

@section("plugins-scripts")
<script src="/assets/js/timeago.min.js"></script>
@stop
@section("scripts")
@stop