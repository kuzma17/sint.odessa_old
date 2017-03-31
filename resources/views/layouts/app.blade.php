<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ \App\Settings::first()->title }}</title>

    <meta name="keywords" content="{{ \App\Settings::first()->keywords }}@if(isset($page) && $page->keywords != ''), {{ $page->keywords }}@endif">
    <!-- Styles -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="/css/bootstrap.min.css" >

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <link href="/css/style.css" rel="stylesheet"/>
    <link href="8768/css/app.css" rel="stylesheet"/>

    <link rel="stylesheet" type="text/css" href="/css/bootstrap-social.css" />
    <link rel="stylesheet" href="/css/font-awesome.min.css">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<div class="top-wrapper">
    @include('layouts.menuTop')
</div>

<div class="container">
    <div class="row">
    <div class="rcol-sm-12 col-md-12 col-lg-4">
        <div class="logo"><img src="/images/logo.jpg"></div>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-4" style="padding-top: 10px; padding-left: 0px; color: #808080; font-family: 'Lato', sans-serif; font-size: 12px">
        <div class="clear"></div>
            <div style="float: left; width: 240px"><i class="glyphicon glyphicon-map-marker" style="color: #107fbe"></i> Адмиральский пр-т. 33А</div>
            <div style="float: left; width: 160px;"><i class="glyphicon glyphicon-earphone" style="color: orangered"></i> +38(0482)333-767</div>
        <div class="clear"></div>
            <div style="float: left; width: 240px"><i class="glyphicon glyphicon-map-marker" style="color: #107fbe"></i> Соборная пл. 12</div>
                <div style="float: left; width: 160px;"><i class="glyphicon glyphicon-earphone" style="color: orangered"></i> +38(0482)777-16-85</div>
        <div class="clear"></div>
            <div style="float: left; width: 240px"><i class="glyphicon glyphicon-map-marker" style="color: #107fbe"></i> Днепропетровская дор. 94</div>
                <div style="float: left; width: 160px;"><i class="glyphicon glyphicon-earphone" style="color: orangered"></i> +38(0482)379-141</div>
        <div class="clear"></div>
            <div style="float: left; width: 240px"><i class="glyphicon glyphicon-map-marker" style="color: #107fbe"></i> Ак. Королева 33</div>
                <div style="float: left; width: 160px;"><i class="glyphicon glyphicon-earphone" style="color: orangered"></i> +38(0482)323-505</div>
        <div class="clear"></div>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-4" style="padding-top: 15px">
        <a href="#" class="btn btn-success btn-top" data-toggle="modal" data-target="#orderModal"><i class="glyphicon glyphicon-plus"></i> Сделать заказ </a>
        <a href="http://sint-market.com" class="btn btn-info btn-top" target="_blank"><i class="glyphicon glyphicon-shopping-cart"></i> Интернет магазин</a>
    </div>
    <div class="clear"></div>
        @include('layouts.menu')
    </div>
</div>
<div class="clear"></div>
<div class="container page">
    <div class="row">
        <div class="col-sm-12 col-md-2 col-lg-2 left_panel">
            <div class="row">
                @if($banner_left = \App\Banner::find(2)->banner)
                    <div class="banner">{!! $banner_left !!}</div>
                @endif
            </div>
    </div>
    <div class="col-sm-12 col-md-8 col-lg-8">
        @include('layouts.slider')
        @include('layouts.bannerTop')
        <br>
        @yield('content')
    </div>
    <div class="col-sm-12 col-md-2 col-lg-2 right_panel">
        <div class="row">
            @include('layouts.map')
            @if($banner_right = \App\Banner::find(3)->banner)
                <div class="banner">{!! $banner_right !!}</div>
            @endif
        </div>
    </div>
    <div class="clear"></div>

    </div>
</div>

