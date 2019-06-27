<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "academic_positions".
 *
 * @property string $academic_positions_id
 * @property string $academic_positions_abb_thai
 * @property string $academic_positions
 * @property string $academic_positions_eng
 * @property string $academic_positions_abb
 */
class AcademicPositions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'academic_positions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['academic_positions_id'], 'required'],
            [['academic_positions_id', 'academic_positions_abb_thai', 'academic_positions', 'academic_positions_eng', 'academic_positions_abb'], 'string', 'max' => 50],
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
