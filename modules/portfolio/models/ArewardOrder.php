<?php

namespace app\modules\portfolio\models;

use Yii;

/**
 * This is the model class for table "areward_order".
 *
 * @property int $areward_order_id
 * @property string $areward_name
 * @property string $date_areward
 * @property int $level_level_id
 * @property int $advisor_id
 * @property int $std_id
 * @property int $person_id
 * @property int $institution_ag_award_id
 * @property string $data_detail
 * @property string $image
 * @property int $cities_id
 * @property int $member_member_id
 *
 * @property Cities $cities
 * @property Institution $institutionAgAward
 * @property Level $levelLevel
 * @property Member $memberMember
 * @property ProPub[] $proPubs
 */
class ArewardOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'areward_order';
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
            [['areward_name'], 'required'],
            [['date_areward'], 'safe'],
            [['level_level_id', 'advisor_id', 'std_id', 'person_id', 'institution_ag_award_id', 'cities_id', 'member_member_id'], 'integer'],
            [['areward_name'], 'string', 'max' => 50],
            [['data_detail'], 'string', 'max' => 200],
            [['image'], 'string', 'max' => 45],
            [['cities_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::className(), 'targetAttribute' => ['cities_id' => 'id']],
            [['institution_ag_award_id'], 'exist', 'skipOnError' => true, 'targetClass' => Institution::className(), 'targetAttribute' => ['institution_ag_award_id' => 'ag_award_id']],
            [['level_level_id'], 'exist', 'skipOnError' => true, 'targetClass' => Level::className(), 'targetAttribute' => ['level_level_id' => 'level_id']],
            [['member_member_id'], 'exist', 'skipOnError' => true, 'targetClass' => Member::className(), 'targetAttribute' => ['member_member_id' => 'member_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'areward_order_id' => 'Areward Order ID',
            'areward_name' => 'Areward Name',
            'date_areward' => 'Date Areward',
            'level_level_id' => 'Level Level ID',
            'advisor_id' => 'Advisor ID',
            'std_id' => 'Std ID',
            'person_id' => 'Person ID',
            'institution_ag_award_id' => 'Institution Ag Award ID',
            'data_detail' => 'Data Detail',
            'image' => 'Image',
            'cities_id' => 'Cities ID',
            'member_member_id' => 'Member Member ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasOne(Cities::className(), ['id' => 'cities_id']);
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
        return $this->hasMany(ProPub::className(), ['areward_order_areward_order_id' => 'areward_order_id']);
    }
}
