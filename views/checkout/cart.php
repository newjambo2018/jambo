<?

use app\models\General;

?>
<form action="" method="post">
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/">Главная</a></li>
                    <li><a href="/catalog">Каталог</a></li>
                    <li class="active">Корзина</li>

                </ol>
            </div><!--/breadcrums-->
            <div class="table-responsive cart_info">
                <table class="table table-condensed" style="margin-bottom: 0px;">
                    <thead>
                    <tr class="cart_menu">
                        <td class="image">Товар</td>
                        <td class="description"></td>
                        <td class="price">Цена</td>
                        <td class="quantity">Количетсво</td>
                        <td class="total">Итого</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="text-center" id="empty_cart_cat" style="<?= $cart ? 'display:none;' : '' ?>">
                        <td colspan="5">
                            <img src="/images/404.png" alt="" width="200px" style="margin-top: 20px">
                            <br>
                            <span style="margin: 30px !important;font-size: 22px;display: block;">К сожалению, Ваша корзина пуста... <br><a href="/catalog">Перейти в каталог</a></span>
                        </td>
                    </tr>
                    <? foreach ($cart as $item) { ?>
                        <tr class="inherit-cart-counter" id="cart_element_<?= $item->item->id ?>">
                            <td class="cart_product">
                                <a href=""><img src="images/cart/one.png" alt=""></a>
                            </td>
                            <td class="cart_description">
                                <h4><a href=""><?= $item->item->name ?></a></h4>
                                <p>Артикул: <?= $item->item->vendor_code ?></p>
                            </td>
                            <td class="cart_price" id="price<?= $item->id ?>">
                                <p><?= General::actualPrice($item->item) ?> грн</p>
                            </td>
                            <td class="cart_quantity">
                                <input type="number" name="item[<?= $item->item->id ?>]" value="<?= $item->count ?>" data-price-change="<?= $item->id ?>" min="1" max="<?= $item->item->quantity ?>" class="qtyinput">
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price" id="sum<?= $item->id ?>"><?= General::actualPrice($item->item) * $item->count ?> грн</p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" data-remove-from-cart="<?= $item->item->id ?>"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    <? } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section> <!--/#cart_items-->

    <?php if ($cart): ?>
        <section id="do_action">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="total_area col-sm-3 col-sm-offset-9">
                            <ul class="pull-right">
                                <li style="width: 100%">Итого: <span id="total_order_sum"></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="checkout-options" style="margin-bottom: 15px;">
                        <h3>Хотите оформить заказ?</h3>
                    </div>
                    <?php if (!\app\models\General::getUser()): ?>
                        <!--<div class="step-one">
                            <h2 class="heading">Регистрация</h2>
                        </div>
                        <div class="checkout-options">
                            <h3>Вы новый пользователь?</h3>
                            <p>Сделайте выбор...</p>
                            <ul class="nav">
                                <li><label><input type="radio"> Я зарегистрирован!</label></li>
                                <li><label><input type="radio"> Я новый пользователь!</label></li>
                            </ul>
                        </div>-->
                    <?php endif ?>
                    <div class="step-one" style="margin-top: 15px;">
                        <h2 class="heading">Дополнительная информация</h2>
                    </div>
                    <div>
                        <div class="row">
                            <div class="col-sm-6 col-xs-12">
                                <div class="shopper-info" style="padding-left: 20px;">
                                    <p>Информация о заказе</p>
                                    <div class="shopper-form">
                                        <input type="text" placeholder="Имя и фамилия*" name="name" value="<? if (General::getUser()) {
                                            echo General::getUser()->first_name . ' ' . General::getUser()->last_name;
                                        } ?>" required>
                                        <input type="email" placeholder="E-mail адрес*" name="email" value="<?= General::getUser()->email ?>" required>
                                        <input type="tel" placeholder="Номер телефона*" name="phone" value="<?= General::getUser()->phone ?>" id="phone" required>
                                        <select name="delivery" id="delivery_toggler" style="height: 35px;margin-bottom: 10px;">
                                            <option value="">Выберите способ доставки...</option>
                                            <? foreach ($delivery as $item) { ?>
                                                <option value="<?= $item->id ?>"><?= $item->name ?> <?= $item->price ? '(+' . number_format($item->price, 2) . ' грн.)' : '' ?></option>
                                            <? } ?>
                                        </select>
                                        <? foreach ($delivery as $item) { ?>
                                            <input type="hidden" id="dhi<?= $item->id ?>" value="<?= $item->display_address_field ?>">
                                        <? } ?>
                                        <input type="text" placeholder="Адрес" name="delivery_address" value="" id="address_hider" style="display: none;">
                                        <ul class="user_info">
                                            <li class="single_field">
                                                <label>Ваш менеджер:</label>
                                                <select name="manager">
                                                    <option value="">-</option>
                                                    <? foreach ($managers as $manager) { ?>
                                                        <option value="<?= $manager->id ?>" <?= General::getUser(1)->personal_manager === $manager->id ? 'selected' : '' ?>><?= $manager->name ?> (<?= $manager->phone ?>)</option>
                                                    <? } ?>
                                                </select>
                                            </li>
                                            <li class="single_field">
                                                <label>Город:</label>
                                                <select name="city">
                                                    <? foreach ($cities as $item) { ?>
                                                        <option value="<?= $item->id ?>"><?= $item->name ?></option>
                                                    <? } ?>
                                                </select>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div style="margin-top: 10px;">
                                    <button type="submit" class="btn btn-default add-to-cart pull-right" href="">Оформить заказ</button>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="order-message">
                                    <p>Описание к заказу</p>
                                    <textarea name="message" placeholder="Добавьте описание к вашему заказу!"></textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section><!--/#do_action-->
    <?php else: ?>
        <br>
        <br>
        <br>
    <?php endif ?>

    <script>
        window.onload = function (ev) {
            update_total_sum();
            $(document).on('change', '#delivery_toggler', function () {
                if ($('#dhi' + $(this).val()).val() == 1)
                    $('#address_hider').show();
                else
                    $('#address_hider').hide();
            })
        }
    </script>
    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
</form>