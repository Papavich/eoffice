<?php

namespace app\modules\personsystem\models;

use Yii;

/**
 * This is the model class for table "major_has_program".
 *
 * @property int $major_id
 * @property string $PROGRAMID
 *
 * @property RegProgram $pROGRAM
 * @property Major $major
 */
class MajorHasProgram extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'major_has_program';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['major_id', 'PROGRAMID'], 'required'],
            [['major_id'], 'integer'],
            [['PROGRAMID'], 'string', 'max' => 255],
            [['PROGRAMID'], 'unique'],
            [['PROGRAMID'], 'exist', 'skipOnError' => true, 'targetClass' => RegProgram::className(), 'targetAttribute' => ['PROGRAMID' => 'PROGRAMID']],
            [['major_id'], 'exist', 'skipOnError' => true, 'targetClass' => Major::className(), 'targetAttribute' => ['major_id' => 'major_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'major_id' => 'Major ID',
            'PROGRAMID' => 'Program ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPROGRAM()
    {
        return $this->hasOne(RegProgram::className(), ['PROGRAMID' => 'PROGRAMID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMajor()
    {
        return $this->hasOne(Major::className(), ['major_id' => 'major_id']);
    }
}
