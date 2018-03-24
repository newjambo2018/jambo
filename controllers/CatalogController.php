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

    public function actionIndex($limit = 12, $cat = false, $subcat = false, $gender = false, $price = false, $brand = false, $search = false)
    {
        $query = ShopProducts::find()
            ->select('name, id, vendor_code, retail_price, retail_stock, brand, category, sub_category, gender, quantity, slug');

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

        if ($brand) {
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

        $price_range = clone $query;
        $price_range = $price_range->select('MAX(retail_price) as max, MIN(retail_price) as min')
            ->asArray()
            ->all();

        if ($price) {
            $price = explode(',', $price);
            $query = $query->andWhere([
                'and',
                ['>', 'retail_price', $price[0]],
                ['<', 'retail_price', $price[1]]
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
            'price'       => $price
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
            ->select('slug, name, id, retail_price')
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