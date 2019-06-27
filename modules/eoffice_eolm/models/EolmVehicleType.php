<?php

namespace app\modules\eoffice_eolm\models;
use yii\helpers\ArrayHelper;

use Yii;

/**
 * This is the model class for table "eolm_vehicle_type".
 *
 * @property integer $eolm_vehicle_type_id
 * @property string $eolm_vehicle_type_name
 *
 * @property EolmApprovalformHasVehicle[] $eolmApprovalformHasVehicles
 * @property EolmApprovalform[] $eolmApps
 */
class EolmVehicleType extends \yii\db\ActiveRecord
{
    const VEHICLE_BUS = 1;
    const VEHICLE_CAB = 2;
    const VEHICLE_CAR = 3;
    const VEHICLE_OFFICE = 4;
    const VEHICLE_PLANE = 5;
    const VEHICLE_bus = 6;

    public static function itemsAlias($key){

        $items = [
            'vehicles'=>[
                self::VEHICLE_BUS => 'ยานพาหนะประจำทาง',
                self::VEHICLE_CAB => 'ยานพาหนะรับจ้าง',
                self::VEHICLE_CAR => 'ยานพาหนะส่วนตัว',
                self::VEHICLE_OFFICE => 'ยานพาหนะของทางราชการ',
                self::VEHICLE_PLANE => 'เครื่องบิน ระหว่าง',
                self::VEHICLE_bus => 'อื่น ๆ'
            ],

        ];
        return ArrayHelper::getValue($items,$key,[]);
        //return array_key_exists($key, $items) ? $items[$key] : [];
    }


    public function getItemVehicle()
    {
        return self::itemsAlias('vehicles');
    }



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eolm_vehicle_type';
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
            [['eolm_vehicle_type_id', 'eolm_vehicle_type_name'], 'required'],
            [['eolm_vehicle_type_id'], 'integer'],
            [['eolm_vehicle_type_name'], 'string', 'max' => 100],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'eolm_vehicle_type_id' => 'Eolm Vehicle Type ID',
            'eolm_vehicle_type_name' => 'Eolm Vehicle Type Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmApprovalformHasVehicles()
    {
        return $this->hasMany(EolmApprovalformHasVehicle::className(), ['eolm_vehicle_type_id' => 'eolm_vehicle_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEolmApps()
    {
        return $this->hasMany(EolmApprovalform::className(), ['eolm_app_id' => 'eolm_app_id'])->viaTable('eolm_approvalform_has_vehicle', ['eolm_vehicle_type_id' => 'eolm_vehicle_type_id']);
    }


}
