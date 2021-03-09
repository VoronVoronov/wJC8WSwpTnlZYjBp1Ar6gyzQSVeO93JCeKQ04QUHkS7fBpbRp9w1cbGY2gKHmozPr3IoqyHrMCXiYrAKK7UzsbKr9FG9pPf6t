@extends("_common/main")
@section("content")
<div class="page-name">
    <h2>Административная панель / Пользователи</h2>
    <h3>Сегодня - {{ getCurrentHumanDate() }}</h3>
    <div class="clear"></div>
</div>

<table class="money_back">
    <thead>
    <tr>
        <td><b>#</b></td>
        <td><b>Логин</b></td>
        <td><b>Ссылка<b></td>
        <td><b>Баланс</b></td>
        <td><b>IP</b></td>
        <td><b>Последний вход</b></td>
        <td><b>Группа</b></td>
        <td></td>
    </tr>
    </thead>
    <tbody>
        @if(empty($users))
        <tr>
            <td style="text-align: center;" colspan="3">Список пользователей пуст</td>
        </tr>
        @else

        @foreach($users as $user)
        
        <tr>
            <td>{{ $user['user_id'] }}</td>
            <td>{{ $user['user_login_show'] }}</td>
            <td> <a href="{{ $this->config->url() }}/{{ $user['user_domain'] }}/">Клик</a></td>
            
            <td>{{ $user['user_balance'] }} ₽</td>
            <td>{{ long2ip($user['user_last_ip']) }}</td>
            
            
            <td><time datetime="{{ date("Y-m-d\TH:i:s\Z", strtotime($user['user_last_login_time'])) }}" class="timeago"></time></td>
            <td> @if($user['user_group'] == 1)
            
            <a class="btn btn-default btn-xs">Пользователь</a> 
            @elseif($user['user_group'] == 2)
            
            <a class="btn btn-info btn-xs">Партнер</a> 
            @elseif($user['user_group'] == 3)
            
            <a class="btn btn-success btn-xs">Модератор </a> 
             @elseif($user['user_group'] == 4)
            
            <a class="btn btn-danger btn-xs">Администратор </a> 
            @endif
            </td>
            
            <td><a href="{{ $this->config->url() }}/admin/users/{{ $user['user_id'] }}"><i class="fa fa-edit okRequest" data-toggle="tooltip" data-placement="top" title="Редактировать"></i></a></td>
            
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
  
            ["{{ getHumanDate($item['donation_end_time']) }}",  {{ $item['sum'] }}, {{ $item['sum'] / 100 * 5 }}],
            @endforeach
        ]);

        var options = {
            vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('graph-stats'));
        chart.draw(data, options);
    }
    @endif
    
     $(".okRequest").click(function(){
              $.ajax({
             
                url: location.pathname,
                type: "POST",
                data: {ajax: "okRequest", item_id: $(this).attr("data-id")},
                success: function(data) {
                    console.log(data);
                    data = $.parseJSON(data);
                    switch(data.status) {
                        case 'error':
                            fly_p('danger', data.error);
                            $('button[type=submit]').prop('disabled', false);
                            break;
                        case 'success':
                            fly_p("success", "Выплата выполнена!");
                            location.reload()
                            break;
                        }
                   }
              })
          });

          $(".aremoveRequest").click(function(){
              $.ajax({
              
                url: location.pathname,
                type: "POST",
                data: {ajax: "aremoveRequest", item_id: $(this).attr("data-id")},
                success: function(data) {
                    console.log(data);
                    data = $.parseJSON(data);
                    switch(data.status) {
                        case 'error':
                            fly_p('danger', data.error);
                            $('button[type=submit]').prop('disabled', false);
                            break;
                        case 'success':
                            fly_p("success", "Выплата отменена!");
                            location.reload()
                            break;
                        }
                    }
              })
          });
      

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
    
    $('#payout-page-form').ajaxForm({
    url: location.href,
    dataType: 'text',
    success: function(data) {
        console.log(data);
        data = $.parseJSON(data);
        switch(data.status) {
            case 'error':
                fly_p('danger', data.error);
                $('button[type=submit]').prop('disabled', false);
                break;
            case 'success':
                fly_p("success", "Настройки успешно сохранены!");
                break;
        }
    },
    beforeSubmit: function(arr, $form, options) {
        $('button[type=submit]').prop('disabled', true);
    }
    });
    
    
    
</script>
@stop