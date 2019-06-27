<?php

namespace app\modules\portfolio\models;

use Yii;

/**
 * This is the model class for table "publication_order".
 *
 * @property int $pub_order_id
 * @property int $publication_pub_id
 * @property int $author_level_auth_level_id
 * @property int $project_member_pro_member_id
 * @property int $publications_type_pub_type_id
 * @property int $dissemination_id
 * @property int $person_id
 * @property string $date
 * @property int $contributor_contributor_id1
 *
 * @property AuthorLevel $authorLevelAuthLevel
 * @property Contributor $contributorContributorId1
 * @property Dissemination $dissemination
 * @property Member $projectMemberProMember
 * @property Publication $publicationPub
 * @property PublicationsType $publicationsTypePubType
 */
class PublicationOrder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'publication_order';
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
            [['publication_pub_id', 'author_level_auth_level_id', 'project_member_pro_member_id', 'publications_type_pub_type_id', 'dissemination_id', 'person_id', 'contributor_contributor_id1'], 'integer'],
            [['date'], 'safe'],
            [['author_level_auth_level_id'], 'exist', 'skipOnError' => true, 'targetClass' => AuthorLevel::className(), 'targetAttribute' => ['author_level_auth_level_id' => 'auth_level_id']],
            [['contributor_contributor_id1'], 'exist', 'skipOnError' => true, 'targetClass' => Contributor::className(), 'targetAttribute' => ['contributor_contributor_id1' => 'contributor_id']],
            [['dissemination_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dissemination::className(), 'targetAttribute' => ['dissemination_id' => 'id']],
            [['project_member_pro_member_id'], 'exist', 'skipOnError' => true, 'targetClass' => Member::className(), 'targetAttribute' => ['project_member_pro_member_id' => 'member_id']],
            [['publication_pub_id'], 'exist', 'skipOnError' => true, 'targetClass' => Publication::className(), 'targetAttribute' => ['publication_pub_id' => 'pub_id']],
            [['publications_type_pub_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => PublicationsType::className(), 'targetAttribute' => ['publications_type_pub_type_id' => 'pub_type_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pub_order_id' => 'Pub Order ID',
            'publication_pub_id' => 'Publication Pub ID',
            'author_level_auth_level_id' => 'Author Level Auth Level ID',
            'project_member_pro_member_id' => 'Project Member Pro Member ID',
            'publications_type_pub_type_id' => 'Publications Type Pub Type ID',
            'dissemination_id' => 'Dissemination ID',
            'person_id' => 'Person ID',
            'date' => 'Date',
            'contributor_contributor_id1' => 'Contributor Contributor Id1',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorLevelAuthLevel()
    {
        return $this->hasOne(AuthorLevel::className(), ['auth_level_id' => 'author_level_auth_level_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContributorContributorId1()
    {
        return $this->hasOne(Contributor::className(), ['contributor_id' => 'contributor_contributor_id1']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDissemination()
    {
        return $this->hasOne(Dissemination::className(), ['id' => 'dissemination_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectMemberProMember()
    {
        return $this->hasOne(Member::className(), ['member_id' => 'project_member_pro_member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublicationPub()
    {
        return $this->hasOne(Publication::className(), ['pub_id' => 'publication_pub_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublicationsTypePubType()
    {
        return $this->hasOne(PublicationsType::className(), ['pub_type_id' => 'publications_type_pub_type_id']);
    }
    public function getNameEng()
    {
        return $this->publicationPub->namework_eng;
    }
    public function getNameThai()
    {
        return $this->publicationPub->namework_thai;
    }
}
