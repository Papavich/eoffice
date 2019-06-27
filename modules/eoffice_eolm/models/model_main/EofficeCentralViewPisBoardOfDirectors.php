<?php

namespace app\modules\eoffice_eolm\models\model_main;

use Yii;

/**
 * This is the model class for table "eoffice_central.view_pis_board_of_directors".
 *
 * @property int $board_id
 * @property int $person_id
 * @property int $director_id
 * @property int $period_id
 * @property string $academic_positions_abb_thai
 * @property string $academic_positions
 * @property string $academic_positions_eng
 * @property string $academic_positions_abb
 * @property string $person_name
 * @property string $person_surname
 * @property string $person_name_eng
 * @property string $person_surname_eng
 * @property string $position_name
 * @property string $period_describe
 * @property string $date
 */
class EofficeCentralViewPisBoardOfDirectors extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eoffice_central.view_pis_board_of_directors';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_eolm');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['board_id', 'person_id', 'director_id', 'period_id'], 'integer'],
            [['person_id', 'director_id', 'period_id', 'person_name', 'person_surname'], 'required'],
            [['date'], 'safe'],
            [['academic_positions_abb_thai', 'academic_positions', 'academic_positions_eng', 'academic_positions_abb', 'person_name', 'person_surname', 'person_name_eng', 'person_surname_eng'], 'string', 'max' => 50],
            [['position_name', 'period_describe'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'board_id' => 'Board ID',
            'person_id' => 'Person ID',
            'director_id' => 'Director ID',
            'period_id' => 'Period ID',
            'academic_positions_abb_thai' => 'Academic Positions Abb Thai',
            'academic_positions' => 'Academic Positions',
            'academic_positions_eng' => 'Academic Positions Eng',
            'academic_positions_abb' => 'Academic Positions Abb',
            'person_name' => 'Person Name',
            'person_surname' => 'Person Surname',
            'person_name_eng' => 'Person Name Eng',
            'person_surname_eng' => 'Person Surname Eng',
            'position_name' => 'Position Name',
            'period_describe' => 'Period Describe',
            'date' => 'Date',
        ];
    }
}
