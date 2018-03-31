<?php

namespace app\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ShopProducts;

/**
 * ProductsSearch represents the model behind the search form of `app\models\ShopProducts`.
 */
class ProductsSearch extends ShopProducts
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'product_id', 'category', 'sub_category', 'brand', 'vendor_code', 'quantity', 'created_at'], 'integer'],
            [['name', 'gender', 'age', 'barcode', 'manufacturer_code', 'slug', 'unit', 'retail_stock', 'wholesale_stock', 'description'], 'safe'],
            [['retail_price', 'wholesale_price', 'old_retail_price', 'old_wholesale_price'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ShopProducts::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'product_id' => $this->product_id,
            'category' => $this->category,
            'sub_category' => $this->sub_category,
            'brand' => $this->brand,
            'retail_price' => $this->retail_price,
            'wholesale_price' => $this->wholesale_price,
            'vendor_code' => $this->vendor_code,
            'quantity' => $this->quantity,
            'old_retail_price' => $this->old_retail_price,
            'old_wholesale_price' => $this->old_wholesale_price,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'age', $this->age])
            ->andFilterWhere(['like', 'barcode', $this->barcode])
            ->andFilterWhere(['like', 'manufacturer_code', $this->manufacturer_code])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'unit', $this->unit])
            ->andFilterWhere(['like', 'retail_stock', $this->retail_stock])
            ->andFilterWhere(['like', 'wholesale_stock', $this->wholesale_stock])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
