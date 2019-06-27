<?php

namespace app\modules\eoffice_ta;

/**
 * eoffice_ta module definition class
 */
class controllers extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\eoffice_ta\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->registerTranslations();
        //\Yii::$app->language = "th";

        // custom initialization code goes here
    }
    public function registerTranslations()
    {
        \Yii::$app->i18n->translations['modules/eoffice_ta/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en',
            'basePath' => '@app/modules/eoffice_ta/messages',
            'fileMap' => [
                'modules/eoffice_ta/menu' => 'menu.php',
                'modules/eoffice_ta/label' => 'label.php',
            ],
        ];
    }
    public static function t($category, $message, $params = [], $language = null)
    {

        return \Yii::t('modules/eoffice_ta/' . $category, $message, $params, $language);
    }
}
