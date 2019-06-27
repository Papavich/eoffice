<?php

namespace app\modules\eproject\models;

use app\modules\eproject\components\ModelHelper;
use Yii;

/**
 * This is the model class for table "epro_download_x_calendar".
 *
 * @property integer $id
 * @property integer $crby
 * @property integer $udby
 * @property string $crtime
 * @property string $udtime
 * @property integer $download_id
 * @property integer $calendar_id
 *
 * @property Calendar $calendar
 * @property Download $download
 */
class DownloadXCalendar extends \yii\db\ActiveRecord
{
    /**
     * @return array
     */
    public function behaviors()
    {
        return ModelHelper::behaviors();
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'epro_download_x_calendar';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_eproject');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'download_id', 'calendar_id'], 'required'],
            [['crby', 'udby', 'download_id', 'calendar_id'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
            [['calendar_id'], 'exist', 'skipOnError' => true, 'targetClass' => Calendar::className(), 'targetAttribute' => ['calendar_id' => 'id']],
            [['download_id'], 'exist', 'skipOnError' => true, 'targetClass' => Download::className(), 'targetAttribute' => ['download_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'crby' => 'Crby',
            'udby' => 'Udby',
            'crtime' => 'Crtime',
            'udtime' => 'Udtime',
            'download_id' => 'แบบฟอร์มที่เกี่ยวข้อง',
            'calendar_id' => 'Calendar ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCalendar()
    {
        return $this->hasOne(Calendar::className(), ['id' => 'calendar_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDownload()
    {
        return $this->hasOne(Download::className(), ['id' => 'download_id']);
    }
}
