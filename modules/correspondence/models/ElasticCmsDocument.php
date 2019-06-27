<?php
/**
 * Created by PhpStorm.
 * User: VaraPhon
 * Date: 2/22/2018
 * Time: 2:42 PM
 */

namespace app\modules\correspondence\models;

use yii\elasticsearch\ActiveRecord;

class ElasticCmsDocument extends ActiveRecord
{
    /**
     * @return array This model's mapping
     */
    public static function mapping()
    {
        return [
            static::type() => [
                'properties' => [
                    'doc_subject' => ['type' => 'text', 'analyzer' => "my_thai"],
                    'doc_date' => [
                        'type' => 'date',
                        'format' => 'yyyy-MM-dd'
                    ],
                    'doc_from' => ['type' => 'text', 'analyzer' => 'thai'],
                    'type_id' => ['type' => 'integer'],
                    'doc_id_regist' => ['type' => 'text', "analyzer" => "autocomplete",
                        "search_analyzer" => "standard"],
                    'doc_id' => ['type' => 'text'],
                    'roll' => ['type' => 'text'], //ระบุว่าอยู่ทะเบียนรับหรือส่ง
                    'address_id' => ['type' => 'text'] //รหัสแฟ้ม
                ]
            ],
        ];
    }

    /**
     * @return array
     */
    public function attributes()
    {
        // path mapping for '_id' is setup to field 'id'
        return [
            'doc_subject',
            'doc_date',
            'doc_from',
            'type_id',
            'doc_id_regist',
            'doc_id',
            'roll',
            'address_id',
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
            'settings' => ['analysis' => [
                'analyzer' => [
                    'default' => [
                        'type' => 'thai'
                    ],
                    "my_thai" => [
                        "tokenizer" => "thai",
                        'type' => 'custom',
                        "filter" => [
                            "standard", "lowercase","kstem"
                        ]
                    ],
                    "autocomplete" => [
                        "type" => "custom",
                        "tokenizer" => "standard",
                        "filter" => [
                            "lowercase",
                            "autocomplete_filter"
                        ]
                    ]
                ],
                "filter" => [
                    "autocomplete_filter" => [
                        "type" => "edge_ngram",
                        "min_gram" => 1,
                        "max_gram" => 20
                    ],
                    "thai_stop" => [
                        "type" => "stop",
                        "stopwords" => "_thai_"
                    ]
                ]
            ]
            ],
            'mappings' => static::mapping(),
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

    //กำหนดค่าใน Elastic ใหม่
    public static function reIndex()
    {
        $models = CmsDocument::find()->all();
        foreach ($models as $model) {
            $tmp = new ElasticCmsDocument();
            $tmp->primaryKey = $model->doc_id;
            $tmp->doc_id = $model->doc_id;
            $tmp->doc_subject = $model->doc_subject;
            $tmp->doc_from = $model->docDept->doc_dept_name;
            $tmp->type_id = $model->type->type_id;
            $tmp->doc_id_regist = $model->doc_id_regist;
            if ($model->cmsDocRollReceives) {
                $tmp->roll = "staff-receive";
                $tmp->doc_date = substr($model->receive_date, 0, 10);
            } else {
                $tmp->roll = "staff-send";
                $tmp->doc_date = substr($model->sent_date, 0, 10);
            }
            $tmp->address_id = $model->address->address_id;
            $tmp->save();
        }
    }

    public function insertElasticCmsDocument($model)
    {
        $tmp = new ElasticCmsDocument();
        $tmp->primaryKey = $model->doc_id;
        $tmp->doc_id = $model->doc_id;
        $tmp->doc_subject = $model->doc_subject;
        $tmp->doc_from = $model->docDept->doc_dept_name;
        $tmp->type_id = $model->type->type_id;
        $tmp->doc_id_regist = $model->doc_id_regist;
        if ($model->cmsDocRollReceives) {
            $tmp->roll = "staff-receive";
            $tmp->doc_date = substr($model->receive_date, 0, 10);
        } else {
            $tmp->roll = "staff-send";
            $tmp->doc_date = substr($model->sent_date, 0, 10);
        }
        $tmp->address_id = $model->address->address_id;
        $tmp->save();
    }

    public function updateElastic($id)
    {
        $model = CmsDocument::findOne($id);
        $tmp = ElasticCmsDocument::get($id);
        $tmp->doc_subject = $model->doc_subject;
        if ($model->cmsDocRollReceives) {
            $tmp->doc_date = substr($model->receive_date, 0, 10);
        } else {
            $tmp->doc_date = substr($model->sent_date, 0, 10);
        }
        $tmp->doc_from = $model->docDept->doc_dept_name;
        $tmp->type_id = $model->type->type_id;
        $tmp->doc_id_regist = $model->doc_id_regist;
        $tmp->address_id = $model->address->address_id;
        $tmp->save();
    }
    public function deleteElastic($id)
    {
        $model = CmsDocument::findOne($id);
        $tmp = ElasticCmsDocument::get($id);
        $tmp->delete();
    }
}