<div class="bottom-wrapper">
    <div class="container bottom">
        <div class="row">
        <div class="col-sm-12 col-md-3 col-lg-3 border_right">
            <h4>Контакты</h4>

            <ul class="address-bottom">
                <li><i class="glyphicon glyphicon-phone"></i> +380 503923925, +380 931929878, +380 675576567</li>
                <li><i class="glyphicon glyphicon-envelope"></i> info@sint.odessa.ua</li>
                <li><a href="http://sint.odessa.ua"><i class="glyphicon glyphicon-globe"></i> http://sint.odessa.ua</a></li>
                <li><a href="http://sint-market.com"><i class="glyphicon glyphicon-shopping-cart"></i> http://sint-market.com</a></li>
            </ul>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4 border_right" >
            <h4>Офисы</h4>

            <ul class="address-bottom">
                <li><i class="glyphicon glyphicon-map-marker"></i> Гл. офис: Адмиральский пр-т. 33А
                    <i class="glyphicon glyphicon-earphone"></i> +38(0482)333-767</li>
                <li><i class="glyphicon glyphicon-map-marker"></i> Соборная пл. 12
                    <i class="glyphicon glyphicon-earphone"></i> +38(0482)777-16-85</li>
                <li><i class="glyphicon glyphicon-map-marker"></i> Днепропетровская дор. 94
                    <i class="glyphicon glyphicon-earphone"></i> +38(0482)379-141</li>
                <li><i class="glyphicon glyphicon-map-marker"></i> Ак. Королева 33
                    <i class="glyphicon glyphicon-earphone"></i> +38(0482)323-505</li>
            </ul>
        </div>
        <div class="col-sm-12 col-md-3 col-lg-3 border_right">
            <h4>Навигация</h4>
            <?php
            $menu = \App\Menu::where('active', 1)->orderBy('weight', 'asc')->get();
                $i = 0;
            ?>
            <ul class="menu-bottom">
                @foreach($menu as $link)
                    @if($i == 5)
            </ul>
            <ul class="menu-bottom">
                    @endif
                    <li><a href="{{ $link->url }}">{{ $link->title }}</a></li>
                <?php $i++; ?>
                @endforeach
            </ul>
        </div>
        <div class="col-sm-12 col-md-2 col-lg-2">
            <div class="banner-bottom">
                <div class="clear"></div>
                <!--<h4>Мы в соцсетях</h4>
                <script type="text/javascript">(function(w,doc) {
                        if (!w.__utlWdgt ) {
                            w.__utlWdgt = true;
                            var d = doc, s = d.createElement('script'), g = 'getElementsByTagName';
                            s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
                            s.src = ('https:' == w.location.protocol ? 'https' : 'http')  + '://w.uptolike.com/widgets/v1/uptolike.js';
                            var h=d[g]('body')[0];
                            h.appendChild(s);
                        }})(window,document);
                </script>
                <div data-background-alpha="1.0" data-buttons-color="#ffffff" data-counter-background-color="#ffffff" data-share-counter-size="12" data-top-button="false" data-share-counter-type="disable" data-share-style="1" data-mode="share" data-like-text-enable="false" data-hover-effect="rotate-cw" data-mobile-view="true" data-icon-color="#ffffff" data-orientation="horizontal" data-text-color="#000000" data-share-shape="round" data-sn-ids="vk.tw.fb.ok." data-share-size="40" data-background-color="#33363b" data-preview-mobile="false" data-mobile-sn-ids="fb.vk.tw.wh.ok.vb." data-pid="1612300" data-counter-background-alpha="1.0" data-following-enable="false" data-exclude-show-more="true" data-selection-enable="false" class="uptolike-buttons" ></div>
                -->
                <h4></h4>
                <!--LiveInternet counter--><script type="text/javascript"><!--
                    document.write("<a href='http://www.liveinternet.ru/click' "+
                            "target=_blank><img src='http://counter.yadro.ru/hit?t14.11;r"+
                            escape(document.referrer)+((typeof(screen)=="undefined")?"":
                            ";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
                                    screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
                            ";"+Math.random()+
                            "' alt='' title='LiveInternet: показано число просмотров за 24"+
                            " часа, посетителей за 24 часа и за сегодня' "+
                            "border=0 width=88 height=31><\/a>")//--></script><!--/LiveInternet-->

                <!-- I.UA counter --><a href="http://www.i.ua/" target="_blank" onclick="this.href='http://i.ua/r.php?198771';" title="Rated by I.UA">
                    <script type="text/javascript"><!--
                        iS='http'+(window.location.protocol=='https:'?'s':'')+
                                '://r.i.ua/s?u198771&p104&n'+Math.random();
                        iD=document;if(!iD.cookie)iD.cookie="b=b; path=/";if(iD.cookie)iS+='&c1';
                        iS+='&d'+(screen.colorDepth?screen.colorDepth:screen.pixelDepth)
                                +"&w"+screen.width+'&h'+screen.height;
                        iT=iR=iD.referrer.replace(iP=/^[a-z]*:\/\//,'');iH=window.location.href.replace(iP,'');
                        ((iI=iT.indexOf('/'))!=-1)?(iT=iT.substring(0,iI)):(iI=iT.length);
                        if(iT!=iH.substring(0,iI))iS+='&f'+escape(iR);
                        iS+='&r'+escape(iH);
                        iD.write('<img src="'+iS+'" border="0" width="88" height="31" />');
                        //--></script></a><!-- End of I.UA counter -->
                <!-- begin of Top100 code -->

                <script id="top100Counter" type="text/javascript" src="http://counter.rambler.ru/top100.jcn?3145247"></script>
                <noscript>
                    <a href="http://top100.rambler.ru/navi/3145247/">
                        <img src="http://counter.rambler.ru/top100.cnt?3145247" alt="Rambler's Top100" border="0" />
                    </a>

                </noscript>
                <!-- end of Top100 code -->

                <!--Openstat-->
                <span id="openstat2377870"></span>
                <script type="text/javascript">
                    var openstat = { counter: 2377870, image: 5081, color: "ff9822", next: openstat };
                    (function(d, t, p) {
                        var j = d.createElement(t); j.async = true; j.type = "text/javascript";
                        j.src = ("https:" == p ? "https:" : "http:") + "//openstat.net/cnt.js";
                        var s = d.getElementsByTagName(t)[0]; s.parentNode.insertBefore(j, s);
                    })(document, "script", document.location.protocol);
                </script>
                <!--/Openstat-->

            <!-- Rating@Mail.ru counter -->
                <script type="text/javascript">
                    var _tmr = window._tmr || (window._tmr = []);
                    _tmr.push({id: "2711518", type: "pageView", start: (new Date()).getTime()});
                    (function (d, w, id) {
                        if (d.getElementById(id)) return;
                        var ts = d.createElement("script"); ts.type = "text/javascript"; ts.async = true; ts.id = id;
                        ts.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//top-fwz1.mail.ru/js/code.js";
                        var f = function () {var s = d.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ts, s);};
                        if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); }
                    })(document, window, "topmailru-code");
                </script><noscript><div style="position:absolute;left:-10000px;">
                        <img src="//top-fwz1.mail.ru/counter?id=2711518;js=na" style="border:0;" height="1" width="1" alt="Рейтинг@Mail.ru" />
                    </div></noscript>
            <!-- //Rating@Mail.ru counter -->

            <!-- Rating@Mail.ru logo -->
                <a target="_blank" href="http://top.mail.ru/jump?from=2711518">
                    <img src="//top-fwz1.mail.ru/counter?id=2711518;t=479;l=1"
                         border="0" height="31" width="88" alt="Рейтинг@Mail.ru"></a>
            <!-- //Rating@Mail.ru logo -->


                <!-- Yandex.Metrika counter -->
                <script type="text/javascript">
                    (function (d, w, c) {
                        (w[c] = w[c] || []).push(function() {
                            try {
                                w.yaCounter33707594 = new Ya.Metrika({
                                    id:33707594,
                                    clickmap:true,
                                    trackLinks:true,
                                    accurateTrackBounce:true
                                });
                            } catch(e) { }
                        });

                        var n = d.getElementsByTagName("script")[0],
                                s = d.createElement("script"),
                                f = function () { n.parentNode.insertBefore(s, n); };
                        s.type = "text/javascript";
                        s.async = true;
                        s.src = "https://mc.yandex.ru/metrika/watch.js";

                        if (w.opera == "[object Opera]") {
                            d.addEventListener("DOMContentLoaded", f, false);
                        } else { f(); }
                    })(document, window, "yandex_metrika_callbacks");
                </script>
                <noscript><div><img src="https://mc.yandex.ru/watch/33707594" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
                <!-- /Yandex.Metrika counter -->
            </div>
        </div>
    </div>
    </div>
