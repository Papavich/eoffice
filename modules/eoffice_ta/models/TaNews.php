<?php

namespace app\modules\eoffice_ta\models;

use Yii;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use \yii\web\UploadedFile;
use app\modules\eoffice_ta\controllers;

/**
 * This is the model class for table "ta_news".
 *
 * @property integer $ta_news_id
 * @property string $ta_news_name
 * @property string $ta_news_detail
 * @property string $ta_news_img
 * @property string $ta_news_imgs
 * @property string $ta_news_url
 * @property integer $ta_documents_id
 * @property string $ta_status
 * @property integer $crby
 * @property string $crtime
 * @property integer $udby
 * @property string $udtime
 *
 * @property TaDocuments $taDocuments
 * @property TaStatus $taStatus
 * @property TaNewsComment[] $taNewsComments
 */
class TaNews extends \yii\db\ActiveRecord
{
    //const UPLOAD_FOLDER='web_ta/images/upload';
    public $upload_folder ='upload';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ta_news';
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
            //[['ta_news_imgs'], 'string'],
            [['ta_documents_id', 'crby', 'udby'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
            [['ta_news_name'], 'string', 'max' => 100],
            [['ta_news_detail'], 'string'],
            [[ 'ta_news_url'], 'string', 'max' => 200],
            [['ta_status'], 'string', 'max' => 15],
            [['ta_documents_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaDocuments::className(), 'targetAttribute' => ['ta_documents_id' => 'ta_documents_id']],
            [['ta_status'], 'exist', 'skipOnError' => true, 'targetClass' => TaStatus::className(), 'targetAttribute' => ['ta_status' => 'ta_status_id']],
            [['ta_news_img'], 'file',
                'skipOnEmpty' => true,
                'extensions' => 'png,jpg'
            ],
            [['ta_news_imgs'], 'file',
              'skipOnEmpty' => true,
              'maxFiles' => 20,
              'extensions' => 'png,jpg'
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ta_news_id' =>  controllers::t('label','News ID'),
            'ta_news_name' => controllers::t('label','News Name'),
            'ta_news_detail' => controllers::t('label','Detail'),
            'ta_news_img' => controllers::t('label','Main Photo'),
            'ta_news_imgs' =>  controllers::t('label','Other Photo'),
            'ta_news_url' => controllers::t('label','Url Link'),
            'ta_documents_id' =>  controllers::t('label','Document'),
           // 'type_id' => controllers::t('label','Type'),
            'ta_status' => controllers::t('label','Status'),
            'crby' => controllers::t('label','Create By'),
            'crtime' => controllers::t('label','Create Time'),
            'udby' => controllers::t('label','Update By'),
            'udtime' => controllers::t('label','Update Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaDocuments()
    {
        return $this->hasOne(TaDocuments::className(), ['ta_documents_id' => 'ta_documents_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaStatus()
    {
        return $this->hasOne(TaStatus::className(), ['ta_status_id' => 'ta_status']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
   /* public function getType()
    {
        return $this->hasOne(Type::className(), ['type_id' => 'type_id']);
    }*/

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaNewsComments()
    {
        return $this->hasMany(TaNewsComment::className(), ['ta_news_id' => 'ta_news_id']);
    }
    //------------------------------------ FUNCTION UPLOAD ONE ----------------------------------
    public function upload($model,$attribute)
    {
        $photo  = UploadedFile::getInstance($model, $attribute);
        $path = $this->getUploadPath();
        if ($this->validate() && $photo !== null) {

            //$fileName = md5($photo->baseName.time()) . '.' . $photo->extension;
            $fileName = $photo->baseName . '.' . $photo->extension;
            if($photo->saveAs($path.$fileName)){
                return $fileName;
            }
        }
        return $model->isNewRecord ? false : $model->getOldAttribute($attribute);
    }

    public function getUploadPath(){
        return Yii::getAlias('@webroot').'/web_ta/images/'.$this->upload_folder.'/';
    }

    public function getUploadUrl(){
        return Yii::getAlias('@web').'/web_ta/images/'.$this->upload_folder.'/';
    }

    public function getPhotoViewer(){
        return empty($this->ta_news_img) ? Yii::getAlias('@web').'/web_ta/images/img/none.png' : $this->getUploadUrl().$this->ta_news_img;
    }
    //------------------------------------ FUNCTION UPLOAD MULTIPLE ----------------------------------
    public function uploadMultiple($model,$attribute)
    {
        $photos  = UploadedFile::getInstances($model, $attribute);
        $path = $this->getUploadPath();
        if ($this->validate() && $photos !== null) {
            $filenames = [];
            foreach ($photos as $file) {
                //$filename = md5($file->baseName.time()) . '.' . $file->extension;
                $filename = $file->baseName . '.' . $file->extension;
                if($file->saveAs($path . $filename)){
                    $filenames[] = $filename;
                }
            }
            if($model->isNewRecord){
                return implode(',', $filenames);
            }else{
                return implode(',',(ArrayHelper::merge($filenames,$model->getOwnPhotosToArray())));
            }
        }

        return $model->isNewRecord ? false : $model->getOldAttribute($attribute);
    }

    public function getPhotosViewer(){
        $photos = $this->ta_news_imgs ? @explode(',',$this->ta_news_imgs) : [];
        $img = '';
        foreach ($photos as  $photo) {
            $img.= ' '.Html::img($this->getUploadUrl().$photo,['class'=>'img-thumbnail','style'=>'max-width:200px;']);
        }
        if (empty($this->ta_news_imgs)){
            $none = '<center>'.Html::img(Yii::getAlias('@web').'/web_ta/images/img/none.png').'</center>';
            return $none;
        }else{
            return $img;
        }
    }

    public function getOwnPhotosToArray()
    {
        return $this->getOldAttribute('ta_news_imgs') ? @explode(',',$this->getOldAttribute('ta_news_imgs')) : [];
    }


}
