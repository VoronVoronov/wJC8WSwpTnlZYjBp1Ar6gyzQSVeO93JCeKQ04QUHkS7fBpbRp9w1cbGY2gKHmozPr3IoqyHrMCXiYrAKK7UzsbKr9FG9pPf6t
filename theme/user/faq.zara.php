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
<script type="text/javascript" src="https://vk.com/js/api/openapi.js?162"></script>

<div id="vk_community_messages"></div>
<script type="text/javascript">
VK.Widgets.CommunityMessages("vk_community_messages", 190202028, {tooltipButtonText: "Здравствуйте,чем могу вам помочь?"});
</script>
@section("scripts")
<script>
    $(document).ready(function () {
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