<?php

namespace app\modules\eproject;

/**
 * eproject module definition class
 */
class controllers extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\eproject\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->layout="main";
        $this->registerTranslations();
        //\Yii::$app->language = "th";
        // custom initialization code goes here
    }
    public function registerTranslations()
    {
        \Yii::$app->i18n->translations['modules/eproject/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en',
            'basePath' => '@app/modules/eproject/messages',
            'fileMap' => [
                'modules/eproject/menu' => 'menu.php',
                'modules/eproject/label' => 'label.php',
            ],
        ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return \Yii::t('modules/eproject/' . $category, $message, $params, $language);
    }
}
