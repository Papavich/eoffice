<?php

namespace app\modules\pfc\models;

use Yii;

/**
 * This is the model class for table "process".
 *
 * @property string $process_id
 * @property int $project_id
 * @property string $process_gantt_tpye_code
 *
 * @property ProcessProgress[] $processProgresses
 */
class Process extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'process';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_pfc');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['process_id', 'project_id', 'process_gantt_tpye_code'], 'required'],
            [['project_id'], 'integer'],
            [['process_id', 'process_gantt_tpye_code'], 'string', 'max' => 100],
            [['process_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'process_id' => 'Process ID',
            'project_id' => 'Project ID',
            'process_gantt_tpye_code' => 'Process Gantt Tpye Code',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcessProgresses()
    {
        return $this->hasMany(ProcessProgress::className(), ['process_id' => 'process_id']);
    }
}
