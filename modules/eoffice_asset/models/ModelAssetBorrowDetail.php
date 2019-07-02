<?php

namespace app\modules\eoffice_asset\models;

use Yii;
use yii\helpers\ArrayHelper;

class ModelAssetBorrowDetail extends \yii\base\Model
{
    /**
     * Creates and populates a set of models.
     *
     * @param string $modelClass
     * @param array $multipleModels
     * @return array
     */
    public static function createMultiple($modelClass, $multipleModels = null)
    {
        $model    = new $modelClass;
        $formName = $model->formName();
        $post     = Yii::$app->request->post($formName);
        $models   = [];
        $flag     = false;

        if (! empty($multipleModels)) {
            $keys = array_keys(ArrayHelper::map($multipleModels, 'borrow_detail_id', 'borrow_detail_id'));
            $multipleModels = array_combine($keys, $multipleModels);
        }

        if ($post && is_array($post)) {
            foreach ($post as $i => $item) {
                if (isset($item['borrow_detail_id']) && !empty($item['borrow_detail_id']) && isset($multipleModels[$item['borrow_detail_id']])) {
                    $models[] = $multipleModels[$item['borrow_detail_id']];
                } else {
                    $models[] = new $modelClass;
                }
            }
        }

        unset($model, $formName, $post);

        return $models;
    }
}

###To zero or more elements (use the following code in your view file)

