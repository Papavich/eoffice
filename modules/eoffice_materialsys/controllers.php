<?php

namespace app\modules\eoffice_materialsys;

/**
 * eoffice_materialsys module definition class
 */
class controllers extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\eoffice_materialsys\controllers';

    public $defaultRoute = 'widen';
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->layout = 'main_material';
        \Yii::setAlias('@mat_assets', '@web/../modules/eoffice_materialsys/assets');
        \Yii::setAlias('@mat_components', '@web/../modules/eoffice_materialsys/components');
        \Yii::setAlias('@mat_plugin', '@web/plugins');
        $this->registerTranslations();
        // custom initialization code goes here
    }

    public function registerTranslations()
    {
        \Yii::$app->i18n->translations['modules/eoffice_materialsys/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en',
            'basePath' => '@app/modules/eoffice_materialsys/messages',
            'fileMap' => [
                'modules/eoffice_materialsys/menu' => 'menu.php',
            ],
        ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return \Yii::t('modules/eoffice_materialsys/' . $category, $message, $params, $language);
    }
}
