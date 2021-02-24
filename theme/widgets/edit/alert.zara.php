@extends("_common/main")
@section("content")
<div class="page-name">
    <h2>Виджет оповещений</h2>
    <div class="clear"></div>
</div>

<div class="row">
    <div class="col-md-12" style="margin-bottom: 20px;">
        <div class="btn-group" data-toggle="buttons" id="tour_alert_one">
            <label class="btn btn-default btn-sm active">
                <input type="checkbox" id="followers_widget_status" autocomplete="off" checked> {{ lang('main.widget_followers_label') }}
            </label>
            <label class="btn btn-default btn-sm active">
                <input type="checkbox" id="subscribers_widget_status" autocomplete="off" checked> {{ lang('main.widget_subsribers_label') }}
            </label>
            <label class="btn btn-default btn-sm active">
                <input type="checkbox" id="donations_widget_status" autocomplete="off" checked> {{ lang('main.widget_donations_label') }}
            </label>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-9" style="margin-bottom: 20px;" id="tour_alert_two">
        <div class="input-group">
            <div class="widget-url-guard-alert-box form-control">
                <i class="fa fa-lock"></i> {{ lang('main.widget_show_url_token') }}
            </div>
            <input class="form-control widget-url-alert" value="{{ config()->url }}widget/{{ $widget['widget_token'] }}" style="display: none;">
            <div class="input-group-btn">
                <button type="button" class="btn btn-default windget-start-btn" onclick="window.open('{{ config()->url }}widget/{{ $widget['widget_token'] }}?bg=true', 'alert-widget', 'menubar=0,resizable=1,width=1000,height=600').focus();">
                    Запустить
                </button>
            </div>
        </div>
    </div>
</div>

<div class="row" style="margin-bottom: 20px;">
    <div class="col-md-12">
        <h4>Тестовые оповещения:</h4>
        <div class="btn-group" role="group" id="tour_alert_three">
            <button type="button" class="btn btn-default" id="sendFollowerAlert">{{ lang('main.widget_new_follower_label') }}</button>
            <button type="button" class="btn btn-default" id="sendSubscriberAlert">{{ lang('main.widget_new_subscriber_label') }}</button>
            <button type="button" class="btn btn-default" id="sendDonationAlert">{{ lang('main.widget_new_donation_label') }}</button>
        </div>
    </div>
</div>

