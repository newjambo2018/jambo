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
                            <p><?= $item->item->retail_price ?> грн</p>
                        </td>
                        <td class="cart_quantity">
                            <input type="number" value="<?= $item->count ?>" data-price-change="<?= $item->id ?>" min="1" max="<?= $item->item->quantity ?>" class="qtyinput">
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price" id="sum<?= $item->id ?>"><?= $item->item->retail_price * $item->count ?> грн</p>
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
            <div class="step-one">
                <h2 class="heading">Шаг 1</h2>
            </div>
            <div class="checkout-options">
                <h3>Вы новый пользователь?</h3>
                <p>Сделайте выбор..</p>
                <ul class="nav">
                    <li><label><input type="checkbox"> Я зарегистрирован!</label></li>
                    <li><label><input type="checkbox"> Я новый пользователь!</label></li>
                    <li><a href=""><i class="fa fa-times"></i>Отменить</a></li>
                </ul>
            </div>
            <div class="step-one" style="margin-top: 15px;">
                <h2 class="heading">Шаг 2</h2>
            </div>
            <div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="shopper-info" style="padding-left: 20px;">
                            <p>Информация о заказе</p>
                            <form>
                                <input type="text" placeholder="Имя и фамилия">
                                <input type="email" placeholder="E-mail адрес">
                                <input type="tel" placeholder="Номер телефона">
                                <input type="text" placeholder="Адрес">
                                <label>Ваш менеджер</label><select>
                                    <option>Катя</option>
                                    <option>Ваня</option>
                                </select>
                                <label>Город</label><select>
                                    <option>Киев</option>
                                    <option>Львов</option>
                                </select>
                            </form>
                        </div>
                        <div style="margin-top: 10px;">
                            <a class="btn btn-default add-to-cart pull-right" href="">Оформить заказ</a>
                        </div>
                    </div>
                    <div class="col-sm-6">
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

<script>
    window.onload = function (ev) {
        update_total_sum()
    }
</script>