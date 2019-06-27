<?php

namespace app\modules\eoffice_ta\models;

use Yii;
use \yii\web\UploadedFile;
/**
 * This is the model class for table "ta_register_section".
 *
 * @property string $section
 * @property string $ta_type_work_id
 * @property string $subject_id
 * @property int $subject_version
 * @property string $person_id
 * @property string $term
 * @property string $year
 * @property string $ta_status
 * @property string $ta_payment_sec
 * @property string $ta_pay_max_sec
 * @property int $crby
 * @property string $crtime
 * @property int $udby
 * @property string $udtime
 *
 * @property TaAssess[] $taAssesses
 * @property TaComment[] $taComments
 * @property TaRegister $subject
 * @property TaStatus $taStatus
 * @property TaRegister $taImage
 */
class TaRegisterSection extends \yii\db\ActiveRecord
{

    public $upload_folder ='register';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ta_register_section';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_ta');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['section', 'ta_type_work_id', 'subject_id', 'subject_version', 'person_id', 'term', 'year', 'ta_status'], 'required'],
            [['subject_version', 'crby', 'udby'], 'integer'],
            [['ta_payment_sec', 'ta_pay_max_sec'], 'number'],
            [['crtime', 'udtime'], 'safe'],
            [['section', 'ta_type_work_id', 'subject_id', 'term', 'year'], 'string', 'max' => 10],
            [['person_id', 'ta_status'], 'string', 'max' => 15],
            [['section', 'ta_type_work_id', 'subject_id', 'subject_version', 'person_id', 'term', 'year'], 'unique', 'targetAttribute' => ['section', 'ta_type_work_id', 'subject_id', 'subject_version', 'person_id', 'term', 'year']],
            [['subject_id', 'term', 'year', 'person_id', 'subject_version'], 'exist', 'skipOnError' => true, 'targetClass' => TaRegister::className(), 'targetAttribute' => ['subject_id' => 'subject_id', 'term' => 'term', 'year' => 'year', 'person_id' => 'person_id', 'subject_version' => 'subject_version']],
            [['ta_status'], 'exist', 'skipOnError' => true, 'targetClass' => TaStatus::className(), 'targetAttribute' => ['ta_status' => 'ta_status_id']],

          /*  [['ta_image'], 'file',
                'skipOnEmpty' => true,
                'extensions' => 'png,jpg'
            ],*/
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'section' => 'Section',
            'ta_type_work_id' => 'Ta Type Work ID',
            'subject_id' => 'Subject ID',
            'subject_version' => 'Subject Version',
            'person_id' => 'Person ID',
            'term' => 'Term',
            'year' => 'Year',
            'ta_status' => 'Ta Status',
            'ta_payment_sec' => 'Ta Payment Sec',
            'ta_pay_max_sec' => 'Ta Pay Max Sec',
            'crby' => 'Crby',
            'crtime' => 'Crtime',
            'udby' => 'Udby',
            'udtime' => 'Udtime',
           // 'ta_image'=>'Ta image',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaAssesses()
    {
        return $this->hasMany(TaAssess::className(), ['section' => 'section', 'subject_id' => 'subject_id', 'ta_id' => 'person_id', 'term' => 'term', 'year' => 'year', 'subject_version' => 'subject_version']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaComments()
    {
        return $this->hasMany(TaComment::className(), ['section' => 'section']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(TaRegister::className(), ['subject_id' => 'subject_id', 'term' => 'term', 'year' => 'year', 'person_id' => 'person_id', 'subject_version' => 'subject_version']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaStatus()
    {
        return $this->hasOne(TaStatus::className(), ['ta_status_id' => 'ta_status']);
    }

    //------------------------------------ FUNCTION UPLOAD ONE ----------------------------------
    public function upload($model2,$attribute)
    {
        $model2 = new TaRegister();
        $photo  = UploadedFile::getInstance($model2, $attribute);
        $path = $this->getUploadPath();
        if ($this->validate() && $photo !== null) {

            //$fileName = md5($photo->baseName.time()) . '.' . $photo->extension;
            $fileName = $photo->baseName . '.' . $photo->extension;
            if($photo->saveAs($path.$fileName)){
                return $fileName;
            }
        }
        return $model2->isNewRecord ? false : $model2->getOldAttribute($attribute);
    }

    public function getUploadPath(){
        return Yii::getAlias('@webroot').'/web_ta/images/'.$this->upload_folder.'/';
    }

    public function getUploadUrl(){
        return Yii::getAlias('@web').'/web_ta/images/'.$this->upload_folder.'/';
    }

    public function getPhotoViewer(){
        $model2 = new TaRegister();
        return empty($model2->ta_image) ? Yii::getAlias('@web').'/web_ta/images/img/none.png' : $this->getUploadUrl().$model2->ta_image;
    }
}
