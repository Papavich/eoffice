<?php

namespace app\modules\portfolio\models;

use Yii;

/**
 * This is the model class for table "academic_positions".
 *
 * @property string $academic_positions_id
 * @property string $academic_positions_no
 * @property string $person_id
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
            [['academic_positions_id', 'academic_positions_no', 'academic_positions', 'academic_positions_eng', 'academic_positions_abb'], 'string', 'max' => 50],
            [['person_id'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'academic_positions_id' => 'Academic Positions ID',
            'academic_positions_no' => 'Academic Positions No',
            'person_id' => 'Person ID',
            'academic_positions' => 'Academic Positions',
            'academic_positions_eng' => 'Academic Positions Eng',
            'academic_positions_abb' => 'Academic Positions Abb',
        ];
    }
}
