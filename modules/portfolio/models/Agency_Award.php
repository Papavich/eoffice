<?php

namespace app\modules\portfolio\models;

use Yii;

/**
 * This is the model class for table "agency award".
 *
 * @property integer $areward_order_id
 * @property string $image
 * @property string $data_detail
 * @property string $locus_areward
 * @property string $countries_areward
 * @property string $cities_areward
 */
class Agency_Award extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'agency award';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image', 'data_detail', 'locus_areward', 'countries_areward', 'cities_areward'], 'required'],
            [['image', 'locus_areward', 'countries_areward', 'cities_areward'], 'string', 'max' => 100],
            [['data_detail'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'areward_order_id' => 'Areward Order ID',
            'image' => 'Image',
            'data_detail' => 'Data Detail',
            'locus_areward' => 'Locus Areward',
            'countries_areward' => 'Countries Areward',
            'cities_areward' => 'Cities Areward',
        ];
    }
}
