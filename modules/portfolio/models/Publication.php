<?php

namespace app\modules\portfolio\models;

use Yii;

/**
 * This is the model class for table "publication".
 *
 * @property int $pub_id
 * @property string $pub_name_thai
 * @property string $pub_name_eng
 * @property string $book_name_thai
 * @property string $book_name_eng
 * @property string $date
 * @property string $acticle_detail
 * @property string $page_number
 * @property string $abstract
 * @property string $press
 * @property string $publisher
 * @property string $ISBN
 * @property int $auth_level_id
 * @property string $issn
 * @property string $dataval
 * @property string $article
 * @property string $number
 * @property string $issuance
 * @property string $dataindex
 * @property string $impact_factor
 * @property string $doi
 * @property string $namework_eng
 * @property string $namework_thai
 * @property int $person_id
 * @property int $db_db_id
 * @property int $present_present_id
 * @property string $meeting_name_thai
 * @property string $meeting_name_eng
 * @property string $bounty
 * @property string $editor
 * @property string $work_name
 * @property int $institution_ag_award_id
 * @property int $sponsor_sponsor_id
 * @property int $countries_id
 * @property int $countries_id1
 * @property int $states_id
 * @property int $cities_id
 *
 * @property ProPub[] $proPubs
 * @property Cities $cities
 * @property Countries $countriesId1
 * @property Db $dbDb
 * @property Institution $institutionAgAward
 * @property Present $presentPresent
 * @property Sponsor $sponsorSponsor
 * @property States $states
 * @property PublicationOrder[] $publicationOrders
 */
class Publication extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'publication';
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
            [['date'], 'safe'],
            [['auth_level_id', 'person_id', 'db_db_id', 'present_present_id', 'institution_ag_award_id', 'sponsor_sponsor_id', 'countries_id', 'countries_id1', 'states_id', 'cities_id'], 'integer'],
            [['pub_name_thai', 'pub_name_eng', 'book_name_thai'], 'string', 'max' => 200],
            ['pub_name_eng', 'match', 'pattern' => '/^[a-zA-Z0-9_-]+$/', 'message' => '*กรอกข้อมูลเป็นภาษาอังกฤษเท่านั้น'],
            ['pub_name_thai', 'match', 'pattern' => '/^[ก-๙]+$/', 'message' => '*กรอกข้อมูลเป็นภาษาไทยเท่านั้น'],

            ['meeting_name_thai', 'match', 'pattern' => '/^[ก-๙]+$/', 'message' => '*กรอกข้อมูลเป็นภาษาไทยเท่านั้น'],
            ['meeting_name_eng', 'match', 'pattern' => '/^[a-zA-Z0-9_-]+$/', 'message' => '*กรอกข้อมูลเป็นภาษาอังกฤษเท่านั้น'],
            ['book_name_eng', 'match', 'pattern' => '/^[a-zA-Z0-9_-]+$/', 'message' => '*กรอกข้อมูลเป็นภาษาอังกฤษเท่านั้น'],
            ['book_name_thai', 'match', 'pattern' => '/^[ก-๙]+$/', 'message' => '*กรอกข้อมูลเป็นภาษาไทยเท่านั้น'],
            [['book_name_eng', 'doi', 'meeting_name_thai', 'meeting_name_eng', 'bounty'], 'string', 'max' => 45],
            [['acticle_detail', 'press', 'publisher', 'dataindex', 'impact_factor', 'namework_eng', 'namework_thai', 'editor', 'work_name'], 'string', 'max' => 100],
            ['namework_thai', 'match', 'pattern' => '/^[ก-๙]+$/', 'message' => '*กรอกข้อมูลเป็นภาษาไทยเท่านั้น'],
            ['namework_eng', 'match', 'pattern' => '/^[a-zA-Z0-9_-]+$/', 'message' => '*กรอกข้อมูลเป็นภาษาอังกฤษเท่านั้น'],
            [['page_number', 'ISBN', 'dataval'], 'string', 'max' => 20],
            [['abstract'], 'string', 'max' => 250],
            [['issn', 'article', 'number', 'issuance'], 'string', 'max' => 50],
            [['cities_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::className(), 'targetAttribute' => ['cities_id' => 'id']],
            [['countries_id1'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['countries_id1' => 'id']],
            [['db_db_id'], 'exist', 'skipOnError' => true, 'targetClass' => Db::className(), 'targetAttribute' => ['db_db_id' => 'db_id']],
            [['institution_ag_award_id'], 'exist', 'skipOnError' => true, 'targetClass' => Institution::className(), 'targetAttribute' => ['institution_ag_award_id' => 'ag_award_id']],
            [['present_present_id'], 'exist', 'skipOnError' => true, 'targetClass' => Present::className(), 'targetAttribute' => ['present_present_id' => 'present_id']],
            [['sponsor_sponsor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sponsor::className(), 'targetAttribute' => ['sponsor_sponsor_id' => 'sponsor_id']],
            [['states_id'], 'exist', 'skipOnError' => true, 'targetClass' => States::className(), 'targetAttribute' => ['states_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pub_id' => 'Pub ID',
            'pub_name_thai' => 'Pub Name Thai',
            'pub_name_eng' => 'Pub Name Eng',
            'book_name_thai' => 'Book Name Thai',
            'book_name_eng' => 'Book Name Eng',
            'date' => 'Date',
            'acticle_detail' => 'Acticle Detail',
            'page_number' => 'Page Number',
            'abstract' => 'Abstract',
            'press' => 'Press',
            'publisher' => 'Publisher',
            'ISBN' => 'Isbn',
            'auth_level_id' => 'Auth Level ID',
            'issn' => 'Issn',
            'dataval' => 'Dataval',
            'article' => 'Article',
            'number' => 'Number',
            'issuance' => 'Issuance',
            'dataindex' => 'Dataindex',
            'impact_factor' => 'Impact Factor',
            'doi' => 'Doi',
            'namework_eng' => 'Namework Eng',
            'namework_thai' => 'Namework Thai',
            'person_id' => 'Person ID',
            'db_db_id' => 'Db Db ID',
            'present_present_id' => 'Present Present ID',
            'meeting_name_thai' => 'Meeting Name Thai',
            'meeting_name_eng' => 'Meeting Name Eng',
            'bounty' => 'Bounty',
            'editor' => 'Editor',
            'work_name' => 'Work Name',
            'institution_ag_award_id' => 'Institution Ag Award ID',
            'sponsor_sponsor_id' => 'Sponsor Sponsor ID',
            'countries_id' => 'Countries ID',
            'countries_id1' => 'Countries Id1',
            'states_id' => 'States ID',
            'cities_id' => 'Cities ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProPubs()
    {
        return $this->hasMany(ProPub::className(), ['publication_pub_id' => 'pub_id']);
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
    public function getCountriesId1()
    {
        return $this->hasOne(Countries::className(), ['id' => 'countries_id1']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDbDb()
    {
        return $this->hasOne(Db::className(), ['db_id' => 'db_db_id']);
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
    public function getPresentPresent()
    {
        return $this->hasOne(Present::className(), ['present_id' => 'present_present_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSponsorSponsor()
    {
        return $this->hasOne(Sponsor::className(), ['sponsor_id' => 'sponsor_sponsor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStates()
    {
        return $this->hasOne(States::className(), ['id' => 'states_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublicationOrders()
    {
        return $this->hasMany(PublicationOrder::className(), ['publication_pub_id' => 'pub_id']);
    }
}
