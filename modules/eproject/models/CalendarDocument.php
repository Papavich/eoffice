<?php

namespace app\modules\eproject\models;

use app\modules\eproject\components\ModelHelper;
use Yii;

/**
 * This is the model class for table "epro_calendar_document".
 *
 * @property integer $download_id
 * @property integer $calendar_id
 * @property integer $crby
 * @property integer $udby
 * @property string $crtime
 * @property string $udtime
 *
 * @property Calendar $calendar
 * @property Download $download
 */
class CalendarDocument extends \yii\db\ActiveRecord
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
        return 'epro_calendar_document';
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
            [['download_id', 'calendar_id', ], 'required'],
            [['download_id', 'calendar_id', 'crby', 'udby'], 'integer'],
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
            'download_id' => 'Download ID',
            'calendar_id' => 'Calendar ID',
            'crby' => 'Crby',
            'udby' => 'Udby',
            'crtime' => 'Crtime',
            'udtime' => 'Udtime',
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
