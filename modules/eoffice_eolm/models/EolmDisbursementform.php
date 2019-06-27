<?php

namespace app\modules\eoffice_eolm\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;

/**
 * This is the model class for table "eolm_disbursementform".
 *
 * @property int $eolm_app_id
 * @property string $eolm_dis_date
 * @property string $eolm_dis_go_from
 * @property string $eolm_dis_go_date
 * @property string $eolm_dis_back_to
 * @property string $eolm_dis_back_date
 * @property string $eolm_dis_disburse_for
 * @property string $eolm_dis_allowance_type
 * @property int $eolm_dis_allowance_day
 * @property string $eolm_dis_hotal_type
 * @property int $eolm_dis_hotal_day
 * @property string $eolm_vehicletype
 * @property string $eolm_dis_vehicle_cost
 * @property string $eolm_dis_other_expenses
 * @property string $eolm_dis_other_expenses_cost
 * @property int $eolm_dis_doc_count
 * @property int $crby
 * @property string $crtime
 * @property int $udby
 * @property string $udtime
 * @property string $eolm_dis_go_time
 * @property string $eolm_dis_back_time
 * @property int $eolm_dis_date_count
 * @property string $eolm_dis_time
 * @property string $eolm_dis_allowance_cost
 * @property string $eolm_dis_hotal_cost
 * @property string $eolm_dis_total
 * @property string $eolm_dis_total_text
 *
 * @property EolmApprovalform $eolmApp
 * @property EolmDisbursementformDetails[] $eolmDisbursementformDetails
 */
