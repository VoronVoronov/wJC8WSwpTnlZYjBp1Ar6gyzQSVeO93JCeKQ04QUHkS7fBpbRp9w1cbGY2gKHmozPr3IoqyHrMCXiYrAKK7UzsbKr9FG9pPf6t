<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="Cache-Control" content="no-cache" />

    <title>IPDonate - зарабатывай вместе с нами!</title>

    <script src="https://vk.com/js/api/openapi.js?162" type="text/javascript"></script>

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <meta name="webmoney" content="CAB1D522-3C80-4778-9D95-EBC276A179C7"/>


    @yield("styles")

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .table {
            border-collapse: collapse !important;
        }
        .table-bordered th,
        .table-bordered td {
            border: 1px solid #ddd !important;
        }
        /*===============================================
         Tables
       ================================================= */
        table {
            background-color: transparent;
        }
        th {
            text-align: left;
        }
        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 0;
        }
        .table > thead > tr > th,
        .table > tbody > tr > th,
        .table > tfoot > tr > th,
        .table > thead > tr > td,
        .table > tbody > tr > td,
        .table > tfoot > tr > td {
            padding: 9px;
            line-height: 1.49;
            vertical-align: middle;
            border-top: 1px solid #eeeeee;
        }
        .table > thead > tr > th {
            font-weight: 600;
            vertical-align: bottom;
            border-bottom: 1px solid #eeeeee;
        }
        .table > caption + thead > tr:first-child > th,
        .table > colgroup + thead > tr:first-child > th,
        .table > thead:first-child > tr:first-child > th,
        .table > caption + thead > tr:first-child > td,
        .table > colgroup + thead > tr:first-child > td,
        .table > thead:first-child > tr:first-child > td {
            border-top: 0;
        }
        .table > tbody + tbody {
            border-top: 2px solid #eeeeee;
        }
        .table tbody > tr:first-child > td {
            border-top: 0;
        }
        .table .table {
            margin-bottom: 0;
            background-color: #ffffff;
        }
        .table-condensed > thead > tr > th,
        .table-condensed > tbody > tr > th,
        .table-condensed > tfoot > tr > th,
        .table-condensed > thead > tr > td,
        .table-condensed > tbody > tr > td,
        .table-condensed > tfoot > tr > td {
            padding: 5px;
        }
        .table-bordered {
            border: 1px solid #eeeeee;
        }
        .table-bordered > thead > tr > th,
        .table-bordered > tbody > tr > th,
        .table-bordered > tfoot > tr > th,
        .table-bordered > thead > tr > td,
        .table-bordered > tbody > tr > td,
        .table-bordered > tfoot > tr > td {
            border: 1px solid #eeeeee;
        }
        .table-bordered > thead > tr > th,
        .table-bordered > thead > tr > td {
            border-bottom-width: 2px;
        }
        .table-striped > tbody > tr:nth-child(odd) > td,
        .table-striped > tbody > tr:nth-child(odd) > th {
            background-color: #c5c5c5;
        }
        .table-hover > tbody > tr:hover > td,
        .table-hover > tbody > tr:hover > th {
            background-color: #f5f5f5;
        }
        .table-curved > tbody > tr > td:first-child {
            border-radius: 4px 0 0 4px;
        }
        .table-curved > tbody > tr > td:last-child {
            border-radius: 0 4px 4px 0;
        }
        table col[class*="col-"] {
            position: static;
            float: none;
            display: table-column;
        }
        table td[class*="col-"],
        table th[class*="col-"] {
            position: static;
            float: none;
            display: table-cell;
        }
        .table > thead > tr > td.default,
        .table > tbody > tr > td.default,
        .table > tfoot > tr > td.default,
        .table > thead > tr > th.default,
        .table > tbody > tr > th.default,
        .table > tfoot > tr > th.default,
        .table > thead > tr.default > td,
        .table > tbody > tr.default > td,
        .table > tfoot > tr.default > td,
        .table > thead > tr.default > th,
        .table > tbody > tr.default > th,
        .table > tfoot > tr.default > th {
            color: white;
            border-color: #ddd;
            background-color: #f0f0f0;
        }
        .table-hover > tbody > tr > td.default:hover,
        .table-hover > tbody > tr > th.default:hover,
        .table-hover > tbody > tr.default:hover > td,
        .table-hover > tbody > tr:hover > .default,
        .table-hover > tbody > tr.default:hover > th {
            background-color: #fcfcfc;
        }
        @media screen and (max-width: 767px) {
            .table-responsive {
                width: 100%;
                margin-bottom: 14.25px;
                overflow-y: hidden;
                overflow-x: auto;
                -ms-overflow-style: -ms-autohiding-scrollbar;
                border: 1px solid #eeeeee;
                -webkit-overflow-scrolling: touch;
            }
            .table-responsive > .table {
                margin-bottom: 0;
            }
            .table-responsive > .table > thead > tr > th,
            .table-responsive > .table > tbody > tr > th,
            .table-responsive > .table > tfoot > tr > th,
            .table-responsive > .table > thead > tr > td,
            .table-responsive > .table > tbody > tr > td,
            .table-responsive > .table > tfoot > tr > td {
                white-space: nowrap;
            }
            .table-responsive > .table-bordered {
                border: 0;
            }
            .table-responsive > .table-bordered > thead > tr > th:first-child,
            .table-responsive > .table-bordered > tbody > tr > th:first-child,
            .table-responsive > .table-bordered > tfoot > tr > th:first-child,
            .table-responsive > .table-bordered > thead > tr > td:first-child,
            .table-responsive > .table-bordered > tbody > tr > td:first-child,
            .table-responsive > .table-bordered > tfoot > tr > td:first-child {
                border-left: 0;
            }
            .table-responsive > .table-bordered > thead > tr > th:last-child,
            .table-responsive > .table-bordered > tbody > tr > th:last-child,
            .table-responsive > .table-bordered > tfoot > tr > th:last-child,
            .table-responsive > .table-bordered > thead > tr > td:last-child,
            .table-responsive > .table-bordered > tbody > tr > td:last-child,
            .table-responsive > .table-bordered > tfoot > tr > td:last-child {
                border-right: 0;
            }
            .table-responsive > .table-bordered > tbody > tr:last-child > th,
            .table-responsive > .table-bordered > tfoot > tr:last-child > th,
            .table-responsive > .table-bordered > tbody > tr:last-child > td,
            .table-responsive > .table-bordered > tfoot > tr:last-child > td {
                border-bottom: 0;
            }
        }
    </style>

