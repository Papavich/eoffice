<?php

namespace app\modules\Tasystem;
/**
 * Tasystem module definition class
 */
class controllers extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\Tasystem\controllers';

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
        \Yii::$app->i18n->translations['modules/Tasystem/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@app/modules/Tasystem/messages',
            'fileMap' => [
                'modules/Tasystem/menu' => 'menu.php',
            ],
        ];
    }
    public static function t($category, $message, $params = [], $language = null)
    {

        return \Yii::t('modules/Tasystem/' . $category, $message, $params, $language);
    }
}
