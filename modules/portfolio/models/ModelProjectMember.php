<?php
/**
 * Created by PhpStorm.
 * User: DELLosc
 * Date: 9/3/2561
 * Time: 3:45
 */

namespace app\modules\portfolio\models;
use Yii;
use yii\helpers\ArrayHelper;

class ModelProjectMember extends \yii\base\Model
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
            $keys = array_keys(ArrayHelper::map($multipleModels, 'member_id', 'member_id'));
            $multipleModels = array_combine($keys, $multipleModels);
        }

        if ($post && is_array($post)) {
            foreach ($post as $i => $item) {
                if (isset($item['member_id']) && !empty($item['member_id']) && isset($multipleModels[$item['member_id']])) {
                    $models[] = $multipleModels[$item['member_id']];
                } else {
                    $models[] = new $modelClass;
                }
            }
        }

        unset($model, $formName, $post);

        return $models;
    }

}