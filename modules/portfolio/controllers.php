<?php

namespace app\modules\portfolio;

/**
 * portfolio module definition class
 */
class controllers extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\portfolio\controllers';

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
        \Yii::$app->i18n->translations['modules/portfolio/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en',
            'basePath' => '@app/modules/portfolio/messages',
            'fileMap' => [
                'modules/portfolio/menu' => 'menu.php',
                'modules/portfolio/label' => 'label.php',
            ],
        ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return \Yii::t('modules/portfolio/' . $category, $message, $params, $language);
    }

}
