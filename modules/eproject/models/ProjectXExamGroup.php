<?php

namespace app\modules\eproject\models;

use Yii;

/**
 * This is the model class for table "epro_project_x_exam_group".
 *
 * @property integer $id
 * @property integer $crby
 * @property integer $udby
 * @property string $crtime
 * @property string $udtime
 * @property integer $exam_group_id
 * @property integer $project_id
 *
 * @property ExamGroup $examGroup
 * @property Project $project
 */
class ProjectXExamGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'epro_project_x_exam_group';
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
            [[ 'exam_group_id', 'project_id'], 'required'],
            [['crby', 'udby', 'exam_group_id', 'project_id'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
            [['exam_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => ExamGroup::className(), 'targetAttribute' => ['exam_group_id' => 'id']],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'crby' => 'Crby',
            'udby' => 'Udby',
            'crtime' => 'Crtime',
            'udtime' => 'Udtime',
            'exam_group_id' => 'Exam Group ID',
            'project_id' => 'Project ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExamGroup()
    {
        return $this->hasOne(ExamGroup::className(), ['id' => 'exam_group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }
}
