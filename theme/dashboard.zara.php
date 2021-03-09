@extends("_common/main")
@section("content")
<div class="page-name">
    <h2>Статистика</h2>
    <h3>Сегодня - {{ getCurrentHumanDate() }}</h3>
    <div class="clear"></div>
</div>
<div class="row">

    <div class="stats-block">
        <h3>{{ isOnline()->user_youtube_sponsors }}</h3>
        <p>Спонсоры(YouTube)</p>
    </div>

    <div class="stats-block">
        <h3>{{ isOnline()->user_youtube_subs }}</h3>
        <p>Подписчики</p>
    </div>

    <div class="stats-block">
        <h3>{{ isOnline()->user_twitch_follows }}</h3>
        <p>Подписчики(Twitch)</p>
    </div>

    <div class="stats-block">
        <h3>{{ isOnline()->user_twitch_subs }}</h3>
        <p>Платные подписчики</p>
    </div>

    <div class="stats-block">
        <h3>{{ isOnline()->user_balance }}</h3>
        <p>Заработано / руб.</p>
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
        <td>Никнейм</td>
        <td>Время</td>
        <td>Действие</td>
    </tr>
    </thead>
    <tbody>
        @if(empty($events))
        <tr>
            <td style="text-align: center;" colspan="3">Список последних действий пуст</td>
        </tr>
        @else
        @foreach($events as $event)
        <tr>
            <td>{{ base64_decode($event['event_json']->user_name) }}</td>
            <td>{{ date("H:i d.m.Y", strtotime($event['event_time'])) }}</td>
            <td>{{ $event['action'] }}</td>
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
            ['Дата', 'Доход'],
            @foreach($stats as $item)
            ["{{ getHumanDate($item['donation_end_time']) }}",  {{ $item['sum'] }}],
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