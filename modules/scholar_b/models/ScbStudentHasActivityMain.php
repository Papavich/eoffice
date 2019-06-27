<?php

namespace app\modules\scholar_b\models;

use Yii;
use app\modules\scholar_b\controllers;
use app\modules\scholar_b\components\ModelHelper;

/**
 * This is the model class for table "scb_student_has_activity_main".
 *
 * @property string $student_id
 * @property int $activity_main_id
 * @property int $year
 * @property int $select_activity_status
 * @property string $activity_img
 *
 * @property ScbActivityMain $activityMain
 * @property ScbStudent $student
 */
class ScbStudentHasActivityMain extends \yii\db\ActiveRecord
{
    public $uploadImageFolder = '/web_scb/uploads/activity/images';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scb_student_has_activity_main';
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
            [['student_id', 'activity_main_id', 'year' ,'activity_img'], 'required'],
            [['activity_main_id', 'year', 'select_activity_status'], 'integer'],
            [['student_id'], 'string', 'max' => 11],
            [['activity_img'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png,jpg'],
            [['student_id', 'activity_main_id', 'year'], 'unique', 'targetAttribute' => ['student_id', 'activity_main_id', 'year']],
            [['activity_main_id', 'year'], 'exist', 'skipOnError' => true, 'targetClass' => ScbActivityMain::className(), 'targetAttribute' => ['activity_main_id' => 'act_main_id', 'year' => 'year']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => ScbStudent::className(), 'targetAttribute' => ['student_id' => 'student_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'student_id' => '',
            'activity_main_id' => '',
            'year' => '',
            'select_activity_status' => '',
            'activity_img' => 'อัพโหลดภาพหลักฐานการเข้าร่วม',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivityMain()
    {
        return $this->hasOne(ScbActivityMain::className(), ['act_main_id' => 'activity_main_id', 'year' => 'year']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(ScbStudent::className(), ['student_id' => 'student_id']);
    }

    public function uploadImage()
    {

        if ($this->validate()) {
            if ($this->activity_img) {
                $fileName = $this->activity_main_id.$this->student_id.$this->year.".".$this->activity_img->extension;
               // return Yii::getAlias('@webroot') . $this->uploadImageFolder . '/' . $fileName;
               // exit;
                $this->activity_img->saveAs(Yii::getAlias('@webroot') . $this->uploadImageFolder . '/' . $fileName);
                return $fileName;
            }
        }
        return $this->isNewRecord ? false : $this->getOldAttribute('activity_img');
    }

    public function uploadImageRep()
    {
        if ($this->validate()) {
            if ($this->activity_img) {
                $fileName = $this->getOldAttribute('activity_img');
                $this->activity_img->saveAs(Yii::getAlias('@webroot') . $this->uploadImageFolder . '/' . $fileName);
                return $fileName;
            }
        }
        return $this->isNewRecord ? false : $this->getOldAttribute('activity_img');
    }
    public function getImage()
    {
        return Yii::getAlias('@web') . $this->uploadImageFolder . '/' . $this->activity_img;
    }

}
