<?

use app\models\General;

?>
<?php if ($index): ?>
    <section id="slider"><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                            <li data-target="#slider-carousel" data-slide-to="2"></li>
                        </ol>

                        <div class="carousel-inner">
                            <div class="item active">
                                <div class="col-sm-6">
                                    <h1><span>E</span>-SHOPPER</h1>
                                    <h2>Free E-Commerce Template</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="/images/home/girl1.jpg" class="girl img-responsive" alt=""/>
                                    <img src="/images/home/pricing.png" class="pricing" alt=""/>
                                </div>
                            </div>
                            <div class="item">
                                <div class="col-sm-6">
                                    <h1><span>E</span>-SHOPPER</h1>
                                    <h2>100% Responsive Design</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="/images/home/girl2.jpg" class="girl img-responsive" alt=""/>
                                    <img src="/images/home/pricing.png" class="pricing" alt=""/>
                                </div>
                            </div>

                            <div class="item">
                                <div class="col-sm-6">
                                    <h1><span>E</span>-SHOPPER</h1>
                                    <h2>Free Ecommerce Template</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="/images/home/girl3.jpg" class="girl img-responsive" alt=""/>
                                    <img src="/images/home/pricing.png" class="pricing" alt=""/>
                                </div>
                            </div>

                        </div>

                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section><!--/slider--><?php endif ?>

<section id="advertisement">
    <div class="container">
        <img src="/images/shop/advertisement.jpg" alt=""/>
    </div>
</section>


