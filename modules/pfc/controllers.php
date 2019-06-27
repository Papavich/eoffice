<?php

namespace app\modules\pfc;

/**
 * pfc module definition class
 */
class controllers extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\pfc\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        $this->registerTranslations();
        $this->layout="main";
        //\Yii::$app->language = "th";
        // custom initialization code goes here
        // custom initialization code goes here
    }

    public function registerTranslations()
    {
        \Yii::$app->i18n->translations['modules/pfc/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en',
            'basePath' => '@app/modules/pfc/messages',
            'fileMap' => [
                'modules/pfc/menu' => 'menu.php',
            ],
        ];
    }
    public static function t($category, $message, $params = [], $language = null)
    {

        return \Yii::t('modules/pfc/' . $category, $message, $params, $language);
    }
}
