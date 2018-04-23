<section id="form">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Мой кабинет</h2>
                    <div class="panel-group category-products" id="accordian"><!--profile-->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a href="/profile"><i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp;Личные данные</a></h4>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a href="/catalog"><i class="fas fa-list-alt"></i>&nbsp;Каталог товаров</a></h4>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
                                        <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                        <i class="fas fa-cart-arrow-down"></i>&nbsp;Мои заказы
                                    </a>
                                </h4>
                            </div>
                            <div id="sportswear" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul>
                                        <li><a href="/checkout/cart">Перейти в корзину</a></li>
                                        <li><a href="/profile/history">История заказов</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <?php if (\app\models\General::getUser()->wholesale === \app\models\Client::WHOLESALE_ACTIVE): ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="#"><i class="fas fa-arrow-circle-down"></i>&nbsp;Скачать прайс-лист</a></h4>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <!--/profile-->
            <div class="col-sm-5 col-sm-offset-2">
                <div class="signup-form profile-form"><!--sign up form-->
                    <div style="text-align: center">
                        <h3>Личные perchiki</h3>
                    </div>
                    <form action="" method="post">
                        <input type="hidden" value="<?= Yii::$app->request->csrfToken ?>" name="_csrf">
                        <input type="text" placeholder="Ваше Имя" value="<?= $client->first_name ?>" name="name"/>
                        <input type="text" placeholder="Ваша Фамилия" value="<?= $client->last_name ?>" name="last_name"/>
                        <input type="tel" placeholder="Ваш номер телефона" value="<?= $client->phone ?>" id="phone" name="phone"/>
                        <input type="password" placeholder="Новый пароль" name="password"/>
                        <div style="text-align: center">
                            <button type="submit" class="btn btn-default add-to-cart">Обновить информацию</button>
                        </div>
                    </form>
                </div>
            </div>
</section>

<section id="advertisement">
    <div class="container">
        <img src="/images/shop/advertisement.jpg" alt=""/>
    </div>
</section>