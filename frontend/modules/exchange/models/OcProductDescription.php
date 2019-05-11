<?php

namespace frontend\modules\exchange\models;

use Yii;

/**
 * This is the model class for table "oc_product_description".
 *
 * @property int $product_id
 * @property int $language_id
 * @property string $name
 * @property string $fimage
 * @property string $video1
 * @property string $html_product_shortdesc
 * @property string $html_product_right
 * @property string $html_product_tab
 * @property string $tab_title
 * @property string $description
 * @property string $tag
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keyword
 */
class OcProductDescription extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'oc_product_description';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'language_id', 'name', 'fimage', 'video1', 'html_product_shortdesc', 'html_product_right', 'html_product_tab', 'tab_title', 'description', 'tag', 'meta_title', 'meta_description', 'meta_keyword'], 'required'],
            [['product_id', 'language_id'], 'integer'],
            [['fimage', 'video1', 'html_product_shortdesc', 'html_product_right', 'html_product_tab', 'tab_title', 'description', 'tag'], 'string'],
            [['name', 'meta_title', 'meta_description', 'meta_keyword'], 'string', 'max' => 255],
            [['product_id', 'language_id'], 'unique', 'targetAttribute' => ['product_id', 'language_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'language_id' => 'Language ID',
            'name' => 'Name',
            'fimage' => 'Fimage',
            'video1' => 'Video1',
            'html_product_shortdesc' => 'Html Product Shortdesc',
            'html_product_right' => 'Html Product Right',
            'html_product_tab' => 'Html Product Tab',
            'tab_title' => 'Tab Title',
            'description' => 'Description',
            'tag' => 'Tag',
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'meta_keyword' => 'Meta Keyword',
        ];
    }
}
