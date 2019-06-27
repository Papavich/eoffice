<?php

namespace app\modules\portfolio\models;

use Yii;

/**
 * This is the model class for table "pro_pub".
 *
 * @property int $pro_pub_id
 * @property int $publication_pub_id
 * @property int $project_project_id
 * @property int $areward_order_areward_order_id
 *
 * @property Areward $arewardOrderArewardOrder
 * @property Project $projectProject
 * @property Publication $publicationPub
 */
class ProPub extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pro_pub';
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
            [['publication_pub_id', 'project_project_id', 'areward_order_areward_order_id'], 'integer'],
            [['areward_order_areward_order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Areward::className(), 'targetAttribute' => ['areward_order_areward_order_id' => 'areward_id']],
            [['project_project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_project_id' => 'project_id']],
            [['publication_pub_id'], 'exist', 'skipOnError' => true, 'targetClass' => Publication::className(), 'targetAttribute' => ['publication_pub_id' => 'pub_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pro_pub_id' => 'Pro Pub ID',
            'publication_pub_id' => 'Publication Pub ID',
            'project_project_id' => 'Project Project ID',
            'areward_order_areward_order_id' => 'Areward Order Areward Order ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArewardOrderArewardOrder()
    {
        return $this->hasOne(Areward::className(), ['areward_id' => 'areward_order_areward_order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectProject()
    {
        return $this->hasOne(Project::className(), ['project_id' => 'project_project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublicationPub()
    {
        return $this->hasOne(Publication::className(), ['pub_id' => 'publication_pub_id']);
    }
}
