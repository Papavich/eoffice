<?php

namespace app\modules\portfolio\models;

use Yii;

/**
 * This is the model class for table "leave".
 *
 * @property integer $id
 * @property string $person_id
 * @property string $leave_year
 * @property string $leave_type
 * @property string $leave_date_start
 * @property string $leave_date_end
 * @property float $leave_num
 * @property string $leave_reason
 * @property string $leave_status
 *
 * @property Person $person
 */
class Leave extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */


    public static function tableName()
    {
        return 'leave';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['person_id','leave_year', 'leave_type', 'leave_day', 'leave_date_start','leave_date_end'], 'required','message' => 'กรุณาเลือก/กรอก ข้อมูลให้ครบ'],
            [['leave_date_start', 'leave_date_end'], 'safe'],
            [['person_id'], 'string', 'max' => 5],
            [['leave_year'], 'string', 'max' => 4],
            [['leave_type'], 'string', 'max' => 20],
            [['leave_day'], 'string', 'max' => 20],
            [['leave_reason'], 'string', 'max' => 255],
            [['leave_status'], 'string', 'max' => 1],
            [['person_id'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(), 'targetAttribute' => ['person_id' => 'person_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'รหัส',
            'person_id' => 'บุคลากร',
            'leave_year' => 'ประจำปี',
            'leave_type' => 'ประเภทการลา',
            'leave_day' => 'รูปแบบการลา',
            'leave_date_start' => 'วันที่เริ่ม',
            'leave_date_end' => 'วันที่สิ้นสุด',
            'leave_num' => 'จำนวนวัน',
            'leave_reason' => 'เหตุผล',
            'leave_status' => 'สถานะการลา',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(Person::className(), ['person_id' => 'person_id']);
    }
    
    
    public function getStatuslabel() {
        if ($this->leave_status == '1') {
            return 'อนุมัติแล้ว';
        }
        return 'ยังไม่อนุมัติ';
    }
}