<form action="" method="POST">
<div class="row" id="tour_alert_four">
    <div class="col-md-12">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#main" aria-controls="main" role="tab" data-toggle="tab">{{ lang('main.main_settings_label') }}</a></li>
            <li role="presentation"><a href="#follower" aria-controls="follower" role="tab" data-toggle="tab">{{ lang('main.widget_new_follower_label') }}</a></li>
            <li role="presentation"><a href="#subscriber" aria-controls="subscriber" role="tab" data-toggle="tab">{{ lang('main.widget_new_subscriber_label') }}</a></li>
            <li role="presentation"><a href="#donation" aria-controls="donation" role="tab" data-toggle="tab">{{ lang('main.widget_new_donation_label') }}</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content" style="padding-top: 15px">
            <div role="tabpanel" class="tab-pane active" id="main">
                <div class="row"> <!-- Задний фон -->
                    <div class="col-md-3 text-right">
                        Цвет фона:
                    </div>
                    <div class="col-md-4">
                        <div id="cp1" class="input-group colorpicker-component">
                            <input type="text" value="{{ $widget['widget_config']->background }}" class="form-control" name="config[background]"/>
                            <span class="input-group-addon"><i></i></span>
                        </div>
                    </div>
                    <div class="col-md-1" style="padding-top: 6px;">
                        <i class="fa fa-question-circle fa-fw" data-toggle="tooltip" data-placement="top" title="Вы можете установить цвет который вы будете использовать как хромакей"></i>
                    </div>
                </div> <!-- /Задний фон -->

                <div class="row" style="margin-top: 10px"> <!-- Продолжительность -->
                    <div class="col-md-3 text-right">
                        Продолжительность оповещения:
                    </div>
                    <div class="col-md-4" style="padding-top: 8px;">
                        <input type="range" class="form-control" id="alert_time" name="config[alert_time]">
                    </div>
                    <div class="col-md-1" style="padding-top: 8px;">
                        <i class="fa fa-question-circle fa-fw" data-toggle="tooltip" data-placement="top" title="Сколько времени будет показыватся оповещение"></i>
                    </div>
                </div> <!-- /Продолжительность -->

                <div class="row" style="margin-top: 10px"> <!-- Следующий -->
                    <div class="col-md-3 text-right">
                        Следующее оповещение:
                    </div>
                    <div class="col-md-4">
                        <input type="range" class="form-control" id="next_alert_time" name="config[next_alert_time]">
                    </div>
                    <div class="col-md-1" style="padding-top: 3px;">
                        <i class="fa fa-question-circle fa-fw" data-toggle="tooltip" data-placement="top" title="Через сколько времени будет показано следующее оповещение"></i>
                    </div>
                </div> <!-- /Следующий -->
            </div>
            <div role="tabpanel" class="tab-pane" id="follower">
                <div class="row"> <!-- Оповещение о новых подписчиках -->
                    <div class="col-md-3 text-right">
                        Оповещения о новых подписчиках
                    </div>
                    <div class="col-md-4">
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-danger @if($widget['widget_config']->follower->status == 0) active @endif">
                                <input type="radio" name="config[follower][status]" autocomplete="off" @if($widget['widget_config']->follower->status == 0) checked @endif value="0">Выключить
                            </label>
                            <label class="btn btn-success @if($widget['widget_config']->follower->status == 1) active @endif">
                                <input type="radio" name="config[follower][status]" autocomplete="off" @if($widget['widget_config']->follower->status == 1) checked @endif value="1">Включить
                            </label>
                        </div>
                    </div>
                    <div class="col-md-1" style="padding-top: 3px;">
                        <i class="fa fa-question-circle fa-fw" data-toggle="tooltip" data-placement="top" title="Отключив этот тип оповещений, оповещения о новых подписчиках будут отключены"></i>
                    </div>
                </div> <!-- Оповещение о новых подписчиках -->
                <div class="row" style="margin-top: 10px"> <!-- Шаблон оповещения -->
                    <div class="col-md-3 text-right">
                        {{ lang('main.widget_new_follower_label') }}:
                    </div>
                    <div class="col-md-8">
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default @if($widget['widget_config']->follower->layout == 1) active @endif">
                                <input type="radio" name="config[follower][layout]" autocomplete="off" @if($widget['widget_config']->follower->layout == 1) checked @endif value="1"><img src="/assets/images/above-layout.png" alt="">
                            </label>
                            <label class="btn btn-default @if($widget['widget_config']->follower->layout == 2) active @endif">
                                <input type="radio" name="config[follower][layout]" autocomplete="off" @if($widget['widget_config']->follower->layout == 2) checked @endif value="2"><img src="/assets/images/banner-layout.png" alt="">
                            </label>
                            <label class="btn btn-default @if($widget['widget_config']->follower->layout == 3) active @endif">
                                <input type="radio" name="config[follower][layout]" autocomplete="off" @if($widget['widget_config']->follower->layout == 3) checked @endif value="3"><img src="/assets/images/side-layout.png" alt="">
                            </label>
                        </div>
                    </div>
                </div> <!-- /Шаблон оповещения -->
                <div class="row" style="margin-top: 10px"> <!-- Изображение -->
                    <div class="col-md-3 text-right" style="padding-top: 3px;">
                        {{ lang('main.widget_image_label') }}:
                    </div>
                    <div class="col-md-5">
                        <div style="width: 400px;">
                            <div class="image-input" id="follower_image_bg" style="background-image: url('{{ $widget['widget_config']->follower->image }}');">
                                <input type="hidden" id="follower_image_input" name="config[follower][image]" value="{{ $widget['widget_config']->follower->image }}">
                                <input type="hidden" id="follower_image_input_name" name="config[follower][image_name]" value="{{ base64_decode($widget['widget_config']->follower->image_name) }}">
                                <div>
                                    <span id="follower_image_name">{{ base64_decode($widget['widget_config']->follower->image_name) }}</span>
                                    <i class="fa fa-image media-gallery-choose-file" data-id="follower_image" data-type="1"></i>
                                    <i class="fa fa-times media-gallery-remove-file" data-id="follower_image" data-type="1"></i>
                                    <i class="fa fa-search-plus" onclick="window.open($('#follower_image_input').val(),'_blank');"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- /Изображение -->
                <div class="row" style="margin-top: 10px"> <!-- Аудио -->
                    <div class="col-md-3 text-right" style="padding-top: 3px;">
                        {{ lang('main.widget_audio_label') }}:
                    </div>
                    <div class="col-md-5">
                        <div style="width: 400px;">
                            <div class="image-input" style="min-height: 32px;">
                                <input type="hidden" id="follower_audio_input" name="config[follower][audio]" value="{{ $widget['widget_config']->follower->audio }}">
                                <input type="hidden" id="follower_audio_input_name" name="config[follower][audio_name]" value="{{ base64_decode($widget['widget_config']->follower->audio_name) }}">
                                <div>
                                    <span id="follower_audio_name">{{ base64_decode($widget['widget_config']->follower->audio_name) }}</span>
                                    <i class="fa fa-image media-gallery-choose-file" data-id="follower_audio" data-type="2"></i>
                                    <i class="fa fa-times media-gallery-remove-file" data-id="follower_audio" data-type="2"></i>
                                    <i class="fa fa-play" onclick="window.open($('#follower_audio_input').val(),'_blank');"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- /Аудио -->
                <div class="row" style="margin-top: 10px"> <!-- Шаблон сообщения -->
                    <div class="col-md-3 text-right" style="padding-top: 3px;">
                        {{ lang('main.widget_message_layout_label') }}:
                    </div>
                    <div class="col-md-5">
                        <input type="text" class="form-control" id="follower_message_layout" name="config[follower][message_layout]" value="{{ base64_decode($widget['widget_config']->follower->message_layout) }}" data-toggle="tooltip" data-placement="top" title="Доступные теги: :name">
                    </div>
                    <div class="col-md-1" style="padding-top: 6px;">
                        <i class="fa fa-question-circle fa-fw" data-toggle="tooltip" data-placement="top" title="Вы можете изменить шаблон выводимого сообщения."></i>
                    </div>
                </div> <!-- /Шаблон сообщения -->
                <div class="row" style="margin-top: 10px"> <!-- Стиль оповещения -->
                    <div class="col-md-3 text-right" style="padding-top: 3px;">
                        {{ lang('main.widget_message_style_label') }}: 
                    </div>
                    <div class="col-md-5">
                        <a href="#" class="btn btn-default btn-sm styleFollowerMessageBtn" onclick="$('#styleFollowerMessageModal').modal('show'); return false;"><i class="fa fa-font"></i> Изменить</a>
                    </div>
                </div> <!-- /Стиль оповещения -->
            </div>
            <div role="tabpanel" class="tab-pane" id="subscriber">
                <div class="row"> <!-- Оповещение о платных подписчиках -->
                    <div class="col-md-3 text-right">
                        Оповещения о платных подписчиках
                    </div>
                    <div class="col-md-4">
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-danger @if($widget['widget_config']->subscribe->status == 0) active @endif">
                                <input type="radio" name="config[subscribe][status]" autocomplete="off" @if($widget['widget_config']->subscribe->status == 0) checked @endif value="0">Выключить
                            </label>
                            <label class="btn btn-success @if($widget['widget_config']->subscribe->status == 1) active @endif">
                                <input type="radio" name="config[subscribe][status]" autocomplete="off" @if($widget['widget_config']->subscribe->status == 1) checked @endif value="1">Включить
                            </label>
                        </div>
                    </div>
                    <div class="col-md-1" style="padding-top: 3px;">
                        <i class="fa fa-question-circle fa-fw" data-toggle="tooltip" data-placement="top" title="Отключив этот тип оповещений, оповещения о новых платных подписчиках будут отключены"></i>
                    </div>
                </div> <!-- Оповещение о платных подписчиках -->
                <div class="row" style="margin-top: 10px"> <!-- Шаблон оповещения -->
                    <div class="col-md-3 text-right">
                        {{ lang('main.widget_alert_layout_label') }}:
                    </div>
                    <div class="col-md-8">
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default @if($widget['widget_config']->subscribe->layout == 1) active @endif">
                                <input type="radio" name="config[subscribe][layout]" autocomplete="off" @if($widget['widget_config']->subscribe->layout == 1) checked @endif value="1"><img src="/assets/images/above-layout.png" alt="">
                            </label>
                            <label class="btn btn-default @if($widget['widget_config']->subscribe->layout == 2) active @endif">
                                <input type="radio" name="config[subscribe][layout]" autocomplete="off" @if($widget['widget_config']->subscribe->layout == 2) checked @endif value="2"><img src="/assets/images/banner-layout.png" alt="">
                            </label>
                            <label class="btn btn-default @if($widget['widget_config']->subscribe->layout == 3) active @endif">
                                <input type="radio" name="config[subscribe][layout]" autocomplete="off" @if($widget['widget_config']->subscribe->layout == 3) checked @endif value="3"><img src="/assets/images/side-layout.png" alt="">
                            </label>
                        </div>
                    </div>
                </div> <!-- /Шаблон оповещения -->
                <div class="row" style="margin-top: 10px"> <!-- Изображение -->
                    <div class="col-md-3 text-right" style="padding-top: 3px;">
                        {{ lang('main.widget_image_label') }}:
                    </div>
                    <div class="col-md-5">
                        <div style="width: 400px;">
                            <div class="image-input" id="subscriber_image_bg" style="background-image: url('{{ $widget['widget_config']->subscribe->image }}');">
                                <input type="hidden" id="subscriber_image_input" name="config[subscribe][image]" value="{{ $widget['widget_config']->subscribe->image }}">
                                <input type="hidden" id="subscriber_image_input_name" name="config[subscribe][image_name]" value="{{ base64_decode($widget['widget_config']->subscribe->image_name) }}">
                                <div>
                                    <span id="subscriber_image_name">{{ base64_decode($widget['widget_config']->subscribe->image_name) }}</span>
                                    <i class="fa fa-image media-gallery-choose-file" data-id="subscriber_image" data-type="1"></i>
                                    <i class="fa fa-times media-gallery-remove-file" data-id="subscriber_image" data-type="1"></i>
                                    <i class="fa fa-search-plus" onclick="window.open($('#subscriber_image_input').val(),'_blank');"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- /Изображение -->
                <div class="row" style="margin-top: 10px"> <!-- Аудио -->
                    <div class="col-md-3 text-right" style="padding-top: 3px;">
                         {{ lang('main.widget_audio_label') }}:
                    </div>
                    <div class="col-md-5">
                        <div style="width: 400px;">
                            <div class="image-input" style="min-height: 32px;">
                                <input type="hidden" id="subscriber_audio_input" name="config[subscribe][audio]" value="{{ $widget['widget_config']->subscribe->audio }}">
                                <input type="hidden" id="subscriber_audio_input_name" name="config[subscribe][audio_name]" value="{{ base64_decode($widget['widget_config']->subscribe->audio_name) }}">
                                <div>
                                    <span id="subscriber_audio_name">{{ base64_decode($widget['widget_config']->subscribe->audio_name) }}</span>
                                    <i class="fa fa-image media-gallery-choose-file" data-id="subscriber_audio" data-type="2"></i>
                                    <i class="fa fa-times media-gallery-remove-file" data-id="subscriber_audio" data-type="2"></i>
                                    <i class="fa fa-play" onclick="window.open($('#subscriber_audio_input').val(),'_blank');"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- /Аудио -->
                <div class="row" style="margin-top: 10px"> <!-- Шаблон сообщения -->
                    <div class="col-md-3 text-right" style="padding-top: 3px;">
                         {{ lang('main.widget_message_layout_label') }}:
                    </div>
                    <div class="col-md-5">
                        <input type="text" class="form-control" id="subscribe_message_layout" name="config[subscribe][message_layout]" value="{{ base64_decode($widget['widget_config']->subscribe->message_layout) }}" data-toggle="tooltip" data-placement="top" title="Доступные теги: :name">
                    </div>
                    <div class="col-md-1" style="padding-top: 6px;">
                        <i class="fa fa-question-circle fa-fw" data-toggle="tooltip" data-placement="top" title="Вы можете изменить шаблон выводимого сообщения."></i>
                    </div>
                </div> <!-- /Шаблон сообщения -->
                <div class="row" style="margin-top: 10px"> <!-- Стиль оповещения -->
                    <div class="col-md-3 text-right" style="padding-top: 3px;">
                         {{ lang('main.widget_message_style_label') }}:
                    </div>
                    <div class="col-md-5">
                        <a href="#" class="btn btn-default btn-sm styleSubscribeMessageBtn" onclick="$('#styleSubscribeMessageModal').modal('show'); return false;"><i class="fa fa-font"></i> Изменить</a>
                    </div>
                </div> <!-- /Стиль оповещения -->
            </div>
            <div role="tabpanel" class="tab-pane" id="donation">
                <div class="row"> <!-- Оповещение о донате -->
                    <div class="col-md-3 text-right">
                        Оповещения о пожертвовании:
                    </div>
                    <div class="col-md-4">
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-danger @if($widget['widget_config']->donation->status == 0) active @endif">
                                <input type="radio" name="config[donation][status]" autocomplete="off" @if($widget['widget_config']->donation->status == 0) checked @endif value="0">Выключить
                            </label>
                            <label class="btn btn-success @if($widget['widget_config']->donation->status == 1) active @endif">
                                <input type="radio" name="config[donation][status]" autocomplete="off" @if($widget['widget_config']->donation->status == 1) checked @endif value="1">Включить
                            </label>
                        </div>
                    </div>
                    <div class="col-md-1" style="padding-top: 3px;">
                        <i class="fa fa-question-circle fa-fw" data-toggle="tooltip" data-placement="top" title="Отключив этот тип оповещений, оповещения о новых пожертвованиях будут отключены"></i>
                    </div>
                </div> <!-- Оповещение о платных подписчиках -->
                <div class="row" style="margin-top: 10px"> <!-- Шаблон оповещения -->
                    <div class="col-md-3 text-right">
                       {{ lang('main.widget_new_follower_label') }}:
                    </div>
                    <div class="col-md-8">
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default @if($widget['widget_config']->donation->layout == 1) active @endif">
                                <input type="radio" name="config[donation][layout]" autocomplete="off" @if($widget['widget_config']->donation->layout == 1) checked @endif value="1"><img src="/assets/images/above-layout.png" alt="">
                            </label>
                            <label class="btn btn-default @if($widget['widget_config']->donation->layout == 2) active @endif">
                                <input type="radio" name="config[donation][layout]" autocomplete="off" @if($widget['widget_config']->donation->layout == 2) checked @endif value="2"><img src="/assets/images/banner-layout.png" alt="">
                            </label>
                            <label class="btn btn-default @if($widget['widget_config']->donation->layout == 3) active @endif">
                                <input type="radio" name="config[donation][layout]" autocomplete="off" @if($widget['widget_config']->donation->layout == 3) checked @endif value="3"><img src="/assets/images/side-layout.png" alt="">
                            </label>
                        </div>
                    </div>
                </div> <!-- /Шаблон оповещения -->
                <div class="row" style="margin-top: 10px"> <!-- Изображение -->
                    <div class="col-md-3 text-right" style="padding-top: 3px;">
                        {{ lang('main.widget_image_label') }}:
                    </div>
                    <div class="col-md-5">
                        <div style="width: 400px;">
                            <div class="image-input" id="donation_image_bg" style="background-image: url('{{ $widget['widget_config']->donation->image }}');">
                                <input type="hidden" id="donation_image_input" name="config[donation][image]" value="{{ $widget['widget_config']->donation->image }}">
                                <input type="hidden" id="donation_image_input_name" name="config[donation][image_name]" value="{{ base64_decode($widget['widget_config']->donation->image_name) }}">
                                <div>
                                    <span id="donation_image_name">{{ base64_decode($widget['widget_config']->donation->image_name) }}</span>
                                    <i class="fa fa-image media-gallery-choose-file" data-id="donation_image" data-type="1"></i>
                                    <i class="fa fa-times media-gallery-remove-file" data-id="donation_image" data-type="1"></i>
                                    <i class="fa fa-search-plus" onclick="window.open($('#donation_image_input').val(),'_blank');"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- /Изображение -->
                <div class="row" style="margin-top: 10px"> <!-- Аудио -->
                    <div class="col-md-3 text-right" style="padding-top: 3px;">
                        {{ lang('main.widget_audio_label') }}:
                    </div>
                    <div class="col-md-5">
                        <div style="width: 400px;">
                            <div class="image-input" style="min-height: 32px;">
                                <input type="hidden" id="donation_audio_input" name="config[donation][audio]" value="{{ $widget['widget_config']->donation->audio }}">
                                <input type="hidden" id="donation_audio_input_name" name="config[donation][audio_name]" value="{{ base64_decode($widget['widget_config']->donation->audio_name) }}">
                                <div>
                                    <span id="donation_audio_name">{{ base64_decode($widget['widget_config']->donation->audio_name) }}</span>
                                    <i class="fa fa-image media-gallery-choose-file" data-id="donation_audio" data-type="2"></i>
                                    <i class="fa fa-times media-gallery-remove-file" data-id="donation_audio" data-type="2"></i>
                                    <i class="fa fa-play" onclick="window.open($('#donation_audio_input').val(),'_blank');"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- /Аудио -->
                <div class="row" style="margin-top: 10px"> <!-- Минимальная сумма -->
                    <div class="col-md-3 text-right" style="padding-top: 3px;">
                        Минимальная сумма:
                    </div>
                    <div class="col-md-3">
                        <input type="number" class="form-control" name="config[donation][min_sum]" value="{{ $widget['widget_config']->donation->min_sum or 1 }}">
                    </div>
                    <div class="col-md-1" style="padding-top: 6px;">
                        <i class="fa fa-question-circle fa-fw" data-toggle="tooltip" data-placement="top" title="Указав сумму все оповещения что равны ей или выше будут показаны. Если вы укажете 0 то будут показыватся все оповещения."></i>
                    </div>
                </div> <!-- /Минимальная сумма -->
                <div class="row" style="margin-top: 10px"> <!-- Шаблон заголовка -->
                    <div class="col-md-3 text-right" style="padding-top: 3px;">
                        Шаблон заголовка:
                    </div>
                    <div class="col-md-5">
                        <input type="text" class="form-control" id="donation_message_layout" name="config[donation][message_layout]" value="{{ base64_decode($widget['widget_config']->donation->message_layout) }}" data-toggle="tooltip" data-placement="top" title="Доступные теги: :name, :ammount">
                    </div>
                    <div class="col-md-1" style="padding-top: 6px;">
                        <i class="fa fa-question-circle fa-fw" data-toggle="tooltip" data-placement="top" title="Вы можете изменить шаблон выводимого заголовка"></i>
                    </div>
                </div> <!-- /Шаблон заголовка -->
                <div class="row" style="margin-top: 10px"> <!-- Стиль заголовка -->
                    <div class="col-md-3 text-right" style="padding-top: 3px;">
                        Стиль заголовка:
                    </div>
                    <div class="col-md-5">
                        <a href="#" class="btn btn-default btn-sm styleDonationTitleBtn" onclick="$('#styleDonationTitleModal').modal('show'); return false;"><i class="fa fa-font"></i> Изменить</a>
                    </div>
                </div> <!-- /Стиль заголовка -->
                <hr>
                <div class="row"> <!-- Сообщение доната -->
                    <div class="col-md-3 text-right" style="padding-top: 3px;">
                        Сообщение:
                    </div>
                    <div class="col-md-4">
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-danger @if($widget['widget_config']->donation->message->status == 0) active @endif">
                                <input type="radio" name="config[donation][message][status]" autocomplete="off" @if($widget['widget_config']->donation->message->status == 0) checked @endif value="0">Не показывать
                            </label>
                            <label class="btn btn-success @if($widget['widget_config']->donation->message->status == 1) active @endif">
                                <input type="radio" name="config[donation][message][status]" autocomplete="off" @if($widget['widget_config']->donation->message->status == 1) checked @endif value="1">Показывать
                            </label>
                        </div>
                    </div>
                    <div class="col-md-1" style="padding-top: 6px;">
                        <i class="fa fa-question-circle fa-fw" data-toggle="tooltip" data-placement="top" title="Показывать ли сообщение пользователя вместе с оповещением"></i>
                    </div>
                </div> <!-- Оповещение о платных подписчиках -->
                <div class="row" style="margin-top: 10px"> <!-- Стиль сообщения -->
                    <div class="col-md-3 text-right" style="padding-top: 3px;">
                       {{ lang('main.widget_message_style_label')}}:
                    </div>
                    <div class="col-md-5">
                        <a href="#" class="btn btn-default btn-sm styleDonationMessageBtn" onclick="$('#styleDonationMessageModal').modal('show'); return false;"><i class="fa fa-font"></i> Изменить</a>
                    </div>
                </div> <!-- /Стиль сообщения -->
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

