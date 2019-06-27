<?php

namespace app\modules\scholar_b\models;

use Yii;
use app\modules\scholar_b\components\ModelHelper;
/**
 * This is the model class for table "scb_staff".
 *
 * @property string $staff_id_card
 * @property integer $crby
 * @property string $crtime
 * @property integer $udby
 * @property string $udtime
 *
 * @property ScbCalendar[] $scbCalendars
 * @property ScbNews[] $scbNews
 */
class ScbStaff extends \yii\db\ActiveRecord
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
        return 'scb_staff';
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
            [['staff_id_card'], 'required'],
            [['crby', 'udby'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
            [['staff_id_card'], 'string', 'max' => 13],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'staff_id_card' => 'Staff Id Card',
            'crby' => 'Crby',
            'crtime' => 'Crtime',
            'udby' => 'Udby',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbCalendars()
    {
        return $this->hasMany(ScbCalendar::className(), ['staff_id_card' => 'staff_id_card']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbNews()
    {
        return $this->hasMany(ScbNews::className(), ['staff_id_card' => 'staff_id_card']);
    }
}
