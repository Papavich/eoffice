<?php

namespace app\modules\eoffice_ta\models\model_main;

use Yii;

/**
 * This is the model class for table "eoffice_main.level".
 *
 * @property string $LEVELID
 * @property string $LEVELNAME
 * @property string $LEVELNAMEENG
 * @property string $LEVELABB
 * @property string $LEVELABBENG
 * @property string $CURRENTACADYEAR
 * @property string $CURRENTSEMESTER
 * @property string $ENROLLACADYEAR
 * @property string $ENROLLSEMESTER
 * @property string $FIRSTYEAR
 */
class Level extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eoffice_main.level';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['LEVELID'], 'required'],
            [['LEVELID', 'LEVELNAME', 'LEVELNAMEENG', 'LEVELABB', 'LEVELABBENG', 'CURRENTACADYEAR', 'CURRENTSEMESTER', 'ENROLLACADYEAR', 'ENROLLSEMESTER', 'FIRSTYEAR'], 'string', 'max' => 50],
            [['LEVELID'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'LEVELID' => 'Levelid',
            'LEVELNAME' => 'Levelname',
            'LEVELNAMEENG' => 'Levelnameeng',
            'LEVELABB' => 'Levelabb',
            'LEVELABBENG' => 'Levelabbeng',
            'CURRENTACADYEAR' => 'Currentacadyear',
            'CURRENTSEMESTER' => 'Currentsemester',
            'ENROLLACADYEAR' => 'Enrollacadyear',
            'ENROLLSEMESTER' => 'Enrollsemester',
            'FIRSTYEAR' => 'Firstyear',
        ];
    }
}
