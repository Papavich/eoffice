<?php

namespace app\modules\eproject\models;

use Yii;

/**
 * This is the model class for table "eoffice_central.view_pis_major".
 *
 * @property string $id
 * @property string $name_th
 * @property string $code
 * @property string $name_en
 */
class Major extends \yii\db\ActiveRecord
{
    public static function primaryKey()
    {
        return ['id'];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eoffice_central.view_pis_major';
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
            [['id'], 'required'],
            [['id'], 'string', 'max' => 50],
            [['name_th'], 'string', 'max' => 200],
            [['code', 'name_en'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_th' => 'Name Th',
            'code' => 'Code',
            'name_en' => 'Name En',
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEproAdviserBroadcastXMajors()
    {
        return $this->hasMany(AdviserBroadcastXMajor::className(), ['major_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjects()
    {
        return $this->hasMany(Project::className(), ['major_id' => 'id']);
    }
    public function getName(){
        if(Yii::$app->language=='th'){
            return $this->name_th;
        }else{
            return $this->name_en;
        }
    }
}
