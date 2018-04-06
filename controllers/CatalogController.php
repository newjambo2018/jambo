<?php

namespace app\controllers;

use app\common\CommonController;
use app\models\Carts;
use app\models\General;
use app\models\ShopBrands;
use app\models\ShopCategories;
use app\models\ShopProducts;
use app\models\ShopSubCategories;
use yii\data\Pagination;
use yii\web\Controller;

class CatalogController extends CommonController
{

    public function actionIndex($stock = 0, $limit = 12, $cat = false, $subcat = false, $gender = false, $price = false, $brand = false, $search = false)
    {
        if (in_array($_SERVER['REQUEST_URI'], ['/', '/site/index'])) {
            $index = 1;
        }

        $query = ShopProducts::find()
            ->select('name, id, vendor_code, retail_price, retail_stock, wholesale_stock, wholesale_price, brand, category, sub_category, gender, quantity, slug');

        if ($cat) $query = $query->andWhere(['category' => $cat]);
        if ($subcat) {
            $subcats_name = ShopSubCategories::find()
                                ->select('name')
                                ->where(['id' => $subcat])
                                ->limit(1)
                                ->asArray()
                                ->one()['name'];
            $subcats_array = ShopSubCategories::find()
                ->select('id')
                ->where(['name' => $subcats_name])
                ->asArray()
                ->all();
            $subcats = [];

            foreach ($subcats_array as $subcat) $subcats[] = $subcat['id'];

            $query = $query->andWhere('sub_category IN (' . implode(',', $subcats) . ')');
        }

        if ($gender) {
            $query = $query->andWhere(['gender' => ($gender === 'm' ? 'Мальчик' : 'Девочка')]);
        }

        if ($brand === 'own') {
            $query = $query->andWhere(['or', ['brand' => 3], ['brand' => 16]]);
        } else if ($brand) {
            $query = $query->andWhere(['brand' => $brand]);
        }

        if ($search) {
            $query = $query->andWhere([
                'or',
                ['LIKE', 'barcode', $search],
                ['LIKE', 'vendor_code', $search],
                ['LIKE', 'name', $search],
                ['LIKE', 'manufacturer_code', $search],
            ]);
        }

        if ($stock) {
            $query = $query->andWhere([
                'or',
                ['retail_stock' => 1],
                ['wholesale_stock' => 1]
            ]);
        }

        $price_range = clone $query;
        $price_type = General::isWholesale() ? 'wholesale_price' : 'retail_price';
        $price_range = $price_range->select("MAX($price_type) as max, MIN($price_type) as min")
            ->asArray()
            ->all();

        if ($price) {
            $price = explode(',', $price);
            $query = $query->andWhere([
                'and',
                ['>', $price_type, $price[0]],
                ['<', $price_type, $price[1]]
            ]);
        }

        $countQuery = clone $query;

        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => $limit]);
        $pages->pageSizeParam = false;

        $products = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        $cats = ShopCategories::find()
            ->with('subcats')
            ->andWhere(['<>', 'id', 8])
            ->orderBy('id ASC')
            ->asArray()
            ->all();

        $brands = ShopBrands::find()
            ->all();

        return $this->render('index', [
            'products'    => $products,
            'pages'       => $pages,
            'cats'        => $cats,
            'brands'      => $brands,
            'price_range' => $price_range[0],
            'price'       => $price,
            'index'       => $index
        ]);
    }

    public function actionProduct($slug)
    {
        $product = ShopProducts::find()
            ->where(['slug' => $slug])
            ->limit(1)
            ->one();

        $prev = ShopProducts::find()
                    ->select('slug')
                    ->where(['<', 'id', $product->id])
                    ->orderBy('id DESC')
                    ->limit(1)
                    ->one()['slug'];

        $next = ShopProducts::find()
                    ->select('slug')
                    ->where(['>', 'id', $product->id])
                    ->orderBy('id ASC')
                    ->limit(1)
                    ->one()['slug'];

        $cat = ShopCategories::find()
            ->where(['id' => $product->category])
            ->limit(1)
            ->one();

        $subcat = ShopSubCategories::find()
            ->where(['id' => $product->sub_category])
            ->limit(1)
            ->one();

        $brand = ShopBrands::find()
            ->where(['id' => $product->brand])
            ->limit(1)
            ->one();

        $same = ShopProducts::find()
            ->select('slug, name, id, retail_price, wholesale_price, vendor_code')
            ->where(['sub_category' => $product->sub_category])
            ->orderBy('RAND()')
            ->limit(6)
            ->all();

        return $this->render('product', [
            'product' => $product,
            'cat'     => $cat,
            'subcat'  => $subcat,
            'brand'   => $brand,
            'next'    => $next,
            'prev'    => $prev,
            'same'    => $same
        ]);
    }

    public function actionToCart($product_id, $quantity = false)
    {
        if (!\Yii::$app->request->isAjax) throw new \HttpException(400);

        $product = ShopProducts::find()
            ->where(['id' => $product_id])
            ->limit(1)
            ->one();

        if (!$product) throw new \HttpException(404);

        $cart = new Carts();

        $cart->append($product_id, $quantity ?: 1);

        return Carts::cartCount();
    }

    public function actionAjaxCart()
    {
        //        $this->layout = false;
        //        return $this->renderAjax('/checkout/cart');
    }

}