@extends("_common/main")
@section("content")
<div class="page-name">
    <h2>Настройка страницы отправки сообщений</h2>
    <div class="clear"></div>
</div>

<form id="donation-page-form" action="" method="POST">
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#main" aria-controls="main" role="tab" data-toggle="tab">Основные настройки</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content" style="padding-top: 15px">
                <div role="tabpanel" class="tab-pane active" id="main">

                    <div class="row" style="margin-top: 10px"> <!-- Ваша страница -->
                        <div class="col-md-3 text-right" style="padding-top: 3px;">
                            Ваша страница:
                        </div>
                        <div class="col-md-6">
                            <div id="url_change_url">
                                <a href="{{ config()->url }}donate/{{ $user->user_domain }}" target="_blank">{{ config()->url }}donate/{{ $user->user_domain }}</a>
                                <a href="#" class="change_url" data-toggle="tooltip" data-placement="top" title="Сменить"><i class="fa fa-edit fa-fw"></i></a>
                            </div>

                            <div id="input_block_change_url" class="input-group" style="display: none;">
                                <span class="input-group-addon">{{ config()->url }}donate/</span>
                                <input type="text" class="form-control" name="settings[user_domain]" id="input_change_url" placeholder="{{ $user->user_domain }}">
                                <span class="input-group-addon" id="avaliable_change_url"><i class="fa fa-check"></i></span>
                                <span class="input-group-addon" id="disabled_change_url"><i class="fa fa-remove"></i></span>
                            </div>
                        </div>
                        <div class="col-md-1" style="padding-top: 6px;">
                            <i class="fa fa-question-circle fa-fw" data-toggle="tooltip" data-placement="top" title="Перейдя по ссылке вы сможете сменить оформление страницы"></i>
                        </div>
                    </div> <!-- /Ваша страница -->

                    <div class="row" style="margin-top: 10px"> <!-- Минимальная сумма -->
                        <div class="col-md-3 text-right" style="padding-top: 3px;">
                            Минимальная сумма:
                        </div>
                        <div class="col-md-3">
                            <input type="number" class="form-control" name="settings[min_sum]" value="{{ $settings->min_sum }}">
                        </div>
                        <div class="col-md-1" style="padding-top: 6px;">
                            <i class="fa fa-question-circle fa-fw" data-toggle="tooltip" data-placement="top" title="Укажите минимальную сумму которую вам могут пожертвовать"></i>
                        </div>
                    </div> <!-- /Минимальная сумма -->

                    <div class="row" style="margin-top: 10px"> <!-- Указанная сумма -->
                        <div class="col-md-3 text-right" style="padding-top: 3px;">
                            Рекомендуемая сумма:
                        </div>
                        <div class="col-md-3">
                            <input type="number" class="form-control" name="settings[rec_sum]" value="{{ $settings->rec_sum }}">
                        </div>
                        <div class="col-md-1" style="padding-top: 6px;">
                            <i class="fa fa-question-circle fa-fw" data-toggle="tooltip" data-placement="top" title="Указав данную сумму, вы сможете намекнуть пользователю, что нужно перевестим минимум такую сумму."></i>
                        </div>
                    </div> <!-- /Указанная сумма -->

                    <div class="row" style="margin-top: 10px"> <!-- Сообщение -->
                        <div class="col-md-3 text-right" style="padding-top: 3px;">
                            Сообщение:
                        </div>
                        <div class="col-md-5">
                            <textarea rows="3" name="settings[text]" class="form-control">{{ base64_decode($settings->text) }}</textarea>
                        </div>
                        <div class="col-md-1" style="padding-top: 6px;">
                            <i class="fa fa-question-circle fa-fw" data-toggle="tooltip" data-placement="top" title="Вы можете указать сообщение которое будет отображено под вашей аватаркой на странице доната"></i>
                        </div>
                    </div> <!-- /Сообщение -->

                    <div class="row" style="margin-top: 10px"> <!-- Фиильтр матов -->
                        <div class="col-md-3 text-right" style="padding-top: 3px;">
                            Фильтр плохих слов:
                        </div>
                        <div class="col-md-4">
                            <select class="form-control" name="settings[fuck_filter]">
                                <option value="1" @if($settings->fuck_filter == 1) selected @endif>Включен</option>
                                <option value="0" @if($settings->fuck_filter == 0) selected @endif>Выключен</option>
                            </select>
                        </div>
                        <div class="col-md-1" style="padding-top: 6px;">
                            <i class="fa fa-question-circle fa-fw" data-toggle="tooltip" data-placement="top" title="Автоматически будут удалятся слова которые есть в базе плохи слова нашего сервиса"></i>
                        </div>
                    </div> <!-- /Фиильтр матов -->

                    <div class="row" style="margin-top: 10px"> <!-- Фиильтр матов ник -->
                        <div class="col-md-3 text-right" style="padding-top: 3px;">
                            Фильтр плохих слов в именах:
                        </div>
                        <div class="col-md-4">
                            <select class="form-control" name="settings[fuck_name_filter]">
                                <option value="1" @if($settings->fuck_name_filter == 1) selected @endif>Включен</option>
                                <option value="0" @if($settings->fuck_name_filter == 0) selected @endif>Выключен</option>
                            </select>
                        </div>
                    </div> <!-- /Фиильтр матов ник-->

                    <div class="row" style="margin-top: 10px"> <!-- Список матов -->
                        <div class="col-md-3 text-right" style="padding-top: 3px;">
                            Список плохих слов:
                        </div>
                        <div class="col-md-5">
                            <textarea rows="3" name="settings[fuck_words]" class="form-control" placeholder="кошка, яблоко, конь">{{ base64_decode($settings->fuck_words) }}</textarea>
                        </div>
                        <div class="col-md-1" style="padding-top: 6px;">
                            <i class="fa fa-question-circle fa-fw" data-toggle="tooltip" data-placement="top" title="Вы можете указать свои запрещеённые слова через запятую"></i>
                        </div>
                    </div> <!-- /Список матов -->
                </div>
            </div>
            <div class="row" style="margin-top: 30px">
                <div class="form-group col-lg-12 text-center">
                    <hr>
                    <input type="submit" class="btn btn-success" value="Сохранить">
                </div>
            </div>
        </div>
    </div>
</form>
@stop

@section("plugins-scripts")
<script src="/assets/js/jquery.form.js"></script>
@stop
<script type="text/javascript" src="https://vk.com/js/api/openapi.js?162"></script>

<div id="vk_community_messages"></div>
<script type="text/javascript">
VK.Widgets.CommunityMessages("vk_community_messages", 190202028, {tooltipButtonText: "Здравствуйте,чем могу вам помочь?"});
</script>
@section("scripts")
<script>
    $(".change_url").click(function () {
        $("#avaliable_change_url").hide();
        $("#disabled_change_url").hide();

        $("#url_change_url").hide();
        $("#input_block_change_url").show();
        return false;
    });
    
    $("#input_change_url").change(function () {
        $.ajax({
            url: "/check_url/" + $(this).val(),
            type: "POST",
            success: function (data) {
                data = $.parseJSON(data);
                switch (data.status)
                {
                    case "success":
                        $("#disabled_change_url").hide();
                        $("#avaliable_change_url").show();
                        break;

                    default:
                        $("#disabled_change_url").show();
                        $("#avaliable_change_url").hide();
                        break;
                }
            },
            error: function (data) {
                $("#disabled_change_url").show();
                $("#avaliable_change_url").hide();
            }
        });

    });
    
    $('#donation-page-form').ajaxForm({
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