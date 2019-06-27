<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/17/2017
 * Time: 3:43 AM
 */

namespace app\components;

use mdm\admin\components\MenuHelper;
use yii\base\Widget;
use yii\bootstrap\Nav;
use yii\helpers\Html;
use Yii;

class Mywidget extends Nav
{
    public $model;

    public function init()
    {
        parent::init();
    }

    public function run()
    {

        $html = '<span></span>';

        $funcT='\app\modules\\'.Yii::$app->controller->module->id.'\controllers::t';
        $arr = [];

        $urlcheck = str_replace(Yii::$app->request->BaseUrl ,"",Yii::$app->request->url);
        foreach (MenuHelper::getAssignedMenu(\Yii::$app->user->id) as $key => $a) { //เอา key ของ arrayมาเก็บไว้

            if ($a['module'] == Yii::$app->controller->module->id) { //if key index of lable === module5
                if (array_key_exists("items", $a)) {
                    //$html .= '<ul class="nav nav-list">';
                    foreach ($a["items"] as $b) { //$b = ค่าใน array //เอา $a ไปใส่ $b
                        $arr2 = [];
                        $arr2["label"] = $b["label"];
                        $arr2["url"] = $b["url"];
                        $arr2["icon"] = $b["icon"];
                        array_push($arr, $arr2); //เอา $arr2 มาต่อท้าย จะได้ไม่ซ้ำ index

                        $html .= '<li >';
                        //เงื่อนไขตรงนี้เช็คว่ามี parent หรือไม่ ถ้ามี parent จะไม่มี path ให้คลิกปุ่มได้ ซึ่งก็คือเงื่อนไข else
                        if(!array_key_exists("items", $b)){
                            if(strcmp($urlcheck,$arr2["url"][0])==0){$html .= '<li class="active">';}
                            $html .= '<a class="up-vote" href="'.Yii::getAlias('@web').$arr2["url"][0].'"><i class="'.$arr2["icon"].'" style="font-size: 20px"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size: 14px">'. $funcT('menu', $arr2["label"]);
                            if(strcmp($urlcheck,$arr2["url"][0])==0){$html .= '</li>';}
                        }else {
                           
                            $html .= '<a class="up-vote" href="#"><i class="' . $arr2["icon"] . '" style="font-size: 20px"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size: 14px">' . $funcT('menu', $arr2["label"]);

                        }
                        if (array_key_exists("items", $b)) { //เช็คลูกอีกรอบ :: ถ้ามี index items ใน $b // $b  = array BIG
                            // $arr["items"] = $b["items"];
                            //ถ้ามี items ให้มีปุ่มกดลงได้ **แต่จะใช้ชื่อว่าอะไร** ซึ่งมันเป็นไปไม่ได้ ยังไงก็ต้อง custom
                            $html .= '</span><i class="fa fa-menu-arrow pull-right"></i></a>';

                            $html .= '<ul style="display: block;">';
                            foreach ($b["items"] as $c){
                                $arr3 = [];
                                $arr3["label"] = $c["label"];
                                $arr3["url"] = $c["url"];
                                //array_push($arr, $arr3);

                                if(strcmp($urlcheck,$arr3["url"][0])==0){
                                    $html .= '<li class="active">';
                                }else{
                                    $html .= '<li>';
                                }
                                $html .= '<a style="font-size: 15px" href="'.Yii::getAlias('@web').$arr3["url"][0].'" class="up-vote">'. $funcT('menu', $arr3["label"]).'</a>';
                                $html .= '</li>';
                            }
                            $html .= '</ul>';
                        }else{
                            $html .= '</span></a>';
                        }
                        $html .= '</li>';
                    }
                }
            }
        }

       $html .= '</ul>';
        // render up and down icon
        $html .= '<div>';
        $html .= '<a class="up-vote"><i class=""></i></a>';
        $html .= '&nbsp;&nbsp;&nbsp;&nbsp;';
        $html .= '<a class="down-vote"><i class=""></i></a>';
        $html .= '</div>';
        $html .= ' <h3>ระบบหลัก</h3>';
        $html .= '<ul class="nav nav-list">';
        $html .= '<li><a href="'.Yii::getAlias('@web').'"> <i class="main-icon glyphicon glyphicon-log-out"></i> <span>'.$funcT('menu','Back Main').'</span></a></li>';
        $html .= '</ul>';

        // register fontawesome CSS
        $fontawesome_url = 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css';
        $this->getView()->registerCssFile($fontawesome_url, [], 'VoteWidget-fontawesome');

        // return html content for rendering
        return $html;
    }

}