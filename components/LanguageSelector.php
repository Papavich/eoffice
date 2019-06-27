<?php
/**
 * Created by PhpStorm.
 * User: MainUser
 * Date: 27/10/2560
 * Time: 11:47
 */

namespace app\components;
use yii\base\BootstrapInterface;
class LanguageSelector implements BootstrapInterface
{
    public $supportedLanguages = [];

    public function bootstrap($app)
    {
        $preferredLanguage = isset($app->request->cookies['language']) ? (string)$app->request->cookies['language'] : null;
        if (empty($preferredLanguage)) {
            $preferredLanguage = 'th';
        }
        $app->language = $preferredLanguage;
    }
}