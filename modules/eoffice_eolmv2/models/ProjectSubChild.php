<?php

namespace app\modules\eoffice_eolmv2\models;

use Yii;

/**
 * This is the model class for table "project_sub".
 *
 * @property integer $ProSub_id
 * @property string $ProSub_name
 * @property string $ProSub_code
 * @property string $ProSub_note
 *
 * @property EolmApprovalform[] $eolmApprovalforms
 */
class ProjectSubChild extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pro_child';
    }
    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_eolmv2');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pro_child_id', 'pro_child_name'], 'required'],
            [['pro_child_id'], 'integer'],
            [['pro_child_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pro_child_id' => 'Pro Child Id',
            'pro_child_name' => 'Pro Child Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmApprovalforms()
    {
        return $this->hasMany(EolmApprovalform::className(), ['pro_child_id' => 'pro_child_id']);
    }
}
