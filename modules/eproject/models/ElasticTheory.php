<?php
/**
 * Created by PhpStorm.
 * User: MainUser
 * Date: 7/11/2560
 * Time: 21:25
 */

namespace app\modules\eproject\models;


use yii\elasticsearch\ActiveRecord;

class ElasticTheory extends ActiveRecord
{
    /**
     * @return array This model's mapping
     */
    public static function mapping()
    {
        return [
            static::type() => [
                'properties' => [
                    'theory_id' => ['type' => 'integer'],
                    'title' => ['type' => 'text', 'analyzer' => 'thai'],
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
        $this->theory_id = (int)$this->getPrimaryKey();
        return parent::beforeSave( $insert );

    }
    public static function reIndex(){

        foreach (ElasticTheory::find()->all() as $item){
            $item->delete();
        }
        $models=Theory::find()->all();
        foreach ($models as $model){
            $tmp=new ElasticTheory();
            $tmp->primaryKey=$model->id;
            $tmp->title=$model->name;
            $tmp->save();
        }
    }

    /**
     * @return array
     */
    public function attributes()
    {
        // path mapping for '_id' is setup to field 'id'
        return [
            'theory_id',
            'title',
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

}