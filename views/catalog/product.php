<?

/**
 * @var \app\models\ShopProducts $product
 */

use app\models\General;

?>

<section>
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="/">Главная</a></li>
                <li><a href="/catalog">Каталог</a></li>
                <li><a href="/catalog?cat=<?= $cat->id ?>"><?= $cat->name ?></a></li>
                <li><a href="/catalog?cat=<?= $cat->id ?>&subcat=<?= $subcat->id ?>"><?= $subcat->name ?></a></li>
                <li class="active"><?= $product->name ?></li>

            </ol>
        </div><!--/breadcrums-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12 padding-right">
                    <div class="product-details"><!--product-details-->
                        <div class="col-sm-5">
                            <div class="view-product">
                                <img src="/sync/products/<?= $product->vendor_code ?>/0.jpg" alt=""/>
                                <h3>Размер</h3>
                            </div>
                            <div id="similar-product" class="carousel slide" data-ride="carousel">


                            </div>

                        </div>
                        <div class="col-sm-7">
                            <div class="product-information"><!--/product-information-->
                                <h2><?= $product->name ?></h2>
                                <p>Артикул: <?= $product->vendor_code ?></p>
                                <span>
									<span>
                                        <?= number_format($actual_price = General::actualPrice($product), 2) ?>

                                        <?php if ($actual_price != ($old_price = General::actualViewPrice($product))): ?>
                                            <sup class="lined_price" style="color: red;"><?= $old_price ?></sup>
                                        <?php endif ?> грн
                                    </span>

									<label>Количетсво:</label>
									<input type="number" value="1" id="quantity-field" min="1" max="<?= $product->quantity ?>"/>
									<button type="button" class="btn btn-fefault add-to-cart <?= $product->quantity < 1 ? 'btn-disabled' : '' ?>" data-to-cart="<?= $product->id ?>" data-quantity="y" style="margin-bottom: 8px;margin-left: 10px;">
										<i class="fa fa-shopping-cart"></i>
										В корзину
									</button>
                                    <?php if (General::isWholesale() || General::getUser()->retail_discount): ?>
                                        <div class="hint-block hint" style="text-align: left;margin-top: 10px;color: grey;font-size: 12px;">Товар отображается с учетом акций, оптовых и Ваших личных скидок.</div>
                                    <?php endif ?>
								</span>
                                <p><b>На складе:</b>&nbsp;<?= $product->quantity > 0 ? '<i class="fa fa-check"></i> В наличии' : '<i class="fa fa-times"></i> Нет на складе' ?></p>
                                <p><b>Брэнд:</b>&nbsp;<?= $brand->name ?></p>
                                <?php if ($product->gender): ?>
                                    <p><b>Пол: </b>&nbsp;<?= $product->gender ?></p>
                                <?php endif ?>
                                <?php if ($product->age): ?>
                                    <p><b>Возраст: </b>&nbsp;<?= $product->age ?></p>
                                <?php endif ?>
                                <div class="row">
                                    <div class="col-xs-11">
                                        <div class="navigation">
                                            <a href="/catalog/product/<?= $next ?>" class="add-to-cart <?= $next ?: 'btn-disabled' ?>">Следующий</a>
                                            <a href="/catalog?cat=<?= $cat->id ?>&subcat=<?= $subcat->id ?>" class="add-to-cart">К разделу</a>
                                            <a href="/catalog/product/<?= $prev ?>" class="add-to-cart <?= $prev ?: 'btn-disabled' ?>">Предыдущий</a>
                                        </div>
                                    </div>
                                </div>
                            </div><!--/product-information-->
                        </div>
                    </div><!--/product-details-->

                    <div>
                        <div class="recommended_items"><!--recommended_items-->
                            <h2 class="title text-center">Похожие товары </h2>

                            <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="item active">
                                        <?php for ($i = 0; $i < 3; $i++): ?>
                                            <div class="col-sm-4">
                                                <div class="product-image-wrapper">
                                                    <div class="single-products">
                                                        <div class="productinfo text-center">
                                                            <a href="/catalog/product/<?= $same[$i]->slug ?>" style="display:block;">
                                                                <img src="/sync/products/<?= $same[$i]->vendor_code ?>/0.jpg" alt=""/>
                                                                <h2><?= General::actualPrice($same[$i]) ?> грн</h2>
                                                                <p><?= mb_strlen($same[$i]->name) > 27 ? mb_substr($same[$i]->name, 0, 25) . '...' : $same[$i]->name ?></p>
                                                            </a>
                                                            <button type="button" class="btn btn-default add-to-cart" data-to-cart="<?= $same[$i]->id ?>"><i class="fa fa-shopping-cart"></i>В корзину</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endfor ?>
                                    </div>
                                    <div class="item">
                                        <?php for ($i = 3; $i < 6; $i++): ?>
                                            <div class="col-sm-4">
                                                <div class="product-image-wrapper">
                                                    <div class="single-products">
                                                        <div class="productinfo text-center">
                                                            <a href="/catalog/product/<?= $same[$i]->vendor_code ?>" style="display:block;">
                                                                <img src="/images/home/recommend1.jpg" alt=""/>
                                                                <h2><?= General::actualPrice($same[$i]) ?> грн</h2>
                                                                <p><?= mb_strlen($same[$i]->name) > 27 ? mb_substr($same[$i]->name, 0, 25) . '...' : $same[$i]->name ?></p>
                                                            </a>
                                                            <button type="button" class="btn btn-default add-to-cart" data-to-cart="<?= $same[$i]->id ?>"><i class="fa fa-shopping-cart"></i>В корзину</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endfor ?>
                                    </div>
                                </div>
                                <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                                <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </div><!--/recommended_items-->
                    </div>


                    <div class="category-tab shop-details-tab"><!--category-tab-->
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#reviews" data-toggle="tab">Отзывы</a></li>
                            </ul>
                        </div>


                        <div class="tab-pane fade active in" id="reviews">
                            <div class="col-sm-12">
                                <div id="disqus_thread"></div>
                                <script>
                                    (function () { // DON'T EDIT BELOW THIS LINE
                                        var d = document, s = d.createElement('script');
                                        s.src = 'https://jambo-ua.disqus.com/embed.js';
                                        s.setAttribute('data-timestamp', +new Date());
                                        (d.head || d.body).appendChild(s);
                                    })();
                                </script>
                                <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

                                <!--                                <ul>-->
                                <!--                                    <li><a href=""><i class="fa fa-user"></i>Евгений</a></li>-->
                                <!--                                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>-->
                                <!--                                    <li><a href=""><i class="fa fa-calendar-o"></i>31.02.2018</a></li>-->
                                <!--                                </ul>-->
                                <!--                                <p>Круто все очень ! Прям супер, люблю джамбо!</p>-->
                                <!--                                <p><b>Напишите свой отзыв</b></p>-->
                                <!---->
                                <!--                                <form action="#">-->
                                <!--										<span>-->
                                <!--											<input type="text" placeholder="Ваше Имя"/>-->
                                <!--											<input type="email" placeholder="Ваш Email-адрес "/>-->
                                <!--										</span>-->
                                <!--                                    <textarea name="" placeholder="Ваш отзыв!"></textarea>-->
                                <!--                                    <button type="button" class="btn btn-default pull-right">-->
                                <!--                                        Запостить-->
                                <!--                                    </button>-->
                                <!--                                </form>-->
                            </div>
                        </div>

                    </div>
                </div><!--/category-tab-->
            </div>


        </div>
    </div>
</section>
