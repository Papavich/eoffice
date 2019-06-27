<?php

namespace app\modules\consulting;

/**
 * consulting module definition class
 */
class controllers extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\consulting\controllers';


    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        \Yii::$app->request->enableCsrfValidation = false;

        $this->registerTranslations();
        \Yii::$app->language = "th";
        $this->layout= "main";
    }
    public function registerTranslations()
    {
        \Yii::$app->i18n->translations['modules/consulting/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@app/modules/consulting/messages',
            'fileMap' => [
                'modules/consulting/menu' => 'menu.php',
            ],
        ];
    }
    public static function t($category, $message, $params = [], $language = null)
    {

        return \Yii::t('modules/consulting/' . $category, $message, $params, $language);
    }
}
