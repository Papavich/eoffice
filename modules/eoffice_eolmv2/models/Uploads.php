<?php

namespace app\modules\eoffice_eolmv2\models;

use Yii;

/**
 * This is the model class for table "uploads".
 *
 * @property int $upload_id
 * @property string $ref
 * @property string $file_name ชื่อไฟล์
 * @property string $real_filename ชื่อไฟล์จริง
 * @property string $create_date
 * @property int $type ประเภท
 */
class Uploads extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'uploads';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_eolmv2');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_date'], 'safe'],
            [['type'], 'integer'],
            [['ref'], 'string', 'max' => 50],
            [['file_name', 'real_filename'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'upload_id' => 'Upload ID',
            'ref' => 'Ref',
            'file_name' => 'File Name',
            'real_filename' => 'Real Filename',
            'create_date' => 'Create Date',
            'type' => 'Type',
        ];
    }
}
