<?php

namespace app\modules\correspondence\models;

use app\modules\correspondence\controllers;
use DateTime;
use Yii;

/**
 * This is the model class for table "cms_document".
 *
 * @property string $doc_id
 * @property string $doc_subject
 * @property string $receive_date
 * @property string $sent_date
 * @property string $doc_rank
 * @property string $doc_expire
 * @property string $doc_tel
 * @property string $doc_date
 * @property string $doc_from
 * @property integer $check_id
 * @property integer $secret_id
 * @property integer $speed_id
 * @property integer $type_id
 * @property integer $user_id
 * @property string $doc_id_regist
 * @property string $doc_ref
 * @property integer $sub_type_id
 * @property string $address_id
 * @property integer $doc_dept_id
 * @property double $money
 *
 * @property CmsDeleteRoll[] $cmsDeleteRolls
 * @property CmsDocFile[] $cmsDocFiles
 * @property CmsFile[] $files
 * @property CmsDocRollReceive[] $cmsDocRollReceives
 * @property CmsDocRollSend[] $cmsDocRollSends
 * @property CmsAddress $address
 * @property CmsDocCheck $check
 * @property CmsDocDept $docDept
 * @property CmsDocSecret $secret
 * @property CmsDocSpeed $speed
 * @property CmsDocSubType $subType
 * @property CmsDocType $type
 * @property User $user
 * @property CmsInbox[] $cmsInboxes
 * @property CmsLog[] $cmsLogs
 * @property CmsOutbox[] $cmsOutboxes
 */
