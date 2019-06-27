<?php

namespace app\modules\scholar_b;

/**
 * scholar_b module definition class
 */
class controllers extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\scholar_b\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->registerTranslations();
        $this->layout="main_module";
        //\Yii::$app->language = "th";

        // custom initialization code goes here
    }
    public function registerTranslations()
    {
        \Yii::$app->i18n->translations['modules/scholar_b/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en',
            'basePath' => '@app/modules/scholar_b/messages',
            'fileMap' => [
                'modules/scholar_b/menu' => 'menu.php',
                'modules/scholar_b/label' => 'label.php',
            ],
        ];
    }
    public static function t($category, $message, $params = [], $language = null)
    {

        return \Yii::t('modules/scholar_b/' . $category, $message, $params, $language);
    }
}
