<?php

namespace app\modules\eproject\models;

use app\modules\eproject\components\ModelHelper;
use Yii;

/**
 * This is the model class for table "epro_request_advisee".
 *
 * @property int $year_id
 * @property int $semester_id
 * @property int $adviser_id
 * @property int $need
 * @property int $added
 * @property int $crby
 * @property int $udby
 * @property string $crtime
 * @property string $udtime
 *
 * @property YearSemester $year
 */
class RequestAdvisee extends \yii\db\ActiveRecord
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
        return 'epro_request_advisee';
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
            [['year_id', 'semester_id', 'adviser_id', 'need', 'added'], 'required'],
            [['year_id', 'semester_id', 'adviser_id', 'need', 'added', 'crby', 'udby'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
            [['year_id', 'semester_id', 'adviser_id'], 'unique', 'targetAttribute' => ['year_id', 'semester_id', 'adviser_id']],
            [['year_id', 'semester_id'], 'exist', 'skipOnError' => true, 'targetClass' => YearSemester::className(), 'targetAttribute' => ['year_id' => 'year_id', 'semester_id' => 'semester_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'year_id' => 'Year ID',
            'semester_id' => 'Semester ID',
            'adviser_id' => 'Adviser ID',
            'need' => 'Need',
            'added' => 'Added',
            'crby' => 'Crby',
            'udby' => 'Udby',
            'crtime' => 'Crtime',
            'udtime' => 'Udtime',
        ];
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
        return $this->hasOne(YearSemester::className(), ['year_id' => 'year_id', 'semester_id' => 'semester_id']);
    }
    public static function generateRequestAdvisee($number,$major)
    {
        $users = User::find()->where( ['user_type_id' => User::TYPE_TEACHER] )->andWhere(['major_id'=>$major])->all();
        foreach ($users as $user) {
            if ($user->currentRequestAdvisee == false) {
                $requestAdvisee = new RequestAdvisee() ;
                $requestAdvisee->year_id = ModelHelper::getNowYear();
                $requestAdvisee->semester_id = ModelHelper::getNowSemester();
                $requestAdvisee->adviser_id = $user->id;
                $requestAdvisee->need = $number;
                $count = Advise::find()
                    ->where( ['adviser_id' => $requestAdvisee->adviser_id] )
                    ->andWhere( ['year_id' => ModelHelper::getNowYear()] )
                    ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )
                    ->andWhere( ['adviser_type_id' => AdviserType::TYPE_PRIMARY_ADVISER,
                    ] )->count();
                $requestAdvisee->added = $count;
                $requestAdvisee->save();
            }else{
                $requestAdvisee=RequestAdvisee::find()->where( ['adviser_id' => $user->id] )
                    ->andWhere( ['year_id' => ModelHelper::getNowYear()] )
                    ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )
                    ->one();
                $count = Advise::find()
                    ->where( ['adviser_id' => $requestAdvisee->adviser_id] )
                    ->andWhere( ['year_id' => ModelHelper::getNowYear()] )
                    ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )
                    ->andWhere( ['adviser_type_id' => AdviserType::TYPE_PRIMARY_ADVISER,
                    ] )->count();
                $requestAdvisee->added = $count;
                $requestAdvisee->save();
            }
        }
        return true;
    }
    public static function updateRequestAdvisee()
    {
        $users = User::find()->where( ['user_type_id' => User::TYPE_TEACHER] )->all();
        foreach ($users as $user) {
            if ($user->currentRequestAdvisee ){
                $requestAdvisee=RequestAdvisee::find()->where( ['adviser_id' => $user->id] )
                    ->andWhere( ['year_id' => ModelHelper::getNowYear()] )
                    ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )
                    ->one();
                $count = Advise::find()
                    ->where( ['adviser_id' => $requestAdvisee->adviser_id] )
                    ->andWhere( ['year_id' => ModelHelper::getNowYear()] )
                    ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )
                    ->andWhere( ['subject_id' => ModelHelper::getSubjectId()] )
                    ->andWhere( ['adviser_type_id' => AdviserType::TYPE_PRIMARY_ADVISER,
                    ] )->count();
                $requestAdvisee->added = $count;
                $requestAdvisee->save();
            }
        }
        return true;
    }
}
