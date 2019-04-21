<?php

namespace frontend\modules\scraps\models;

use Yii;

/**
 * This is the model class for table "scraps".
 *
 * @property int $scrap_id
 * @property string $scarp_name
 * @property string $scrap_image
 * @property string $scrap_status
 * @property string $createdDate
 * @property string $updatedDate
 */
class Scraps extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
	public $scrap_price;
    public static function tableName()
    {
        return 'scraps';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['scarp_name', 'scrap_image', 'scrap_status', 'createdDate','scrap_price'], 'safe'],
        	[['scarp_name',  'scrap_status', ], 'safe'],
            [['scrap_image', 'scrap_status'], 'string'],
            [['createdDate', 'updatedDate'], 'safe'],
            [['scarp_name'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'scrap_id' => 'Scrap ID',
            'scarp_name' => 'Scarp Name',
            'scrap_image' => 'Scrap Image',
            'scrap_status' => 'Scrap Status',
            'createdDate' => 'Created Date',
            'updatedDate' => 'Updated Date',
        ];
    }
    public static function findByScrap($scrapid){
    	$Scraps = Scraps::find()->where(['scrap_id'=>$scrapid])->one();
    	return $Scraps;
    }
    
}
