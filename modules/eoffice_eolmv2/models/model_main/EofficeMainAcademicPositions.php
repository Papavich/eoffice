<?php

namespace app\modules\eoffice_eolmv2\models\model_main;

use Yii;

/**
 * This is the model class for table "eoffice_central.academic_positions".
 *
 * @property string $academic_positions_id
 * @property string $academic_positions_abb_thai
 * @property string $academic_positions
 * @property string $academic_positions_eng
 * @property string $academic_positions_abb
 */
class EofficeMainAcademicPositions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eoffice_central.academic_positions';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_eolm');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['academic_positions_id'], 'required'],
            [['academic_positions_id', 'academic_positions_abb_thai', 'academic_positions', 'academic_positions_eng', 'academic_positions_abb'], 'string', 'max' => 50],
            [['academic_positions_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'academic_positions_id' => 'Academic Positions ID',
            'academic_positions_abb_thai' => 'Academic Positions Abb Thai',
            'academic_positions' => 'Academic Positions',
            'academic_positions_eng' => 'Academic Positions Eng',
            'academic_positions_abb' => 'Academic Positions Abb',
        ];
    }
}
