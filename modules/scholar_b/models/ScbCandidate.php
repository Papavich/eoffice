<?php

namespace app\modules\scholar_b\models;

use Yii;
use app\modules\scholar_b\components\ModelHelper;

/**
 * This is the model class for table "scb_candidate".
 *
 * @property string $id_card
 * @property string $password
 * @property string $prefix
 * @property string $firstname
 * @property string $lastname
 * @property string $blood_type
 * @property string $birth_date
 * @property string $origin
 * @property string $nationality
 * @property string $religion
 * @property string $place_of_birth
 * @property string $email
 * @property string $mobile
 * @property string $status
 * @property string $schoolname
 * @property string $school_status
 * @property int $total_brethren
 * @property int $number_of_sister
 * @property int $number_of_brother
 * @property int $crby
 * @property string $crtime
 * @property int $udby
 * @property string $udtime
 *
 * @property ScbAddressCandidate[] $scbAddressCandidates
 * @property ScbCandidateHasParents[] $scbCandidateHasParents
 * @property ScbParents[] $scbParentsIdCardParents
 * @property ScbEnrollScholarship[] $scbEnrollScholarships
 * @property ScbScholarshipTypeHasYear[] $scholarships
 */
class ScbCandidate extends \yii\db\ActiveRecord
{
    public $uploadFilesFolder = '/web_scb/uploads/import-cand/';


    public function behaviors()
    {
        return ModelHelper::behaviors();
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scb_candidate';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_scb');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_card'], 'validateIdCard'],
            [['birth_date', 'crtime', 'udtime'], 'safe'],
            [['total_brethren', 'number_of_sister', 'number_of_brother', 'crby', 'udby'], 'integer'],
            [['id_card'], 'string', 'max' => 17],
            [['password'], 'string', 'max' => 128],
            [['prefix'], 'string', 'max' => 6],
            [['firstname', 'lastname', 'place_of_birth'], 'string', 'max' => 30],
            [['blood_type'], 'string', 'max' => 2],
            [['origin', 'nationality', 'religion'], 'string', 'max' => 15],
            [['email'], 'string', 'max' => 45],
            [['mobile'], 'string', 'max' => 11],
            [['status'], 'string', 'max' => 20],
            [['school_status'], 'string', 'max' => 10],
            [['schoolname'], 'string', 'max' => 50],
            [['id_card'], 'unique'],
        ];
    }

    public function validateIdCard()
    {
        $id = str_split(str_replace('-','', $this->id_card)); //ตัดรูปแบบและเอา ตัวอักษร ไปแยกเป็น array $id
        $sum = 0;
        $total = 0;
        $digi = 13;

        for($i=0; $i<12; $i++){
            $sum = $sum + (intval($id[$i]) * $digi);
            $digi--;
        }
        $total = (11 - ($sum % 11)) % 10;

        if($total != $id[12]){ //ตัวที่ 13 มีค่าไม่เท่ากับผลรวมจากการคำนวณ ให้ add error
            $this->addError('id_card', 'หมายเลขบัตรประชาชนไม่ถูกต้อง');
        }


    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_card' => 'เลขบัตรประจำตัวประชาชน',
            'password' => 'รหัสผ่าน',
            'prefix' => 'คำนำหน้า',
            'firstname' => 'ชื่อจริง',
            'lastname' => 'นามสกุล',
            'blood_type' => 'หมู่โลหิต',
            'birth_date' => 'วัน/เดือน/ปีเกิด',
            'origin' => 'เชื้อชาติ',
            'nationality' => 'สัญชาติ',
            'religion' => 'ศาสนา',
            'place_of_birth' => 'สถานที่เกิด',
            'email' => 'อีเมล์',
            'mobile' => 'เบอร์โทรศัพท์ติดต่อ',
            'status' => 'สถานะ',
            'schoolname' => 'โรงเรียน',
            'school_status' => 'สถานะโรงเรียน',
            'total_brethren' => 'จำนวนพี่น้อง',
            'number_of_sister' => 'จำนวนผู้หญิง',
            'number_of_brother' => 'จำนวนผู้ชาย',
            //'crby' => 'Crby',
            //'crtime' => 'Crtime',
            //'udby' => 'Udby',
            //'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbAddressCandidates()
    {
        return $this->hasMany(ScbAddressCandidate::className(), ['scb_candidate_id_card' => 'id_card']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbCandidateHasParents()
    {
        return $this->hasMany(ScbCandidateHasParents::className(), ['scb_candidate_id_card' => 'id_card']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbParentsIdCardParents()
    {
        return $this->hasMany(ScbParents::className(), ['id_card_parent' => 'scb_parents_id_card_parent'])->viaTable('scb_candidate_has_parents', ['scb_candidate_id_card' => 'id_card']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbEnrollScholarships()
    {
        return $this->hasMany(ScbEnrollScholarship::className(), ['candidate_id_card' => 'id_card']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScholarships()
    {
        return $this->hasMany(ScbScholarshipTypeHasYear::className(), ['scholarship_id' => 'scholarship_id', 'scholarship_year' => 'scholarship_year'])->viaTable('scb_enroll_scholarship', ['candidate_id_card' => 'id_card']);
    }
}
