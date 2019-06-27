<?php

namespace app\modules\pfc\models;

use app\modules\pfc\components\ModelHelper;
use Yii;

/**
 * This is the model class for table "epro_advise".
 *
 * @property int $project_id
 * @property int $adviser_id
 * @property int $year_id
 * @property int $subject_id
 * @property int $semester_id
 * @property int $adviser_type_id
 * @property int $crby
 * @property int $udby
 * @property string $crtime
 * @property string $udtime
 *
 * @property Project $project

 */
class ViewAdvise extends \yii\db\ActiveRecord
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
        return 'epro_advise';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get( 'db_eproject' );
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'adviser_id', 'year_id', 'subject_id', 'semester_id', 'adviser_type_id', ], 'required'],
            [['project_id', 'adviser_id', 'year_id', 'semester_id', 'adviser_type_id', 'crby', 'udby'], 'integer'],
            [['subject_id'], 'string', 'max' => 10],
            [['crtime', 'udtime'], 'safe'],
            [['project_id', 'adviser_id', 'year_id', 'subject_id', 'semester_id'], 'unique', 'targetAttribute' => ['project_id', 'adviser_id', 'year_id', 'subject_id', 'semester_id']],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => ViewProject::className(), 'targetAttribute' => ['project_id' => 'id']],
            [['adviser_id'], 'exist', 'skipOnError' => true, 'targetClass' => ViewUser::className(), 'targetAttribute' => ['adviser_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'project_id' => 'Project ID',
            'adviser_id' => 'Adviser ID',
            'year_id' => 'Year ID',
            'subject_id' => 'Subject ID',
            'semester_id' => 'Semester ID',
            'adviser_type_id' => 'Adviser Type ID',
            'crby' => 'Crby',
            'udby' => 'Udby',
            'crtime' => 'Crtime',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne( ViewProject::className(), ['id' => 'project_id'] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdviser()
    {
        return $this->hasOne( ViewUser::className(), ['id' => 'adviser_id'] );
    }
}
