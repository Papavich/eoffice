<?php

namespace app\modules\eoffice_eolmv2;

/**
 * module5 module definition class
 */
class controllers extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\eoffice_eolmv2\controllers';

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
        \Yii::$app->i18n->translations['modules/eoffice_eolmv2/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@app/modules/eoffice_eolmv2/messages',
            'fileMap' => [
                'modules/eoffice_eolmv2/menu' => 'menu.php',
                'modules/eoffice_eolmv2/label' => 'label.php',
                'modules/eoffice_eolmv2/label_appform' => 'label_appform.php',
            ],
        ];
    }
    public static function t($category, $message, $params = [], $language = null)
    {

        return \Yii::t('modules/eoffice_eolmv2/' . $category, $message, $params, $language);
    }

}
