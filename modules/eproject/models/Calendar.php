<?php

namespace app\modules\eproject\models;

use app\modules\eproject\components\ModelHelper;
use app\modules\eproject\controllers;
use Yii;

/**
 * This is the model class for table "epro_calendar".
 *
 * @property integer $id
 * @property string $detail
 * @property string $start_date
 * @property string $end_date
 * @property integer $crby
 * @property integer $udby
 * @property string $crtime
 * @property string $udtime
 *
 * @property CalendarDocument[] $calendarDocuments
 * @property Download[] $downloads
 */
class Calendar extends \yii\db\ActiveRecord
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
        return 'epro_calendar';
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
            [['detail', 'start_date', 'end_date', ], 'required'],
            [['detail'], 'string'],
            [['start_date', 'end_date', 'crtime', 'udtime'], 'safe'],
            [['crby', 'udby'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'detail' => controllers::t( 'label', 'Detail' ),
            'start_date' => controllers::t( 'label', 'Start Date' ),
            'end_date' => controllers::t( 'label', 'End Date' ),
            'crby' => 'สร้างโดย',
            'udby' => 'แก้ไขล่าสุดโดย',
            'crtime' => 'สร้างเมื่อ',
            'udtime' => 'แก้ไขล่าสุด',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCalendarDocuments()
    {
        return $this->hasMany(CalendarDocument::className(), ['calendar_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDownloads()
    {
        return $this->hasMany(Download::className(), ['id' => 'download_id'])
            ->viaTable('epro_calendar_document', ['calendar_id' => 'id']);
    }

}
