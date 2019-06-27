<?php

namespace app\modules\eoffice_ta\models\model_central;

use Yii;

/**
 * This is the model class for table "eoffice_central.reg_level".
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
class EofficeCentralRegLevel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eoffice_central.reg_level';
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
