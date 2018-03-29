<!DOCTYPE html>
<html class=" ">
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
    <meta charset="utf-8"/>
    <title>Jambo Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>

    <link rel="shortcut icon" href="/admin_assets/images/favicon.png" type="image/x-icon"/>    <!-- Favicon -->
    <link rel="apple-touch-icon-precomposed" href="/admin_assets/images/apple-touch-icon-57-precomposed.png">    <!-- For iPhone -->
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/admin_assets/images/apple-touch-icon-114-precomposed.png">    <!-- For iPhone 4 Retina display -->
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/admin_assets/images/apple-touch-icon-72-precomposed.png">    <!-- For iPad -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/admin_assets/images/apple-touch-icon-144-precomposed.png">    <!-- For iPad Retina display -->


    <!-- CORE CSS FRAMEWORK - START -->
    <link href="/admin_assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="/admin_assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="/admin_assets/plugins/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
    <link href="/css/font-awesome.min.css" rel="stylesheet">
    <link href="/admin_assets/css/animate.min.css" rel="stylesheet" type="text/css"/>
    <link href="/admin_assets/plugins/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" type="text/css"/>
    <!-- CORE CSS FRAMEWORK - END -->

    <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START -->
    <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END -->


    <!-- CORE CSS TEMPLATE - START -->
    <link href="/admin_assets/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="/admin_assets/css/responsive.css" rel="stylesheet" type="text/css"/>
    <!-- CORE CSS TEMPLATE - END -->

</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<body class=" "><!-- START TOPBAR -->
<div class='page-topbar '>
    <div class='logo-area' style="background-image:none !important;color: white;font-size: 25px;text-align: center;word-spacing: 0px;padding-top: 16px">JAMBO ADMIN</div>
    <div class='quick-area'>
        <div class='pull-left'>
            <ul class="info-menu left-links list-inline list-unstyled">
                <li class="sidebar-toggle-wrap">
                    <a href="#" data-toggle="sidebar" class="sidebar_toggle">
                        <i class="fa fa-bars"></i>
                    </a>
                </li>
                <!--<li class="">
                    <a href="#" data-toggle="dropdown" class="toggle">
                        <i class="fa fa-envelope"></i>
                        <span class="badge badge-primary">7</span>
                    </a>
                    <ul class="dropdown-menu messages animated fadeIn">

                        <li class="list">

                            <ul class="dropdown-menu-list list-unstyled ps-scrollbar">
                                <li class="unread status-available">
                                    <a href="javascript:;">
                                        <div class="user-img">
                                            <img src="../../../web/data/profile/avatar-1.png" alt="user-image" class="">
                                        </div>
                                        <div>
                                                    <span class="name">
                                                        <strong>Clarine Vassar</strong>
                                                        <span class="time small">- 15 mins ago</span>
                                                        <span class="profile-status available pull-right"></span>
                                                    </span>
                                            <span class="desc small">
                                                        Sometimes it takes a lifetime to win a battle.
                                                    </span>
                                        </div>
                                    </a>
                                </li>
                            </ul>

                        </li>

                        <li class="external">
                            <a href="javascript:;">
                                <span>Read All Messages</span>
                            </a>
                        </li>
                    </ul>

                </li>-->
                <li class="">
                    <a href="#" data-toggle="dropdown" class="toggle">
                        <i class="fa fa-bell"></i>
                        <span class="badge badge-orange">3</span>
                    </a>
                    <ul class="dropdown-menu notifications animated fadeIn">
                        <li class="total">
                                    <span class="small">
                                        You have <strong>3</strong> new notifications.
                                        <a href="javascript:;" class="pull-right">Mark all as Read</a>
                                    </span>
                        </li>
                        <li class="list">

                            <ul class="dropdown-menu-list list-unstyled ps-scrollbar">
                                <li class="unread available"> <!-- available: success, warning, info, error -->
                                    <a href="javascript:;">
                                        <div class="notice-icon">
                                            <i class="fa fa-check"></i>
                                        </div>
                                        <div>
                                                    <span class="name">
                                                        <strong>Server needs to reboot</strong>
                                                        <span class="time small">15 mins ago</span>
                                                    </span>
                                        </div>
                                    </a>
                                </li>
                                <li class="unread away"> <!-- available: success, warning, info, error -->
                                    <a href="javascript:;">
                                        <div class="notice-icon">
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                        <div>
                                                    <span class="name">
                                                        <strong>45 new messages</strong>
                                                        <span class="time small">45 mins ago</span>
                                                    </span>
                                        </div>
                                    </a>
                                </li>
                                <li class=" busy"> <!-- available: success, warning, info, error -->
                                    <a href="javascript:;">
                                        <div class="notice-icon">
                                            <i class="fa fa-times"></i>
                                        </div>
                                        <div>
                                                    <span class="name">
                                                        <strong>Server IP Blocked</strong>
                                                        <span class="time small">1 hour ago</span>
                                                    </span>
                                        </div>
                                    </a>
                                </li>
                                <li class=" offline"> <!-- available: success, warning, info, error -->
                                    <a href="javascript:;">
                                        <div class="notice-icon">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <div>
                                                    <span class="name">
                                                        <strong>10 Orders Shipped</strong>
                                                        <span class="time small">5 hours ago</span>
                                                    </span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="external">
                            <a href="javascript:;">
                                <span>Read All Notifications</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--                <li class="hidden-sm hidden-xs searchform">-->
                <!--                    <div class="input-group">-->
                <!--                                <span class="input-group-addon input-focus">-->
                <!--                                    <i class="fa fa-search"></i>-->
                <!--                                </span>-->
                <!--                        <form action="search-page.html" method="post">-->
                <!--                            <input type="text" class="form-control animated fadeIn" placeholder="Search & Enter">-->
                <!--                            <input type='submit' value="">-->
                <!--                        </form>-->
                <!--                    </div>-->
                <!--                </li>-->
            </ul>
        </div>
        <div class='pull-right'>
            <ul class="info-menu right-links list-inline list-unstyled">
                <li class="profile">
                    <a href="#" data-toggle="dropdown" class="toggle">
                        <i class="fa fa-user img-circle img-inline"></i>
                        <span><?= \app\models\Admin::get()->name ?> <i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul class="dropdown-menu profile animated fadeIn">
                        <li>
                            <a href="/admin/default/settings">
                                <i class="fa fa-wrench"></i>
                                Настройки
                            </a>
                        </li>
                        <li class="last">
                            <a href="/admin/default/logout">
                                <i class="fa fa-lock"></i>
                                Выйти
                            </a>
                        </li>
                    </ul>
                </li>
                <!--                <li class="chat-toggle-wrapper">-->
                <!--                    <a href="#" data-toggle="chatbar" class="toggle_chat">-->
                <!--                        <i class="fa fa-comments"></i>-->
                <!--                        <span class="badge badge-warning">9</span>-->
                <!--                    </a>-->
                <!--                </li>-->
            </ul>
        </div>
    </div>

