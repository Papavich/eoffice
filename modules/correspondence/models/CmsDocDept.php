<?php

namespace app\modules\correspondence\models;

use Yii;

/**
 * This is the model class for table "cms_doc_dept".
 *
 * @property integer $doc_dept_id
 * @property string $doc_dept_name
 * @property integer $user_id
 *
 * @property User $user
 * @property CmsDocument[] $cmsDocuments
 */
class CmsDocDept extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cms_doc_dept';
    }
    public static function getDb()
    {
        return Yii::$app->get('db_cms');
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['doc_dept_id','doc_dept_name'], 'required'],
            [['doc_dept_id', 'user_id'], 'integer'],
            [['doc_dept_name'], 'string', 'max' => 100],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $funcT = '\app\modules\\' . Yii::$app->controller->module->id . '\controllers::t';
        return [
            'doc_dept_id' => 'Doc Dept ID',
            'doc_dept_name' => $funcT('menu', 'Doc Dept Name'),
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsDocuments()
    {
        return $this->hasMany(CmsDocument::className(), ['doc_dept_id' => 'doc_dept_id']);
    }
}
