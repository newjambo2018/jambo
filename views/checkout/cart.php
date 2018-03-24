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
          <div class="step-one">
              <h2 class="heading">Шаг 1</h2>
          </div>
        </div>
    </div>
</section><!--/#do_action-->

<script>
    window.onload = function (ev) {
        update_total_sum()
    }
</script>