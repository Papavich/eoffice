<?php

namespace app\modules\portfolio\models;

use Yii;

/**
 * This is the model class for table "agency_award".
 *
 * @property int $areward_order_id
 * @property string $image
 * @property string $data_detail
 * @property string $locus_areward
 * @property string $countries_areward
 * @property string $cities_areward
 */
class AgencyAward extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'agency_award';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_pfo');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image', 'data_detail', 'locus_areward', 'countries_areward', 'cities_areward'], 'required'],
            [['locus_areward', 'countries_areward', 'cities_areward'], 'string', 'max' => 100],
            [['data_detail'], 'string', 'max' => 500],
            [['image'], 'required', 'on' => 'update-image'],
            [['image'], 'file', 'extensions' => 'png, jpg, gif']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'areward_order_id' => 'รหัสหน่วยงานที่ให้รางวัล',
            'image' => 'รูปภาพ',
            'data_detail' => 'รายละเอียดอื่นๆ',
            'locus_areward' => 'สถานที่ได้รับรางวัล',
            'countries_areward' => 'ประเทศที่รับรางวัล',
            'cities_areward' => 'เมืองที่ได้รับรางวัล',
        ];
    }
}