<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <form action="/catalog/index" id="#main-filter">
                    <div class="left-sidebar">
                        <h2>Категории</h2>
                        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                            <? foreach ($cats as $key => $cat) { ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a href="?cat=<?= $cat['id'] ?>">
                                                <?= mb_substr($cat['name'], mb_stripos($cat['name'], ' ')) ?>
                                            </a>
                                            <span data-toggle="collapse" data-parent="#accordian" href="#main_cat<?= $key ?>" class="badge pull-right"><i class="fa fa-plus"></i></span>
                                        </h4>
                                    </div>
                                    <div id="main_cat<?= $key ?>" class="panel-collapse <?= $_GET['cat'] === $cat['id'] ? 'in' : 'collapse' ?>">
                                        <div class="panel-body">
                                            <ul>
                                                <? foreach ($cat['subcats'] as $subcat) { ?>
                                                    <li><a href="?cat=<?= $cat['id'] ?>&subcat=<?= $subcat['id'] ?>"><?= $subcat['name'] ?></a></li>
                                                <? } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <? } ?>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="?brand=own">Собственный импорт</a></h4>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="?new=1">Новинки</a></h4>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="?stock=1">Акция</a></h4>
                                </div>
                            </div>

                        </div><!--/category-product-->

                        <div class="price-range"><!--price-range-->
                            <h2>Цена</h2>
                            <div class="well">
                                <input type="text" class="span2" value="" data-slider-min="<?= floor($price_range['min']) ?>" data-slider-max="<?= round($price_range['max']) ?>" data-slider-step="5"
                                       data-slider-value="[<?= $price ? implode(',', $price) : floor($price_range['min']) . ',' . round($price_range['max']) ?>]"
                                       id="sl2"><br/>
                                <b>₴ <?= number_format(floor($price_range['min'])) ?></b> <b class="pull-right">₴ <?= number_format(round($price_range['max'])) ?></b>
                                <div class="text-center">
                                    <a href="#!" class="btn btn-default add-to-cart" style="margin-top: 20px;margin-bottom: 0" id="filter_by_price">Фильтровать</a>
                                </div>
                            </div>
                        </div> <!-- price slider-->

                        <script>
                            window.onload = function (ev) {
                                $(document).on('click', '#filter_by_price', function () {
                                    window.location = '?<?= $_GET ? http_build_query($_GET) . '&' : '' ?>price=' + $('#sl2').val()
                                })
                            }
                        </script>


                        <div style="text-align: center">
                            <h2>Для кого</h2>
                            <fieldset class="gender">
                                <div class="col-xs-11">
                                    <div>
                                        <div class="checkbox checkbox-circle">
                                            <a href="?<?= $_GET ? http_build_query($_GET) . '&' : '' ?>gender=m" class="gender-filter">
                                                <input id="checkbox7" type="checkbox" <?= $_GET['gender'] == 'm' ? 'checked' : '' ?>>
                                                <span for="checkbox7" style="font-weight: 300" class="gender-btn">Мальчик&nbsp;<i class="fas fa-male"></i></span>
                                            </a>
                                        </div>
                                        <div class="checkbox checkbox-circle" style="margin-top: 10px">
                                            <a href="?<?= $_GET ? http_build_query($_GET) . '&' : '' ?>gender=f" class="gender-filter">
                                                <input id="checkbox8" type="checkbox" <?= $_GET['gender'] == 'f' ? 'checked' : '' ?> >
                                                <span for="checkbox8" style="font-weight: 300" class="gender-btn">Девочка&nbsp;<i class="fas fa-female"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>


                        <div class="brands_products"><!--brands_products-->
                            <h2>Бренды</h2>
                            <div class="brands-name">
                                <ul class="nav nav-pills nav-stacked" style="font-weight: 300">
                                    <li><a href="?brand=1"> <span class="pull-right"><i class="fa fa-arrow-right"></i></span>BabyMix</a></li>
                                    <li><a href="?brand=23"> <span class="pull-right"><i class="fa fa-arrow-right"></i></span>Colorino</a></li>
                                    <li><a href="?brand=30"> <span class="pull-right"><i class="fa fa-arrow-right"></i></span>Arial</a></li>
                                    <li><a href="?brand=5"> <span class="pull-right"><i class="fa fa-arrow-right"></i></span>DankoToys</a></li>
                                    <li><a href="#!"> <span class="pull-right"><i class="fa fa-arrow-right"></i></span>Defa</a></li>
                                    <li><a href="?brand=31"> <span class="pull-right"><i class="fa fa-arrow-right"></i></span>Kinsmart</a></li>
                                    <li><a href="#!"> <span class="pull-right"><i class="fa fa-arrow-right"></i></span>Brick</a></li>
                                    <li><a href="?brand=41"> <span class="pull-right"><i class="fa fa-arrow-right"></i></span>Intex</a></li>
                                    <li><a href="?brand=2"> <span class="pull-right"><i class="fa fa-arrow-right"></i></span>Doloni</a></li>
                                    <li><a href="#!"> <span class="pull-right"><i class="fa fa-arrow-right"></i></span>Автопром</a></li>
                                </ul>
                            </div>
                            <div class="panel-group category-products" id="accordian" style="margin-top: 10px;"><!--category-productsr-->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
                                                <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                                Еще
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="sportswear" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <ul>
                                                <? foreach ($brands as $brand) { ?>
                                                    <li><a href="?brand=<?= $brand['id'] ?>"><?= $brand['name'] ?></a></li>
                                                <? } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-sm-9 padding-right">
                <? foreach ($products as $product) { ?>
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <a href="/catalog/product/<?= $product['slug'] ?>"><img src="/images/shop/product12.jpg" alt=""/></a>
                                    <h2><?= General::actualPrice($product) ?> грн</h2>
                                    <h6>
                                        <?php if ($product['quantity']): ?>
                                            <span class="badge badge-secondary" style="background: #28a745">В наличии</span>
                                        <?php else: ?>
                                            <span class="badge badge-secondary">Нет на складе</span>
                                        <?php endif ?>
                                    </h6>
                                    <h6>Артикул: <?= $product['vendor_code'] ?></h6>
                                    <p><?= mb_strlen($product['name']) > 27 ? mb_substr($product['name'], 0, 27) . '...' : $product['name'] ?></p>
                                    <div>
                                        <div>
                                            <input type="number" value="1" min="1" data-item-quantity="<?= $product['id'] ?>" class="qtyinput" style="background: #fefefe;">
                                        </div>
                                        <a class="btn btn-default add-to-cart" data-quantity="s" data-to-cart="<?= $product['id'] ?>"><i class="fa fa-shopping-cart"></i><span>В корзину</span></a>
                                    </div>
                                </div>

                                <?php if ($product['brand'] === 3 || $product['brand'] === 16): ?>
                                    <img src="/images/home/import.png" class="new" alt=""/>
                                <?php endif ?>

                                <?php if (General::isWholesale() ? $product['wholesale_stock'] : $product['retail_stock']): ?>
                                    <img src="/images/home/sale.png" class="new" alt=""/>
                                <?php endif ?> <!-- import.png sale.png new.png -->
                            </div>
                        </div>
                    </div>
                <? } ?>

                <div class="text-center">
                    <? echo \yii\widgets\LinkPager::widget([
                        'pagination' => $pages,
                    ]); ?>
                </div>

            </div><!--features_items-->
        </div>
    </div>
</section>
