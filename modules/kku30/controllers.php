<?php

namespace app\modules\kku30;

/**
 * scholar_b module definition class
 */
class controllers extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\kku30\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->registerTranslations();
        $this->layout="main";
        //\Yii::$app->language = "th";
        // custom initialization code goes here
    }
    public function registerTranslations()
    {
        \Yii::$app->i18n->translations['modules/kku30/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en',
            'basePath' => '@app/modules/kku30/messages',
            'fileMap' => [
                'modules/kku30/menu' => 'menu.php',
            ],
        ];
    }
    public static function t($category, $message, $params = [], $language = null)
    {

        return \Yii::t('modules/kku30/' . $category, $message, $params, $language);
    }
}
