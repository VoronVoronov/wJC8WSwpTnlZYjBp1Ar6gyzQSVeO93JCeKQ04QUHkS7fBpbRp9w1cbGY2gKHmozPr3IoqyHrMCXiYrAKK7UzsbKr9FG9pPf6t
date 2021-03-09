@extends("_common/main")
@section("content")
<div class="page-name">
    <h2>Административная панель / Выплаты</h2>
    <h3>Сегодня - {{ getCurrentHumanDate() }}</h3>
    <div class="clear"></div>
</div>

<table class="money_back">
    <thead>
    <tr>
        <td><b>#</b></td>
        <td><b>ID пользователя</b></td>
        <td><b>Номер счета</b></td>
        <td><b>Код</b></td>
        <td><b>Сумма</b></td>
        <td><b>Способ</b></td>
        <td><b>Дата</b></td>
        <td><b>Статус</b></td>
        <td><b>Действие</b></td>
    </tr>
    </thead>
    <tbody>
        @if(empty($payouts))
        <tr>
            <td style="text-align: center;" colspan="3">Список выплат пуст</td>
        </tr>
        @else
        @foreach($payouts as $payout)
        
        <tr>
            <td>{{ $payout['money_id'] }}</td>
            <td>{{ $payout['user_id'] }}</td>
            <td>{{ $payout['money_wallet'] }}</td>
            <td>{{ $payout['money_code'] }}</td>
            <td>{{ $payout['money_sum'] }} ₽</td>
            
            <td> @if($payout['money_method'] == 1)
            
            <strong>QIWI</strong> 
            @elseif($payout['money_method'] == 2)
            
            <strong>WebMoney</strong> 
            @elseif($payout['money_method'] == 3)
            
            <strong>Яндекс.Деньги</strong> 
            @elseif($payout['money_method'] == 4)
            
            <strong>Банковский счет</strong> 
            @endif
            </td>
            
            <td><time datetime="{{ date("Y-m-d\TH:i:s\Z", strtotime($payout['money_time'])) }}" class="timeago"></time></td>
            <td> @if($payout['money_status'] == 0)
            
            <a stmnid="<?php echo $payout['money_id'] ?>" class="btn btn-warning btn-xs">Ожидается</a> 
            @elseif($payout['money_status'] == 1)
            
            <a stmnid="<?php echo $payout['money_id'] ?>" class="btn btn-success btn-xs">Выплачено</a> 
            @elseif($payout['money_status'] == 2)
            
            <a stmnid="<?php echo $payout['money_id'] ?>" class="btn btn-danger btn-xs">Ошибка</a> 
            @endif
            </td>
            
             <td ><i class="fa fa-check okRequest" data-id="<?php echo $payout['money_id'] ?>" data-toggle="tooltip" data-placement="top" title="Оплачено"></i><i class="fa fa-remove aremoveRequest" data-id="<?php echo $payout['money_id'] ?>" data-toggle="tooltip" data-placement="top" title="Отменить"></i></td>
            
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