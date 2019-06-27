<?php

namespace app\modules\materialsystem;

/**
 * materialsystem module definition class
 */
class controllers extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\materialsystem\controllers';




    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->registerTranslations();

        $this->layout = "main";
        // custom initialization code goes here
    }
    public function registerTranslations()
    {
        \Yii::$app->i18n->translations['modules/materialsystem/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en',
            'basePath' => '@app/modules/materialsystem/messages',
            'fileMap' => [
                'modules/materialsystem/menu' => 'menu.php',
            ],
        ];
    }
    public static function t ($category, $message, $params = [], $language = null)
    {
        return \Yii::t('modules/materialsystem/'. $category, $message, $params, $language);
    }
}