class CmsDocument extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        date_default_timezone_set("Asia/Bangkok");
        return [
            'AuditTrailBehavior' => [
                'class' => 'bedezign\yii2\audit\AuditTrailBehavior',
                // Array with fields to save. You don't need to configure both `allowed` and `ignored`
                'allowed' => ['doc_subject','doc_id_regist','receive_date'
                    ,'sent_date','doc_date','check_id'],
                // Is the behavior is active or not
                'active' => true,
                // Date format to use in stamp - set to "Y-m-d H:i:s" for datetime or "U" for timestamp
                'dateFormat' => date('Y-m-d H:i:s'),
            ]
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_document';
    }
    public static function getDb()
    {
        return Yii::$app->get('db_cms');
    }
    public static function primaryKey()
    {
        return ['doc_id'];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['doc_id', 'doc_subject', 'doc_date', 'doc_from', 'check_id', 'secret_id', 'speed_id', 'type_id', 'user_id', 'doc_id_regist'
                , 'sub_type_id', 'address_id', 'doc_dept_id','receive_date', 'sent_date','money'], 'required'],
            [['receive_date', 'sent_date', 'doc_expire', 'doc_date'], 'safe'],
            [['doc_date','receive_date', 'sent_date'],'validateDates'],
            [['doc_date','receive_date', 'sent_date'],'validateDateFormat'],
            [['check_id', 'secret_id', 'speed_id', 'type_id', 'user_id', 'sub_type_id', 'doc_dept_id'], 'integer'],
            [['money'], 'number'],
            [['doc_id', 'doc_id_regist'], 'string', 'max' => 45],
            [['doc_subject', 'doc_from'], 'string', 'max' => 200],
            [['doc_rank', 'doc_ref'], 'string', 'max' => 100],
            [['doc_tel'], 'string', 'max' => 15],
            [['address_id'], 'string', 'max' => 11],
            [['address_id'], 'exist', 'skipOnError' => true, 'targetClass' => CmsAddress::className(), 'targetAttribute' => ['address_id' => 'address_id']],
            [['check_id'], 'exist', 'skipOnError' => true, 'targetClass' => CmsDocCheck::className(), 'targetAttribute' => ['check_id' => 'check_id']],
            [['doc_dept_id'], 'exist', 'skipOnError' => true, 'targetClass' => CmsDocDept::className(), 'targetAttribute' => ['doc_dept_id' => 'doc_dept_id']],
            [['secret_id'], 'exist', 'skipOnError' => true, 'targetClass' => CmsDocSecret::className(), 'targetAttribute' => ['secret_id' => 'secret_id']],
            [['speed_id'], 'exist', 'skipOnError' => true, 'targetClass' => CmsDocSpeed::className(), 'targetAttribute' => ['speed_id' => 'speed_id']],
            [['sub_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => CmsDocSubType::className(), 'targetAttribute' => ['sub_type_id' => 'sub_type_id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => CmsDocType::className(), 'targetAttribute' => ['type_id' => 'type_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $funcT = '\app\modules\\' . Yii::$app->controller->module->id . '\controllers::t';
        return [
            'doc_id' => $funcT('menu', 'Doc ID'),
            'doc_subject' => $funcT('menu', 'Doc Subject'),
            'receive_date' => $funcT('menu', 'Receive Date'),
            'sent_date' => $funcT('menu', 'Sent Date'),
            'doc_rank' => 'Doc Rank',
            'doc_expire' => 'Doc Expire',
            'doc_tel' => $funcT('menu', 'Doc Tel'),
            'doc_date' => $funcT('menu', 'Doc Date'),
            'doc_from' => $funcT('menu', 'Doc From'),
            'check_id' => 'Check ID',
            'secret_id' => $funcT('menu', 'Secret ID'),
            'speed_id' => $funcT('menu', 'Speed ID'),
            'type_id' => $funcT('menu', 'Type ID'),
            'user_id' => 'User ID',
            'doc_id_regist' => $funcT('menu', 'Doc Id Regist'),
            'doc_ref' => 'Doc Ref',
            'sub_type_id' => $funcT('menu', 'Sub Type ID'),
            'address_id' => $funcT('menu', 'Address Book'),
            'doc_dept_id' => 'Doc Dept ID',
            'money' => $funcT('menu', 'Money'),
        ];
    }
    public function validateDates($attribute, $params){
        date_default_timezone_set('Asia/Bangkok');
        if(substr($this->doc_date,0,10) > date('Y-m-d')){
            $this->addError('doc_date',controllers::t('menu','Please give correct date !'));
        }
        if (substr($this->receive_date,0,10) > date('Y-m-d')){
            $this->addError('receive_date',controllers::t('menu','Please give correct date !'));
        }
        if (substr($this->sent_date,0,10) > date('Y-m-d')){
            $this->addError('sent_date',controllers::t('menu','Please give correct date !'));
        }
    }
    public function validateDateFormat($attribute,$params)
    {
        if (DateTime::createFromFormat('Y-m-d H:i:s', $this->$attribute) == FALSE) {
            $this->addError($attribute, controllers::t('menu','Please give correct date !'));
        }
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsDeleteRolls()
    {
        return $this->hasMany(CmsDeleteRoll::className(), ['doc_id' => 'doc_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsDocFiles()
    {
        return $this->hasMany(CmsDocFile::className(), ['doc_id' => 'doc_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(CmsFile::className(), ['file_id' => 'file_id'])->viaTable('cms_doc_file', ['doc_id' => 'doc_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsDocRollReceives()
    {
        return $this->hasMany(CmsDocRollReceive::className(), ['doc_id' => 'doc_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsDocRollSends()
    {
        return $this->hasMany(CmsDocRollSend::className(), ['doc_id' => 'doc_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddress()
    {
        return $this->hasOne(CmsAddress::className(), ['address_id' => 'address_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCheck()
    {
        return $this->hasOne(CmsDocCheck::className(), ['check_id' => 'check_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocDept()
    {
        return $this->hasOne(CmsDocDept::className(), ['doc_dept_id' => 'doc_dept_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSecret()
    {
        return $this->hasOne(CmsDocSecret::className(), ['secret_id' => 'secret_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpeed()
    {
        return $this->hasOne(CmsDocSpeed::className(), ['speed_id' => 'speed_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubType()
    {
        return $this->hasOne(CmsDocSubType::className(), ['sub_type_id' => 'sub_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(CmsDocType::className(), ['type_id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsInboxes()
    {
        return $this->hasMany(CmsInbox::className(), ['doc_id' => 'doc_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsLogs()
    {
        return $this->hasMany(CmsLog::className(), ['doc_id' => 'doc_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsOutboxes()
    {
        return $this->hasMany(CmsOutbox::className(), ['doc_id' => 'doc_id']);
    }
}