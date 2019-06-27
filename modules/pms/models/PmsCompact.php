<?php

namespace app\modules\pms\models;

use Yii;

/**
 * This is the model class for table "pms_compact".
 *
 * @property int $compact_id
 * @property string $date_start
 * @property string $date_end
 *
 * @property PmsCompactHasExecute[] $pmsCompactHasExecutes
 */
class PmsCompact extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pms_compact';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_pms');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_start', 'date_end'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'compact_id' => 'Compact ID',
            'date_start' => 'Date Start',
            'date_end' => 'Date End',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPmsCompactHasExecutes()
    {
        return $this->hasMany(PmsCompactHasExecute::className(), ['pms_compact_compact_id' => 'compact_id']);
    }
}
