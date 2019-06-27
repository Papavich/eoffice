<?php

namespace app\modules\personsystem\models;

use Yii;

/**
 * This is the model class for table "branch_has_level".
 *
 * @property string $LEVELID
 * @property int $branch_id
 *
 * @property Branch $branch
 * @property RegLevel $lEVEL
 */
class BranchHasLevel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'branch_has_level';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['LEVELID', 'branch_id'], 'required'],
            [['branch_id'], 'integer'],
            [['LEVELID'], 'string', 'max' => 50],
            [['LEVELID'], 'unique'],
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::className(), 'targetAttribute' => ['branch_id' => 'branch_id']],
            [['LEVELID'], 'exist', 'skipOnError' => true, 'targetClass' => RegLevel::className(), 'targetAttribute' => ['LEVELID' => 'LEVELID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'LEVELID' => 'Levelid',
            'branch_id' => 'Branch ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(Branch::className(), ['branch_id' => 'branch_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLEVEL()
    {
        return $this->hasOne(RegLevel::className(), ['LEVELID' => 'LEVELID']);
    }
}
