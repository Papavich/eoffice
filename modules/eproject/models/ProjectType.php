<?php

namespace app\modules\eproject\models;

use app\modules\eproject\components\ModelHelper;
use Yii;

/**
 * This is the model class for table "epro_project_type".
 *
 * @property integer $id
 * @property string $name
 * @property string $crtime
 * @property string $udtime
 * @property integer $crby
 * @property integer $udby
 *
 * @property ProjectXProjectType[] $projectXProjectTypes
 */
class ProjectType extends \yii\db\ActiveRecord
{
    /**
     * @return array
     */
    public function behaviors()
    {
        return ModelHelper::behaviors();
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'epro_project_type';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_eproject');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['crtime', 'udtime'], 'safe'],
            [['crby', 'udby'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ชื่อ',
            'crby' => 'สร้างโดย',
            'udby' => 'แก้ไขล่าสุดโดย',
            'crtime' => 'สร้างเมื่อ',
            'udtime' => 'แก้ไขล่าสุด',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEproProjectXProjectTypes()
    {
        return $this->hasMany(ProjectXProjectType::className(), ['project_type_id' => 'id']);
    }
    public function getProjectCountByUserId()
    {
        return ProjectXProjectType::find()
            ->innerJoin( Advise::tableName(), Advise::tableName() . '.project_id = ' . ProjectXProjectType::tableName() . '.project_id AND adviser_type_id=' . AdviserType::TYPE_PRIMARY_ADVISER )
            ->groupBy( 'project_id' )
            ->where( ['adviser_id' => Yii::$app->user->identity->getId()] )
            ->andWhere( ['project_type_id' => $this->id] )
            ->count();

    }
}
