<?php

namespace app\modules\eoffice_exam;
/**
 * eoffice_exam module definition class
 */
class controllers extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\eoffice_exam\controllers';

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
        \Yii::$app->i18n->translations['modules/eoffice_exam/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@app/modules/eoffice_exam/messages',
            'fileMap' => [
                'modules/eoffice_exam/menu' => 'menu.php',
            ],
        ];
    }
    public static function t($category, $message, $params = [], $language = null)
    {

        return \Yii::t('modules/eoffice_exam/' . $category, $message, $params, $language);
    }
}
