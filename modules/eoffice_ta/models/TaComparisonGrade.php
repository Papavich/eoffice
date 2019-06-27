<?php

namespace app\modules\eoffice_ta\models;

use Yii;
use \yii\web\UploadedFile;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\modules\eoffice_ta\controllers;
/**
 * This is the model class for table "ta_comparison_grade".
 *
 * @property int $ta_comparison_grade_id
 * @property string $person_id
 * @property string $subject_id
 * @property int $subject_version
 * @property string $term
 * @property string $year
 * @property string $ta_status_id
 * @property string $grade_name
 * @property string $grade_value
 * @property string $doc_ref
 * @property int $crby
 * @property string $crtime
 * @property int $udby
 * @property string $udtime
 * @property string $subject_id_compar
 * @property string $subject_name_compar
 * @property string $compar_detail
 *
 * @property TaStatus $taStatus
 * @property TaRegister $subject
 */
class TaComparisonGrade extends \yii\db\ActiveRecord
{
   // public $upload_folder ='comparisons';
    public $upload_folder ='comparisons';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ta_comparison_grade';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_ta');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           // [['person_id', 'subject_id', 'subject_version', 'term', 'year'], 'required'],
            [['subject_version', 'crby', 'udby'], 'integer'],
            [['grade_value'], 'number'],
            [['crtime', 'udtime'], 'safe'],
            [['compar_detail'], 'string'],
            [['person_id', 'ta_status_id'], 'string', 'max' => 15],
            [['subject_id', 'term', 'year', 'grade_name', 'subject_id_compar'], 'string', 'max' => 10],
            [['doc_ref'], 'string', 'max' => 200],
            [['subject_name_compar'], 'string', 'max' => 100],
            [['ta_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaStatus::className(), 'targetAttribute' => ['ta_status_id' => 'ta_status_id']],
            [['subject_id', 'term', 'year', 'person_id', 'subject_version'], 'exist', 'skipOnError' => true, 'targetClass' => TaRegister::className(), 'targetAttribute' => ['subject_id' => 'subject_id', 'term' => 'term', 'year' => 'year', 'person_id' => 'person_id', 'subject_version' => 'subject_version']],

            /*[['doc_ref'], 'file',
                'skipOnEmpty' => true,
                'extensions' => 'docx,doc,pdf,ppt,txt,zip,xls,xlw,png,jpg'
            ],*/
            ['doc_ref', 'file', 'maxSize' => 1024 * 1024 * 70, 'extensions' => ['docx',
                'doc', 'xls','xlsx','png','jpg',
                'pdf','ppt','pptx','zip'],'checkExtensionByMimeType'=>false],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ta_comparison_grade_id' => 'Ta Comparison Grade ID',
            'person_id' => 'Person ID',
            'subject_id' => 'Subject ID',
            'subject_version' => 'Subject Version',
            'term' => 'Term',
            'year' => 'Year',
            'ta_status_id' => 'Ta Status ID',
            'grade_name' => 'เกรดของรายวิชาเทียบ',
            'grade_value' => 'GPA',
            'doc_ref' => 'หลักฐาน/เอกสารประกอบ/ใบประกาศ',
            'crby' => 'Crby',
            'crtime' => 'Crtime',
            'udby' => 'Udby',
            'udtime' => 'Udtime',
            'subject_id_compar' => 'รหัสรายวิชาขอเทียบ',//Subject Id Compar
            'subject_name_compar' => 'ชื่อรายวิชาขอเทียบ',//Subject Name Compar
            'compar_detail' => 'รายละเอียด',//Compar Detail
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaStatus()
    {
        return $this->hasOne(TaStatus::className(), ['ta_status_id' => 'ta_status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(TaRegister::className(), ['subject_id' => 'subject_id', 'term' => 'term', 'year' => 'year', 'person_id' => 'person_id', 'subject_version' => 'subject_version']);
    }

//------------------------------------ Upload ----------------------------------------------
    public function upload($model,$attribute)
    {
        $photo  = UploadedFile::getInstance($model, $attribute);
        $path = $this->getUploadPath();
        if ($this->validate() && $photo !== null) {

           $fileName = md5($photo->baseName.time()) . '.' . $photo->extension;
           // $fileName = $photo->baseName . '.' . $photo->extension;
            if($photo->saveAs($path.$fileName)){
                return $fileName;
            }
        }
        return $model->isNewRecord ? false : $model->getOldAttribute($attribute);
    }

    public function getUploadPath(){
        return Yii::getAlias('@webroot').'/web_ta/'.$this->upload_folder.'/';
    }

    public function getUploadUrl(){
        return Yii::getAlias('@web').'/web_ta/'.$this->upload_folder.'/';
    }

    public function getPhotoViewer(){
        return empty($this->doc_ref) ? Yii::getAlias('@web').'/web_ta/images/img/none.png' : $this->getUploadUrl().$this->doc_ref;
    }
}
