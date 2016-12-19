<?php
namespace frontend\models;

use yii\base\Model;

/**
 * Products form
 */
class ProductsForm extends Model
{
    public $link;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['link', 'trim'],
            ['link', 'required'],
        ];
    }

    public function addLink($link)
    {
        
    }
}
