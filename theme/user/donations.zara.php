@extends("_common/main")
@section("content")
<div class="page-name">
    <h2>Мои донаты</h2>
    <div class="clear"></div>
</div>

<div class="row">
    <div class="col-md-12">
        <table class="donations">
            @foreach($donations as $item)
            <tr>
                <td>Донат от <b>{{ $item['donation_name'] }}</b></td>
                <td>+{{ $item['donation_ammount'] }} {{ getHumanCurrency($item['donation_currency']) }}</td>
                <td>
                    <b>{{ date("H:i", strtotime($item['donation_end_time'])) }}</b>
                    <p>{{ date("d/m/Y", strtotime($item['donation_end_time'])) }}</p>
                </td>
            </tr>
            @endforeach
            @if(empty($donations))
            <center>Список пуст</center>
            @endif
        </table>

        {{ $pagination }}
    </div>
</div>
@stop
@section("scripts")
@stop