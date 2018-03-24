<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/font-awesome.min.css" rel="stylesheet">
    <link href="/css/prettyPhoto.css" rel="stylesheet">
    <link href="/css/price-range.css" rel="stylesheet">
    <link href="/css/animate.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">
    <link href="/css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="/js/html5shiv.js"></script>
    <script src="/js/respond.min.js"></script>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="/images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo col-xs-8">
                        <ul class="nav nav-pills ">
                            <li><a><i class="fa fa-phone"></i>&nbsp;Розница:&nbsp;(098) 705-05-05 </a></li>
                            <li><a><i class="fa fa-phone""></i>&nbsp;Опт:&nbsp;(096) 650-69-29 </a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="/"><img src="/images/home/logo.png" alt="Джамбо" style="width: 150px"/></a>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right col-xs-offset-2">
                        <ul class="nav navbar-nav">
                            <li><a href="/profile"><i class="fa fa-user"></i>&nbsp;Кабинет</a></li>
                            <li><a href="/checkout/cart" _data-open-cart="1"><i class="fa fa-shopping-cart"></i> Корзина <span class="badge cart-count-element"><?= \app\models\Carts::cartCount() ?></span></a></li>
                            <li><a href="/auth"><i class="fa fa-lock"></i> Вход</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="/" class="active">Главная</a></li>
                            <li class="dropdown"><a href="#">Магазин<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="/catalog">Каталог</a></li>
                                    <li><a href="/catalog">Акция</a></li>
                                    <li><a href="/catalog">Собственный импорт</a></li>
                                    <li><a href="/catalog">Новинки</a></li>
                                    <li><a href="/checkout">Ваш заказ</a></li>
                                    <li><a href="/checkout/cart">Корзина</a></li>
                                    <li><a href="/auth">Вход</a></li>
                                </ul>
                            </li>
                            <li><a href="#">О нас</a></li>
                            <li><a href="contact-us.html">Наши контакты </a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="search_box pull-right">
                        <form action="/catalog" method="get">
                            <input type="text" placeholder="Поиск" name="search"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->

<?= $content ?>

<footer id="footer"><!--Footer-->
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <div class="companyinfo">
                        <h2><span>J</span>ambo</h2>
                        <p>Лучшие игрушки по лучшим ценам!</p>
                    </div>
                </div>
                <div class="col-sm-9">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d40643.10045548781!2d30.474440333709687!3d50.45611614226741!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40d4cf1f7549bcbb%3A0x60f6e9bc28c98f54!2sJAMBO!5e0!3m2!1sru!2sua!4v1520259088342" width="100%"
                            height="200" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
        </div>

        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Service</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Online Help</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Order Status</a></li>
                                <li><a href="#">Change Location</a></li>
                                <li><a href="#">FAQ’s</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Quock Shop</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">T-Shirt</a></li>
                                <li><a href="#">Mens</a></li>
                                <li><a href="#">Womens</a></li>
                                <li><a href="#">Gift Cards</a></li>
                                <li><a href="#">Shoes</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Policies</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Terms of Use</a></li>
                                <li><a href="#">Privecy Policy</a></li>
                                <li><a href="#">Refund Policy</a></li>
                                <li><a href="#">Billing System</a></li>
                                <li><a href="#">Ticket System</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>О нас </h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">О нас </a></li>
                                <li><a href="#">Сотрудничество</a></li>
                                <li><a href="#">Store Location</a></li>
                                <li><a href="#">Affillate Program</a></li>
                                <li><a href="#">Copyright</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3 col-sm-offset-1">
                        <div class="single-widget">
                            <h2>Подписаться на наши новости!</h2>
                            <form action="#" class="searchform">
                                <input type="text" placeholder="Ваш E-mail адрес"/>
                                <button type="submit" class="btn btn-default"><i class="fas fa-arrow-right"></i></button>
                                <p>Получайте самые свежие новости нашей компании, а также свежий каталог товаров...</p>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <p class="pull-left">Copyright © <?= date('Y') ?> JAMBO</p>
                    <p class="pull-right">All rights reserved.</a></span></p>
                </div>
            </div>
        </div>

</footer><!--/Footer-->

<!--<div class="modal cart-modal" tabindex="-1" role="dialog">-->
<!--    <div class="modal-dialog" style="width: 90%;" role="document">-->
<!--        <div class="modal-content">-->
<!--            <div class="modal-header">-->
<!--                <h5 class="modal-title">Ваша корзина</h5>-->
<!--                <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
<!--                    <span aria-hidden="true">&times;</span>-->
<!--                </button>-->
<!--            </div>-->
<!--            <div class="modal-body">-->
<!---->
<!--            </div>-->
<!--            <div class="modal-footer">-->
<!--                <button type="button" class="btn btn-primary">Save changes</button>-->
<!--                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->


<script src="/js/jquery.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/maskedinput.min.js"></script>
<script src="/js/jquery.scrollUp.min.js"></script>
<script src="/js/price-range.js"></script>
<script src="/js/jquery.prettyPhoto.js"></script>
<script src="/js/main.js"></script>
</body>
</html>