<!-- Модальные окна настроек стилей сообщений -->
<div id="styleFollowerMessageModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Стиль сообщения</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="previewsDemo well well-sm" id="styleFollowerMessagePreview">
                    <div id="styleFollowerMessagePreviewText">Maksa988 подписался!</div>
                </div>
                <div class="form-horizontal">
                    <div class="form-group">
                        <label for="style_follower_message_font_family" class="col-sm-3 control-label">Шрифт</label>
                        <div class="col-sm-9">
                            <select name="config[follower][font_family]" class="form-control" id="style_follower_message_font_family">
                                <option value="0" selected disabled>Выберите шрифт</option>
                                <option value="Roboto Condensed" @if($widget['widget_config']->follower->font_family == "Roboto Condensed") selected @endif>Roboto Condensed</option>
                                <option value="Open Sans" @if($widget['widget_config']->follower->font_family == "Open Sans") selected @endif>Open Sans</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Размер шрифта</label>
                        <div class="col-sm-9">
                            <div class="form-group" style="padding: 0px 15px;">
                                <input type="range" class="form-control" id="style_follower_message_font_size" name="config[follower][font_size]" style="width: 100%">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Цвет текста</label>
                        <div class="col-sm-4">
                            <div id="cp2" class="input-group colorpicker-component">
                                <input type="text" id="style_follower_message_color" value="{{ $widget['widget_config']->follower->color }}" class="form-control" name="config[follower][color]"/>
                                <span class="input-group-addon"><i></i></span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Жирный</label>
                        <div class="col-sm-9">
                            <div class="checkbox">
                                <input type="checkbox" id="style_follower_message_weight" name="config[follower][weight]" value="true" @if($widget['widget_config']->follower->weight) checked @endif>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Курсив</label>
                        <div class="col-sm-9">
                            <div class="checkbox">
                                <input type="checkbox" id="style_follower_message_italic" name="config[follower][italic]" value="true" @if($widget['widget_config']->follower->italic) checked @endif>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Подчеркивание</label>
                        <div class="col-sm-9">
                            <div class="checkbox">
                                <input type="checkbox" id="style_follower_message_underline" name="config[follower][underline]" value="true" @if($widget['widget_config']->follower->underline) checked @endif>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="style_follower_message_transformation" class="col-sm-3 control-label">Трансформация</label>
                        <div class="col-sm-9">
                            <select name="config[follower][transformation]" class="form-control" id="style_follower_message_transformation">
                                <option value="none" @if($widget['widget_config']->follower->transformation == "none") selected @endif>Нет</option>
                                <option value="uppercase" @if($widget['widget_config']->follower->transformation == "uppercase") selected @endif>Все буквы прописные</option>
                                <option value="lowercase" @if($widget['widget_config']->follower->transformation == "lowercase") selected @endif>Все буквы строчные</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Размер тени</label>
                        <div class="col-sm-9">
                            <div class="form-group" style="padding: 0px 15px;">
                                <input type="range" class="form-control" id="style_follower_message_shadow_size" name="config[follower][shadow_size]" style="width: 100%">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Цвет тени</label>
                        <div class="col-sm-4">
                            <div id="cp3" class="input-group colorpicker-component">
                                <input type="text" id="style_follower_message_shadow_color" value="{{ $widget['widget_config']->follower->shadow_color }}" class="form-control" name="config[follower][shadow_color]"/>
                                <span class="input-group-addon"><i></i></span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="style_follower_message_animation" class="col-sm-3 control-label">Анимация</label>
                        <div class="col-sm-9">
                            <select name="config[follower][animation]" class="form-control" id="style_follower_message_animation">
                                <option value="none" @if($widget['widget_config']->follower->animation == "none") selected @endif>Нет</option>
                                <option value="bounce" @if($widget['widget_config']->follower->animation == "bounce") selected @endif>Подпрыгивание</option>
                                <option value="pulse" @if($widget['widget_config']->follower->animation == "pulse") selected @endif>Пульсация</option>
                                <option value="rubberBand" @if($widget['widget_config']->follower->animation == "rubberBand") selected @endif>Резинка</option>
                                <option value="shake" @if($widget['widget_config']->follower->animation == "shake") selected @endif>Тряска</option>
                                <option value="swing" @if($widget['widget_config']->follower->animation == "swing") selected @endif>Взмахи</option>
                                <option value="tada" @if($widget['widget_config']->follower->animation == "tada") selected @endif>Та-да</option>
                                <option value="wobble" @if($widget['widget_config']->follower->animation == "wobble") selected @endif>Виляние</option>
                                <option value="jello" @if($widget['widget_config']->follower->animation == "jello") selected @endif>Желе</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="style_follower_message_animation_object" class="col-sm-3 control-label">Анимировать</label>
                        <div class="col-sm-9">
                            <select name="config[follower][animation_object]" class="form-control" id="style_follower_message_animation_object">
                                <option value="animated-letter" @if($widget['widget_config']->follower->animation_object == "animated-letter") selected @endif>Побуквенно поочередно</option>
                                <option value="animated-letter-sim" @if($widget['widget_config']->follower->animation_object == "animated-letter-sim") selected @endif>Побуквенно одновременно</option>
                                <option value="text" @if($widget['widget_config']->follower->animation_object == "text") selected @endif>Весь текст</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="style_follower_message_aling" class="col-sm-3 control-label">Выравнивание текста</label>
                        <div class="col-sm-9">
                            <select name="config[follower][aling]" class="form-control" id="style_follower_message_aling">
                                <option value="left" @if($widget['widget_config']->follower->aling == "left") selected @endif>По левому краю</option>
                                <option value="right" @if($widget['widget_config']->follower->aling == "right") selected @endif>По правому краю</option>
                                <option value="center" @if($widget['widget_config']->follower->aling == "center") selected @endif>По центру</option>
                                <option value="justify" @if($widget['widget_config']->follower->aling == "justify") selected @endif>По всей ширине</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <button type="submit" class="btn btn-xs btn-default" data-dismiss="modal" aria-label="Close">Закрыть редактор</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="styleSubscribeMessageModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Стиль сообщения</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="previewsDemo well well-sm" id="styleSubscribeMessagePreview">
                    <div id="styleSubscribeMessagePreviewText">Maksa988 подписался!</div>
                </div>
                <div class="form-horizontal">
                    <div class="form-group">
                        <label for="style_subscribe_message_font_family" class="col-sm-3 control-label">Шрифт</label>
                        <div class="col-sm-9">
                            <select name="config[subscribe][font_family]" class="form-control" id="style_subscribe_message_font_family">
                                <option value="0" selected disabled>Выберите шрифт</option>
                                <option value="Roboto Condensed" @if($widget['widget_config']->subscribe->font_family == "Roboto Condensed") selected @endif>Roboto Condensed</option>
                                <option value="Open Sans" @if($widget['widget_config']->subscribe->font_family == "Open Sans") selected @endif>Open Sans</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Размер шрифта</label>
                        <div class="col-sm-9">
                            <div class="form-group" style="padding: 0px 15px;">
                                <input type="range" class="form-control" id="style_subscribe_message_font_size" name="config[subscribe][font_size]" style="width: 100%">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Цвет текста</label>
                        <div class="col-sm-4">
                            <div id="cp4" class="input-group colorpicker-component">
                                <input type="text" id="style_subscribe_message_color" value="{{ $widget['widget_config']->subscribe->color }}" class="form-control" name="config[subscribe][color]"/>
                                <span class="input-group-addon"><i></i></span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Жирный</label>
                        <div class="col-sm-9">
                            <div class="checkbox">
                                <input type="checkbox" id="style_subscribe_message_weight" name="config[subscribe][weight]" value="true" @if($widget['widget_config']->subscribe->weight) checked @endif>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Курсив</label>
                        <div class="col-sm-9">
                            <div class="checkbox">
                                <input type="checkbox" id="style_subscribe_message_italic" name="config[subscribe][italic]" value="true" @if($widget['widget_config']->subscribe->italic) checked @endif>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Подчеркивание</label>
                        <div class="col-sm-9">
                            <div class="checkbox">
                                <input type="checkbox" id="style_subscribe_message_underline" name="config[subscribe][underline]" value="true" @if($widget['widget_config']->subscribe->underline) checked @endif>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="style_subscribe_message_transformation" class="col-sm-3 control-label">Трансформация</label>
                        <div class="col-sm-9">
                            <select name="config[subscribe][transformation]" class="form-control" id="style_subscribe_message_transformation">
                                <option value="none" @if($widget['widget_config']->subscribe->transformation == "none") selected @endif>Нет</option>
                                <option value="uppercase" @if($widget['widget_config']->subscribe->transformation == "uppercase") selected @endif>Все буквы прописные</option>
                                <option value="lowercase" @if($widget['widget_config']->subscribe->transformation == "lowercase") selected @endif>Все буквы строчные</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Размер тени</label>
                        <div class="col-sm-9">
                            <div class="form-group" style="padding: 0px 15px;">
                                <input type="range" class="form-control" id="style_subscribe_message_shadow_size" name="config[subscribe][shadow_size]" style="width: 100%">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Цвет тени</label>
                        <div class="col-sm-4">
                            <div id="cp5" class="input-group colorpicker-component">
                                <input type="text" id="style_subscribe_message_shadow_color" value="{{ $widget['widget_config']->subscribe->shadow_color }}" class="form-control" name="config[subscribe][shadow_color]"/>
                                <span class="input-group-addon"><i></i></span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="style_subscribe_message_animation" class="col-sm-3 control-label">Анимация</label>
                        <div class="col-sm-9">
                            <select name="config[subscribe][animation]" class="form-control" id="style_subscribe_message_animation">
                                <option value="none" @if($widget['widget_config']->subscribe->animation == "none") selected @endif>Нет</option>
                                <option value="bounce" @if($widget['widget_config']->subscribe->animation == "bounce") selected @endif>Подпрыгивание</option>
                                <option value="pulse" @if($widget['widget_config']->subscribe->animation == "pulse") selected @endif>Пульсация</option>
                                <option value="rubberBand" @if($widget['widget_config']->subscribe->animation == "rubberBand") selected @endif>Резинка</option>
                                <option value="shake" @if($widget['widget_config']->subscribe->animation == "shake") selected @endif>Тряска</option>
                                <option value="swing" @if($widget['widget_config']->subscribe->animation == "swing") selected @endif>Взмахи</option>
                                <option value="tada" @if($widget['widget_config']->subscribe->animation == "tada") selected @endif>Та-да</option>
                                <option value="wobble" @if($widget['widget_config']->subscribe->animation == "wobble") selected @endif>Виляние</option>
                                <option value="jello" @if($widget['widget_config']->subscribe->animation == "jello") selected @endif>Желе</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="style_subscribe_message_animation_object" class="col-sm-3 control-label">Анимировать</label>
                        <div class="col-sm-9">
                            <select name="config[subscribe][animation_object]" class="form-control" id="style_subscribe_message_animation_object">
                                <option value="animated-letter" @if($widget['widget_config']->subscribe->animation_object == "animated-letter") selected @endif>Побуквенно поочередно</option>
                                <option value="animated-letter-sim" @if($widget['widget_config']->subscribe->animation_object == "animated-letter-sim") selected @endif>Побуквенно одновременно</option>
                                <option value="text" @if($widget['widget_config']->subscribe->animation_object == "text") selected @endif>Весь текст</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="style_subscribe_message_aling" class="col-sm-3 control-label">Выравнивание текста</label>
                        <div class="col-sm-9">
                            <select name="config[subscribe][aling]" class="form-control" id="style_subscribe_message_aling">
                                <option value="left" @if($widget['widget_config']->subscribe->aling == "left") selected @endif>По левому краю</option>
                                <option value="right" @if($widget['widget_config']->subscribe->aling == "right") selected @endif>По правому краю</option>
                                <option value="center" @if($widget['widget_config']->subscribe->aling == "center") selected @endif>По центру</option>
                                <option value="justify" @if($widget['widget_config']->subscribe->aling == "justify") selected @endif>По всей ширине</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <button type="submit" class="btn btn-xs btn-default" data-dismiss="modal" aria-label="Close">Закрыть редактор</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="styleDonationTitleModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Стиль заголовка</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="previewsDemo well well-sm" id="styleDonationTitlePreview">
                    <div id="styleDonationTitlePreviewText">Maksa988 подписался!</div>
                </div>
                <div class="form-horizontal">
                    <div class="form-group">
                        <label for="style_donation_title_font_family" class="col-sm-3 control-label">Шрифт</label>
                        <div class="col-sm-9">
                            <select name="config[donation][title][font_family]" class="form-control" id="style_donation_title_font_family">
                                <option value="0" selected disabled>Выберите шрифт</option>
                                <option value="Roboto Condensed" @if($widget['widget_config']->donation->title->font_family == "Roboto Condensed") selected @endif>Roboto Condensed</option>
                                <option value="Open Sans" @if($widget['widget_config']->donation->title->font_family == "Open Sans") selected @endif>Open Sans</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Размер шрифта</label>
                        <div class="col-sm-9">
                            <div class="form-group" style="padding: 0px 15px;">
                                <input type="range" class="form-control" id="style_donation_title_font_size" name="config[donation][title][font_size]" style="width: 100%">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Цвет текста</label>
                        <div class="col-sm-5">
                            <div id="cp6" class="input-group colorpicker-component">
                                <input type="text" id="style_donation_title_color" value="{{ $widget['widget_config']->donation->title->color }}" class="form-control" name="config[donation][title][color]"/>
                                <span class="input-group-addon"><i></i></span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Жирный</label>
                        <div class="col-sm-9">
                            <div class="checkbox">
                                <input type="checkbox" id="style_donation_title_weight" name="config[donation][title][weight]" value="true" @if($widget['widget_config']->donation->title->weight) checked @endif>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Курсив</label>
                        <div class="col-sm-9">
                            <div class="checkbox">
                                <input type="checkbox" id="style_donation_title_italic" name="config[donation][title][italic]" value="true" @if($widget['widget_config']->donation->title->italic) checked @endif>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Подчеркивание</label>
                        <div class="col-sm-9">
                            <div class="checkbox">
                                <input type="checkbox" id="style_donation_title_underline" name="config[donation][title][underline]" value="true" @if($widget['widget_config']->donation->title->underline) checked @endif>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="style_donation_title_transformation" class="col-sm-3 control-label">Трансформация</label>
                        <div class="col-sm-9">
                            <select name="config[donation][title][transformation]" class="form-control" id="style_donation_title_transformation">
                                <option value="none" @if($widget['widget_config']->donation->title->transformation == "none") selected @endif>Нет</option>
                                <option value="uppercase" @if($widget['widget_config']->donation->title->transformation == "uppercase") selected @endif>Все буквы прописные</option>
                                <option value="lowercase" @if($widget['widget_config']->donation->title->transformation == "lowercase") selected @endif>Все буквы строчные</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Размер тени</label>
                        <div class="col-sm-9">
                            <div class="form-group" style="padding: 0px 15px;">
                                <input type="range" class="form-control" id="style_donation_title_shadow_size" name="config[donation][title][shadow_size]" style="width: 100%">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Цвет тени</label>
                        <div class="col-sm-4">
                            <div id="cp7" class="input-group colorpicker-component">
                                <input type="text" id="style_donation_title_shadow_color" value="{{ $widget['widget_config']->donation->title->shadow_color }}" class="form-control" name="config[donation][title][shadow_color]"/>
                                <span class="input-group-addon"><i></i></span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="style_donation_title_animation" class="col-sm-3 control-label">Анимация</label>
                        <div class="col-sm-9">
                            <select name="config[donation][title][animation]" class="form-control" id="style_donation_title_animation">
                                <option value="none" @if($widget['widget_config']->donation->title->animation == "none") selected @endif>Нет</option>
                                <option value="bounce" @if($widget['widget_config']->donation->title->animation == "bounce") selected @endif>Подпрыгивание</option>
                                <option value="pulse" @if($widget['widget_config']->donation->title->animation == "pulse") selected @endif>Пульсация</option>
                                <option value="rubberBand" @if($widget['widget_config']->donation->title->animation == "rubberBand") selected @endif>Резинка</option>
                                <option value="shake" @if($widget['widget_config']->donation->title->animation == "shake") selected @endif>Тряска</option>
                                <option value="swing" @if($widget['widget_config']->donation->title->animation == "swing") selected @endif>Взмахи</option>
                                <option value="tada" @if($widget['widget_config']->donation->title->animation == "tada") selected @endif>Та-да</option>
                                <option value="wobble" @if($widget['widget_config']->donation->title->animation == "wobble") selected @endif>Виляние</option>
                                <option value="jello" @if($widget['widget_config']->donation->title->animation == "jello") selected @endif>Желе</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="style_donation_title_animation_object" class="col-sm-3 control-label">Анимировать</label>
                        <div class="col-sm-9">
                            <select name="config[donation][title][animation_object]" class="form-control" id="style_donation_title_animation_object">
                                <option value="animated-letter" @if($widget['widget_config']->donation->title->animation_object == "animated-letter") selected @endif>Побуквенно поочередно</option>
                                <option value="animated-letter-sim" @if($widget['widget_config']->donation->title->animation_object == "animated-letter-sim") selected @endif>Побуквенно одновременно</option>
                                <option value="text" @if($widget['widget_config']->donation->title->animation_object == "text") selected @endif>Весь текст</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="style_donation_title_aling" class="col-sm-3 control-label">Выравнивание текста</label>
                        <div class="col-sm-9">
                            <select name="config[donation][title][aling]" class="form-control" id="style_donation_title_aling">
                                <option value="left" @if($widget['widget_config']->donation->title->aling == "left") selected @endif>По левому краю</option>
                                <option value="right" @if($widget['widget_config']->donation->title->aling == "right") selected @endif>По правому краю</option>
                                <option value="center" @if($widget['widget_config']->donation->title->aling == "center") selected @endif>По центру</option>
                                <option value="justify" @if($widget['widget_config']->donation->title->aling == "justify") selected @endif>По всей ширине</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <button type="submit" class="btn btn-xs btn-default" data-dismiss="modal" aria-label="Close">Закрыть редактор</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="styleDonationMessageModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Стиль сообщения</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="previewsDemo well well-sm" id="styleDonationMessagePreview">
                    <div id="styleDonationMessagePreviewText">Это сообщение!</div>
                </div>
                <div class="form-horizontal">
                    <div class="form-group">
                        <label for="style_donation_message_font_family" class="col-sm-3 control-label">Шрифт</label>
                        <div class="col-sm-9">
                            <select name="config[donation][message][font_family]" class="form-control" id="style_donation_message_font_family">
                                <option value="0" selected disabled>Выберите шрифт</option>
                                <option value="Roboto Condensed" @if($widget['widget_config']->donation->message->font_family == "Roboto Condensed") selected @endif>Roboto Condensed</option>
                                <option value="Open Sans" @if($widget['widget_config']->donation->message->font_family == "Open Sans") selected @endif>Open Sans</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Размер шрифта</label>
                        <div class="col-sm-9">
                            <div class="form-group" style="padding: 0px 15px;">
                                <input type="range" class="form-control" id="style_donation_message_font_size" name="config[donation][message][font_size]" style="width: 100%">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Цвет текста</label>
                        <div class="col-sm-4">
                            <div id="cp8" class="input-group colorpicker-component">
                                <input type="text" id="style_donation_message_color" value="{{ $widget['widget_config']->donation->message->color }}" class="form-control" name="config[donation][message][color]"/>
                                <span class="input-group-addon"><i></i></span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Жирный</label>
                        <div class="col-sm-9">
                            <div class="checkbox">
                                <input type="checkbox" id="style_donation_message_weight" name="config[donation][message][weight]" value="true" @if($widget['widget_config']->donation->message->weight) checked @endif>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Курсив</label>
                        <div class="col-sm-9">
                            <div class="checkbox">
                                <input type="checkbox" id="style_donation_message_italic" name="config[donation][message][italic]" value="true" @if($widget['widget_config']->donation->message->italic) checked @endif>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Подчеркивание</label>
                        <div class="col-sm-9">
                            <div class="checkbox">
                                <input type="checkbox" id="style_donation_message_underline" name="config[donation][message][underline]" value="true" @if($widget['widget_config']->donation->message->underline) checked @endif>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="style_donation_message_transformation" class="col-sm-3 control-label">Трансформация</label>
                        <div class="col-sm-9">
                            <select name="config[donation][message][transformation]" class="form-control" id="style_donation_message_transformation">
                                <option value="none" @if($widget['widget_config']->donation->message->transformation == "none") selected @endif>Нет</option>
                                <option value="uppercase" @if($widget['widget_config']->donation->message->transformation == "uppercase") selected @endif>Все буквы прописные</option>
                                <option value="lowercase" @if($widget['widget_config']->donation->message->transformation == "lowercase") selected @endif>Все буквы строчные</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Размер тени</label>
                        <div class="col-sm-9">
                            <div class="form-group" style="padding: 0px 15px;">
                                <input type="range" class="form-control" id="style_donation_message_shadow_size" name="config[donation][message][shadow_size]" style="width: 100%">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Цвет тени</label>
                        <div class="col-sm-4">
                            <div id="cp9" class="input-group colorpicker-component">
                                <input type="text" id="style_donation_message_shadow_color" value="{{ $widget['widget_config']->donation->message->shadow_color }}" class="form-control" name="config[donation][message][shadow_color]"/>
                                <span class="input-group-addon"><i></i></span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="style_donation_message_animation" class="col-sm-3 control-label">Анимация</label>
                        <div class="col-sm-9">
                            <select name="config[donation][message][animation]" class="form-control" id="style_donation_message_animation">
                                <option value="none" @if($widget['widget_config']->donation->message->animation == "none") selected @endif>Нет</option>
                                <option value="bounce" @if($widget['widget_config']->donation->message->animation == "bounce") selected @endif>Подпрыгивание</option>
                                <option value="pulse" @if($widget['widget_config']->donation->message->animation == "pulse") selected @endif>Пульсация</option>
                                <option value="rubberBand" @if($widget['widget_config']->donation->message->animation == "rubberBand") selected @endif>Резинка</option>
                                <option value="shake" @if($widget['widget_config']->donation->message->animation == "shake") selected @endif>Тряска</option>
                                <option value="swing" @if($widget['widget_config']->donation->message->animation == "swing") selected @endif>Взмахи</option>
                                <option value="tada" @if($widget['widget_config']->donation->message->animation == "tada") selected @endif>Та-да</option>
                                <option value="wobble" @if($widget['widget_config']->donation->message->animation == "wobble") selected @endif>Виляние</option>
                                <option value="jello" @if($widget['widget_config']->donation->message->animation == "jello") selected @endif>Желе</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="style_donation_message_animation_object" class="col-sm-3 control-label">Анимировать</label>
                        <div class="col-sm-9">
                            <select name="config[donation][message][animation_object]" class="form-control" id="style_donation_message_animation_object">
                                <option value="animated-letter" @if($widget['widget_config']->donation->message->animation_object == "animated-letter") selected @endif>Побуквенно поочередно</option>
                                <option value="animated-letter-sim" @if($widget['widget_config']->donation->message->animation_object == "animated-letter-sim") selected @endif>Побуквенно одновременно</option>
                                <option value="text" @if($widget['widget_config']->donation->message->animation_object == "text") selected @endif>Весь текст</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="style_donation_message_aling" class="col-sm-3 control-label">Выравнивание текста</label>
                        <div class="col-sm-9">
                            <select name="config[donation][message][aling]" class="form-control" id="style_donation_message_aling">
                                <option value="left" @if($widget['widget_config']->donation->message->aling == "left") selected @endif>По левому краю</option>
                                <option value="right" @if($widget['widget_config']->donation->message->aling == "right") selected @endif>По правому краю</option>
                                <option value="center" @if($widget['widget_config']->donation->message->aling == "center") selected @endif>По центру</option>
                                <option value="justify" @if($widget['widget_config']->donation->message->aling == "justify") selected @endif>По всей ширине</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <button type="submit" class="btn btn-xs btn-default" data-dismiss="modal" aria-label="Close">Закрыть редактор</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Модальные окна настроек стилей сообщений -->
