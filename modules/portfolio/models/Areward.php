<?php

namespace app\modules\portfolio\models;

use Yii;

/**
 * This is the model class for table "areward".
 *
 * @property int $areward_id
 * @property string $areward_name
 * @property string $date_areward
 * @property int $level_level_id
 * @property int $institution_ag_award_id
 * @property string $data_detail
 * @property string $image
 * @property int $member_member_id
 * @property int $std_id
 * @property int $person_id
 * @property int $base_tambon_id
 *
 * @property BaseTambon $baseTambon
 * @property Institution $institutionAgAward
 * @property Level $levelLevel
 * @property Member $memberMember
 * @property ProPub[] $proPubs
 */
class Areward extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'areward';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_pfo');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['areward_name'], 'required'],
            [['date_areward'], 'safe'],
            [['level_level_id', 'institution_ag_award_id', 'member_member_id', 'std_id', 'person_id', 'base_tambon_id'], 'integer'],
            [['areward_name'], 'string', 'max' => 50],
            [['data_detail'], 'string', 'max' => 200],
            [['image'], 'string', 'max' => 45],
            [['base_tambon_id'], 'exist', 'skipOnError' => true, 'targetClass' => BaseTambon::className(), 'targetAttribute' => ['base_tambon_id' => 'id']],
            [['institution_ag_award_id'], 'exist', 'skipOnError' => true, 'targetClass' => Institution::className(), 'targetAttribute' => ['institution_ag_award_id' => 'ag_award_id']],
            [['level_level_id'], 'exist', 'skipOnError' => true, 'targetClass' => Level::className(), 'targetAttribute' => ['level_level_id' => 'level_id']],
            [['member_member_id'], 'exist', 'skipOnError' => true, 'targetClass' => Member::className(), 'targetAttribute' => ['member_member_id' => 'member_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'areward_id' => 'รหัสรางวัล',
            'areward_name' => 'ชื่อรางวัล',
            'date_areward' => 'วันที่ได้รับรางวัล',
            'level_level_id' => 'รหัสอันดับ',
            'institution_ag_award_id' => 'สถาบันที่ให้รางวัล',
            'data_detail' => 'Data Detail',
            'image' => 'รูปภาพ',
            'member_member_id' => 'Member Member ID',
            'std_id' => 'Std ID',
            'person_id' => 'Person ID',
            'base_tambon_id' => 'Base Tambon ID',
            'Tel' => 'โทรศัพท์',
            'name' => 'ชื่อ',
            'lastname' => 'นามสกุล'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseTambon()
    {
        return $this->hasOne(BaseTambon::className(), ['id' => 'base_tambon_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstitutionAgAward()
    {
        return $this->hasOne(Institution::className(), ['ag_award_id' => 'institution_ag_award_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLevelLevel()
    {
        return $this->hasOne(Level::className(), ['level_id' => 'level_level_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemberMember()
    {
        return $this->hasOne(Member::className(), ['member_id' => 'member_member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProPubs()
    {
        return $this->hasMany(ProPub::className(), ['areward_order_areward_order_id' => 'areward_id']);
    }
}