</div>
<!-- END TOPBAR -->
<!-- START CONTAINER -->
<div class="page-container row-fluid">

    <!-- SIDEBAR - START -->
    <div class="page-sidebar ">


        <!-- MAIN MENU - START -->
        <div class="page-sidebar-wrapper" id="main-menu-wrapper">

            <!-- USER INFO - START -->
            <div class="profile-info row">

                <div class="profile-image col-md-4 col-sm-4 col-xs-4">
                    <a href="#!">
                        <i class="fa fa-user img-circle img-inline" style="font-size: 60px;margin-left: 25px;margin-top: 5px;color: white"></i>
                    </a>
                </div>

                <div class="profile-details col-md-8 col-sm-8 col-xs-8">

                    <h3 style="overflow: hidden;">
                        <a href="#!" style="font-size: 20px;"><?= \app\models\Admin::get()->name ?></a>

                        <!-- Available statuses: online, idle, busy, away and offline -->
                        <span class="profile-status online"></span>
                    </h3>

                    <p class="profile-title"><?= \app\models\Admin::isSuperuser() ? '<i class="fa fa-user-secret"></i> Администратор' : '<i class="fa fa-user"></i> Менеджер' ?></p>

                </div>

            </div>
            <!-- USER INFO - END -->


            <ul class='wraplist'>
                <li class="">
                    <a href="/admin">
                        <i class="fa fa-home"></i>
                        <span class="title">Главная</span>
                    </a>
                </li>
                <?php if (\app\models\Admin::isSuperuser()): ?>
                    <li class="">
                        <a href="/admin/admins">
                            <i class="fa fa-user-secret"></i>
                            <span class="title">Администраторы</span>
                        </a>
                    </li>
                <?php endif ?>
                <li>
                    <a href="/admin/orders">
                        <i class="fa fa-database"></i>
                        <span class="title">Заказы <span class="badge"></span></span>
                    </a>
                </li>
                <li>
                    <a href="/admin/clients">
                        <i class="fa fa-users"></i>
                        <span class="title">Пользователи <span class="badge"></span></span>
                    </a>
                </li>
                <li class="">
                    <a href="javascript:;">
                        <i class="fa fa-suitcase"></i>
                        <span class="title">Dropdown</span>
                        <span class="fa fa-arrow-down pull-right" style="margin-top: 15px;margin-right: 15px"></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a class="" href="#!">Test</a>
                        </li>
                        <li>
                            <a class="" href="#!">Test</a>
                        </li>
                        <li>
                            <a class="" href="#!">Test</a>
                        </li>
                        <li>
                            <a class="" href="#!">Test</a>
                        </li>
                    </ul>
                </li>


            </ul>

        </div>
        <!-- MAIN MENU - END -->


        <div class="project-info">

            <div class="block1">
                <div class="data">
                    <span class='title'>New&nbsp;Orders</span>
                    <span class='total'>2,345</span>
                </div>
                <div class="graph">
                    <span class="sidebar_orders">...</span>
                </div>
            </div>

            <div class="block2">
                <div class="data">
                    <span class='title'>Visitors</span>
                    <span class='total'>345</span>
                </div>
                <div class="graph">
                    <span class="sidebar_visitors">...</span>
                </div>
            </div>

        </div>


    </div>
    <!--  SIDEBAR - END -->
    <!-- START CONTENT -->
    <section id="main-content" class=" ">
        <section class="wrapper" style='margin-top:60px;display:inline-block;width:100%;padding:15px 0 0 15px;'>

            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                <div class="page-title">

                    <div class="pull-left">
                        <h1 class="title">Jambo Admin Panel</h1></div>


                </div>
            </div>
            <div class="clearfix"></div>

            <div class="col-lg-12">
                <section class="box ">
                    <header class="panel_header">
                        <h2 class="title pull-left">Section Box</h2>
                        <div class="actions panel_actions pull-right">
                            <i class="box_toggle fa fa-chevron-down"></i>
                            <i class="box_setting fa fa-cog" data-toggle="modal" href="#section-settings"></i>
                            <i class="box_close fa fa-times"></i>
                        </div>
                    </header>
                    <div class="content-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">

                                <? foreach (\app\models\General::getFlash() as $item) { ?>
                                    <div class="alert alert-danger" style="border-radius: 0">
                                        <?= $item ?>
                                    </div>
                                <? } ?>
                                <? foreach (\app\models\General::getFlash('success') as $item) { ?>
                                    <div class="alert alert-success" style="border-radius: 0">
                                        <?= $item ?>
                                    </div>
                                <? } ?>

                                <?= $content ?>
                            </div>
                        </div>
                    </div>
                </section>
            </div>


        </section>
    </section>
    <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->


