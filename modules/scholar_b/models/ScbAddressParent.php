<?php

namespace app\modules\scholar_b\models;

use Yii;
use app\modules\scholar_b\components\ModelHelper;

/**
 * This is the model class for table "scb_address_parent".
 *
 * @property string $scb_parents_id_card_parent
 * @property string $address
 * @property string $tumbon
 * @property string $amphor
 * @property string $province
 * @property string $country
 * @property string $zipcode
 * @property integer $crby
 * @property string $crtime
 * @property integer $udby
 * @property string $udtime
 *
 * @property ScbParents $scbParentsIdCardParent
 */
class ScbAddressParent extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return ModelHelper::behaviors();
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scb_address_parent';
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
            [['scb_parents_id_card_parent'], 'required'],
            [['crby', 'udby'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
            [['scb_parents_id_card_parent'], 'string', 'max' => 17],
            [['address'], 'string', 'max' => 45],
            [['tumbon', 'amphor', 'province', 'country'], 'string', 'max' => 15],
            [['zipcode'], 'string', 'max' => 5],
            [['scb_parents_id_card_parent'], 'exist', 'skipOnError' => true, 'targetClass' => ScbParents::className(), 'targetAttribute' => ['scb_parents_id_card_parent' => 'id_card_parent']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'scb_parents_id_card_parent' => '',
            'address' => '',
            'tumbon' => '',
            'amphor' => '',
            'province' => '',
            'country' => '',
            'zipcode' => '',
            'crby' => 'Crby',
            'crtime' => 'Crtime',
            'udby' => 'Udby',
            'udtime' => 'Udtime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScbParentsIdCardParent()
    {
        return $this->hasOne(ScbParents::className(), ['id_card_parent' => 'scb_parents_id_card_parent']);
    }
}
