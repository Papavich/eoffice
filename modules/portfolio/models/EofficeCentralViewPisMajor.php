<?php

namespace app\modules\scholar_b\models\model_main;

use Yii;

/**
 * This is the model class for table "Eoffice_central.view_pis_major".
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
        return 'Eoffice_central.view_pis_major';
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
