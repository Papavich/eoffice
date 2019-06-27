<?php

namespace app\modules\pfc\models;

use app\models\User;
use app\modules\pfc\components\ModelHelper;
use Yii;

/**
 * This is the model class for table "epro_user_type".
 *
 * @property integer $id
 * @property integer $crby
 * @property integer $udby
 * @property string $crtime
 * @property string $udtime
 * @property string $name
 *
 * @property User[] $Users
 */
class ViewUserType extends \yii\db\ActiveRecord
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
        return 'epro_user_type';
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
            [[], 'required'],
            [['crby', 'udby'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
            [['name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'crby' => 'Crby',
            'udby' => 'Udby',
            'crtime' => 'Crtime',
            'udtime' => 'Udtime',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(ViewUser::className(), ['user_type_id' => 'id']);
    }
}
