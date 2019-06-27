<?php

namespace app\modules\scholar_b\models\model_main;

use Yii;

/**
 * This is the model class for table "Eoffice_central.view_pis_enroll_scb".
 *
 * @property string $STUDENTID
 * @property string $STUDENTCODE
 * @property string $ACADYEAR
 * @property string $SEMESTER
 * @property string $CREDITATTEMPT
 * @property string $GRADE
 */
class EofficeCentralViewPisEnrollScb extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Eoffice_central.view_pis_enroll_scb';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_scb');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['STUDENTID', 'ACADYEAR', 'SEMESTER'], 'required'],
            [['STUDENTID'], 'string', 'max' => 9],
            [['STUDENTCODE'], 'string', 'max' => 20],
            [['ACADYEAR'], 'string', 'max' => 4],
            [['SEMESTER'], 'string', 'max' => 1],
            [['CREDITATTEMPT'], 'string', 'max' => 255],
            [['GRADE'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'STUDENTID' => 'Studentid',
            'STUDENTCODE' => 'Studentcode',
            'ACADYEAR' => 'Acadyear',
            'SEMESTER' => 'Semester',
            'CREDITATTEMPT' => 'Creditattempt',
            'GRADE' => 'Grade',
        ];
    }
}
