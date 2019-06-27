<?php

namespace app\modules\eoffice_eolm\models;
use app\modules\eoffice_eolm\controllers;
use app\modules\eoffice_eolm\models\model_main\EofficeMainProvince;
use app\modules\eoffice_eolm\models\model_main\EofficeMainViewPisPerson;
use Yii;
use cornernote\linkall\LinkAllBehavior;
/**
 * This is the model class for table "eolm_approvalform".
 *
 * @property integer $eolm_app_id
 * @property string $eolm_app_date
 * @property string $eolm_app_subject
 * @property string $eolm_app_event_date
 * @property string $eolm_app_number
 * @property string $eolm_app_deprture_date
 * @property string $eolm_app_retuen_date
 * @property string $eolm_app_borrow_money
 * @property integer $eolm_budget_year
 * @property string $eolm_link
 * @property integer $eolm_type_id
 * @property integer $eolm_status_id
 * @property integer $eolm_budp_id
 * @property integer $eolm_budt_id
 * @property integer $eolm_exp_id
 * @property integer $pro_id
 * @property integer $crby
 * @property string $crtime
 * @property integer $udby
 * @property string $udtime
 *
 * @property EolmExpenditurecategoty $eolmExp
 * @property EolmBudgettype $eolmBudt
 * @property EolmBudgetplan $eolmBudp
 * @property ProjectSub $pro
 * @property EolmStatus $eolmStatus
 * @property EolmType $eolmType
 * @property EolmApprovalformHasPersonal[] $eolmApprovalformHasPersonals
 * @property Person[] $people
 * @property EolmApprovalformHasProvince[] $eolmApprovalformHasProvinces
 * @property EolmProvince[] $eolmProvs
 * @property EolmApprovalformHasSigner[] $eolmApprovalformHasSigners
 * @property EolmSigner[] $people0
 * @property EolmApprovalformHasVehicle[] $eolmApprovalformHasVehicles
 * @property EolmVehicleType[] $vehicleTypes
 * @property EolmDisbursementform $eolmDisbursementform
 * @property EolmLoancontract $eolmLoancontract
 * @property EolmReceiptHotel[] $eolmReceiptHotels
 * @property EolmRepay[] $eolmRepays
 */
class EolmApprovalform extends \yii\db\ActiveRecord
{
    public $person_ids = []; /* add หลายผู้ติดตาม */
    public $person_ids1;
    public $person_ids2 = []; /* add student  */
   /* public $vehicles;*/

