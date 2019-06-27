<?php

namespace app\modules\scholar_b\models;

use app\modules\scholar_b\components\ModelHelper;
use Yii;

/**
 * This is the model class for table "scb_portfolio".
 *
 * @property int $id_portfolio
 * @property string $port_name
 * @property string $port_date
 * @property string $port_img
 * @property string $port_location
 * @property string $port_detail
 * @property string $port_file
 * @property int $port_status
 * @property int $crby
 * @property string $crtime
 * @property int $udby
 * @property string $udtime
 * @property int $port_type_id
 * @property int $year
 * @property int $semester
 * @property int $project_code
 *
 * @property ScbPortfolioType $portType
 * @property ScbProject $projectCode
 * @property ScbYearHasSemester $year0
 */
class ScbPortfolio extends \yii\db\ActiveRecord
{
    public $uploadImageFolder = 'web_scb/uploads/portfolio/images';
    public $uploadFilesFolder = 'web_scb/uploads/portfolio';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scb_portfolio';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_scb');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['port_date', 'crtime', 'udtime'], 'safe'],
            [['port_status', 'crby', 'udby', 'port_type_id', 'year', 'semester', 'project_code'], 'integer'],
            [['port_type_id', 'year', 'semester', 'project_code'], 'required'],
            [['port_name', 'port_location', 'port_detail'], 'string', 'max' => 45],
            [['port_file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf,zip,docx,doc'],
            [['port_img'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png,jpg'],
            [['port_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ScbPortfolioType::className(), 'targetAttribute' => ['port_type_id' => 'type_id']],
            [['project_code'], 'exist', 'skipOnError' => true, 'targetClass' => ScbProject::className(), 'targetAttribute' => ['project_code' => 'project_code']],
            [['year', 'semester'], 'exist', 'skipOnError' => true, 'targetClass' => ScbYearHasSemester::className(), 'targetAttribute' => ['year' => 'year', 'semester' => 'semester']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return ModelHelper::behaviors();
    }

    public function attributeLabels()
    {
        return [
            'id_portfolio' => 'รหัสผลงาน',
            'port_name' => 'ชื่อผลงาน',
            'port_date' => 'วันที่เผยแพร่ผลงาน',
            'port_img' => 'อัปโหลดรูปภาพ',
            'port_location' => 'สถานที่เผยแพร่',
            'port_detail' => 'รายละเอียดผลงาน',
            'port_file' => 'อัปโหลดไฟล์ผลงาน',
            'port_status' => '',
            'crby' => 'Crby',
            'crtime' => 'Crtime',
            'udby' => 'Udby',
            'udtime' => 'Udtime',
            'port_type_id' => 'ประเภทผลงาน',
            'year' => 'ปีการศึกษา',
            'semester' => 'เทอม',
            'project_code' => 'โปรเจคที่เผยแพร่',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPortType()
    {
        return $this->hasOne(ScbPortfolioType::className(), ['type_id' => 'port_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectCode()
    {
        return $this->hasOne(ScbProject::className(), ['project_code' => 'project_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYear0()
    {
        return $this->hasOne(ScbYearHasSemester::className(), ['year' => 'year', 'semester' => 'semester']);
    }

    public function uploadFile()
    {
        if ($this->validate()) {
            if ($this->port_file) {
                if ($this->isNewRecord) {
                    $fileName = time() . $this->port_file;
                    //$fileName = iconv('UTF-8','WINDOWS-874',$this->scholarship_file).'.'.$this->extension;
                } else {
                    $fileName = $this->getOldAttribute('port_file');
                }
                $this->port_file->saveAs(Yii::getAlias('@webroot') . '/' . $this->uploadFilesFolder . '/' . $fileName);
                return $fileName;
            }
        }
        return $this->isNewRecord ? false : $this->getOldAttribute('port_file');
    }

    public function uploadImage()
    {
        if ($this->validate()) {
            if ($this->port_img) {
                if ($this->isNewRecord) {
                    $fileName = substr(md5(rand(1, 1000) . time()), 0, 30) . '.' . $this->port_img->extension;
                } else {
                    $fileName = $this->getOldAttribute('port_img');
                }
                $this->port_img->saveAs(Yii::getAlias('@webroot') . '/' . $this->uploadImageFolder . '/' . $fileName);
                return $fileName;
            }
        }
        return $this->isNewRecord ? false : $this->getOldAttribute('port_img');
    }
}
