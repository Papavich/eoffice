<?php

namespace app\modules\eproject\models;

use app\modules\eproject\components\ModelHelper;
use Yii;

/**
 * This is the model class for table "epro_adviser_type".
 *
 * @property integer $id
 * @property string $name
 * @property integer $crby
 * @property integer $udby
 * @property string $crtime
 * @property string $udtime
 *
 * @property Advise[] $advises
 */
class AdviserType extends \yii\db\ActiveRecord
{
    /**
     * @return array
     */
    public function behaviors()
    {
        return ModelHelper::behaviors();
    }
    const TYPE_PRIMARY_ADVISER=1;
    const TYPE_SECONDARY_ADVISER=2;
    const TYPE_EXTERNAL_ADVISER=3;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'epro_adviser_type';
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
            [['name', ], 'required'],
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
            'name' => 'Name',
            'crby' => 'Crby',
            'udby' => 'Udby',
            'crtime' => 'Crtime',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdvises()
    {
        return $this->hasMany(Advise::className(), ['adviser_type_id' => 'id']);
    }
}
