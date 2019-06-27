<?php

namespace app\modules\eoffice_eolm\models;

use Yii;

/**
 * This is the model class for table "eolm_rate_cost".
 *
 * @property int $academic_positions_id
 * @property string $eolm_pos_allowance_rate
 * @property string $eolm_pos_singlebed_rate
 * @property string $eolm_pos_twinbeds_rate
 * @property string $eolm_pos_singlebed_rate2
 * @property string $eolm_pos_twinbeds_rate2
 */
class EolmRateCost extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eolm_rate_cost';
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
            [['academic_positions_id'], 'integer'],
            [['eolm_pos_allowance_rate', 'eolm_pos_singlebed_rate', 'eolm_pos_twinbeds_rate', 'eolm_pos_singlebed_rate2', 'eolm_pos_twinbeds_rate2'], 'number'],
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
            'eolm_pos_allowance_rate' => 'Eolm Pos Allowance Rate',
            'eolm_pos_singlebed_rate' => 'Eolm Pos Singlebed Rate',
            'eolm_pos_twinbeds_rate' => 'Eolm Pos Twinbeds Rate',
            'eolm_pos_singlebed_rate2' => 'Eolm Pos Singlebed Rate2',
            'eolm_pos_twinbeds_rate2' => 'Eolm Pos Twinbeds Rate2',
        ];
    }
}
