@extends("_common/main")
@section("content")
<div class="page-name">
    <h2>Административная панель</h2>
    <h3>Сегодня - {{ getCurrentHumanDate() }}</h3>
    <div class="clear"></div>
</div>
<div class="row"  style="text-align: center;">


    <div class="stats-block">
        <h3>{{ count($users) }}</h3>
        <p>Всего пользователей</p>
    </div>

    <div class="stats-block">
        <h3>{{ count($donations) }}</h3>
        <p>Всего донатов</p>
    </div>

    <div class="stats-block">
        <h3>{{ count($payouts) }}</h3>
        <p>Всего выплат</p>
    </div>

</div>

<div id="graph-stats">
    @if(empty($stats))
    <img src="/assets/images/graph-layout.png" style="width: 100%;">
    @endif
</div>

<table class="last-donations">
    <thead>
    <tr>
        <td><b>#</b></td>
        <td><b>ID пользователя</b></td>
        <td><b>Отправитель</b></td>
        <td><b>Сумма</b></td>
        <td><b>Дата</b></td>
        <td><b>Статус</b></td>
    </tr>
    </thead>
    <tbody>
        @if(empty($donations))
        <tr>
            <td style="text-align: center;" colspan="3">Список последних донатов пуст</td>
        </tr>
        @else
        @foreach($donations as $donation)
        <tr>
            <td>{{ $donation['donation_id'] }}</td>
            <td>{{ $donation['user_id'] }}</td>
            <td>{{ $donation['donation_name'] }}</td>
            <td>{{ $donation['donation_ammount'] }} ₽</td>
            <td>{{ date("H:i d.m.Y", strtotime($donation['donation_create_time'])) }}</td>
            <td> @if(!$donation['donation_status'])
            
            <a class="btn btn-warning btn-xs">Ожидается</a> 
            
            @else
            
            <a class="btn btn-success btn-xs">Зачислен</a> 
            @endif
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>
@stop

@section("plugins-scripts")
<script src="/assets/js/timeago.min.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
@stop

@section("scripts")
<script>
    @if(!empty($stats))
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Дата', 'Оборот', 'Чистая прибыль'],
            @foreach($stats as $item)
  
            ["{{ getHumanDate($item['donation_end_time']) }}",  {{ $item['amomunt'] }}, {{ $item['sum'] }}],
            @endforeach
        ]);

        var options = {
            vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('graph-stats'));
        chart.draw(data, options);
    }
    @endif
</script>
@stop