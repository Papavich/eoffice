<?php

namespace app\modules\requestform;
/**
 * requestform module definition class
 */
class controllers extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\requestform\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->registerTranslations();
        \Yii::$app->language = "th";
        $this->layout= "main";
    }
    public function registerTranslations()
    {
        \Yii::$app->i18n->translations['modules/requestform/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@app/modules/requestform/messages',
            'fileMap' => [
                'modules/requestform/menu' => 'menu.php',
            ],
        ];
    }
    public static function t($category, $message, $params = [], $language = null)
    {

        return \Yii::t('modules/requestform/' . $category, $message, $params, $language);
    }
}
