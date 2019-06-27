<?php

namespace app\modules\eoffice_asset\models;

use Yii;
use yii\helpers\ArrayHelper;

class ModelAssetDetail extends \yii\base\Model
{
    /**
     * Creates and populates a set of models.
     *
     * @param string $modelClass
     * @param array $multipleModels
     * @return array
     */
    public static function createMultiple($modelClass, $multipleModels = [])
    {
        $model    = new $modelClass;
        $formName = $model->formName();
        $post     = Yii::$app->request->post($formName);
        $models   = [];

        if (! empty($multipleModels)) {
            $keys = array_keys(ArrayHelper::map($multipleModels, 'asset_detail_id', 'asset_detail_id'));
            $multipleModels = array_combine($keys, $multipleModels);
        }

        if ($post && is_array($post)) {
            foreach ($post as $i => $item) {
                if (isset($item['asset_detail_id']) && !empty($item['asset_detail_id']) && isset($multipleModels[$item['asset_detail_id']])) {
                    $models[] = $multipleModels[$item['asset_detail_id']];
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

