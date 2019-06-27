<?php

namespace app\modules\correspondence\models\model_main;

use Yii;

/**
 * This is the model class for table "eoffice_central.view_pis_major".
 *
 * @property int $id
 * @property string $name_th
 * @property string $code
 * @property string $name_en
 */
class EofficeCentralViewPisMajor extends \yii\db\ActiveRecord
{
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
        return Yii::$app->get('db_cms');
    }
    public static function primaryKey()
    {
        return ['id'];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name_th', 'code', 'name_en'], 'required'],
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
}
