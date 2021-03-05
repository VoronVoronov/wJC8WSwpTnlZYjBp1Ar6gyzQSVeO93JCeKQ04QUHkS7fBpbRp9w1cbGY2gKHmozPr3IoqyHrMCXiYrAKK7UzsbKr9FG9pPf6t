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
            background-color: #f9f9f9;
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
                            <li><strong>Who we are</strong>
                                <ol class="ol-mod">
                                    <li>This Privacy Policy sets out how we collect and use your personal information when you visit our
                                        site https://donatepay.ru("Site") or use our online service “DonatePay” (“DP Services”) offered by
                                        ООО &quot;ХАУС СЕРВИС&quot; and the choices available to you in connection with our use of your personal information
                                        (“Privacy Policy”). The Site and DP Services are hereinafter collectively referred to as the “DP Platform”.
                                        This Privacy Policy should be read alongside.
                                    </li>
                                </ol>
                            </li>

                            <li>
                                <strong>This Privacy Policy</strong>
                                <ol class="ol-mod">
                                    <li>By making available the DP Platform we, acting reasonably and in good faith, believe that you:
                                        <ol class="ol-mod">
                                            <li>have all necessary rights to register and use the DP Platform;</li>
                                            <li>provide true information about yourself to the extent necessary for use of the DP Platform;</li>
                                            <li>understand that by the posting your personal information you have manifestly made this information
                                                public, and this information may become available to other DP Platform users and internet users, be
                                                copied and disseminated by them;
                                            </li>
                                            <li>understand that some types of information transferred by you to other DP Platform users cannot be
                                                deleted by you or us;
                                            </li>
                                            <li>are aware of and accept this Privacy Policy.</li>
                                        </ol>
                                    </li>
                                    <li>We do not check the user information received from you, except where such check is necessary in order for
                                        us to fulfill our obligations to you.
                                    </li>
                                </ol>
                            </li>

                            <li>
                                <strong>Information we collect about you</strong>
                                <ol class="ol-mod">
                                    <li>In order to implement the agreement between you and us, and provide you with access to the use of the DP
                                        Platform, we will improve, develop and implement new features to the DP Platform, and enhance the available
                                        DP Platform functionality. To achieve these objectives, and in compliance with applicable laws, we will
                                        collect, store, aggregate, organise, extract, compare, use, and supplement your data. We will also receive
                                        and pass this data, and our automatically processed analyses of this data to our affiliates and partners as
                                        set out in the table below and section 4 of this Privacy Policy.
                                    </li>
                                    <li>
                                        We set out in more detail the information we may collect when you use the DP Platform, why we collect
                                        and process it and the legal bases below.<br><br>

                                        <table class="table table-bordered table-striped">
                                            <tr>
                                                <th>Information Collected</th>
                                                <th>Purpose</th>
                                                <th>Legal Basis</th>
                                            </tr>
                                            <tr>
                                                <td>Data you provide for registering in DP Platform: data obtained via third parties - your social
                                                    network nickname and email (such as Facebook, Google, YouTube), your nickname that you create at the
                                                    process of registering
                                                </td>
                                                <td>We use this information in order to manage and administer DP Platform provided to you. We use this
                                                    data to enable us to fulfill our obligations to you as part of DA Platform (e.g. in cases where you
                                                    request restoration of your account). See section 8.3 of this Privacy Policy for more information.
                                                </td>
                                                <td>Legitimate interests<br><br>Performance of our contract with you</td>
                                            </tr>
                                            <tr>
                                                <td>Additional data you provide when you edit your profile page at https://donatepay.ru or on
                                                    dedicated service profile page via including your name, surname, mobile phone, email, nickname,
                                                    country.
                                                </td>
                                                <td>We use this information in order to provide DP Platform to you, to manage and administer DP Platform
                                                    and as additional information to verify your account to prevent abuse and infringements of your or
                                                    other persons' rights.<br>
                                                    We also use this information in order to provide you with updates and information on our and selected
                                                    third parties' products and DP Platform we think you may be interested in.
                                                </td>
                                                <td>Legitimate interests<br><br>Performance of our contract with you</td>
                                            </tr>
                                            <tr>
                                                <td>Additional data received when you access DP Platform, including information regarding technical
                                                    interaction with DP Platform such as your IP-address, time of registration on DP Platform, time of
                                                    your last visit of DP Platform, device ids, country and language settings.
                                                </td>
                                                <td>We use your data for internal review in order to constantly improve the content of DP Platform and
                                                    web pages, optimizing your user experience, to understand any errors you may encounter when using DP
                                                    Platform, to notify you of changes to DP Platform and to personalise the use of our DP Platform.
                                                </td>
                                                <td>Legitimate Interests</td>
                                            </tr>
                                            <tr>
                                                <td>Information that is created by you while using DP Platform (including User Content). This
                                                    information can be available to all viewers of the Broadcaster Content where the User Content is
                                                    placed
                                                </td>
                                                <td>We use this information in order to manage and administer DP Platform including providing our DP
                                                    Platform to you.
                                                </td>
                                                <td>Legitimate interests</td>
                                            </tr>
                                            <tr>
                                                <td>Information that is created by you while placing requests to our Services support.</td>
                                                <td>We use this information in order to verify your identity and to fulfill your support request.<br>
                                                    We may also use this data in order to investigate any complaints on your behalf and to provide you
                                                    with a more efficient service.
                                                </td>
                                                <td>Legitimate interests<br><br>Performance of our contract with you</td>
                                            </tr>
                                            <tr>
                                                <td>Information that is received as the result of your using payment functionality on the Site (e.g.
                                                    first and last four digits of your card number that are needed for the option of matching these
                                                    details with user’s id number).
                                                </td>
                                                <td>We use this information in order to manage and administer the Site including providing our Site
                                                    Services to you.<br>
                                                    We may also use this data in order to investigate any complaints on your behalf and to provide you
                                                    with a more efficient service.
                                                </td>
                                                <td>Legitimate interests<br><br>Performance of our contract with you</td>
                                            </tr>
                                            <tr>
                                                <td>Data collected via third parties, in case you choose to provide such data from a third-party social
                                                    network or authentication service (such as Facebook, Google, YouTube, among others), when you log in
                                                    using such network and/or service or connect such network and/or service to our DP Platform, including
                                                    your social network ids (such as Google ID), application store ids, nickname, email, subscribers list,
                                                    channel name, channel URL, avatar.
                                                </td>
                                                <td>We use this information in order to manage and administer the DA Platform provided to you.</td>
                                                <td>Legitimate interests<br><br>Performance of our contract with you.</td>
                                            </tr>
                                        </table>
                                        <br>
                                    </li>
                                    <li>Our legitimate interests include (1) maintaining and administrating Dp Platform; (2) providing DP
                                        Platform to you; (3) improving the content of DP Platform and web pages; (4) processing of the data that was
                                        manifestly made public by you (5) ensuring your account is adequately protected; and (6) compliance with any
                                        contractual, legal or regulatory obligations under any applicable law.
                                    </li>
                                    <li>Your personal information may also be processed if it is required by a law enforcement or regulatory
                                        authority, body or agency or in the defence or exercise of legal claims.<br>
                                        We will not delete personal information if it is relevant to an investigation or a dispute. It will continue
                                        to be stored until those issues are fully resolved and/or during the term that is required and/or
                                        permissible under applicable/relevant law.
                                    </li>
                                    <li>You may withdraw your consent for sending you marketing information by amending your privacy settings
                                        of your account. An option to unsubscribe will also be included in every email sent to you by us or our
                                        selected third party partners.
                                    </li>
                                    <li>Please note, if you do not want us to process sensitive and special categories of data about you
                                        (including data relating to your health, racial or ethnic origin, political opinion, religious or
                                        philosophical beliefs, sex life, and your sexual orientation) you should take care not to post this
                                        information or share this data on DP Platform.<br>
                                        Once you have provided this data it will be accessible by the users of the web-sites (including mobile
                                        versions) where this data is posted and it becomes difficult for us to remove this data.
                                    </li>
                                    <li>Please note, if you withdraw your consent to processing or you do not provide the data that we
                                        require in order to maintain and administer DP Platform, you may not be able to access and use DP Platform.
                                    </li>
                                    <li>If we intend to further process your data for any other purpose to those set out in this Privacy
                                        Policy, we shall provide you with details of this further purpose before we commence processing.
                                    </li>
                                </ol>
                            </li>

                            <li>
                                <strong>Data sharing</strong>
                                <ol class="ol-mod">
                                    <li>Your nickname can be available to all viewers of your Broadcasting Content in the Internet when you
                                        use DP Platform. We take technical and organizational measures to ensure that your data is safe. Please note
                                        that by the posting your personal information you have manifestly made this information public, and this may
                                        become available to other Service users and internet users and be copied and/ or disseminated by such users.
                                        Once this data is transferred by you to other users you will not be able to delete this data.
                                    </li>
                                    <li>We may share your data with our affiliates. Sometimes we may also need to share your data with a
                                        third party in order to provide DP Platform to you or to administer DP Platform, for example if you choose
                                        to share your data across other social media platforms.
                                    </li>
                                </ol>
                            </li>

                            <li>
                                <strong>Privacy Settings</strong>
                                <ol class="ol-mod">
                                    <li>
                                        DP Platform may contain links to sites operated by third parties. We are not responsible for your data
                                        privacy when you access these links or engage with third party DP Platform and you should ensure you review
                                        the relevant third party's privacy statement which will govern your data privacy rights.
                                    </li>
                                    <li>In case you intend to connect your YouTube or Google account to the DA Platform using YouTube API, you may
                                        review and, if necessary, adjust your YouTube privacy settings before linking or connecting them to our
                                        website or Service. You can find more information on YouTube and Google’s privacy at
                                        <a href="http://www.google.com/policies/privacy" target="_blank">http://www.google.com/policies/privacy</a>.
                                    </li>
                                    <li>We bear no liability for the actions of third parties which, as the result of your use of the
                                        internet or the DP Platform, obtain access to your information in accordance with the confidentiality level
                                        selected by you.
                                    </li>
                                    <li>We bear no liability for the consequences of use of the information which, due to DP Platform nature,
                                        is available to any internet user. We ask you to take a responsible approach to the scope of their
                                        information posted in DP Platform.
                                    </li>
                                </ol>
                            </li>

                            <li>
                                <strong>International Transfers</strong>
                                <ol class="ol-mod">
                                    <li>We may transfer and maintain on our servers or databases some of your personal information in different
                                        countries worldwide.
                                    </li>
                                </ol>
                            </li>

                            <li>
                                <strong>Retention Periods</strong>
                                <ol class="ol-mod">
                                    <li>
                                        We will retain your personal information for as long as required to perform the purposes for which the
                                        data was collected depending on the legal basis for which that data was obtained and/or whether additional
                                        legal/regulatory obligations mandate that we retain your personal information during the term that is
                                        required and/or permissible under applicable/relevant law.
                                    </li>
                                    <li>
                                        You may delete your personal data by removing the data from your account or by sending us an email to
                                        <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="a6d5d3d6d6c9d4d2e6c2c9c8c7d2c3d6c7df88d4d388">[email&#160;protected]</a>
                                    </li>
                                </ol>
                            </li>

                            <li>
                                <strong>Your Rights</strong>
                                <ol class="ol-mod">
                                    <li>You have the following rights, in certain circumstances, in relation to your personal information:
                                        <ol class="ol-mod">
                                            <li>Right to access your personal information.</li>
                                            <li>Right to rectify your personal information: you can request that we update, block or delete your
                                                personal data, if the data is incomplete, outdated, incorrect, unlawfully received or no longer relevant
                                                for the purpose of processing.
                                            </li>
                                            <li>Right to restrict the use of your personal information.</li>
                                            <li>Right to request that your personal information is erased.</li>
                                            <li>Right to object to processing of your personal information.</li>
                                            <li>Right to data portability (in certain specific circumstances).</li>
                                            <li>Right not to be subject to an automated decision.</li>
                                            <li>Right to lodge a complaint with a supervisory authority.</li>
                                        </ol>
                                    <li>You also have a right to independently remove personal information on your account and make changes
                                        and corrections to your information, provided that such changes and corrections contain up-to-date and true
                                        information. You can also view an overview of the information we hold about you.
                                    </li>
                                    <li>If you would like to exercise these rights, please contact Support Service at
                                        <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="1a696f6a6a75686e5a7e75747b6e7f6a7b6334686f34">[email&#160;protected]</a> We will aim to respond to you within period established by applicable law. We
                                        will need to verify your identity before we are able to disclose any personal data to you.
                                    </li>
                                </ol>
                            </li>

                            <li>
                                <strong>Security Measures</strong>
                                <ol class="ol-mod">
                                    <li>We take technical, organizational and legal measures, including, where suitable, encryption, to
                                        ensure that your personal data are protected from unauthorized or accidental access, deletion, modification,
                                        blocking, copying and dissemination.
                                    </li>
                                    <li>Access to DP Platform is authorized using by the relevant social network your login (e-mail address
                                        or mobile phone number) and password. You are responsible for keeping this information confidential. You
                                        should not share your credentials with third parties and we recommend you take measures to ensure this
                                        information is kept confidential.
                                    </li>
                                </ol>
                            </li>

                            <li>
                                <strong>Changes to this Policy</strong>
                                <ol class="ol-mod">
                                    <li>From time to time, we may change and/or update this Privacy Policy. If this Privacy Policy changes
                                        in any way, we will post an updated version on this page. We will store the previous versions of this
                                        Privacy Policy in our documentation achieve. We recommend you regularly review this page to ensure that you
                                        are always aware of our information practices and any changes to such.
                                    </li>
                                </ol>
                            </li>

                            <li>
                                <strong>Contact Us</strong>
                                <ol class="ol-mod">
                                    <li>If you have any questions, please send your inquiries to Service support at
                                        <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="80f3f5f0f0eff2f4c0e4efeee1f4e5f0e1f9aef2f5ae">[email&#160;protected]</a> So we can deal with your enquiry effectively, please quote this Privacy Policy.
                                        We will aim to respond to you within period established by applicable law.
                                    </li>
                                    <li>All correspondence received by us from you is classified as restricted-access information and may not be
                                        disclosed without your written consent. The personal data and other information about you may not be used
                                        without your consent for any purpose other than for response to the inquiry, except as expressly provided by
                                        law.
                                    </li>
                                </ol>
                            </li>
                        </ol>
                    </section>
                    <br><br><br>
                    <small>Последнее изменение: 03.03.2021 - 23:35</small>
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
                        <a href="https://webmoney.ru/" target="_blank"><img src="/assets/images/88x31_wm_white_blue.png"></a>
                    </div>
                    <div class="right-menu">
                        <a href="https://unitpay.ru/" target="_blank"><img src="/assets/images/unitpay.png"></a>
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
                        <a href="https://updown.io/wkrd">
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
                    </div>
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
