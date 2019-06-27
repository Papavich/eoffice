<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 6/3/2561
 * Time: 6:51
 */

namespace app\modules\eoffice_materialsys\models;

use yii\elasticsearch\ActiveRecord;
use yii\elasticsearch\Query;


class elasticsearchMaterial extends ActiveRecord
{
    // Other class attributes and methods go here
    // ...
//    public static function getDb()
//    {
//        return \Yii::$app->get('db_mat');
//    }

    /**
     * @return array This model's mapping
     */
    public static function mapping()
    {
        return [
            static::type() => [
                'properties' => [
                    'material_id' => ['type' => 'text'],
                    'material_name' => ['type' => 'text'],
                    'material_detail' => ['type' => 'text'],
                    'material_amount_check' => ['type' => 'integer'],
                    'material_order_count' => ['type' => 'integer'],
                    'material_unit_name' => ['type' => 'text'],
                    'material_image' => ['type' => 'text'],
                    'location_id' => ['type' => 'text'],
                    'material_type_id' => ['type' => 'text'],
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
        $this->material_id = (int)$this->getPrimaryKey();
        return parent::beforeSave($insert);

    }

    public function attributes()
    {
        return [
            'material_id',
            'material_name',
            'material_detail',
            'material_amount_check',
            'material_order_count',
            'material_unit_name',
            'material_image',
            'location_id',
            'material_type_id'
        ];
    }

    /**
     * Set (update) mappings for this model
     */
    public static function updateMapping()
    {
        $db = static::getDb();
        $command = $db->createCommand();
        $command->setMapping(static::index(), static::type(), static::mapping());
    }

    /**
     * Create this model's index
     */
    public static function createIndex()
    {
        $db = static::getDb();
        $command = $db->createCommand();
        $command->createIndex(static::index(), [
            'settings' => [],
            'mappings' => static::mapping(),
            //'warmers' => [ /* ... */ ],
            //'aliases' => [ /* ... */ ],
            //'creation_date' => '...'
        ]);
    }

    /**
     * Delete this model's index
     */
    public static function deleteIndex()
    {
        $db = static::getDb();
        $command = $db->createCommand();
        $command->deleteIndex(static::index(), static::type());
    }
}