</head>
<body>

<div id="wrapper">

    <div class="navbar">
        <div class="container text-center">
            <ul>
                <li><a href="/">Главная</a></li>
                <li><a href="https://vk.com/im?sel=-174659405">Помощь</a></li>
                <li class="auth"><a href="#">Войти</a></li>
            </ul>
        </div>
    </div>

    <div id="landing">


        <div class="content">
            <div class="stats container">
                <h5>Политикой конфиденциальности</h5>
                <div style="    line-height: 20px;">
                    <div style="width: 100%; height: 61px;"></div>

                    <section class="content container text-white">
                        <ol class="mt40 ol-mod ol-parent" style="padding-left: 15px;">
                            <li><strong>Кто мы?</strong>
                                <ol class="ol-mod">
                                    <li>В этой политике конфиденциальности описано, как мы собираем и используем ваши персональные данные,
                                        когда вы посещаете НАШ САЙТ https://ipdonate.com("сайт") или
                                        использовать наш онлайн-сервис "IPDonate” (“IPD платформа”).
                                        А также доступные вам варианты в связи с использованием нами вашей личной информации (“Политика Конфиденциальности”).
                                        Сайт и услуги IPD в дальнейшем совместно именуются “платформа IPD”.
                                        Эта политика конфиденциальности должна быть прочитана вместе с ней.
                                    </li>
                                </ol>
                            </li>

                            <li>
                                <strong>Настоящая Политика Конфиденциальности</strong>
                                <ol class="ol-mod">
                                    <li>Предоставляя доступ к платформе IPD, мы, действуя разумно и добросовестно, считаем, что вы::
                                        <ol class="ol-mod">
                                            <li>иметь все необходимые права для регистрации и использования платформы IPD;</li>
                                            <li>предоставьте достоверную информацию о себе в объеме, необходимом для использования платформы IPD;</li>
                                            <li>поймите, что публикуя свою личную информацию, вы явно сделали эту информацию общедоступной, и эта информация может стать доступной другим пользователям платформы IPD и пользователям Интернета, быть скопирована и распространена ими;
                                            </li>
                                            <li>поймите, что некоторые типы информации, переданные вами другим пользователям платформы IPD, не могут быть удалены вами или нами;
                                            </li>
                                            <li>вы знаете и принимаете настоящую Политику конфиденциальности.</li>
                                        </ol>
                                    </li>
                                    <li>Мы не проверяем полученную от вас пользовательскую информацию, за исключением случаев, когда такая проверка необходима для выполнения нами своих обязательств перед вами.
                                    </li>
                                </ol>
                            </li>

                            <li>
                                <strong>Информация, которую мы собираем о вас</strong>
                                <ol class="ol-mod">
                                    <li>В целях реализации соглашения между вами и нами, а также предоставления вам доступа к использованию IPD Платформа, мы будем улучшать, разрабатывать и внедрять новые функции для платформы IPD, а также улучшать доступные Функциональность платформы IPD. Для достижения этих целей и в соответствии с применимым законодательством мы будем собирать, хранить, агрегировать, организовывать, извлекать, сравнивать, использовать и дополнять ваши данные. Мы также будем получать и передавать эти данные, а также наш автоматически обработанный анализ этих данных нашим аффилированным лицам и партнерам в качестве изложено в таблице ниже и разделе 4 настоящей Политики конфиденциальности.
                                    </li>
                                    <li>
                                        Мы более подробно описываем информацию, которую мы можем собирать, когда вы используете платформу IPD, почему мы собираем и обрабатываем ее, а также правовые основы ниже.<br><br>

                                        <table class="table table-bordered table-striped">
                                            <tr>
                                                <th>Собранная Информация</th>
                                                <th>Цель</th>
                                                <th>Правовая Основа</th>
                                            </tr>
                                            <tr>
                                                <td>Данные, которые вы предоставляете для регистрации в IPD платформа: данные, полученные через третьих лиц - ваш ник в социальной сети и адрес электронной почты (например, Facebook, Google, YouTube), ваш ник, который вы создаете в процессе регистрации
                                                </td>
                                                <td>Мы используем эту информацию для управления и администрирования предоставленной вам платформы IPD. Мы используем эти данные для выполнения наших обязательств перед вами как частью платформы IPD (например, в тех случаях, когда вы запрашиваете восстановление своей учетной записи). Дополнительную информацию смотрите в разделе 8.3 настоящей Политики конфиденциальности.
                                                </td>
                                                <td>Законные интересы<br><br>Исполнение нашего договора с вами</td>
                                            </tr>
                                            <tr>
                                                <td>Дополнительные данные, которые вы предоставляете при редактировании страницы своего профиля по адресу https://ipdonate.com или на специальной странице профиля службы, включая ваше имя, фамилию, мобильный телефон, электронную почту, ник, страну.
                                                </td>
                                                <td>Мы используем эту информацию для предоставления вам платформы IPD, для управления и администрирования платформы IPD, а также в качестве дополнительной информации для проверки вашей учетной записи, чтобы предотвратить злоупотребления и нарушения Ваших или других прав.<br>
                                                    Мы также используем эту информацию для того, чтобы предоставлять вам обновления и информацию о наших и выбранных сторонних продуктах и платформе IPD, которые, по нашему мнению, могут вас заинтересовать.
                                                </td>
                                                <td>Законные интересы<br><br>Исполнение нашего договора с вами</td>
                                            </tr>
                                            <tr>
                                                <td>Дополнительные данные, полученные при доступе к платформе IPD, включая информацию о техническом взаимодействии с платформой IPD, такую как ваш IP-адрес, время регистрации на платформе IPD, время вашего последнего посещения платформы IPD, идентификаторы устройств, настройки страны и языка.
                                                </td>
                                                <td>Мы используем ваши данные для внутреннего анализа с целью постоянного улучшения содержания платформы IPD и веб-страниц, оптимизации вашего пользовательского опыта, понимания любых ошибок, с которыми вы можете столкнуться при использовании IPD Платформа, чтобы уведомить вас об изменениях в платформе IPD и персонализировать использование нашей платформы IPD.
                                                </td>
                                                <td>Законные Интересы</td>
                                            </tr>
                                            <tr>
                                                <td>Информация, созданная вами при использовании платформы IPD (включая пользовательский контент). Эта информация может быть доступна всем зрителям контента вещателя, в котором размещен пользовательский контент
                                                </td>
                                                <td>Мы используем эту информацию для управления и администрирования платформы IPD, включая предоставление наших IPD Платформа для вас.
                                                </td>
                                                <td>Законные Интересы</td>
                                            </tr>
                                            <tr>
                                                <td>Информация, которая создается вами при размещении запросов в нашу службу поддержки.</td>
                                                <td>Мы используем эту информацию для того, чтобы подтвердить вашу личность и выполнить ваш запрос в службу поддержки.
                                                    Мы также можем использовать эти данные для расследования любых жалоб от вашего имени и предоставления вам более эффективного сервиса.
                                                </td>
                                                <td>Законные интересы<br><br>исполнение нашего договора с вами</td>
                                            </tr>
                                            <tr>
                                                <td>Информация, полученная в результате использования вами платежного функционала на сайте (например , первые и последние четыре цифры номера вашей карты, необходимые для возможности сопоставления этих данных с идентификационным номером пользователя).
                                                </td>
                                                <td>Мы используем эту информацию для управления и администрирования сайта включая предоставление нашего сайта Услуги для вас.<br>
                                                    Мы также можем использовать эти данные для расследования любых жалоб от вашего имени и предоставления вам более эффективного сервиса.
                                                </td>
                                                <td>Законные интересы<br><br>исполнение нашего договора с вами</td>
                                            </tr>
                                            <tr>
                                                <td>Собранные данные через третьих лиц, в случае, если вы решите не предоставлять такие данные, от стороннего социальной сеть или службы аутентификации (например, Facebook, Google, Youtube и т. д.), Когда вы входите в с помощью такой сети и/или услуги или подключить такую сеть и/или услуг на нашей платформе IPD, в том числе ваш социальной сети с идентификаторами (например, Google ID), магазин приложений идентификаторы, ник, адрес электронной почты, подписчиком рассылки, имя канала, URL-адрес канала, аватар.
                                                </td>
                                                <td>Мы используем эту информацию для управления и администрирования платформы IPD, предоставленной вам.</td>
                                                <td>Законные интересы<br><br>исполнение нашего договора с вами</td>
                                            </tr>
                                        </table>
                                        <br>
                                    </li>
                                    <li>Наши законные интересы включают (1) поддержание и администрирование Платформы IPD; (2) предоставление вам Платформы IPD; (3) улучшение контента Платформы IPD и веб-страниц; (4) обработку данных, которые были явным образом разглашены вами; (5) обеспечение надлежащей защиты вашей учетной записи; и (6) соблюдение любых договорных, правовых или нормативных обязательств в соответствии с любым применимым законодательством.
                                    </li>
                                    <li>Ваши персональные данные также могут обрабатываться, если это требуется правоохранительным или регулирующим органом, ведомством или учреждением, или при защите или реализации прав требования.<br>
                                        Мы не будем удалять персональные данные, если они имеют отношение к расследованию или спору. Они будут храниться до тех пор, пока указанные расследования или споры не будут полностью урегулированы и/или в течение срока, который требуется и/или допускается применимым/соответствующим законодательством.
                                    </li>
                                    <li>Вы можете отозвать свое согласие на отправку вам маркетинговой информации, изменив настройки конфиденциальности своей учетной записи. Возможность отказаться от подписки также будет включена в каждое электронное письмо, отправленное вам нами или нашими избранными сторонними партнерами.
                                    </li>
                                    <li>Обратите внимание, что если вы не хотите, чтобы мы обрабатывали конфиденциальные и особые категории данных (включая данные, касающиеся вашего здоровья, расового или этнического происхождения, политических взглядов, религиозных или философских убеждений, интимной жизни и сексуальной ориентации), вы должны проявить осторожность и не размещать эту информацию, а также не делиться этими данными при использовании Платформы IPD.<br>
                                        После предоставления вами этих данных они станут доступными пользователям веб-сайтов (включая мобильные версии), где размещены эти данные, и нам станет трудно удалить эти данные.
                                    </li>
                                    <li>Обратите внимание, что, если вы отзываете свое согласие на обработку или не предоставляете данные, которые нам требуются для технической поддержки и администрирования Платформы IPD, вы не сможете получить доступ к Платформе IPD и пользоваться ей.
                                    </li>
                                    <li>Если мы намереваемся обрабатывать ваши данные в каких-либо иных целях, помимо тех, которые указаны в настоящей Политике конфиденциальности, мы предоставим вам подробную информацию об этой дополнительной цели до того, как мы начнем обработку.
                                    </li>
                                </ol>
                            </li>

                            <li>
                                <strong>Обмен данными</strong>
                                <ol class="ol-mod">
                                    <li>Ваше имя пользователя может быть доступно всем зрителям вашего Контента Стримера в сети Интернет при использовании вами Платформы IPD. Мы принимаем технические и организационные меры для обеспечения безопасности ваших данных. Примите к сведению, что, публикуя ваши персональные данные, вы явно разглашаете эти данные, и эти данные могут стать доступны для других пользователей Сервиса и пользователей сети Интернет, и копироваться и/или распространяться такими пользователями. Как только вы передадите эти данные другим пользователям, вы не сможете их удалить.
                                    </li>
                                    <li>Мы вправе передавать ваши данные компании нашим аффилированным лицам. Иногда нам также может потребоваться предоставить ваши данные третьему лицу для предоставления вам Платформы IPD или для управления Платформой IPD, например, если вы решите поделиться своими данными с другими социальными сетями.
                                    </li>
                                </ol>
                            </li>

                            <li>
                                <strong>Настройки конфиденциальности</strong>
                                <ol class="ol-mod">
                                    <li>
                                        Платформа IPD может содержать ссылки на сайты, управляемые третьими лицами. Мы не несем ответственности за конфиденциальность ваших данных, когда вы получаете доступ к этим ссылкам или взаимодействуете со сторонними сервисами на Платформе IPD, и вам следует убедиться, что вы ознакомились с соответствующим заявлением о конфиденциальности третьего лица, которое будет регулировать ваши права на конфиденциальность данных.
                                    </li>
                                    <li>Если вы собираетесь привязать вашу учетную запись YouTube или Google к Платформе IPD с использованием YouTube API, вы можете проверить и, при необходимости, изменить ваши настройки конфиденциальности YouTube на странице настроек безопасности Google по ссылке <a href="https://security.google.com/settings/security/permissions" target="_blank">https://security.google.com/settings/security/permissions</a> до подключения или привязки их к нашему сайту или IPD Сервисам. С подробной информацией о конфиденциальности YouTube и Google вы можете ознакомиться на <a href="https://policies.google.com/" target="_blank">https://policies.google.com/</a> и с Политикой конфиденциальности Google по адресу <a href="https://www.google.com/policies/privacy" target="_blank">https://www.google.com/policies/privacy</a>.
                                    </li>
                                    <li>Мы не несем ответственность за действия третьих лиц, которые в результате использования вами сети Интернет или Платформы IPD получают доступ к вашей информации в соответствии с выбранным вами уровнем конфиденциальности.
                                    </li>
                                    <li>Мы не несем ответственности за последствия использования информации, которая в силу характера Платформы IPD доступна любому пользователю сети Интернет. Мы просим вас ответственно подходить к выбору вашей информации, размещенной в Платформе IPD.
                                    </li>
                                </ol>
                            </li>

                            <li>
                                <strong>Трансграничная передача</strong>
                                <ol class="ol-mod">
                                    <li>Мы можем передавать и хранить на наших серверах или в базах данных часть ваших персональных данных в различных странах на территории всего мира.
                                    </li>
                                </ol>
                            </li>

                            <li>
                                <strong>Сроки хранения</strong>
                                <ol class="ol-mod">
                                    <li>
                                        Мы будем хранить ваши персональные данные в течение срока, необходимого для выполнения целей, для которых данные были собраны в зависимости от правовых оснований, по которым эти данные были получены и/или в зависимости от того, будут ли дополнительные установленные законом/нормативные обязательства требовать, чтобы мы хранили ваши персональные данные в течение срока, необходимого и/или допустимого в соответствии с применимым/действующим законодательством.
                                    </li>
                                    <li>
                                        Вы можете удалить свои персональные данные, удалив данные из вашей учетной записи или прислав нам электронное письмо по адресу privacy@ipdonate.com.
                                    </li>
                                </ol>
                            </li>

                            <li>
                                <strong>Ваши права</strong>
                                <ol class="ol-mod">
                                    <li>При определенных обстоятельствах вы имеете следующие права в отношении ваших персональных данных:
                                        <ol class="ol-mod">
                                            <li>право на доступ к Вашим персональным данным;</li>
                                            <li>право на внесение исправлений в Ваши персональные данные: Вы можете потребовать, чтобы мы обновили, заблокировали или удалили Ваши персональные данные, если такие данные являются неполными, устаревшими, неверными, незаконно полученными или не актуальными для целей обработки;
                                            </li>
                                            <li>право ограничить использование Ваших персональных данных;</li>
                                            <li>Право требовать, чтобы ваша личная информация была удалена.</li>
                                            <li>Право возражать против обработки вашей личной информации.</li>
                                            <li>Право на переносимость данных (при определенных конкретных обстоятельствах).</li>
                                            <li>Право не подчиняться автоматическому решению.</li>
                                            <li>Право на подачу жалобы в надзорный орган.</li>
                                        </ol>
                                    <li>Вы также имеете право самостоятельно удалять личную информацию в вашем аккаунте и вносить изменения и исправления в вашу информацию, при условии, что такие изменения и исправления содержат актуальную и достоверную информацию. Вы также можете просмотреть обзор информации, которую мы храним о вас.
                                    </li>
                                    <li>Если вы хотите воспользоваться этими правами, пожалуйста, свяжитесь со службой поддержки по адресу privacy@ipdonate.com мы постараемся ответить вам в срок, установленный действующим законодательством. Нам необходимо будет подтвердить вашу личность, прежде чем мы сможем раскрыть вам какие-либо персональные данные.
                                    </li>
                                </ol>
                            </li>

                            <li>
                                <strong>Меры Безопасности</strong>
                                <ol class="ol-mod">
                                    <li>
                                        Мы принимаем технические, организационные и правовые меры, включая, при необходимости, шифрование, чтобы обеспечить защиту Ваших персональных данных от несанкционированного или случайного доступа, удаления, изменения, блокирования, копирования и распространения.
                                    </li>
                                    <li>
                                        Доступ к платформе IPD авторизуется с использованием соответствующей социальной сетью Вашего логина (адреса электронной почты или номера мобильного телефона) и пароля. Вы несете ответственность за сохранение этой информации в тайне. Вы не должны передавать свои учетные данные третьим лицам, и мы рекомендуем вам принять меры для обеспечения конфиденциальности этой информации.
                                    </li>
                                </ol>
                            </li>

                            <li>
                                <strong>Изменения в настоящей Политике</strong>
                                <ol class="ol-mod">
                                    <li>Время от времени мы можем изменять и/или обновлять настоящую Политику конфиденциальности. Если эта политика конфиденциальности каким-либо образом изменится, мы опубликуем обновленную версию на этой странице. Мы будем хранить предыдущие версии этой политики конфиденциальности в нашей документации achieve. Мы рекомендуем вам регулярно просматривать эту страницу, чтобы убедиться, что вы всегда в курсе нашей информационной практики и любых изменений в ней.</li>
                                </ol>
                            </li>

                            <li>
                                <strong>Contact Us</strong>
                                <ol class="ol-mod">
                                    <li>Если у вас есть какие-либо вопросы, пожалуйста, отправьте свои запросы в службу технической поддержки по адресу privacy@ipdonate.com. чтобы мы могли эффективно справиться с вашим запросом, пожалуйста, процитируйте эту политику конфиденциальности. Мы постараемся ответить вам в срок, установленный действующим законодательством.
                                    </li>
                                    <li>
                                        Вся корреспонденция, полученная нами от вас, классифицируется как информация ограниченного доступа и не может быть раскрыта без вашего письменного согласия. Персональные данные и другая информация о вас не могут быть использованы без вашего согласия в каких-либо иных целях, кроме как для ответа на запрос, за исключением случаев, прямо предусмотренных законом.
                                    </li>
                                </ol>
                            </li>
                        </ol>
                    </section>
                    <br><br><br>
                    <small>Последнее изменение: 06.03.2021 - 1:45</small>
                </div>
            </div>
        </div>


        <div class="footer">
            <div class="container">
                <div class="left-footer">
                    <div class="left-menu">
                        <a href="/">- Главная</a>
                        <a href="/oferta">- Публичная оферта</a>
                        <a href="/agreement">- Пользовательское соглашение</a>
                        <a href="https://vk.com/ipdonate">- ВКонтакте</a>
                    </div>

                    <div class="left-menu">
                        <a href="https://passport.webmoney.ru/asp/certview.asp?wmid=413143268781" target="_blank"><img src="/assets/images/v_blue_on_white_ru.png" alt="Здесь находится аттестат нашего WM идентификатора 413143268781" border="0" /></a>
                    </div>
                    <div class="left-menu">
                        <a href="https://megastock.ru/" target="_blank"><img src="/assets/images/webmoney_accept.png"></a>
                    </div>
                </div>

                <div class="clear"></div>
            </div>
            <div class="footer-line">
                <div class="container">
                    <div class="copyright">
                        2019 - <?php echo date ( 'Y' ) ; ?> &copy; IPDonate
                        <i class="fab fa-vimeo"></i>
                        <?
                        $version_json = @file_get_contents('https://ipdonate.com/api/v1/version/?token=OitQDh8fwQIO0ZaFJZwXuz5R');
                        $version = json_decode($version_json, true);
                        echo $version[0]['version'];
                        echo $version[0]['type'];
                        ?>.
                        <a href="https://status.ipdonate.com/">
                            UPTIME:
                            <!--
                            <i class="fas fa-signal"></i>
                            <i class="fab fa-dev"></i>
                            -->

                            <?
                            $status_json = @file_get_contents('https://updown.io/api/checks?api-key=CayZiwAv5S9oVkEUYxnu');
                            $status = json_decode( $status_json, true );
                            echo $uptime = $status[0]['uptime'].'%';
                            ?>
                        </a>
                    </div>

                    <div class="copyright-right">
                        Все права защищены
                    </div>

                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>

    <div id="notifier-box"></div>
    <!-- /#wrapper -->


    <!-- Модальное окно -->
    <div id="authModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row row-sm-offset-3 socialButtons">
                        <center>
                            <div class="col-xs-2 col-sm-2">
                                <a href="/login/twitch" class="btn btn-lg btn-block lgn_btn-twitch" data-toggle="tooltip" data-placement="top" title="Twitch Login">
                                    <i class="fa fa-twitch fa-2x"></i>
                                    <span class="hidden-xs"></span>
                                </a>
                            </div>
                            <div class="col-xs-2 col-sm-2">
                                <a href="/login/vk" class="btn btn-lg btn-block lgn_btn-vk" data-toggle="tooltip" data-placement="top" title="VK Login">
                                    <i class="fa fa-vk fa-2x"></i>
                                    <span class="hidden-xs"></span>
                                </a>
                            </div>
                            <div class="col-xs-2 col-sm-2">
                                <a href="/login/youtube" class="btn btn-lg btn-block lgn_btn-google-plus" data-toggle="tooltip" data-placement="top" title="YouTube login">
                                    <i class="fa fa-youtube fa-2x"></i>
                                    <span class="hidden-xs"></span>
                                </a>
                            </div>
                            <br>
                        </center>
                    </div>
                    <center>
                        <small>Авторизуясь, Вы подтверждаете, что внимательно прочитали и согласились нашими <a href="/agreement">пользовательским соглашением</a> и нашей <a href="/privacy">Политикой конфиденциальности</a>.</small>
                    </center>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://vk.com/js/api/openapi.js?162"></script>
    <div id="vk_community_messages"></div>
    <script type="text/javascript">
        VK.Widgets.CommunityMessages("vk_community_messages", 174659405, {tooltipButtonText: "Здравствуйте,чем могу вам помочь?"});
    </script>

    <script src="https://use.fontawesome.com/1d342aabb8.js"></script>
    <script src="/assets/js/jquery.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/common.js"></script>
    <script type="text/javascript">
        $(".slide-btn, .auth, .rate .btn, .panel-btn").click(function() {
            $("#authModal").modal("show");

            return false;
        });

        $(".contact").click(function() {
            $("#contactModal").modal("show");

            return false;
        });
    </script>


</body>
</html>
