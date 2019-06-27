<?php
/**
 * Created by PhpStorm.
 * User: MainUser
 * Date: 7/11/2560
 * Time: 21:25
 */

namespace app\modules\eproject\models;


use yii\elasticsearch\ActiveRecord;

class ElasticProject extends ActiveRecord
{
    /**
     * @return array This model's mapping
     */
    public static function mapping()
    {
        return [
            static::type() => [
                'properties' => [
                    'project_id' => ['type' => 'integer'],
                    'name_th' => ['type' => 'text', 'analyzer' => 'thai', 'boost' => 1], //boost ได้ตอนแก้ไขข้อมูลโครงงาน / เปลี่ยนหัวข้อ
                    'name_en' => ['type' => 'text', 'analyzer' => 'english'],// ได้ตอนแก้ไขชื่อโครงงาน / เปลี่ยนหัวข้อ
                    'theory' => ['type' => 'text', 'analyzer' => 'thai'],// ได้ตอนแก้ไขชื่อโครงงาน / อัพโหลดเอกสารโครงงาน
                    'tool' => ['type' => 'text', 'analyzer' => 'thai'],// ได้ตอนแก้ไขชื่อโครงงาน / อัพโหลดเอกสารโครงงาน
                    'detail' => ['type' => 'text', 'analyzer' => 'thai'], // ได้ตอนแก้ไขชื่อโครงงาน / อัพโหลดเอกสารโครงงาน
                    'owner' => ['type' => 'text', 'analyzer' => 'thai'],  // ได้ตอนรับเป็นที่ปรึกษา
                    'major' => ['type' => 'integer'], // ได้ตอนรับเป็นที่ปรึกษา ได้ตอนแก้ไขชื่อโครงงาน
                    'semester' => ['type' => 'integer'], // ได้ตอนรับเป็นที่ปรึกษา ได้ตอนแก้ไขชื่อโครงงาน
                    'year' => ['type' => 'integer'], // ได้ตอนรับเป็นที่ปรึกษา ได้ตอนแก้ไขชื่อโครงงาน
                    'type' => ['type' => 'integer'], // multiple find by multiple //ได้ตอนแก้ไขชื่อโครงงาน
                    'adviser' => ['type' => 'integer'],// multiple find by multiple //ได้ตอนอนุมัติ ได้ตอนแก้ไขข้อมูลโครงงาน
                    'activated' => ['type' => 'boolean'],
                ]
            ],
        ];
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        $this->project_id = (int)$this->getPrimaryKey();
        return parent::beforeSave( $insert );

    }

    /**
     * @return array
     */
    public function attributes()
    {
        // path mapping for '_id' is setup to field 'id'
        return [
            'project_id',
            'name_th',
            'name_en',
            'theory',
            'tool',
            'detail',
            'owner',
            'major',
            'semester',
            'year',
            'type',
            'adviser',
            'activated'
        ];
    }

    /**
     * Set (update) mappings for this model
     */
    public static function updateMapping()
    {
        $db = static::getDb();
        $command = $db->createCommand();
        $command->setMapping( static::index(), static::type(), static::mapping() );
    }

    /**
     * Create this model's index
     */
    public static function createIndex()
    {
        $db = static::getDb();
        $command = $db->createCommand();
        $command->createIndex( static::index(), [
            'settings' => ['analysis' => ['analyzer' => [
                'default' => [
                    'type' => 'thai']]]],
            'mappings' => static::mapping(),
            //'warmers' => [ /* ... */ ],
            //'aliases' => [ /* ... */ ],
            //'creation_date' => '...'
        ] );
    }

    /**
     * Delete this model's index
     */
    public static function deleteIndex()
    {
        $db = static::getDb();
        $command = $db->createCommand();
        $command->deleteIndex( static::index(), static::type() );
    }
    public static function reIndex(){
        foreach (ElasticProject::find()->all() as $item){
            $item->delete();
        }
        $models=Project::find()->all();
        foreach ($models as $model){
            $tmp = new ElasticProject();
            $tmp->primaryKey = $model->id;
            if ($model->name_th != "") {
                $tmp->activated = true;
            }else{
                $tmp->activated = false;
            }
            $tmp->name_th = $model->name_th;
            $tmp->name_en = $model->name_en;
            $tmp->theory = $model->retrieveProjectTheory();
            $tmp->tool = $model->retrieveProjectTool();
            $tmp->detail = $model->abstract;
            $tmp->owner = $model->retrieveOwner();
            $tmp->major = $model->major_id;
            $tmp->semester = $model->semester_id;
            $tmp->year = $model->year_id;
            $tmp->type = $model->retrieveProjectType();
            $tmp->adviser = $model->retrieveAdviser();
            $tmp->save();
        }
    }
}