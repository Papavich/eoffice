<?php

namespace app\modules\scholar_b\models;

use Yii;
use app\modules\scholar_b\components\ModelHelper;

/**
 * This is the model class for table "scb_news".
 *
 * @property int $news_id
 * @property string $staff_id_card
 * @property string $news_name
 * @property string $news_detail
 * @property string $news_date
 * @property string $news_image
 * @property int $crby
 * @property string $crtime
 * @property int $udby
 * @property string $udtime
 *
 * @property ScbStaff $staffIdCard
 */
class ScbNews extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return ModelHelper::behaviors();
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scb_news';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_scb');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['staff_id_card','news_name'], 'required'],
            [['news_detail'], 'string'],
            [['news_date', 'crtime', 'udtime'], 'safe'],
            [['crby', 'udby'], 'integer'],
            [['staff_id_card'], 'string', 'max' => 13],
            [['news_name'], 'string', 'max' => 50],
            [['news_image'], 'string', 'max' => 100],
            [['staff_id_card'], 'exist', 'skipOnError' => true, 'targetClass' => ScbStaff::className(), 'targetAttribute' => ['staff_id_card' => 'staff_id_card']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'news_id' => 'News ID',
            'staff_id_card' => 'Staff Id Card',
            'news_name' => 'หัวข้อข่าว',
            'news_detail' => 'รายละเอียด',
            'news_date' => 'News Date',
            'news_image' => 'อัพโหลดไฟล์',
            'crby' => 'สร้างโดย',
            'crtime' => 'สร้างเมื่อ',
            'udby' => 'แก้ไขโดย',
            'udtime' => 'แก้ไขเมื่อ',
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaffIdCard()
    {
        return $this->hasOne(ScbStaff::className(), ['staff_id_card' => 'staff_id_card']);
    }
}
