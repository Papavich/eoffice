<?php

namespace app\modules\eproject\models;

use app\modules\eproject\components\ModelHelper;
use Yii;

/**
 * This is the model class for table "epro_adviser_request".
 *
 * @property integer $id
 * @property integer $crby
 * @property integer $udby
 * @property string $crtime
 * @property string $udtime
 * @property string $year
 * @property string $semester
 * @property integer $need
 * @property integer $added
 * @property integer $adviser_id
 *
 * @property User $adviser
 */
class AdviserRequest extends \yii\db\ActiveRecord
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
        return 'epro_adviser_request';
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
            [[ 'year', 'semester', 'need', 'adviser_id'], 'required'],
            [['crby', 'udby', 'need', 'added', 'adviser_id'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
            [['year'], 'string', 'max' => 4],
            [['semester'], 'string', 'max' => 1],
            [['adviser_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['adviser_id' => 'id']],
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
            'year' => 'Year',
            'semester' => 'Semester',
            'need' => 'Need',
            'added' => 'Added',
            'adviser_id' => 'Adviser ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdviser()
    {
        return $this->hasOne(User::className(), ['id' => 'adviser_id']);
    }
}