class EolmDisbursementform extends \yii\db\ActiveRecord
{
    const UPLOAD_FOLDER = 'web_eolm/bill';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eolm_disbursementform';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_eolm');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['eolm_app_id'], 'required'],
            [['eolm_app_id', 'eolm_dis_allowance_day', 'eolm_dis_hotal_day', 'eolm_dis_doc_count', 'crby', 'udby', 'eolm_dis_date_count', 'eolm_dis_pay_by', 'eolm_dis_room_type'], 'integer'],
            [['eolm_dis_date', 'eolm_dis_go_date', 'eolm_dis_back_date', 'crtime', 'udtime'], 'safe'],
            [['eolm_dis_vehicle_cost', 'eolm_dis_other_expenses_cost', 'eolm_dis_allowance_cost', 'eolm_dis_hotal_cost', 'eolm_dis_total'], 'number'],
            [['eolm_dis_go_from', 'eolm_dis_back_to', 'eolm_dis_disburse_for', 'eolm_vehicletype'], 'string', 'max' => 50],
            [['eolm_dis_allowance_type', 'eolm_dis_hotal_type'], 'string', 'max' => 2],
            [['eolm_dis_other_expenses', 'eolm_dis_go_time', 'eolm_dis_back_time', 'eolm_dis_time'], 'string', 'max' => 45],
            [['eolm_dis_total_text'], 'string', 'max' => 255],
            [['eolm_app_id'], 'unique'],
            [['eolm_app_id'], 'exist', 'skipOnError' => true, 'targetClass' => EolmApprovalform::className(), 'targetAttribute' => ['eolm_app_id' => 'eolm_app_id']],
          //  [['docs'],'file','maxFiles'=>10], //<---
            [['ref'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'eolm_app_id' => 'แบบขออนุมัติหลักการ',
            'eolm_dis_date' => 'วันที่',
            'eolm_dis_go_from' => 'โดยออกเดินทางจาก',
            'eolm_dis_go_date' => 'วันที่ออกเดินทาง',
            'eolm_dis_back_to' => 'กลับถึง',
            'eolm_dis_back_date' => 'วันที่เดินทางกลับ',
            'eolm_dis_disburse_for' => 'เบิกค่าใช้จ่ายในการเดินทางไปราชการสำหรับ',
            'eolm_dis_allowance_type' => 'ค่าเบี้ยเลี้ยงประเภท',
            'eolm_dis_allowance_day' => 'จำนวนค่าเบี้ยเลี้ยง(วัน)',
            'eolm_dis_hotal_type' => 'ค่าเช่าที่พักประเภท',
            'eolm_dis_hotal_day' => 'จำนวน(วัน)',
            'eolm_vehicletype' => 'ค่าพาหนะ',
            'eolm_dis_vehicle_cost' => 'ค่าพาหนะรวมเป็นเงิน(บาท)',
            'eolm_dis_other_expenses' => 'ค่าใช้จ่ายอื่นๆ',
            'eolm_dis_other_expenses_cost' => 'ค่าใช้จ่ายอื่นๆรวมเป็นเงิน(บาท)',
            'eolm_dis_doc_count' => 'จำนวนเอกสารที่แนบ',
            'crby' => 'Crby',
            'crtime' => 'Crtime',
            'udby' => 'Udby',
            'udtime' => 'Udtime',
            'eolm_dis_go_time' => 'เวลาที่ออกเดินทาง',
            'eolm_dis_back_time' => 'เวลาที่เดินทางกลับ',
            'eolm_dis_date_count' => 'รวม(วัน)',
            'eolm_dis_time' => 'คิดเป็น (ชั่วโมง)',
            'eolm_dis_allowance_cost' => 'รวมเป็นเงิน(บาท)',
            'eolm_dis_hotal_cost' => 'รวมเป็นเงิน(บาท)',
            'eolm_dis_total' => 'รวมเงินทั้งสิ้น (บาท)',
            'eolm_dis_total_text' => 'รวมเงินทั้งสิ้น(ตัวหนังสือ)',
            'eolm_dis_pay_by' => 'จ่ายแบบ',
            'eolm_dis_room_type' => 'ห้องพัก',
            //'docs' => 'เอกสารแนบ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmApp()
    {
        return $this->hasOne(EolmApprovalform::className(), ['eolm_app_id' => 'eolm_app_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmDisbursementformDetails()
    {
        return $this->hasMany(EolmDisbursementformDetails::className(), ['eolm_app_id' => 'eolm_app_id']);
    }


    public static function getUploadPath(){
        return Yii::getAlias('@webroot').'/'.self::UPLOAD_FOLDER.'/';
    }

    public static function getUploadUrl(){
        return Url::base(true).'/'.self::UPLOAD_FOLDER.'/';
    }

    public function getThumbnails($ref,$event_name){
        $uploadFiles   = Uploads::find()->where(['ref'=>$ref])->all();
        $preview = [];
        foreach ($uploadFiles as $file) {
            $preview[] = [
                'url'=>self::getUploadUrl(true).$ref.'/'.$file->real_filename,
                'src'=>self::getUploadUrl(true).$ref.'/thumbnail/'.$file->real_filename,
                'options' => ['title' => $event_name]
            ];
        }
        return $preview;
    }

    public function listDownloadFiles($type){
        $docs_file = '';
        if(in_array($type, ['docs'])){
            $data = $this->docs;
            $files = Json::decode($data);
            if(is_array($files)){
                $docs_file ='<ul>';
                foreach ($files as $key => $value) {
                    $docs_file .= '<li>'.Html::a($value,['/eoffice_eolm/disbursementform/download','id'=>$this->id,'file'=>$key,'file_name'=>$value]).'</li>';
                }
                $docs_file .='</ul>';
            }
        }

        return $docs_file;
    }
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
                        'url'    => Url::to(['/eoffice_eolm/disbursementform/deletefile-ajax','id'=>$this->id,'fileName'=>$key,'field'=>$field]),
                        'key'    => $key
                    ];
                }
                else{
                    $initial[] = Html::img(self::getUploadUrl().$this->ref.'/'.$value,['class'=>'file-preview-image', 'alt'=>$this->file_name, 'title'=>$this->file_name]);
                }
            }
        }
        return $initial;
    }
}
