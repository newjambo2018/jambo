<?php
/**
 * Created by PhpStorm.
 * User: johankitelman
 * Date: 23.03.2018
 * Time: 10:56
 */

namespace app\commands;

use app\models\General;
use app\models\ShopBrands;
use app\models\ShopCategories;
use app\models\ShopProducts;
use app\models\ShopSubCategories;
use Yii;
use yii\console\Controller;
use yii\helpers\ArrayHelper;
use yii\helpers\Console;

class SyncController extends Controller
{

    public function actionIndex()
    {
        echo Console::renderColoredString("%r%_[" . date('d.m.Y H:i:s') . "]: Sync initialized!%n%n%g Starting parser of brands, cats and subcats...%n\n");

        $this->actionBrands();

        echo Console::renderColoredString("%r%_[" . date('d.m.Y H:i:s') . "]: Done!%n%n%g Now updating and inserting new products...%n\n");

        $this->actionFull();

        echo Console::renderColoredString('%r%_[' . date('d.m.Y H:i:s') . "]: Sync finished.%n\n");
    }

    public function actionBrands()
    {
        $catalog = simplexml_load_file(Yii::$app->basePath . '/common/Stock_Jambo.xml');
        $brands = [];
        $cats = [];

        foreach ($catalog as $item) {
            $item = (array)$item;
            if (!in_array($item['Бренд'], $brands) && $item['Бренд']) {
                $new_brand = new ShopBrands();

                $new_brand->name = trim($item['Бренд']);

                $new_brand->save();

                $brands[$new_brand->id] = $item['Бренд'];
            }

            if (!in_array($item['Категория'], $cats) && $item['Категория']) {
                $new_category = new ShopCategories();

                $new_category->name = trim($item['Категория']);

                $new_category->save();

                $cats[$new_category->id] = $item['Категория'];
            }
        }

        $cats = ArrayHelper::map(ShopCategories::find()
            ->all(), 'name', 'id');

        foreach ($catalog as $item) {
            $item = (array)$item;

            if ($item['Категория']) {
                $new_sub_category = new ShopSubCategories();

                $new_sub_category->name = $item['Группа'];
                $new_sub_category->category_id = $cats[$item['Категория']];

                $new_sub_category->save();
            }
        }
    }

    public function actionFull()
    {
        $catalog = simplexml_load_file(Yii::$app->basePath . '/common/Stock_Jambo.xml');

        $brands = ArrayHelper::map(ShopBrands::find()
            ->all(), 'name', 'id');
        $categories = ArrayHelper::map(ShopCategories::find()
            ->all(), 'name', 'id');
        $sub_categories = ArrayHelper::map(ShopSubCategories::find()
            ->all(), 'name', 'id');


        foreach ($catalog as $item) {
            $item = (array)$item;
            $product = ShopProducts::find()
                ->where(['product_id' => $item['НомерПП']])
                ->limit(1)
                ->one();

            if (!$product) $product = new ShopProducts();

            $product->product_id = $item['НомерПП'];
            $product->vendor_code = $item['Код'];
            $product->name = $item['Название'];
            $product->unit = $item['ЕдИзм'];
            $product->brand = $item['Бренд'] ? $brands[$item['Бренд']] : 0;
            $product->category = $item['Категория'] ? $categories[$item['Категория']] : 0;
            $product->sub_category = $item['Группа'] ? $sub_categories[$item['Группа']] : 0;
            $product->gender = $item['Пол'] ?: '';
            $product->age = $item['Возраст'] ?: '';
            $product->barcode = $item['ШтрихКод'] ?: '0';
            $product->manufacturer_code = $item['КодПроизводителя'] ?: '0';
            $product->quantity = $item['Количество'];
            $product->wholesale_price = $item['ОптоваяЦена'];
            $product->retail_price = $item['РозничнаяЦена'];
            $product->wholesale_stock = $item['ОптоваяАкция'] ?: 0;
            $product->retail_stock = $item['РозничнаяАкция'] ?: 0;
            $product->old_wholesale_price = $item['СтараяОптоваяЦена'];
            $product->old_retail_price = $item['СтараяРозничнаяЦена'];
            $product->slug = $item['НомерПП'] . '-' . str_replace('--', '-', preg_replace("/[^a-zA-Z0-9\-\s]/", "", General::translit($item['Название'], '-')));

            if ($product->isNewRecord) $product->created_at = time();

            $product->save();
        }
    }
}