</form>
<!-- Модальное окно галереи -->
<div id="mediaGalleryModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="float: left;">Медиа галлерея</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#gallery" aria-controls="gallery" role="tab" data-toggle="tab">Галеря</a></li>
                    <li role="presentation"><a href="#uploaded" aria-controls="uploaded" role="tab" data-toggle="tab">Загруженные</a></li>
                    <li role="presentation"><a href="#upload" aria-controls="upload" role="tab" data-toggle="tab"><i class="fa fa-cloud-upload"></i> Загрузить</a></li>
                    <li role="presentation" class="pull-right"><a href="#" role="tab" data-toggle="tab" id="gallery_size">0.13 / 60 MB</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="gallery">
                        <ul class="nav nav-tabs nav-stacked" role="tablist" style="display: inline-block; width: 30%; margin-top: 10px;">
                            <li role="presentation" class="active"><a href="#gallery_audio" aria-controls="gallery_audio" role="tab" data-toggle="tab"><i class="fa fa-music"></i> Аудио файлы</a></li>
                            <li role="presentation"><a href="#gallery_images" aria-controls="gallery_images" role="tab" data-toggle="tab"><i class="fa fa-image"></i> Изображения</a></li>
                        </ul>
                        <div class="tab-content" style="display: inline-block; width: 67%; margin-top: 10px; float: right;">
                            <div role="tabpanel" class="tab-pane active" id="gallery_audio"></div>
                            <div role="tabpanel" class="tab-pane" id="gallery_images"></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="uploaded">
                        <ul class="nav nav-tabs nav-stacked" role="tablist" style="display: inline-block; width: 30%; margin-top: 10px;">
                            <li role="presentation" class="active"><a href="#own_all" aria-controls="own_all" role="tab" data-toggle="tab"><i class="fa fa-file-o"></i> Все файлы</a></li>
                            <li role="presentation"><a href="#own_audio" aria-controls="own_audio" role="tab" data-toggle="tab"><i class="fa fa-music"></i> Аудио файлы</a></li>
                            <li role="presentation"><a href="#own_images" aria-controls="own_images" role="tab" data-toggle="tab"><i class="fa fa-image"></i> Изображения</a></li>
                        </ul>
                        <div class="tab-content" style="display: inline-block; width: 70%; margin-top: 10px; float: right;">
                            <div role="tabpanel" class="tab-pane active" id="own_all"></div>
                            <div role="tabpanel" class="tab-pane" id="own_audio"></div>
                            <div role="tabpanel" class="tab-pane" id="own_images"></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div role="tabpanel" class="tab-pane text-center" id="upload">
                        <div id="dropzone" class="dropbox" draggable="true">
                            <div class="dropbox_wrap">
                                <div class="dropbox_area">
                                    <div class="dropbox_label">Перетащите файлы сюда</div>
                                </div>
                            </div>
                        </div>
                        <input type="file" name="file" id="fileToUpload" style="display: none;">
                        <a href="#" id="fileUploadBtn" class="btn btn-default" style="margin-top: 60px; margin-bottom: 50px;">
                            <i class="fa fa-cloud-upload"></i> Выбрать файл
                        </a>
                    </div>
                </div>
            </div>
            <audio id="gallery-audio-player" src=""></audio>
        </div>
    </div>
