<?php

namespace app\modules\eproject\models;

use app\modules\eproject\components\ModelHelper;
use Yii;

/**
 * This is the model class for table "epro_public_type".
 *
 * @property int $id
 * @property string $name
 * @property int $crby
 * @property int $udby
 * @property string $crtime
 * @property string $udtime
 *
 * @property PublicDocument[] $eproPublicDocuments
 */
class PublicType extends \yii\db\ActiveRecord
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
        return 'epro_public_type';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get( 'db_eproject' );
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['crby', 'udby'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ชื่อประเภท',
            'crby' => 'Crby',
            'udby' => 'Udby',
            'crtime' => 'Crtime',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublicDocuments()
    {
        return $this->hasMany( PublicDocument::className(), ['public_type_id' => 'id'] );
    }

    public function getProjectCountByUserId()
    {
        return Project::find()
            ->innerJoin( ProjectPublic::tableName(), ProjectPublic::tableName() . '.project_id = ' . Project::tableName() . '.id' )
            ->innerJoin( Advise::tableName(), Advise::tableName() . '.project_id = ' . Project::tableName() . '.id AND adviser_type_id=' . AdviserType::TYPE_PRIMARY_ADVISER )
            ->groupBy( 'id' )
            ->where( ['adviser_id' => Yii::$app->user->identity->getId()] )
            ->andWhere( ['public_type_id' => $this->id] )
            ->count();

    }
}
