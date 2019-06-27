<?php

namespace app\modules\pfc\models;

use app\modules\pfc\components\ModelHelper;
use app\modules\pfc\controllers;
use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "epro_project".
 *
 * @property int $id
 * @property int $year_id
 * @property int $semester_id
 * @property int $major_id
 * @property int $number
 * @property string $name_th
 * @property string $name_en
 * @property string $image
 * @property string $abstract
 * @property int $crby
 * @property int $udby
 * @property string $crtime
 * @property string $udtime
 *

 */
class ViewProject extends \yii\db\ActiveRecord
{
    /**
     * @return array
     */
    public function behaviors()
    {
        return ModelHelper::behaviors();
    }

    const UPLOAD_FOLDER = 'web_eproject/uploads/project_images'; //ที่เก็บรูปภาพ

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'epro_project';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get( 'db_eproject' );
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['year_id', 'semester_id', 'major_id', 'number', 'crby', 'udby'], 'integer'],
            [['major_id',], 'required'],
            [['abstract'], 'string'],
            ['image', 'file', 'maxSize' => 1024 * 1024 * 50, 'extensions' => ['png', 'jpg','gif','jpeg'], 'checkExtensionByMimeType' => false],
            [['crtime', 'udtime'], 'safe'],
            [['name_th', 'name_en',], 'string', 'max' => 255],
         ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'year_id' => 'Year ID',
            'semester_id' => 'Semester ID',
            'major_id' => 'Major ID',
            'number' => 'Number',
            'name_th' => controllers::t( 'label', 'Project Name (Thai)' ),
            'name_en' => controllers::t( 'label', 'Project Name (English)' ),
            'image' => 'Image',
            'abstract' => controllers::t( 'label', 'Abstract' ),
            'crby' => 'Crby',
            'udby' => 'Udby',
            'crtime' => 'Crtime',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdvises()
    {
        return $this->hasMany( ViewAdvise::className(), ['project_id' => 'id'] );
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentProjects()
    {
        return $this->hasMany( ViewStudentProject::className(), ['project_id' => 'id'] );
    }


}
