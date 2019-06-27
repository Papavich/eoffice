<?php

namespace app\modules\eoffice_eolmv2\models;

use Yii;
use yii\helpers\Url;
use \yii\web\UploadedFile;
use yii\base\Model;
/**
 * This is the model class for table "eolm_disbursementform_details_item".
 *
 * @property int $person_id
 * @property int $eolm_app_id
 * @property int $eolm_dis_type
 * @property string $eolm_dis_detail_date
 * @property string $eolm_dis_detail_detail
 * @property string $eolm_dis_detail_amout
 * @property int $eolm_dis_detail_note
 * @property int $eolm_dis_detail_bill
 * @property int $eolm_dis_bill_id
 *
 * @property EolmDisbursementformDetails $person
 */
class EolmDisbursementformDetailsItem extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eolm_disbursementform_details_item';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_eolmv2');
    }


    public $imageFile;
    public $upload_folder ='uploads';
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            /*[['person_id', 'eolm_app_id', 'eolm_dis_type'], 'required'],*/
            [['person_id', 'eolm_app_id', 'eolm_dis_type',  'eolm_dis_detail_bill', /*'eolm_dis_bill_id'*/], 'integer'],
            [['eolm_dis_detail_date'], 'safe'],
            [['eolm_dis_detail_amout'], 'number'],
            [['eolm_dis_detail_note','eolm_dis_detail_detail'], 'string', 'max' => 300],
            [['doc'], 'file',
                'skipOnEmpty' => true,
                //'extensions' => 'png,jpg'
            ],
           // [['imageFile'], 'file', 'skipOnEmpty' => false],
            [['person_id', 'eolm_app_id', 'eolm_dis_type'], 'exist', 'skipOnError' => true, 'targetClass' => EolmDisbursementformDetails::className(), 'targetAttribute' => ['person_id' => 'person_id', 'eolm_app_id' => 'eolm_app_id', 'eolm_dis_type' => 'eolm_dis_type']],
            //[['img'],'file','maxFiles'=>1], //เพิ่มfile
        ];
    }


    public function upload($model,$attribute)
    {
        $doc  = UploadedFile::getInstance($model, $attribute);
        $path = $this->getUploadPath();
        //if ($this->validate() && $doc !== null) {

            $fileName = md5($doc->baseName.time()) . '.' . $doc->extension;
            //$fileName =$doc['name'];
            //$fileName = $doc->baseName . '.' . $doc->extension;
            if($doc->saveAs($path.$fileName)){
                return $fileName;
            }
        //}
       // return $model->isNewRecord ? false : $model->getOldAttribute($attribute);
    }

    public function getUploadPath(){
        return Yii::getAlias('@webroot').'/web_eolm/'.$this->upload_folder.'/';
    }

    public function getUploadUrl(){
        return Yii::getAlias('@web').'/web_eolm/'.$this->upload_folder.'/';
    }

    public function getPhotoViewer(){
        return empty($this->doc) ? Yii::getAlias('@web').'/img/none.png' : $this->getUploadUrl().$this->doc;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'person_id' => 'Person ID',
            'eolm_app_id' => 'Eolm App ID',
            'eolm_dis_type' => 'Eolm Dis Type',
            'doc' => 'แนบบิล',
            'eolm_dis_detail_date' => 'Eolm Dis Detail Date',
            'eolm_dis_detail_detail' => 'Eolm Dis Detail Detail',
            'eolm_dis_detail_amout' => 'Eolm Dis Detail Amout',
            'eolm_dis_detail_note' => 'Eolm Dis Detail Note',
            'eolm_dis_detail_bill' => 'Eolm Dis Detail Bill',
            //'eolm_dis_bill_id' => 'Eolm Dis Bill ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(EolmDisbursementformDetails::className(), ['person_id' => 'person_id', 'eolm_app_id' => 'eolm_app_id', 'eolm_dis_type' => 'eolm_dis_type']);
    }
}
