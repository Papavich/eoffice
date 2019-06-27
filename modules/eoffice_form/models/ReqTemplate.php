<?php

namespace app\modules\eoffice_form\models;

use Yii;
use yii\helpers\Json;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * This is the model class for table "req_template".
 *
 * @property int $template_id
 * @property string $template_name
 * @property string $template_description
 * @property string $template_available
 * @property string $template_file
 * @property string $template_level
 * @property string $template_operation
 * @property string $template_category
 * @property string $cr_by
 * @property string $cr_date
 * @property string $ud_by
 * @property string $ud_date
 *
 * @property ApproveGroup[] $approveGroups
 * @property DesignSection[] $designSections
 */
class ReqTemplate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'req_template';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_form');
    }

    //Upload File//
    const UPLOAD_FOLDER = '../modules/eoffice_form/template';

    public static function getUploadPath(){
        return ''.self::UPLOAD_FOLDER.'/';
    }

    public static function getUploadUrl(){
        return Url::base(true).'/'.self::UPLOAD_FOLDER.'/';
    }
    //Upload File//

    //Download File//
    public function listDownloadFiles($type){
        $docs_file = '';
        if(in_array($type, ['docs','template_file'])){

            $data = $type==='docs'?$this->docs:$this->template_file;
            $files = Json::decode($data);
            if(is_array($files)){
                $docs_file ='<ul>';
                foreach ($files as $key => $value) {
                    $docs_file .= '<li>'.Html::a($value,['req-template/download','id'=>$this->template_id,'file'=>$key,'file_name'=>$value]).'</li>';
                }
                $docs_file .='</ul>';
            }
        }

        return $docs_file;
    }

    //Download File//

    //Update File//
    public function initialPreview($data,$field,$type='file'){
        $initial = [];
        $files = Json::decode($data);
        if(is_array($files)){
            foreach ($files as $key => $value) {
                if($type=='file'){
                    $initial[] = "<div class='file-preview-other'><h2><i class='glyphicon glyphicon-file'></i></h2></div>";
                }elseif($type=='config'){
                    $initial[] = [
                        'caption'=> $value,
                        'width'  => '120px',
                        'url'    => Url::to(['/req-template/deletefile','id'=>$this->template_id,'fileName'=>$key,'field'=>$field]),
                        'key'    => $key
                    ];
                }
                else{
                    $initial[] = Html::img(self::getUploadUrl().$this->ref.'/'.$value,['class'=>'file-preview-image', 'alt'=>$model->file_name, 'title'=>$model->file_name]);
                }
            }
        }
        return $initial;
    }
    //Update File//
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['template_file'], 'string'],
            [['cr_date', 'ud_date'], 'safe'],
            [['template_name', 'template_available', 'template_level', 'template_operation', 'template_category', 'cr_by', 'ud_by'], 'string', 'max' => 45],
            [['template_name', 'template_available', 'template_level', 'template_operation', 'template_category'], 'required'],
            [['template_file'],'file','maxFiles'=>1], //<---
            [['template_description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'template_id' => 'รหัสแบบฟอร์มคำร้อง',
            'template_name' => 'ชื่อแบบฟอร์มคำร้อง',
            'template_description' => 'คำอธิบาย',
            'template_available' => 'การใช้งาน',
            'template_file' => 'เทมเพลต',
            'template_level' => 'ระดับการศึกษา',
            'template_operation' => 'การดำเนินการ',
            'template_category' => 'ประเภทแบบฟอร์มคำร้อง',
            'cr_by' => 'สร้างโดย',
            'cr_date' => 'วันที่สร้าง',
            'ud_by' => 'แก้ไขโดย',
            'ud_date' => 'วันที่แก้ไข',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApproveGroups()
    {
        return $this->hasMany(ApproveGroup::className(), ['req_template_template_id' => 'template_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDesignSections()
    {
        return $this->hasMany(DesignSection::className(), ['template_id' => 'template_id']);
    }
}