    public $vehicle_detail3,$vehicle_detail4,$vehicle_detail5,$vehicle_detail6;
    public $vehicle1,$vehicle2,$vehicle3,$vehicle4,$vehicle5,$vehicle6;
    public $vdate1,$vdate2,$vdate3,$vdate4,$vdate5,$vdate6;
    public $vamount1,$vamount2,$vamount3,$vamount4,$vamount5,$vamount6;
    public $provinces;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eolm_approvalform';
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
            [['eolm_app_date', 'eolm_app_event_date', 'eolm_app_deprture_date', 'eolm_app_retuen_date', 'crtime', 'udtime',
                /*'vehicles',*/'vehicle1','vehicle2','vehicle3','vehicle4','vehicle5','vehicle6',
                'vdate1','vdate2','vdate3','vdate4','vdate5','vdate6',
                'vamount1','vamount2','vamount3','vamount4','vamount5','vamount6',
                'provinces','person_ids','person_ids2','person_ids1','vehicle_detail3','vehicle_detail4','vehicle_detail5','vehicle_detail6'], 'safe'],
            //[['eolm_app_borrow_money'], 'number'],
            [['eolm_budget_year', 'eolm_type_id', 'eolm_status_id', 'eolm_budp_id', 'eolm_budt_id', 'eolm_exp_id', 'pro_id', 'crby', 'udby'], 'integer'],
            [['eolm_type_id', 'eolm_status_id','provinces','person_ids1','eolm_app_subject','eolm_app_date','eolm_app_event_date','eolm_app_deprture_date','eolm_app_retuen_date'], 'required'],
            [['eolm_app_subject'], 'string', 'max' => 100],
            [['eolm_app_number','eolm_app_number2'], 'string', 'max' => 50],
            [['eolm_link'], 'string', 'max' => 200],
            [['eolm_exp_id'], 'exist', 'skipOnError' => true, 'targetClass' => EolmExpenditurecategoty::className(), 'targetAttribute' => ['eolm_exp_id' => 'eolm_exp_id']],
            [['eolm_budt_id'], 'exist', 'skipOnError' => true, 'targetClass' => EolmBudgettype::className(), 'targetAttribute' => ['eolm_budt_id' => 'eolm_budt_id']],
            [['eolm_budp_id'], 'exist', 'skipOnError' => true, 'targetClass' => EolmBudgetplan::className(), 'targetAttribute' => ['eolm_budp_id' => 'eolm_budp_id']],
            [['pro_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectSub::className(), 'targetAttribute' => ['pro_id' => 'ProSub_id']],
            [['eolm_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => EolmStatus::className(), 'targetAttribute' => ['eolm_status_id' => 'eolm_status_id']],
            [['eolm_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => EolmType::className(), 'targetAttribute' => ['eolm_type_id' => 'eolm_type_id']],
        ];
    }

    /* add many to many province */
    public function behaviors()
    {
        return [
            LinkAllBehavior::className(),
        ];
    }
    public function afterSave($insert, $changedAttributes)
    {

        foreach ($this->provinces as $id) { //Write new values
            $apv = new EolmApprovalformHasProvince();
            $apv->eolm_app_id = $this->eolm_app_id;
            $apv->PROVINCE_ID = $id;
            $apv->save();
        }
        if (!empty($this->person_ids2)){
            foreach ($this->person_ids2 as $id) { //Write new values
                $apv = new EolmApprovalformHasStudent();
                $apv->eolm_app_id = $this->eolm_app_id;
                $apv->STUDENTID = $id;
                $apv->save();
            }
        }

        $rows = EolmSigner::find()->all();
        EolmApprovalformHasSigner::deleteAll(['eolm_app_id'=>$this->eolm_app_id]);
        foreach ($rows as $row) {
            $person_id = $row['person_id'];
            $eolm_signer_type_id = $row['eolm_signer_type_id'];
            $s = new EolmApprovalformHasSigner();
            $s->person_id = $person_id;
            $s->eolm_signer_type_id = $eolm_signer_type_id;
            $s->eolm_app_id=$this->eolm_app_id;
            $s->save();
        }

    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'eolm_app_id' =>controllers::t('label_appform','id'),
            'eolm_app_date'  =>controllers::t('label_appform','Date'),
            'eolm_app_subject' => controllers::t('label_appform','Subject'),
            'eolm_app_event_date' => controllers::t('label_appform','Date event'),
            'eolm_app_number' => controllers::t('label_appform','Number'),
            'eolm_app_number2' => controllers::t('label_appform','Number'),
            'eolm_app_deprture_date' =>controllers::t('label_appform','Day of departure'),
            'eolm_app_retuen_date' => controllers::t('label_appform','Day of return'),
            //'eolm_app_borrow_money' => controllers::t('label_appform','Borrow Money'),
            'eolm_budget_year' => controllers::t('label_appform','Budget year'),
            'eolm_link' =>controllers::t('label_appform','Link'),
            'eolm_type_id' =>controllers::t('label_appform','Type'),
            'eolm_status_id' =>controllers::t('label_appform','Status'),
            'eolm_budp_id' =>controllers::t('label_appform','From budget plan'),
            'eolm_budt_id' =>controllers::t('label_appform','Budgets'),
            'eolm_exp_id' =>controllers::t('label_appform','Group disbursement'),
            'pro_id' =>controllers::t('label_appform','Project'),
            'crby' => 'Crby',
            'crtime' => 'Crtime',
            'udby' => 'Udby',
            'udtime' => 'Udtime',
            'vehicle1'=>'ยานพาหนะประจำทาง',
            'vehicle2'=>'ยานพาหนะประจำทาง',
            'vehicle3'=>'ยานพาหนะส่วนตัว',
            'vehicle4'=>'ยานพาหนะของทางราชการ',
            'vehicle5'=>'เครื่องบิน ระหว่าง',
            'vehicle6'=>'อื่น ๆ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmExp()
    {
        return $this->hasOne(EolmExpenditurecategoty::className(), ['eolm_exp_id' => 'eolm_exp_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmBudt()
    {
        return $this->hasOne(EolmBudgettype::className(), ['eolm_budt_id' => 'eolm_budt_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmBudp()
    {
        return $this->hasOne(EolmBudgetplan::className(), ['eolm_budp_id' => 'eolm_budp_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPro()
    {
        return $this->hasOne(ProjectSub::className(), ['ProSub_id' => 'pro_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmStatus()
    {
        return $this->hasOne(EolmStatus::className(), ['eolm_status_id' => 'eolm_status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmType()
    {
        return $this->hasOne(EolmType::className(), ['eolm_type_id' => 'eolm_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmApprovalformHasPersonals()
    {
        return $this->hasMany(EolmApprovalformHasPersonal::className(), ['eolm_app_id' => 'eolm_app_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeople()
    {
        return $this->hasMany(EofficeMainViewPisPerson::className(), ['person_id' => 'person_id'])->viaTable('eolm_approvalform_has_personal', ['eolm_app_id' => 'eolm_app_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmApprovalformHasProvinces()
    {
        return $this->hasMany(EolmApprovalformHasProvince::className(), ['eolm_app_id' => 'eolm_app_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmApprovalformHasSigners()
    {
        return $this->hasMany(EolmApprovalformHasSigner::className(), ['eolm_app_id' => 'eolm_app_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeople0()
    {
        return $this->hasMany(EolmSigner::className(), ['person_id' => 'person_id', 'eolm_signer_type_id' => 'eolm_signer_type_id'])->viaTable('eolm_approvalform_has_signer', ['eolm_app_id' => 'eolm_app_id']);
    }

    public function getPerson1()
    {
        $n= $this->hasOne(EofficeMainViewPisPerson::className(), ['person_id' => 'person_id'])->viaTable('eolm_approvalform_has_personal', ['eolm_app_id' => 'eolm_app_id'], function ($query) {
            /* @var $query \yii\db\ActiveQuery */

            $query->andWhere(['eolm_app_has_person_type_id' => 1]);
            // ->orderBy(['sort' => SORT_DESC]);
        });
        return  $n;
    }
    public function getPerson2()
    {
        $n= $this->hasOne(EofficeMainViewPisPerson::className(), ['person_id' => 'person_id'])->viaTable('eolm_approvalform_has_personal', ['eolm_app_id' => 'eolm_app_id'], function ($query) {
            /* @var $query \yii\db\ActiveQuery */

            $query->andWhere(['eolm_app_has_person_type_id' => 2]);
            // ->orderBy(['sort' => SORT_DESC]);
        });
        return  $n;
    }
    public function getProvinces(){
        $n= $this->hasMany(EofficeMainProvince::className(), ['PROVINCE_ID' => 'PROVINCE_ID'])->viaTable('eolm_approvalform_has_province', ['eolm_app_id' => 'eolm_app_id'], function ($query) {
            /* @var $query \yii\db\ActiveQuery */

            //$query->andWhere(['eolm_app_has_person_type_id' => 1]);
            // ->orderBy(['sort' => SORT_DESC]);
        });
        return  $n;
    }
    public function getUser()
    {
        $n= $this->hasOne(EofficeMainViewPisPerson::className(), ['person_id' => 'person_id'])->viaTable('eolm_approvalform_has_personal', ['eolm_app_id' => 'eolm_app_id'], function ($query) {
            /* @var $query \yii\db\ActiveQuery */

            $query->andWhere(['eolm_app_has_person_type_id' => 1]);
            // ->orderBy(['sort' => SORT_DESC]);
        });
        return  $n;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmApprovalformHasVehicles()
    {
        return $this->hasMany(EolmApprovalformHasVehicle::className(), ['eolm_app_id' => 'eolm_app_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVehicleTypes()
    {
        return $this->hasMany(EolmVehicleType::className(), ['eolm_vehicle_type_id' => 'vehicle_type_id'])->viaTable('eolm_approvalform_has_vehicle', ['eolm_app_id' => 'eolm_app_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmDisbursementform()
    {
        return $this->hasOne(EolmDisbursementform::className(), ['eolm_app_id' => 'eolm_app_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmLoancontract()
    {
        return $this->hasOne(EolmLoancontract::className(), ['eolm_app_id' => 'eolm_app_id']);
    }

    public function getEolmDisbursementformDetails()
    {
        return $this->hasMany(EolmDisbursementformDetails::className(), ['eolm_app_id' => 'eolm_app_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmReceiptHotels()
    {
        return $this->hasMany(EolmReceiptHotel::className(), ['eolm_app_id' => 'eolm_app_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmRepays()
    {
        return $this->hasMany(EolmRepay::className(), ['eolm_app_id' => 'eolm_app_id']);
    }
}
