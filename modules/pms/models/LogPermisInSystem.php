<?php

namespace app\modules\pms\models;

use Yii;

/**
 * This is the model class for table "log_permis_in_system".
 *
 * @property int $id
 * @property string $event_date
 * @property string $status
 * @property string $person
 * @property string $comment
 * @property int $status_process
 * @property int $pms_compact_has_prosub_id
 * @property string $pms_project_sub_prosub_code
 */
class LogPermisInSystem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'log_permis_in_system';
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
            [['status_process', 'pms_compact_has_prosub_id'], 'integer'],
            [['event_date'], 'string', 'max' => 50],
            [['status', 'person'], 'string', 'max' => 100],
            [['comment'], 'string', 'max' => 256],
            [['pms_project_sub_prosub_code'], 'string', 'max' => 17],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'event_date' => 'Event Date',
            'status' => 'Status',
            'person' => 'Person',
            'comment' => 'Comment',
            'status_process' => 'Status Process',
            'pms_compact_has_prosub_id' => 'Pms Compact Has Prosub ID',
            'pms_project_sub_prosub_code' => 'Pms Project Sub Prosub Code',
        ];
    }
}
