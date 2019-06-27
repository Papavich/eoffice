<?php

namespace app\modules\portfolio\models;

use Yii;

/**
 * This is the model class for table "file_work".
 *
 * @property integer $file_id
 * @property string $file_name
 *
 * @property Publication[] $publications
 */
class File_Work extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'file_work';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_pfo');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['file_id', 'file_name'], 'required'],
            [['file_id'], 'integer'],
            [['file_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'file_id' => 'File ID',
            'file_name' => 'File Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublications()
    {
        return $this->hasMany(Publication::className(), ['file_work_file_id' => 'file_id']);
    }
}