</div>
<!-- /Модальное окно галереи -->
@stop

@section("styles")
<link rel="stylesheet" href="/assets/css/bootstrap-colorpicker.min.css">
<link rel="stylesheet" href="/assets/css/bootstrap-slider.min.css">
<link rel="stylesheet" href="/assets/css/widget.css">

<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300&subset=latin,cyrillic-ext,cyrillic,latin-ext' rel='stylesheet' type='text/css'>
@stop

@section("plugins-scripts")
<script src="/assets/js/bootstrap-colorpicker.min.js"></script>
<script src="/assets/js/bootstrap-slider.min.js"></script>
@stop
<script type="text/javascript" src="https://vk.com/js/api/openapi.js?162"></script>
<div id="vk_community_messages"></div>
<script type="text/javascript">
VK.Widgets.CommunityMessages("vk_community_messages", 190202028, {tooltipButtonText: "Здравствуйте,чем могу вам помочь?"});
</script>
@section("scripts")
<script>
    $(".widget-url-guard-alert-box").click(function() {
        $(this).hide();
        $(".widget-url-alert").show();
    });

    $(function() {
        $('#cp1').colorpicker();
        $('#cp2').colorpicker();
        $('#cp3').colorpicker();
        $('#cp4').colorpicker();
        $('#cp5').colorpicker();
        $('#cp6').colorpicker();
        $('#cp7').colorpicker();
        $('#cp8').colorpicker();
        $('#cp9').colorpicker();
    });

    $(function() {
        $('#alert_time').slider({
            min: 2,
            max: 60,
            value: {{ $widget['widget_config']->alert_time }},
        formatter: function(value) {
            return value + " сек.";
        }
    });

        $('#next_alert_time').slider({
            min: 2,
            max: 60,
            value: {{ $widget['widget_config']->next_alert_time }},
        formatter: function(value) {
            return value + " сек.";
        }
    });
    });

    $(function() {
        $('#style_subscribe_message_font_size').slider({
            min: 8,
            max: 110,
            value: {{ $widget['widget_config']->subscribe->font_size or 64 }},
        formatter: function(value) {
            return value + "px";
        }
    });

        $('#style_subscribe_message_shadow_size').slider({
            min: 0,
            max: 100,
            value: {{ $widget['widget_config']->subscribe->shadow_size or 1 }},
        formatter: function(value) {
            return value + "px";
        }
    });

        $('#style_follower_message_font_size').slider({
            min: 8,
            max: 110,
            value: {{ $widget['widget_config']->follower->font_size or 64 }},
        formatter: function(value) {
            return value + "px";
        }
    });

        $('#style_follower_message_shadow_size').slider({
            min: 0,
            max: 100,
            value: {{ $widget['widget_config']->follower->shadow_size or 1 }},
        formatter: function(value) {
            return value + "px";
        }
    });

        $('#style_donation_message_font_size').slider({
            min: 8,
            max: 110,
            value: {{ $widget['widget_config']->donation->message->font_size or 64 }},
        formatter: function(value) {
            return value + "px";
        }
    });

        $('#style_donation_message_shadow_size').slider({
            min: 0,
            max: 100,
            value: {{ $widget['widget_config']->donation->message->shadow_size or 1 }},
        formatter: function(value) {
            return value + "px";
        }
    });

        $('#style_donation_title_font_size').slider({
            min: 8,
            max: 110,
            value: {{ $widget['widget_config']->donation->title->font_size or 64 }},
        formatter: function(value) {
            return value + "px";
        }
    });

        $('#style_donation_title_shadow_size').slider({
            min: 0,
            max: 100,
            value: {{ $widget['widget_config']->donation->title->shadow_size or 1 }},
        formatter: function(value) {
            return value + "px";
        }
    });
    });

    //
    function changePreviewStyle(type)
    {
        var bigType;
        var demoText;
        if(type == "follower_message") {
            bigType = "FollowerMessage";
            demoText = $("#follower_message_layout").val();
            demoText = demoText.replace(":name", "{{ $user->user_login_show }}");
        }
        if(type == "subscribe_message") {
            bigType = "SubscribeMessage";
            demoText = $("#subscribe_message_layout").val();
            demoText = demoText.replace(":name", "{{ $user->user_login_show }}");
        }
        if(type == "donation_message") {
            bigType = "DonationMessage";
            demoText = "Это сообщение!";
        }
        if(type == "donation_title") {
            bigType = "DonationTitle";
            demoText = $("#donation_message_layout").val();
            demoText = demoText.replace(":name", "{{ $user->user_login_show }}");
            demoText = demoText.replace(":ammount", "{{ rand(11, 100) }} USD");
        }

        $("#style" + bigType + "PreviewText").removeClass("animated");
        $("#style" + bigType + "PreviewText").removeClass("infinite");

        if($("#style_" + type + "_animation_object").val() == "text" && $("#style_" + type + "_animation").val() != "none") {
            $("#style" + bigType + "PreviewText").addClass("animated");
            $("#style" + bigType + "PreviewText").addClass("infinite");
            $("#style" + bigType + "PreviewText").addClass($("#style_" + type + "_animation").val());
        }

        $("#style" + bigType + "PreviewText").html(" ");
        for (var i = 0; i < demoText.length; i++) {
            if($("#style_" + type + "_animation").val() == "none" && $("#style_" + type + "_animation_object").val() == "text") {
                $("#style" + bigType + "PreviewText").html($("#style" + bigType + "PreviewText").html() + '<span class="char' + i + '">' + demoText.charAt(i) + '</span>');
            } else {
                $("#style" + bigType + "PreviewText").html($("#style" + bigType + "PreviewText").html() + '<span class="char' + i + ' animated ' + $("#style_" + type + "_animation_object").val() + ' infinite ' + $("#style_" + type + "_animation").val() + '">' + demoText.charAt(i) + '</span>');
            }
        }

        $("#style" + bigType + "PreviewText").css("font-family", $("#style_" + type + "_font_family").val());
        $("#style" + bigType + "PreviewText").css("font-size", $("#style_" + type + "_font_size").val() + "px");
        $("#style" + bigType + "PreviewText").css("color", $("#style_" + type + "_color").val());
        if($("#style_" + type + "_weight").prop('checked')) {
            $("#style" + bigType + "PreviewText").css("font-weight", "bold");
        } else {
            $("#style" + bigType + "PreviewText").css("font-weight", "normal");
        }
        if($("#style_" + type + "_italic").prop('checked')) {
            $("#style" + bigType + "PreviewText").css("font-style", "italic");
        } else {
            $("#style" + bigType + "PreviewText").css("font-style", "normal");
        }
        if($("#style_" + type + "_underline").prop('checked')) {
            $("#style" + bigType + "PreviewText").css("text-decoration", "underline");
        } else {
            $("#style" + bigType + "PreviewText").css("text-decoration", "none");
        }
        $("#style" + bigType + "PreviewText").css("text-shadow", "0px 0px " + $("#style_" + type + "_shadow_size").val() + "px rgb(0, 0, 0), 0px 0px " +
            (parseInt($("#style_" + type + "_shadow_size").val()) + 1) + "px "+ $("#style_" + type + "_shadow_color").val() +", 0px 0px " +
            (parseInt($("#style_" + type + "_shadow_size").val()) + 2) + "px "+ $("#style_" + type + "_shadow_color").val() +", 0px 0px " +
            (parseInt($("#style_" + type + "_shadow_size").val()) + 3) + "px "+ $("#style_" + type + "_shadow_color").val());
        $("#style" + bigType + "PreviewText").css("text-transform", $("#style_" + type + "_transformation").val());
        $("#style" + bigType + "PreviewText").css("text-align", $("#style_" + type + "_aling").val());
    }

    $("#style_donation_message_font_family, #style_donation_message_font_size, #style_donation_message_color, #style_donation_message_weight, " +
        "#style_donation_message_italic, #style_donation_message_underline, #style_donation_message_shadow_size, " +
        "#style_donation_message_transformation, #style_donation_message_shadow_color, " +
        "#style_donation_message_animation_object, #style_donation_message_animation, #style_donation_message_aling," +
        "#style_donation_message_font_size_input, #style_donation_message_shadow_size_input").change(function() {
        changePreviewStyle("donation_message");
    });

    $("#style_donation_title_font_family, #style_donation_title_font_size, #style_donation_title_color, #style_donation_title_weight, " +
        "#style_donation_title_italic, #style_donation_title_underline, #style_donation_title_shadow_size, " +
        "#style_donation_title_transformation, #style_donation_title_shadow_color, " +
        "#style_donation_title_animation_object, #style_donation_title_animation, #style_donation_title_aling," +
        "#style_donation_title_font_size_input, #style_donation_title_shadow_size_input").change(function() {
        changePreviewStyle("donation_title");
    });

    $("#style_subscribe_message_font_family, #style_subscribe_message_font_size, #style_subscribe_message_color, #style_subscribe_message_weight, " +
        "#style_subscribe_message_italic, #style_subscribe_message_underline, #style_subscribe_message_shadow_size, " +
        "#style_subscribe_message_transformation, #style_subscribe_message_shadow_color, " +
        "#style_subscribe_message_animation_object, #style_subscribe_message_animation, #style_subscribe_message_aling," +
        "#style_subscribe_message_font_size_input, #style_subscribe_message_shadow_size_input").change(function() {
        changePreviewStyle("subscribe_message");
    });

    $("#style_follower_message_font_family, #style_follower_message_font_size, #style_follower_message_color, #style_follower_message_weight, " +
        "#style_follower_message_italic, #style_follower_message_underline, #style_follower_message_shadow_size, " +
        "#style_follower_message_transformation, #style_follower_message_shadow_color, " +
        "#style_follower_message_animation_object, #style_follower_message_animation, #style_follower_message_aling," +
        "#style_follower_message_font_size_input, #style_follower_message_shadow_size_input").change(function() {
        changePreviewStyle("follower_message");
    });

    $(".styleFollowerMessageBtn").click(function() {
        changePreviewStyle("follower_message");
    });

    $(".styleSubscribeMessageBtn").click(function() {
        changePreviewStyle("subscribe_message");
    });

    $(".styleDonationTitleBtn").click(function() {
        changePreviewStyle("donation_title");
    });

    $(".styleDonationMessageBtn").click(function() {
        changePreviewStyle("donation_message");
    });

    function sendAlert(type) {
        $.ajax({
            url: "/alert/{{ $widget['widget_token'] }}?type="+ type +"&name={{ $user->user_login_show }}",
            type: "POST"
        });
    }

    $("#sendFollowerAlert").click(function () { sendAlert(1); });
    $("#sendSubscriberAlert").click(function () { sendAlert(2); });
    $("#sendDonationAlert").click(function () { sendAlert(3); });

    function changeWidgetURL() {
        if($("#followers_widget_status").prop("checked")
            && $("#subscribers_widget_status").prop("checked")
            && $("#donations_widget_status").prop("checked")) {
            $(".widget-url-alert").val("{{ config()->url }}widget/{{ $widget['widget_token'] }}");
            $(".windget-start-btn").attr("onclick", "window.open('{{ config()->url }}widget/{{ $widget['widget_token'] }}?bg=true', 'alert-widget', 'menubar=0,resizable=1,width=1000,height=600').focus();");
        }

        if($("#followers_widget_status").prop("checked")
            && $("#subscribers_widget_status").prop("checked")
            && !$("#donations_widget_status").prop("checked")) {
            $(".widget-url-alert").val("{{ config()->url }}widget/{{ $widget['widget_token'] }}?code=1");
            $(".windget-start-btn").attr("onclick", "window.open('{{ config()->url }}widget/{{ $widget['widget_token'] }}?code=1&bg=true', 'alert-widget', 'menubar=0,resizable=1,width=1000,height=600').focus();");
        }

        if($("#followers_widget_status").prop("checked")
            && !$("#subscribers_widget_status").prop("checked")
            && $("#donations_widget_status").prop("checked")) {
            $(".widget-url-alert").val("{{ config()->url }}widget/{{ $widget['widget_token'] }}?code=2");
            $(".windget-start-btn").attr("onclick", "window.open('{{ config()->url }}widget/{{ $widget['widget_token'] }}?code=2&bg=true', 'alert-widget', 'menubar=0,resizable=1,width=1000,height=600').focus();");
        }

        if(!$("#followers_widget_status").prop("checked")
            && $("#subscribers_widget_status").prop("checked")
            && $("#donations_widget_status").prop("checked")) {
            $(".widget-url-alert").val("{{ config()->url }}widget/{{ $widget['widget_token'] }}?code=3");
            $(".windget-start-btn").attr("onclick", "window.open('{{ config()->url }}widget/{{ $widget['widget_token'] }}?code=3&bg=true', 'alert-widget', 'menubar=0,resizable=1,width=1000,height=600').focus();");
        }

        if($("#followers_widget_status").prop("checked")
            && !$("#subscribers_widget_status").prop("checked")
            && !$("#donations_widget_status").prop("checked")) {
            $(".widget-url-alert").val("{{ config()->url }}widget/{{ $widget['widget_token'] }}?code=4");
            $(".windget-start-btn").attr("onclick", "window.open('{{ config()->url }}widget/{{ $widget['widget_token'] }}?code=4&bg=true', 'alert-widget', 'menubar=0,resizable=1,width=1000,height=600').focus();");
        }

        if(!$("#followers_widget_status").prop("checked")
            && $("#subscribers_widget_status").prop("checked")
            && !$("#donations_widget_status").prop("checked")) {
            $(".widget-url-alert").val("{{ config()->url }}widget/{{ $widget['widget_token'] }}?code=5");
            $(".windget-start-btn").attr("onclick", "window.open('{{ config()->url }}widget/{{ $widget['widget_token'] }}?code=5&bg=true', 'alert-widget', 'menubar=0,resizable=1,width=1000,height=600').focus();");
        }

        if(!$("#followers_widget_status").prop("checked")
            && !$("#subscribers_widget_status").prop("checked")
            && $("#donations_widget_status").prop("checked")) {
            $(".widget-url-alert").val("{{ config()->url }}widget/{{ $widget['widget_token'] }}?code=6");
            $(".windget-start-btn").attr("onclick", "window.open('{{ config()->url }}widget/{{ $widget['widget_token'] }}?code=6&bg=true', 'alert-widget', 'menubar=0,resizable=1,width=1000,height=600').focus();");
        }
    }

    $("#followers_widget_status").change(function () {
        changeWidgetURL();
    });
    $("#subscribers_widget_status").change(function () {
        changeWidgetURL();
    });
    $("#donations_widget_status").change(function () {
        changeWidgetURL();
    });
</script>
@stop