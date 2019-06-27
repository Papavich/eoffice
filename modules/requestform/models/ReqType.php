<?php

namespace app\modules\requestform\models;

use Yii;

/**
 * This is the model class for table "req_type".
 *
 * @property integer $req_type_id
 * @property string $req_type_name
 *
 * @property ReqTemplate[] $reqTemplates
 */
class ReqType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'req_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['req_type_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'req_type_id' => 'Req Type ID',
            'req_type_name' => 'Req Type Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReqTemplates()
    {
        return $this->hasMany(ReqTemplate::className(), ['req_type_req_type_id' => 'req_type_id']);
    }
}
