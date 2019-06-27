<?php

namespace app\modules\eproject\models;

use app\modules\eproject\components\ModelHelper;
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
 * @property AdviserType $adviserType
 * @property Project $project
 * @property User $adviser
 * @property OpenSubject $year
 */
class Advise extends \yii\db\ActiveRecord
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
            [['adviser_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => AdviserType::className(), 'targetAttribute' => ['adviser_type_id' => 'id']],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'id']],
            [['adviser_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['adviser_id' => 'id']],
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
    public function getAdviserType()
    {
        return $this->hasOne( AdviserType::className(), ['id' => 'adviser_type_id'] );
    }

    public function afterDelete()
    {
        self::updateAdviserRequest();
        parent::afterDelete();
    }

    /**
     * @param null $condition
     * @param array $params
     * @return int
     */
    public static function deleteAll($condition = null, $params = [])
{
    RequestAdvisee::updateRequestAdvisee();
    return parent::deleteAll( $condition, $params );
}

    public function afterSave($insert, $changedAttributes)
    {

        self::updateAdviserRequest();
        parent::afterSave( $insert, $changedAttributes );
    }

    public function updateAdviserRequest()
    {
        if ($this->adviser_type_id==AdviserType::TYPE_PRIMARY_ADVISER) {
            $count = Advise::find()
                ->where( ['adviser_id' => $this->adviser_id] )
                ->andWhere( ['year_id' => $this->year_id] )
                ->andWhere( ['semester_id' => $this->semester_id] )
                ->andWhere( ['subject_id' => $this->subject_id] )
                ->andWhere( ['adviser_type_id' => AdviserType::TYPE_PRIMARY_ADVISER,
                ] )->count();
            if ($model = RequestAdvisee::find()
                ->where( ['adviser_id' => $this->adviser_id] )
                ->andWhere( ['year_id' => ModelHelper::getNowYear()] )
                ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )
                ->one()) {
                $model->added = $count;
                $model->save();
            }
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne( Project::className(), ['id' => 'project_id'] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdviser()
    {
        return $this->hasOne( User::className(), ['id' => 'adviser_id'] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYear()
    {
        return $this->hasOne( OpenSubject::className(), ['year_id' => 'year_id', 'subject_id' => 'subject_id', 'semester_id' => 'semester_id'] );
    }

}
