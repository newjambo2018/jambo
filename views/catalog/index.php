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
                                    <h4 class="panel-title"><a href="?brand=3">Собсвтенный импорт</a></h4>
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
                                                <span for="checkbox7" style="font-weight: 300">Мальчик&nbsp;<i class="fas fa-male"></i></span>
                                            </a>
                                        </div>
                                        <div class="checkbox checkbox-circle" style="margin-top: 10px">
                                            <a href="?<?= $_GET ? http_build_query($_GET) . '&' : '' ?>gender=f" class="gender-filter">
                                                <input id="checkbox8" type="checkbox" <?= $_GET['gender'] == 'f' ? 'checked' : '' ?> >
                                                <span for="checkbox8" style="font-weight: 300">Девочка&nbsp;<i class="fas fa-female"></i></span>
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
                                    <li><a href="?brand=1"> <span class="pull-right">(50)</span>BabyMix</a></li>
                                    <li><a href="?brand=23"> <span class="pull-right">(56)</span>Colorino</a></li>
                                    <li><a href="?brand=30"> <span class="pull-right">(27)</span>Arial</a></li>
                                    <li><a href="?brand=5"> <span class="pull-right">(32)</span>DankoToys</a></li>
                                    <li><a href="#!"> <span class="pull-right">(5)</span>Defa</a></li>
                                    <li><a href="?brand=31"> <span class="pull-right">(9)</span>Kinsmart</a></li>
                                    <li><a href="#!"> <span class="pull-right">(4)</span>Brick</a></li>
                                    <li><a href="?brand=41"> <span class="pull-right">(4)</span>Intex</a></li>
                                    <li><a href="?brand=2"> <span class="pull-right">(4)</span>Doloni</a></li>
                                    <li><a href="#!"> <span class="pull-right">(4)</span>Автопром</a></li>
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
                                    <h2><?= $product['retail_price'] ?> грн</h2>
                                    <h6>
                                        <?php if ($product['quantity']): ?>
                                            <span class="badge badge-secondary" style="background: #28a745">В наличии</span>
                                        <?php else: ?>
                                            <span class="badge badge-secondary">Нет на складе</span>
                                        <?php endif ?>
                                    </h6>
                                    <h6>Артикул: <?= $product['vendor_code'] ?></h6>
                                    <p><?= mb_strlen($product['name']) > 27 ? mb_substr($product['name'], 0, 27) . '...' : $product['name'] ?></p>
                                    <a class="btn btn-default add-to-cart" data-to-cart="<?= $product['id'] ?>"><i class="fa fa-shopping-cart"></i><span>В корзину</span></a>
                                </div>

                                <?php if ($product['brand'] === 3): ?>
                                    <img src="/images/home/import.png" class="new" alt=""/>
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
