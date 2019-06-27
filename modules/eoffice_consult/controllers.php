<?php

namespace app\modules\eoffice_consult;

/**
 * eoffice_consult module definition class
 */
class controllers extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\eoffice_consult\controllers';


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
        \Yii::$app->i18n->translations['modules/eoffice_consult/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@app/modules/eoffice_consult/messages',
            'fileMap' => [
                'modules/eoffice_consult/menu' => 'menu.php',
            ],
        ];
    }
    public static function t($category, $message, $params = [], $language = null)
    {

        return \Yii::t('modules/eoffice_consult/' . $category, $message, $params, $language);
    }
}
