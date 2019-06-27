<?php

namespace app\modules\eproject\models;

use app\modules\eproject\components\ModelHelper;
use Yii;

/**
 * This is the model class for table "epro_semester".
 *
 * @property int $id
 * @property int $crby
 * @property int $udby
 * @property string $crtime
 * @property string $udtime
 *
 * @property YearSemester[] $eproYearSemesters
 * @property Year[] $years
 */
class Semester extends \yii\db\ActiveRecord
{

    /**
     * @return array
     */
    public function behaviors()
    {
        return ModelHelper::behaviors();
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'epro_semester';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_eproject');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[], 'required'],
            [['crby', 'udby'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'crby' => 'Crby',
            'udby' => 'Udby',
            'crtime' => 'Crtime',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYearSemesters()
    {
        return $this->hasMany(YearSemester::className(), ['semester_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYears()
    {
        return $this->hasMany(Year::className(), ['id' => 'year_id'])->viaTable('epro_year_semester', ['semester_id' => 'id']);
    }
}
