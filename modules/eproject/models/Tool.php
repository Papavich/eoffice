<?php

namespace app\modules\eproject\models;

use app\modules\eproject\components\ModelHelper;
use app\modules\eproject\controllers;
use Yii;

/**
 * This is the model class for table "epro_tool".
 *
 * @property integer $id
 * @property integer $crby
 * @property integer $udby
 * @property string $crtime
 * @property string $udtime
 * @property string $name
 *
 * @property ProjectXTool[] $eproProjectXTools
 */
class Tool extends \yii\db\ActiveRecord
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
        return 'epro_tool';
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
            [[], 'required'],
            [['crby', 'udby'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => controllers::t('label','ID'),
            'crby' => 'Crby',
            'udby' => 'Udby',
            'crtime' => 'Crtime',
            'udtime' => 'Udtime',
            'name' => controllers::t('label','Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectXTools()
    {
        return $this->hasMany( ProjectXTool::className(), ['tool_id' => 'id'] );
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->updateElastic();
        parent::afterSave( $insert, $changedAttributes );
    }

    public function updateElastic()
    {
        if (ElasticTool::get( $this->id )) {
            $model = ElasticTool::get( $this->id );
        } else {
            $model = new ElasticTool();
            $model->primaryKey = $this->id;
        }
        $model->title = $this->name;
        $model->save();
    }
}
