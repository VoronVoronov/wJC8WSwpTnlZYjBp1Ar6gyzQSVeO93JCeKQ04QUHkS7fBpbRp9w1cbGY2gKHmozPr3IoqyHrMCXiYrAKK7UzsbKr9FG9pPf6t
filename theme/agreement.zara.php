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
                <h5>Пользовательское соглашение</h5>
                    <div style="    line-height: 20px;">
                    <h4 class="page_top">1. Регистрация партнера и принятие соглашения</h4>
                    <br>1.1. Свидетельством полного и безоговорочного акцепта (принятия) условий данного Соглашения является осуществление физическим или юридическим лицом процедуры регистрации, и заключающейся в предоставлении Агентом заполненной регистрационной формы на сайте ipdonate.com.
                    <br>1.2. По завершении процесса регистрации пользователь получить доступа к панели управления, позволяющие просматривать состояние счета и получать статистику платежей которые будут произведены в его сторону.
                    <br>1.3. Партнер несет ответственность за безопасность своего аккаунта, а также за все действия, которые будет осуществлены в Партнерском интерфейсе под логином и паролем Партнера.
                    <br><br><br>
                    <h4 class="page_top">2. Описание сути и технических возможностей услуг</h4>
                    <br>2.1. Сервис iPDonate работает по принципу приему пожертвований в пользу физического или юридического лица проводящий прямой трансляций.
                    <br>2.2. Все средства которые получают владельцы iPDonate в качестве комиссии переводятся как пожертвование для помощи содержания сервиса iPDonate.
                    <br>2.3. Партнер может использовать все технические возможности которые предоставляет сервис.
                    <br>2.4. Партнер имеет возможность использовать все возможности сервиса.
                    <br><br><br>
                    <h4 class="page_top">3. Порядок предоставление услуги и ответственность сторон</h4>
                    <br>3.1. Партнер признает, что владельцы сервиса могут устанавливать ограничения в использовании технических услуг, равно как и отказать Партнеру в предоставлении технических услуг без объяснения причин.
                    <br>3.2. Сервис не несет ответственности за задержки, cбои, неверную или несвоевременную доставку запросов пользователей, имевших место быть вследствие проблем на стороне Партнера.
                    <br>3.3. Никакая информация или советы, предоставляемые Агентом, не могут рассматриваться как гарантии, поскольку являются консультационными.
                    <br>3.4. Партнер признает, что владельцы сервиса могут поменять правила и ограничения в любое время, с и/или без предварительного уведомления Партнера.
                    <br>3.5. Сервис действует от имени и за счет Партнера. Сервис не принимает участия в возможных разногласиях и спорах между Партнерами и Клиентами.
                    <br>3.6. Партнер признает, что сотрудники Сервиса могут по своему усмотрению и в любое время производить тестирование Сервиса Партнера путем отправки Запросов на Сервис Партнера.
                    <br>3.7. Сервис оставляет за собой право в любое время улучшать или модифицировать любые услуги и разделы проекта. Информация об изменениях и модификациях, публикуется в группе ВКонтакте или на дочерных сайтах сервиса, а также может быть направлена Партнеру в устной форме.
                    <br>3.8. Партнер, который не удовлетворен услугами сервиса, условиями, правилами, качеством, ее содержанием или практикой предоставления Услуги, имеет исключительное право прекратить пользование сервиса. При этом взаимные расчеты сторон производятся по условиям, изложенным в статье 8 настоящего Соглашения. Исключением являются жалобы со стороны Операторов, Агрегаторов, Клиентов, либо других пользователей, подкрепленных доказательствами вины Партнера. В таком случае Сервис оставляет за собой право действовать согласно статье 9 данного Соглашения.
                    <br>3.9. Партнер обязуется не использовать услуги сервиса в целях, которые могут причинить прямой или косвенный ущерб третьим лицам. Также не допускается использование услуг в целях проведение обмена средств между платёжными системами,возбуждения ненависти либо вражды, а также направленных на унижение достоинства человека либо группы лиц по признакам пола, расы, национальности, языка, происхождения, отношения к религии, а равно принадлежности к какой-либо социальной группе, призыва к осуществлению экстремистской деятельности и в иных противоправных целях.
                    <br>3.10. В случае если у Сервиса есть достаточные основания полагать, что Услуга используется в противоправных целях, доступ к учетной записи Партнера и денежным средствам на счету может быть заблокирован. В дальнейшем стороны действуют в порядке, описанном в ст. 9 настоящего Соглашения.
                    <br>3.11. Сервис не отвечает за возможную потерю или порчу данных, которая может произойти из-за нарушения Партнером положений настоящего Соглашения.
                    <br>3.12. Партнер понимает и принимает, что Сервис не несет никакой ответственности за тексты, полученные в результате использования услуг; не контролирует текст sms-сообщений, передаваемых c помощью услуг Клиентами и не гарантирует их точность и полноту.
                    <br>3.13. При поступление жалобы со стороны банков-партнеров на подозрительную транзакцию, средства на аккаунте будет на время заморожены. Пока партнер не предоставить доказательств,о том что средства были получены во время прямой трансляций или любым другим легальным способом.   
                  <br><br><br>
                    <h4 class="page_top">4. Обязанности партнера</h4>
                    <br>4.1 Партнер принимает на себя следующие обязательства:
                    <br>4.1.1 выполнять все предписания, содержащиеся в настоящем Соглашении;
                    <br>4.1.2. не использовать услуги в противоправных целях;
                    <br>4.1.3. не совершать противозаконных, провоцирующих противоправное поведение действий с использованием услуг сервиса, системы Компании, ее сервисов и сайта;
                    <br>4.1.4. не сообщать кому-либо пароли, коды и другую информацию, предоставленную для использования услуг сервиса;
                    <br>4.1.5. не использовать услуги предоставляемым сервисом во вред самого сервиса..
                    <br>4.1.6. не использовать услуги сервиса в отношении не принадлежащих Партнеру Сервисов.
                    <br>4.1.7. блокировка счета на 3 рабочих дня с момента регистраций.
                    <br>4.1.8. хранить прямые трансляций сроком на 1 год.
                    <br>4.2. Партнер обязуется самостоятельно и за свой счёт урегулировать споры по любым возникшим у Партнера обязательствам и расходам в случае, если Партнер не указал или неверно указал регистрационные данные.
                    <br>4.3. Партнер несет полную ответственность за все обращения абонентов к услуге сервиса и действия, предпринятые через обращение к услуге сервиса, имевшие место при введении идентификационных данных Партнера.
                    <br>4.4. В случае предъявления третьими лицами претензий к Сервису, связанных с содержанием Сервисов Партнера, а также информационных материалов и материалов Интернет-страниц Партнера, Партнер обязан своими силами и за свой счет урегулировать указанные претензии, а также возместить Сервису убытки в полном объеме.
                    <br>4.6. Прекращение действия настоящего Соглашения не освобождает Партнера от ответственности, если основания для возникновения такой ответственности возникли до даты прекращения действия настоящего Соглашения.
                    <br>4.7. В случае обращения Пользователя к Сервису в связи с несоответствием содержания, заявленной стоимости и/или качества Сервиса Партнера, сервис производит возвращение средств если средства которые были получены на счет партнера еще не были выведены, в противном случае Сервис не обязуеться возмещать убытки.
                    <br>4.8. Обязанность по исчислению и уплате налогов и иных платежей, вытекающих из использования услуг сервиса лежит на Партнере.
                    <br><br><br>
                    <h4 class="page_top">5. Обязанности Сервиса</h4>
                    <br>5.1. Сервис обязуется принимать все возможные меры, чтобы услуги предоставлялась бесперебойно и без ошибок.
                    <br>5.2. Сервис обязуется использовать регистрационную информацию Партнера исключительно в целях, предусмотренным настоящим Соглашением, и исключить распространение регистрационной информации.
                    <br>5.3. Сервис обязуется в пределах функционирования услуг сервиса соблюдать конфиденциальность информации о Партнерах, а также иной информации о Партнере, ставшей известной Компании в связи с использованием Партнером услуг сервиса.
                    <br>5.4. Сервис не несет ответственности и не возмещает убытки, возникшие по причине несанкционированного использования третьими лицами идентификационных и регистрационных данных Партнера, а также несанкционированного доступа третьих лиц к Пользовательскому интерфейсу Партнера, произошедших не по вине Сервиса.
                    <br>5.5. Сервис в праве приостановить выплату средств на счет партнера, при наличие нарушений установленных правил со стороны партнера. 
                    <br>5.6. Сервис в праве заблокировать аккаунт партнера,если он предоставил не настоящую скан-копию паспорта.
                    <br>5.7. Сервис обязуется уведомлять партнера об изменениях процентной комиссии не ранее чем за 72 часа.
                    <br><br><br>
                    <h4 class="page_top">6. Вступление в силу, срок действия и прекращение соглашения</h4>
                    <br>6.1. Соглашение вступает в силу с момента завершения регистрации Партнера через Партнерский интерфейс Сервиса и заканчивается в момент расторжения Соглашения.
                    <br>6.2. Любая из сторон может расторгнуть Соглашение в одностороннем порядке.
                    <br>6.3. Партнер имеет право в любое время расторгнуть отношения с Сервисом и отказаться от использования услуг. При этом Партнеру будут произведены все причитающиеся выплаты со стороны Агента.
                    <br>6.4. Сервис имеет право расторгнуть отношения с Партнером в случае нарушения последним любого из пунктов настоящего Соглашения
                    <br>6.5. Сервис оставляет за собой право временно приостановить либо прекратить предоставление услуг сервиса.
                    <br>6.6. Сервис не обязан хранить данные Партнера (сведения из регистрационной формы, статистику запросов абонентов и т. д.) после расторжения Соглашения с Партнером.
                    <br><br><br>
                    <h4 class="page_top">7. Форс-мажорные обстоятельства и условия прерывания действия услуги</h4>
                    <br>7.1. Агент не гарантирует постоянного или безусловного доступа к услугам сервиса. Функционирование услуг может нарушаться действиями непреодолимых сил и иных факторов, предотвращение или преодоление которых выходит за пределы возможностей Сервиса.
                    <br>7.2. Агент не несёт ответственности за совместимость услуг сервиса с данными, программами, конфигурациями и другими аппаратными и программными ресурсами Партнера. В частности, Сервис не берёт на себя никакие издержки, оплаты, расходы, понесенные Партнером при интеграции или не удавшиеся интеграции услуг сервиса. Также исключается какая-либо ответственность за убытки, которые возникают из-за того, что третье лицо неправомерно воспользовалось логином и паролем Партнера.
                    <br>7.3. В случае наступления форс-мажорных обстоятельств, а также аварий или сбоев в программно-аппаратных комплексах третьих лиц, сотрудничающих с Сервисом, или действий третьих лиц, направленных на приостановку или прекращение функционирования услуг сервиса, возможна приостановка работы услуг без предварительного уведомления Партнера.
                    <br><br><br>
                    <h4 class="page_top">8. Размеры, порядок и сроки выплат вознаграждения</h4>
                    <br>8.1. Все расчеты между сторонами по данному Соглашению производятся в рублях.
                    <br>8.2. Выплата вознаграждения Партнеру производится после истечения отчетного периода и производится не реже одного раза в месяц.
                    <br>8.3. Неоплаченные Абонентами Операторам запросы или запросы, направленные Абонентами Операторам путем несанкционированного доступа к услугам связи, не учитываются при расчете стоимости услуг.
                    <br>8.4. Статистика и выплаты вознаграждения по завершению отчетного периода могут быть скорректированы согласно пункту 8.3. данного Соглашения.
                    <br>8.5. Агент в праве приостановить выплаты партнеру, если у него есть достаточно доказательств,что сервис использует для обмана. Но при этом, агент в праве не предоставлять доказательств партнеру.
                    <br><br><br>
                    <h4 class="page_top">9. Размеры и порядок применения штрафных санкций в случае нарушения правил пользования услугами сервиса</h4>
                    <br>9.1. Агент оставляет за собой право применять штрафные санкции к Партнерам в случае нарушения правил пользования услугами:
                    <br>9.2. В случае обнаружения использования Партнером запрещенных ниш, а также ключевых слов, вроде: зоофилии, детской порнографии, изнасилований (rape), в том числе постановочных, некрофилии, троянов и вирусов различного типа; а также Сервисов подмены номера и Сервисов распространяющих программное обеспечение и медиа-продукцию без разрешения владельца авторских прав, учетная запись Партнера блокируется, выплаты не производятся.
                    <br>9.3. Любые нарушения данного соглашения несут за собой блокировку аккаунта Партнера и сервисов которые закрепленны за данным аккаунтом, выплаты не производятся.
                    <br>9.4. Штрафные санкции, указанные в настоящей главе, могут быть пересмотрены как в сторону увеличения, так и в сторону уменьшения, о чем Партнеры будут в обязательном порядке извещены.
                    <br>9.5. Бездействие со стороны Сервиса в случае нарушения Партнером либо иными пользователями положений Соглашения не лишает Сервиса права предпринять соответствующие действия в защиту своих интересов по прошествии времени, а также не означает отказ Агента от своих прав в случае совершения Партнером подобных либо сходных нарушений в будущем.                 
                    <br><br><br>
                    <h4 class="page_top">10. Защита личной информации партнера конфиденциальность и безопасность</h4>
                    <br>10.1. Партнер и Агент обязуются хранить в тайне пароль доступа к Пользовательскому интерфейсу для управления Услугой ЭПС Партнера, а также принимать все необходимые меры по безопасности и защите информации.
                    <br>10.2. При утере доступа к Пользовательскому интерфейсу Партнера, Партнер может запросить отправку нового пароля на указанный при регистрации адрес электронной почты.
                    <br>10.3. Партнер дает согласие на использование Агентом персональной информации в обобщенном виде в целях проведения маркетинговых исследований и таргетинга. Адреса электронной почты и иные данные, указанные Партнером при регистрации, не будут передаваться третьим лицам, если на то нет прямого согласия Партнера, за исключением случаев описанных в п. 10.4.
                    <br>10.4. Личная информация Партнера может быть передана Агрегатору по запросу Агрегатора в случае наличия у Агента или Агрегатора весомых оснований полагать, что имеет место факт нарушения Партнером положений настоящего Соглашения.
                    <br>10.5. Личная информация Партнера может быть передана органам МВД в случае поступления соответствующего запроса. 
                    <br><br><br>    
                    <h4 class="page_top">11. Отказ от ответственности.</h4>
                    <br>11.1 В МАКСИМАЛЬНОЙ СТЕПЕНИ, ДОПУСТИМОЙ ПРИМЕНИМЫМ ЗАКОНОДАТЕЛЬСТВОМ: (A) СЕРВИС IPDONATE, СООТВЕТСТВУЮЩИЕ ЭЛЕМЕНТЫ И МАТЕРИАЛЫ, СОДЕРЖАЩИЕСЯ В НЕМ, ПРЕДОСТАВЛЯЮТСЯ НА УСЛОВИЯХ «КАК ЕСТЬ» В ОТСУТСТВИЕ ГАРАНТИЙ ЛЮБОГО ВИДА, ЯВНЫХ ИЛИ ПОДРАЗУМЕВАЕМЫХ, ЕСЛИ ИНОЕ ПРЯМО НЕ ПРЕДУСМОТРЕНО КОМПАНИЕЙ В ПИСЬМЕННОЙ ФОРМЕ; (B) КОМПАНИЯ И ЕЕ АФФИЛИРОВАННЫЕ ЛИЦА, ПАРТНЕРЫ И ПОСТАВЩИКИ (ДАЛЕЕ — «СТОРОНЫ КОМПАНИИ») ОТКАЗЫВАЮТСЯ ОТ ВСЕХ ПРОЧИХ ГАРАНТИЙ, УСТАНОВЛЕННЫХ ЗАКОНОМ, ЯВНЫХ ИЛИ ПОДРАЗУМЕВАЕМЫХ, ВКЛЮЧАЯ В ТОМ ЧИСЛЕ ПОДРАЗУМЕВАЕМЫЕ ГАРАНТИИ ПРИГОДНОСТИ ДЛЯ ПРОДАЖИ, ПРИГОДНОСТИ ДЛЯ ОПРЕДЕЛЕННОЙ ЦЕЛИ, ПРАВА СОБСТВЕННОСТИ И ОТСУТСТВИЯ НАРУШЕНИЙ В ОТНОШЕНИИ СЕРВИСА IPDONATE, ВКЛЮЧАЯ ЛЮБУЮ ИНФОРМАЦИЮ, КОНТЕНТ ИЛИ МАТЕРИАЛЫ, СОДЕРЖАЩИЕСЯ В НЕМ; (C) КОМПАНИЯ НЕ ПРЕДСТАВЛЯЕТ ЗАВЕРЕНИЙ ИЛИ ГАРАНТИЙ ТОГО, ЧТО ИНФОРМАЦИЯ, КОНТЕНТ ИЛИ МАТЕРИАЛЫ В СЕРВИСЕ ДА ЯВЛЯЮТСЯ ТОЧНЫМИ, ПОЛНЫМИ, ДОСТОВЕРНЫМИ, АКТУАЛЬНЫМИ ИЛИ НЕ СОДЕРЖАТ ОШИБОК; (D) КОМПАНИЯ НЕ НЕСЕТ ОТВЕТСТВЕННОСТИ ЗА ОПЕЧАТКИ ИЛИ ПРОПУСКИ, КАСАЮЩИЕСЯ ТЕКСТА ИЛИ ФОТОГРАФИЙ; И (E) НЕСМОТРЯ НА ТО, ЧТО КОМПАНИЯ ПЫТАЕТСЯ СДЕЛАТЬ ВАШ ДОСТУП И ИСПОЛЬЗОВАНИЕ ВАМИ СЕРВИСА КОМПАНИИ БЕЗОПАСНЫМ, КОМПАНИЯ НЕ МОЖЕТ ЗАВЕРЯТЬ ИЛИ ГАРАНТИРОВАТЬ, ЧТО СЕРВИС ДА ИЛИ НАШИ СЕРВЕРЫ НЕ СОДЕРЖАТ ВИРУСОВ ИЛИ ИНЫХ ВРЕДОНОСНЫХ КОМПОНЕНТОВ, И, В ЭТОЙ СВЯЗИ, ВЫ ДОЛЖНЫ ИСПОЛЬЗОВАТЬ СООТВЕТСТВУЮЩЕЕ ПРОГРАММНОЕ ОБЕСПЕЧЕНИЕ ДЛЯ ЗАЩИТЫ И ЛЕЧЕНИЯ ОТ ВИРУСОВ ПРИ ЛЮБОМ СКАЧИВАНИИ. СООБЩЕНИЯ ИЛИ СВЕДЕНИЯ, УСТНЫЕ ИЛИ ПИСЬМЕННЫЕ, ПОЛУЧЕННЫЕ ВАМИ ОТ КОМПАНИИ ИЛИ ЧЕРЕЗ СЕРВИС IPDONATE, НЕ ПРЕДСТАВЛЯЮТ КАКОЙ-ЛИБО ГАРАНТИИ, ПРЯМО НЕ ВЫРАЖЕННОЙ В НАСТОЯЩЕМ ДОКУМЕНТЕ. ВЫ ЯВНО ПРИЗНАЕТЕ, ЧТО В КОНТЕКСТЕ НАСТОЯЩЕГО РАЗДЕЛА 11 ТЕРМИН «КОМПАНИЯ» ВКЛЮЧАЕТ В СЕБЯ СЛУЖАЩИХ, ДИРЕКТОРОВ, СОТРУДНИКОВ, АКЦИОНЕРОВ, АГЕНТОВ, ЛИЦЕНЗИАРОВ И СУБПОДРЯДЧИКОВ КОМПАНИИ IPDONATE.
                    <br><br><br>
                        <h4 class="page_top">12. Уведомления об ответственности.</h4>
                        <br>Предлагаемые товары и услуги предоставляются не по заказу лица либо предприятия, эксплуатирующего систему WebMoney Transfer.
                        Мы являемся независимым предприятием, оказывающим услуги, и самостоятельно принимаем решения о ценах и предложениях. Предприятия, эксплуатирующие систему WebMoney Transfer, не получают комиссионных вознаграждений или иных вознаграждений за участие в предоставлении услуг и не несут никакой ответственности за нашу деятельность.
                        Аттестация, произведенная со стороны WebMoney Transfer, лишь подтверждает наши реквизиты для связи и удостоверяет личность. Она осуществляется по нашему желанию и не означает, что мы каким-либо образом связаны с продажами операторов системы WebMoney.
                        <br><br><br>
                        <h4 class="page_top">13. Изменение настоящего соглашения.</h4>
                        <br>Компания оставляет за собой право, по нашему усмотрению, вносить изменения, дополнения или удалять части настоящего Соглашения в любое время (например, для отражения обновлений Сервиса IPDonate или отражения изменений законодательства). Если Компания вносит изменения в настоящее Соглашение, мы направим вам уведомление о таких изменениях путем размещения уведомления на веб-странице или указания новой даты последнего обновления выше. Следует периодически пересматривать настоящее Соглашение и Руководства на предмет таких изменений. Продолжение вами использования Сервиса IPDonate после размещения изменений представляет собой принятие вами таких изменений. В отношении любых существенных изменений настоящего Соглашения измененные условия автоматически вступают в силу по истечении тридцати дней после их первоначального размещения в Сервисе IPDonate, если Вы не предоставили Нам уведомление о расторжении в течение указанного периода. Текущая версия Соглашения доступна по адресу: https://ipdonate.com/agreement.
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
                        <a href="/privacy">- Политика конфиденциальности</a>
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
