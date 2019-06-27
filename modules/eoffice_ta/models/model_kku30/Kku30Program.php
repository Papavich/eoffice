<?php

namespace app\modules\eoffice_ta\models\model_kku30;

use Yii;

/**
 * This is the model class for table "eoffice_kku30.kku30_program".
 *
 * @property string $program_id
 * @property int $program_class
 * @property string $program_name
 * @property string $program_nameeng
 */
class Kku30Program extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eoffice_kku30.kku30_program';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_kku30');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['program_id', 'program_class', 'program_name', 'program_nameeng'], 'required'],
            [['program_class'], 'integer'],
            [['program_id'], 'string', 'max' => 10],
            [['program_name', 'program_nameeng'], 'string', 'max' => 50],
            [['program_id', 'program_class'], 'unique', 'targetAttribute' => ['program_id', 'program_class']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'program_id' => 'Program ID',
            'program_class' => 'Program Class',
            'program_name' => 'Program Name',
            'program_nameeng' => 'Program Nameeng',
        ];
    }
}
