<?php

namespace app\modules\personsystem\models;

use Yii;

/**
 * This is the model class for table "branch".
 *
 * @property int $branch_id
 * @property string $branch_name
 *
 * @property BranchHasLevel[] $branchHasLevels
 */
class Branch extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'branch';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['branch_name'], 'required'],
            [['branch_name'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'branch_id' => 'Branch ID',
            'branch_name' => 'Branch Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranchHasLevels()
    {
        return $this->hasMany(BranchHasLevel::className(), ['branch_id' => 'branch_id']);
    }
}
