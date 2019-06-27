<?php

namespace app\modules\eoffice_asset;

/**
 * eoffice_ta module definition class
 */
class controllers extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\eoffice_asset\controllers';

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
        \Yii::$app->i18n->translations['modules/eoffice_asset/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en',
            'basePath' => '@app/modules/eoffice_asset/messages',
            'fileMap' => [
                'modules/eoffice_asset/menu' => 'menu.php',
                'modules/eoffice_asset/label' => 'label.php',
            ],
        ];
    }
    public static function t($category, $message, $params = [], $language = null)
    {

        return \Yii::t('modules/eoffice_asset/' . $category, $message, $params, $language);
    }
}
