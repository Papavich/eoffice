<?php

namespace app\modules\eoffice_eolm;

/**
 * module5 module definition class
 */
class controllers extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\eoffice_eolm\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->layout="main";
        $this->registerTranslations();
        // \Yii::$app->language = "th";
    }
    public function registerTranslations()
    {
        \Yii::$app->i18n->translations['modules/eoffice_eolm/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@app/modules/eoffice_eolm/messages',
            'fileMap' => [
                'modules/eoffice_eolm/menu' => 'menu.php',
                'modules/eoffice_eolm/label' => 'label.php',
                'modules/eoffice_eolm/label_appform' => 'label_appform.php',
            ],
        ];
    }
    public static function t($category, $message, $params = [], $language = null)
    {

        return \Yii::t('modules/eoffice_eolm/' . $category, $message, $params, $language);
    }

}
