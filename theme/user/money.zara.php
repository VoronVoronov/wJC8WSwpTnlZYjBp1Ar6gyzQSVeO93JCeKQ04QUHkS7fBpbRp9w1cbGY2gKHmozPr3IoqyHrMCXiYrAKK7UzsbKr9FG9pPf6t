@extends("_common/main")
@section("content")
<div class="page-name">
    <h2>Мои выплаты</h2>
    <a href="#" class="btn btn-default btn-sm pull-right newRequestBtn" style="margin-top: 15px;">
        Запросить выплату
    </a>
    <div class="clear"></div>
</div>

<div class="row">
    <div class="col-md-12">
        <table class="money_back">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Номер кошелька</th>
                    <th>Время</th>
                    <th>Сумма</th>
                    <th>Статус</th>
                </tr>
            </thead>
            <tbody>
                @foreach($money as $item)
                <tr>
                    <td>{{ $item['money_id'] }}</td>
                    <td>{{ $item['money_wallet'] }}</td>
                    <td>
                        <!--<time datetime="{{ date("Y-m-d\TH:i:s\Z", strtotime($item['money_time'])) }}" class="timeago"></time>-->
                        {{ date("H:i d.m.Y", strtotime($item['money_time'])) }}
                    </td>
                    <td>{{ $item['money_back'] }} {{ getHumanCurrency($item['money_curr']) }}</td>
                    <td>
                        @if($item['money_status'] == 0)
                        <span class="label label-warning">Ожидает выплаты</span>
                        @elseif($item['money_status'] == 1)
                        <span class="label label-success">Выплачено</span>
                        @elseif($item['money_status'] == 2)
                        <span class="label label-danger">Ошибка выплаты</span>
                        @endif
                    </td>
                </tr>
                @endforeach
                @if(empty($money))
                <tr>
                    <td colspan="5" style="text-align: center;">Список пуст</td>
                </tr>
                @endif
            </tbody>
        </table>

        {{ $pagination }}
    </div>
</div>

<!-- Модальное окно -->
<div id="newRequestModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Новая выплата</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label for="style_follower_message_font_family" class="col-sm-3 control-label">Сумма</label>
                        <div class="col-sm-6">
                            <input type="number" id="money_sum" class="form-control" placeholder="Введите сумму">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="style_follower_message_font_family" class="col-sm-3 control-label">Система</label>
                        <div class="col-sm-6">
                            <select id="money_system" class="form-control">
                                <option value="0" selected disabled>Выберите платежную систему</option>
                                <option value="1">Qiwi</option>
                                <option value="2">WebMoney</option>
                                <option value="3">Яндекс.Деньги</option>
                                <option value="4">Банковский счет</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-sm btn-default" id="money_btn">Запросить</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Модальное окно -->

@stop

@section("plugins-scripts")
<script src="/assets/js/timeago.min.js"></script>
@stop
<script type="text/javascript" src="https://vk.com/js/api/openapi.js?162"></script>

<div id="vk_community_messages"></div>
<script type="text/javascript">
VK.Widgets.CommunityMessages("vk_community_messages", 190202028, {tooltipButtonText: "Здравствуйте,чем могу вам помочь?"});
</script>
@section("scripts")
<script>
    $(document).ready(function () {

        $(".newRequestBtn").click(function () {
            $("#newRequestModal").modal("show");

            return false;
        });

        $("#money_btn").click(function(){
            $.ajax({
                url: location.href,
                type: "POST",
                data: {request_money: true, money_system: $("#money_system").val(), money_sum: $("#money_sum").val()},
                success: function (data) {
                    data = JSON.parse(data);

                    switch (data.status) {
                        case "success":
                            $("#newRequestModal").modal("hide");
                            fly_p("success", "Ваш запрос на выплату был создан!");
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
    });
</script>
@stop