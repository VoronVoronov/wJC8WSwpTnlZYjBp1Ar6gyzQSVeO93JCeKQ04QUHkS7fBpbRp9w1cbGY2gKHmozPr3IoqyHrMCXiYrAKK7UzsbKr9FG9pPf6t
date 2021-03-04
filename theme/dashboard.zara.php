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
            <td>{{ $event['event_json']->user_name }}</td>
            <td><time datetime="{{ date("Y-m-d\TH:i:s\Z", strtotime($event['event_time'])) }}" class="timeago"></time></td>
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
<script type="text/javascript" src="https://vk.com/js/api/openapi.js?162"></script>
<div id="vk_community_messages"></div>
<script type="text/javascript">
VK.Widgets.CommunityMessages("vk_community_messages", 174659405, {tooltipButtonText: "Здравствуйте,чем могу вам помочь?"});
</script>


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

    function numpf(n, f, s, t) {
        // f - 1, 21, 31, ...
        // s - 2-4, 22-24, 32-34 ...
        // t - 5-20, 25-30, ...
        var n10 = n % 10;
        if ( (n10 == 1) && ( (n == 1) || (n > 20) ) ) {
            return f;
        } else if ( (n10 > 1) && (n10 < 5) && ( (n > 20) || (n < 10) ) ) {
            return s;
        } else {
            return t;
        }
    }

    $.timeago.settings.strings = {
        prefixAgo: null,
        prefixFromNow: "через",
        suffixAgo: "назад",
        suffixFromNow: null,
        seconds: "меньше минуты",
        minute: "минуту",
        minutes: function(value) { return numpf(value, "%d минута", "%d минуты", "%d минут"); },
        hour: "час",
        hours: function(value) { return numpf(value, "%d час", "%d часа", "%d часов"); },
        day: "день",
        days: function(value) { return numpf(value, "%d день", "%d дня", "%d дней"); },
        month: "месяц",
        months: function(value) { return numpf(value, "%d месяц", "%d месяца", "%d месяцев"); },
        year: "год",
        years: function(value) { return numpf(value, "%d год", "%d года", "%d лет"); }
    };
    $('time.timeago').timeago();
</script>
@stop