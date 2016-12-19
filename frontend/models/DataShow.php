<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "data".
 *
 * @property integer $id
 * @property string $link
 * @property integer $buy
 * @property integer $sell
 * @property double $diff
 * @property integer $sold
 * @property double $avg
 * @property string $click
 */
class DataShow extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['link', 'buy', 'sell', 'diff', 'sold', 'avg', 'click'], 'required'],
            [['buy', 'sell', 'sold'], 'integer'],
            [['diff', 'avg'], 'number'],
            [['link'], 'string', 'max' => 250],
            [['click'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'link' => 'Link',
            'buy' => 'Buy',
            'sell' => 'Sell',
            'diff' => 'Diff',
            'sold' => 'Sold',
            'avg' => 'Avg',
            'click' => 'Click',
        ];
    }

    public function show()
    {
        $query = Data::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $dataProvider;
    }
}
