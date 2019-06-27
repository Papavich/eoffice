<?php

namespace app\modules\personsystem\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "importsql".
 *
 * @property integer $id
 * @property string $name
 * @property string $last_name
 * @property integer $age
 */
class Importsql extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'importsql';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['age'], 'integer'],
            [['name', 'last_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'last_name' => 'Last Name',
            'age' => 'Age',
        ];
    }


    public function upload($model,$attribute)
    {
        $photo  = UploadedFile::getInstance($model, $attribute);
        $path = $this->getUploadPath();
        if ($this->validate() && $photo !== null) {

            $fileName = $model->name.'.'.$photo->extension;
            //$fileName = $photo->baseName . '.' . $photo->extension;
            if($photo->saveAs($path.$fileName)){
                return $fileName;
            }
        }
        return $model->isNewRecord ? false : $model->getOldAttribute($attribute);
    }
    public function getUploadPath(){
        return Yii::getAlias('@webroot').'/web_personal/upload/person/';
    }
}
