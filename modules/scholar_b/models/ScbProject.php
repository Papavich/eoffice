<?php

namespace app\modules\scholar_b\models;

use app\modules\scholar_b\components\ModelHelper;
use Yii;

/**
 * This is the model class for table "scb_project".
 *
 * @property int $project_code
 * @property int $project_type_id
 * @property string $project_name
 * @property string $project_detail
 * @property string $project_date
 * @property int $project_status
 * @property string $project_file
 * @property string $project_image
 * @property int $pro_status
 * @property int $crby
 * @property string $crtime
 * @property int $udby
 * @property string $udtime
 *
 * @property ScbPortfolio[] $scbPortfolios
 * @property ScbProjectType $projectType
 * @property ScbStudentHasProject[] $scbStudentHasProjects
 * @property ScbTeacherHasProject[] $scbTeacherHasProjects
 */
class ScbProject extends \yii\db\ActiveRecord
{
    public $uploadFilesFolder = '/web_scb/uploads/project';
    public $uploadImageFolder = '/web_scb/uploads/project/images';

    public function behaviors()
    {
        return ModelHelper::behaviors();
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'scb_project';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_scb');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_type_id'], 'required'],
            [['project_type_id', 'project_status', 'pro_status', 'crby', 'udby'], 'integer'],
            [['project_detail'], 'string'],
            [['project_date', 'crtime', 'udtime'], 'safe'],
            [['project_name'], 'string', 'max' => 255],
            [['project_file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf,zip,docx,doc'],
            [['project_image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png,jpg'],
            [['project_name'], 'unique'],
            [['project_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ScbProjectType::className(), 'targetAttribute' => ['project_type_id' => 'type_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'project_code' => 'Project Code',
            'project_type_id' => 'Project Type ID',
            'project_name' => 'Project Name',
            'project_detail' => 'Project Detail',
            'project_date' => 'Project Date',
            'project_status' => 'Project Status',
            'project_file' => 'Project File',
            'project_image' => 'Project Image',
            'pro_status' => 'Pro Status',
            'crby' => 'Crby',
            'crtime' => 'Crtime',
            'udby' => 'Udby',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbPortfolios()
    {
        return $this->hasMany(ScbPortfolio::className(), ['project_code' => 'project_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectType()
    {
        return $this->hasOne(ScbProjectType::className(), ['type_id' => 'project_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbStudentHasProjects()
    {
        return $this->hasMany(ScbStudentHasProject::className(), ['project_code' => 'project_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbTeacherHasProjects()
    {
        return $this->hasMany(ScbTeacherHasProject::className(), ['project_code' => 'project_code']);
    }

    public function getScbTeacherHasTypes()
    {
        return $this->hasMany(ScbTeacherHasType::className(), ['project_code' => 'project_code']);
    }

    public function uploadFile()
    {
        if ($this->validate()) {
            if ($this->project_file) {
                if ($this->isNewRecord) {
                    $fileName = time().$this->project_file;
                    //$fileName = iconv('UTF-8','WINDOWS-874',$this->scholarship_file).'.'.$this->extension;
                } else {
                    $fileName = $this->getOldAttribute('project_file');
                }
                $this->project_file->saveAs(Yii::getAlias('@webroot') . '/' . $this->uploadFilesFolder . '/' . $fileName);
                return $fileName;
            }
        }
        return $this->isNewRecord ? false : $this->getOldAttribute('project_file');
    }

    public function uploadImage()
    {
        if ($this->validate()) {
            if ($this->project_image) {
                if ($this->isNewRecord) {
                    $fileName = substr(md5(rand(1, 1000) . time()), 0, 30) . '.' . $this->project_image->extension;
                } else {
                    $fileName = $this->getOldAttribute('scholarship_image');
                }
                $this->project_image->saveAs(Yii::getAlias('@webroot') . '/' . $this->uploadImageFolder . '/' . $fileName);
                return $fileName;
            }
        }
        return $this->isNewRecord ? false : $this->getOldAttribute('project_image');
    }
}
