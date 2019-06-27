<?php

namespace app\modules\pms;

/**
 * pms module definition class
 */
class controllers extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\pms\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->registerTranslations();

        // custom initialization code goes here
    }
    public function registerTranslations()
    {
        \Yii::$app->i18n->translations['modules/pms/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en',
            'basePath' => '@app/modules/pms/messages',
            'fileMap' => [
                'modules/pms/menu' => 'menu.php',
            ],
        ];
    }
    public static function t($category, $message, $params = [], $language = null)
    {

        return \Yii::t('modules/pms/' . $category, $message, $params, $language);
    }
}