</div>
<div class="copyright-wrapper">
    <div class="container">
        <div style="float: right">Copyright 2016 @ design by kuzma</div>
    </div>
</div>

@include('order.orderModal')

    <script src="/js/app.js"></script>
@if(Request::path() == '/')
<script type="text/javascript">
    $('.carousel-slogan').html($('.carousel-inner .active img').attr('alt'));
    $('.carousel').on('slide.bs.carousel', function (e) {
        $('.carousel-slogan').html(e.relatedTarget.children[0].alt);
    });
</script>
@endif
<script type="text/javascript">

    $('.edit_panel').hide();
    $('.avatar').hover(function() {
                 $('.edit_panel').toggle();
            });

    $('#avatar').on('change', function(){
        $('.avatar-upload').attr('data-text', $(this).val());
    });
</script>
<script type="text/javascript">
    $('#client_company').click(function () {
        $('#name_account').html('Компания <span class="red">*</span>');
        $('#info_account').html('Наименование компании.');
        $('.client_company').animate({height: "show"}, 500);
    });
    $('#client_user').click(function () {
        $('#name_account').html('ФИО <span class="red">*</span>');
        $('#info_account').html('Фамилия Имя Отчество.');
        $('.client_company').animate({height: "hide"}, 500);
    });

    $('#payment_b_nal').click(function () {
        $('.payment_b_nal').animate({height: "show"}, 500);
        $('.payment_nds').animate({height: "hide"}, 500);
    });
    $('#payment_nds').click(function () {
        $('.payment_b_nal').animate({height: "show"}, 500);
        $('.payment_nds').animate({height: "show"}, 500);
    });
    $('#payment_nal').click(function () {
        $('.payment_b_nal').animate({height: "hide"}, 500);
        $('.payment_nds').animate({height: "hide"}, 500);
    });
</script>

</body>
</html>
