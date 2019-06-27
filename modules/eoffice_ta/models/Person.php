<?php

namespace app\modules\eoffice_ta\models;

use Yii;

/**
 * This is the model class for table "person".
 *
 * @property string $person_id
 * @property string $personcode
 * @property string $prefix
 * @property string $fname_th
 * @property string $lname_th
 * @property string $gender
 * @property string $username
 * @property string $E-mail
 * @property string $branch_id
 * @property string $level_id
 * @property integer $type_id
 *
 * @property Level $level
 * @property Type $type
 * @property TaAssess[] $taAssesses
 * @property TaInboxUser[] $taInboxUsers
 * @property TaLanguageAbility[] $taLanguageAbilities
 * @property TaRegister[] $taRegisters
 * @property TaRequest0[] $taRequests
 */
class Person extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'person';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_ta');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['person_id', 'personcode', 'fname_th', 'lname_th'], 'required'],
            [['type_id'], 'integer'],
            [['person_id', 'personcode', 'prefix', 'username'], 'string', 'max' => 15],
            [['fname_th', 'lname_th'], 'string', 'max' => 45],
            [['gender'], 'string', 'max' => 7],
            [['E-mail'], 'string', 'max' => 30],
            [['branch_id', 'level_id'], 'string', 'max' => 10],
            [['level_id'], 'exist', 'skipOnError' => true, 'targetClass' => Level::className(), 'targetAttribute' => ['level_id' => 'level_id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Type::className(), 'targetAttribute' => ['type_id' => 'type_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'person_id' => 'Person ID',
            'personcode' => 'Personcode',
            'prefix' => 'Prefix',
            'fname_th' => 'Fname Th',
            'lname_th' => 'Lname Th',
            'gender' => 'Gender',
            'username' => 'Username',
            'E-mail' => 'E Mail',
            'branch_id' => 'Branch ID',
            'level_id' => 'Level ID',
            'type_id' => 'Type ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLevel()
    {
        return $this->hasOne(Level::className(), ['level_id' => 'level_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Type::className(), ['type_id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaAssesses()
    {
        return $this->hasMany(TaAssess::className(), ['assess_person' => 'person_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaInboxUsers()
    {
        return $this->hasMany(TaInboxUser::className(), ['person_id' => 'person_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaLanguageAbilities()
    {
        return $this->hasMany(TaLanguageAbility::className(), ['person_id' => 'person_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaRegisters()
    {
        return $this->hasMany(TaRegister::className(), ['person_id' => 'person_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaRequests()
    {
        return $this->hasMany(TaRequest0::className(), ['person_id' => 'person_id']);
    }
}
