<?php

namespace app\modules\eproject\models;

use app\modules\eproject\components\ModelHelper;
use Yii;

/**
 * This is the model class for table "epro_subject".
 *
 * @property int $id
 * @property int $crby
 * @property int $udby
 * @property string $crtime
w * @property string $udtimew
 *
 * @property SubjectDocumentType[] $eproSubjectDocumentTypes
 * @property DocumentType[] $documentTypes
 * @property OpenSubject[] $viewKku30OpenSubjects
 * @property YearSemester[] $years
 */
class Subject extends \yii\db\ActiveRecord
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
        return 'epro_subject';
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
            [['id' ] ,'required'],
            [['id' ] ,'unique'],
            [['crby', 'udby'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
            [['id'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'crby' => 'Crby',
            'udby' => 'Udby',
            'crtime' => 'Crtime',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubjectDocumentTypes()
    {
        return $this->hasMany(SubjectDocumentType::className(), ['subject_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentTypes()
    {
        return $this->hasMany(DocumentType::className(), ['id' => 'document_type_id'])->viaTable('epro_subject_document_type', ['subject_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOpenSubjects()
    {
        return $this->hasMany(OpenSubject::className(), ['subject_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYears()
    {
        return $this->hasMany(YearSemester::className(), ['year_id' => 'year_id', 'semester_id' => 'semester_id'])->viaTable('view_kku30_open_subject', ['subject_id' => 'id']);
    }

    public function getName(){
        $subject=SubjectView::findOne($this->id);
        if($subject){
            if (Yii::$app->language == "en") {

                return $subject->id.': '.$subject->name_en;

            } else {
                return $subject->id.': '.$subject->name_th;
            }
        }else{
            return "N/A";
        }


    }
    public static function getNowOpenSubjects(){
//        $subjects = Subject::find()->all();
//        foreach ($subjects as $key=> $item){
//            $sid[$key]=$item->id;
//        }
//        $openSubjects=OpenSubject::find()->where( ['subject_id' => $sid] )
//            ->andWhere( ['year_id' => ModelHelper::getNowYear()] )
//            ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )
//            ->all();
//        foreach ($openSubjects as $key=> $item){
//            $osid[$key]=$item->subject_id;
//        }
//        return SubjectView::find()->where(['id'=>$osid])->all();

        $openSubject=SubjectView::find()->innerJoin(OpenSubject::tableName(),SubjectView::tableName().'.id = '.OpenSubject::tableName().'.subject_id')
            ->innerJoin(Subject::tableName(),Subject::tableName().'.id = '.OpenSubject::tableName().'.subject_id')
            ->where( ['year_id' => ModelHelper::getNowYear()] )
            ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )
            ->orderBy('subject_id')
            ->all();
        return $openSubject;
    }
}