<!-- CORE JS FRAMEWORK - START -->
<script src="/admin_assets/js/jquery-1.11.2.min.js" type="text/javascript"></script>
<script src="/admin_assets/js/jquery.easing.min.js" type="text/javascript"></script>
<script src="/admin_assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/admin_assets/plugins/pace/pace.min.js" type="text/javascript"></script>
<script src="/admin_assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js" type="text/javascript"></script>
<script src="/admin_assets/plugins/viewport/viewportchecker.js" type="text/javascript"></script>
<!-- CORE JS FRAMEWORK - END -->


<!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START -->
<!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END -->


<!-- CORE TEMPLATE JS - START -->
<script src="/js/maskedinput.min.js"></script>

<link rel="stylesheet" href="/lib/noty.css">
<link rel="stylesheet" href="/lib/themes/mint.css">
<script src="/admin_assets/js/scripts.js" type="text/javascript"></script>
<script src="/lib/noty.min.js" type="text/javascript"></script>
<!-- END CORE TEMPLATE JS - END -->

<!-- Sidebar Graph - START -->
<script src="/admin_assets/plugins/sparkline-chart/jquery.sparkline.min.js" type="text/javascript"></script>
<script src="/admin_assets/js/chart-sparkline.js" type="text/javascript"></script>
<!-- Sidebar Graph - END -->


<script>
    function notify(text, type) {
        new Noty({
            text: text,
            type: type ? type : 'error',
            progressBar: true,
            timeout: 8000
        }).show();
    }
    $("#phone").mask("+38 (099) 999 99 99");
</script>

<!-- General section box modal start -->
<div class="modal" id="section-settings" tabindex="-1" role="dialog" aria-labelledby="ultraModal-Label" aria-hidden="true">
    <div class="modal-dialog animated bounceInDown">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Section Settings</h4>
            </div>
            <div class="modal-body">

                Body goes here...

            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-success" type="button">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- modal end -->
</body>
</html>



