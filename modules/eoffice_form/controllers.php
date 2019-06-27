<?php

namespace app\modules\eoffice_form;

/**
 * eoffice_form module definition class
 */
class controllers extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\eoffice_form\controllers';

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
        \Yii::$app->i18n->translations['modules/eoffice_form/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@app/modules/eoffice_form/messages',
            'fileMap' => [
                'modules/eoffice_form/menu' => 'menu.php',
                'modules/eoffice_form/label' => 'label.php',
            ],
        ];
    }
    public static function t($category, $message, $params = [], $language = null)
    {

        return \Yii::t('modules/eoffice_form/' . $category, $message, $params, $language);
    }
}
