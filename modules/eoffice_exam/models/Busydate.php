<?php

namespace app\modules\eoffice_exam\models;

use Yii;
use \yii\web\UploadedFile;


/**
 * This is the model class for table "eoffice_exam_busydate".
 *
 * @property string $exam_busydate_date
 * @property string $exam_busydate_time
 * @property string $exam_busydate_note
 * @property int $person_id
 * @property string $exam_busy_file
 */
class Busydate extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'eoffice_exam_busydate';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_exam');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['exam_busydate_date', 'exam_busydate_time', 'exam_busydate_note', 'person_id'], 'required'],
            [['exam_busydate_date'], 'safe'],
            [['person_id'], 'integer'],
            [['exam_busy_file'], 'file',
              'skipOnEmpty' => true,
              'maxFiles' => 10,
              'extensions' => 'docx,pdf,jpg,png'
            ],
            [['exam_busydate_time'], 'string', 'max' => 50],
            [['exam_busydate_note'], 'string', 'max' => 100],
            [['exam_busydate_date', 'exam_busydate_time', 'person_id'], 'unique', 'targetAttribute' => ['exam_busydate_date', 'exam_busydate_time', 'person_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'exam_busydate_date' => 'วัน/เดือน/ปี',
            'exam_busydate_time' => 'เวลา',
            'exam_busydate_note' => 'เนื่องจาก',
            'person_id' => 'รหัสกรรมการคุมสอบ',
            'exam_busy_file' => 'เอกสาร',
        ];
    }

    public $upload_foler ='file_busydate';

    public function upload($model,$attribute)
      {
          $exam_busy_file  = UploadedFile::getInstance($model, $attribute);
          $path = $this->getUploadPath();
          if ($this->validate() && $exam_busy_file !== null) {

            $fileName = md5($exam_busy_file->baseName.time()) . '.' . $exam_busy_file->extension;
            //$fileName = $photo->baseName . '.' . $photo->extension;
          if($exam_busy_file->saveAs($path.$fileName)){
              return $fileName;
            }
          }
          return $model->isNewRecord ? false : $model->getOldAttribute($attribute);
      }

      public function getUploadPath(){
          return Yii::getAlias('@webroot').'/web_exam'.'/'.$this->upload_foler.'/';
      }

      public function getUploadUrl(){
          return Yii::getAlias('@web').'/web_exam'.'/'.$this->upload_foler.'/';
      }

      public function getPhotoViewer(){
        return empty($this->exam_busy_file) ? Yii::getAlias('@web').'/img/none.png' : $this->getUploadUrl().$this->exam_busy_file;
      }

      //ชื่อจริง
      public function getViewperson()
      {
        return $this->hasOne(ViewPisPerson::className(), ['person_id' => 'person_id']);
      }

}
