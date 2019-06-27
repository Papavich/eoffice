<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10/3/2017
 * Time: 10:14 PM
 */

namespace app\components;
use mdm\admin\components\MenuHelper;
use yii\base\Widget;
use yii\bootstrap\Nav;
use yii\helpers\Html;
use Yii;

class CenterWidget extends Nav
{
    public $model;

    public function init()
    {
        parent::init();
    }
    public function run()
    {

        $html = '<span></span>';
        $arr = [];
//        $funcT='\app\modules\\'.Yii::$app->controller->module->id.'\controllers::t';
//        $html .= '<li><a href="'.Yii::getAlias('@web').'"> <i class="main-icon fa fa-home"></i> <span>'.$funcT('menu','Home').'</span></a></li>';
        $html .= '<li><a href="'.Yii::getAlias('@web').'"> <i class="main-icon fa fa-home"></i> <span>'.Yii::t('app','Home').'</span></a></li>';
        foreach (MenuHelper::getAssignedMenu(\Yii::$app->user->id) as $key => $a) {
            $arr[$key]["label"] = $a["label"];
            $arr[$key]["url"] = $a["url"];
            $arr[$key]["icon"] = $a["icon"];
            $html .= '<li >';
            $html .= '<a href="'.Yii::getAlias('@web').$arr[$key]["url"][0].'" class="dashboard"><i class="'.$arr[$key]["icon"].'"  style="font-size: 20px"></i>  '."&nbsp;&nbsp;<span style=\"font-size: 16px\">".$arr[$key]["label"].'</span></a>';
            $html .= '</li>';
        }
        //echo Json::encode(MenuHelper::getAssignedMenu(\Yii::$app->user->id));


        // register fontawesome CSS
        $fontawesome_url = 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css';
        $this->getView()->registerCssFile($fontawesome_url, [], 'VoteWidget-fontawesome');

        // return html content for rendering
        return $html;
    }
}