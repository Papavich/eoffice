<?php

namespace app\modules\module5;

/**
 * module5 module definition class
 */
class controllers extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\module5\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->registerTranslations();
       // \Yii::$app->language = "th";
    }
    public function registerTranslations()
    {
        \Yii::$app->i18n->translations['modules/module5/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@app/modules/module5/messages',
            'fileMap' => [
                'modules/module5/menu' => 'menu.php',
            ],
        ];
    }
    public static function t($category, $message, $params = [], $language = null)
    {

        return \Yii::t('modules/module5/' . $category, $message, $params, $language);
    }

}
