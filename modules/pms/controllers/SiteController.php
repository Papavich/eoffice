<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 26/10/2560
 * Time: 15:15
 */

namespace app\modules\pms\controllers;
use app\modules\pms\components\AuthHelper;
use app\modules\pms\models\PmsCompactHasProsub;
use app\modules\pms\models\PmsProjectSub;
use Yii;
use yii\helpers\Json;
use yii\web\Controller;

class SiteController extends Controller
{

    public function actionIndex()
    {
        $calendars = "[";
        $model = PmsProjectSub::find()->all();


        $calendarss=[];
        foreach ($model as $row){
            $data = PmsCompactHasProsub::find()->where(['pms_project_sub_prosub_code'=>$row['prosub_code']])->all();
            $stgs ="".$row['prosub_start_date'];
            $dates = substr($stgs, 0, 10);
            $stge ="".$row['prosub_start_date'];
            $datee = substr($stge, 0, 10);
            $datee = date('Y-m-d', strtotime($datee. ' + 1 days'));
            $calendars = $calendars."{";
            $calendars = $calendars."title:\"".$row['prosub_name']."\",";
            $calendars = $calendars."start:\"".$dates."\",";
            $calendars = $calendars."end:\"".$datee."\",";
            $calendars = $calendars."url:\"../tablepro/prosub?id=".$row['prosub_code']."\",";

            $op['title'] = $row['prosub_name'];
            $op['start'] = $dates;
            $op['end'] = $datee;
            $op['url'] = "../tablepro/prosub?id=".$row['prosub_code'];

            if($data){
                $i = 0;
                foreach ($data as $rows){
                    if($rows['status_result'] == "เสร็จสิ้น"){
                        $i++;
                    }
                }
                if($i == sizeof($data)){
                    $calendars = $calendars."className:[\"bg-success\"],";
                    $op['className'] = "bg-success";
                }else{
                    $calendars = $calendars."className:[\"bg-info\"],";
                    $op['className'] = "bg-info";
                }
            }else{
                if($row['compact_save'] == "true"){
                    $calendars = $calendars."className:[\"bg-info\"],";
                    $op['className'] = "bg-info";
                }else{
                    $calendars = $calendars."className:[\"bg-primary\"],";
                    $op['className'] = "bg-primary";
                }

            }

            //$calendars = $calendars."description:\"จัดครั้งที่ ".$row->round."\",";
            $calendars = $calendars."icon:\"fa-clock-o\"";
//            $calendar =[
//                'title'=> $name->prosub_name,
//            'start'=> $dates,
//            'end'=> $datee,
//            'allDay'=> false,
//            'className'=>["bg-info"],
//            'description'=> 'รอบที่ '.$row->round,
//            'icon'=> 'fa-clock-o'
//            ];
            $calendars = $calendars."}";
            if(sizeof($model)>1){
                $calendars = $calendars.",";
            }





            $op['icon'] = "fa-clock-o";
            array_push($calendarss,$op);

        }
        $calendars = $calendars."]";
        //return Json::encode($calendarss);



        $this->layout = "main_module";
        $type_permis = AuthHelper::getUserType();

        if($type_permis == 0){
            return $this->render('index_responsible',['calendars'=>$calendars]);
        }else if($type_permis == 1){
            $prosub_offer = PmsProjectSub::find()->where(['prosub_status_offer'=>"รอฝ่ายพัฒนานักศึกษาตรวจสอบ"])->all();
            $prosub_place = $prosub = PmsProjectSub::find()->where(['compact_save'=>'true','prosub_status_place'=>'รอฝ่ายพัฒนานักศึกษาตรวจสอบ'])->all();
            $prosub_budget = Yii::$app->get('db_pms')->createCommand('SELECT * FROM pms_project_sub INNER JOIN pms_compact_has_prosub ON pms_compact_has_prosub.pms_project_sub_prosub_code = pms_project_sub.prosub_code WHERE pms_project_sub.compact_save = "true" AND pms_compact_has_prosub.status_finance = "รอฝ่ายพัฒนานักศึกษาตรวจสอบ"')
                ->queryAll();
            $prosub_pandb = Yii::$app->get('db_pms')->createCommand('SELECT * FROM pms_project_sub INNER JOIN pms_compact_has_prosub ON pms_compact_has_prosub.pms_project_sub_prosub_code = pms_project_sub.prosub_code WHERE pms_project_sub.compact_save = "true_pb" AND pms_compact_has_prosub.status_process = "4" AND pms_compact_has_prosub.status_pandf = "รอฝ่ายพัฒนานักศึกษาตรวจสอบ"')
                ->queryAll();
            return $this->render('index_staff',['calendars'=>$calendars,
                'prosub_offer'=>$prosub_offer,'prosub_place'=>$prosub_place,
                'prosub_budget'=>$prosub_budget,'prosub_pandb'=>$prosub_pandb]);
        }else if($type_permis == 2){
            $prosub_offer = PmsProjectSub::find()->where(['prosub_status_offer'=>"รอหัวหน้าภาคอนุมัติ"])->all();
            $prosub_place = $prosub = PmsProjectSub::find()->where(['compact_save'=>'true','prosub_status_place'=>'รอหัวหน้าภาคอนุมัติ'])->all();
            $prosub_budget = Yii::$app->get('db_pms')->createCommand('SELECT * FROM pms_project_sub INNER JOIN pms_compact_has_prosub ON pms_compact_has_prosub.pms_project_sub_prosub_code = pms_project_sub.prosub_code WHERE pms_project_sub.compact_save = "true" AND pms_compact_has_prosub.status_finance = "รอหัวหน้าภาคอนุมัติ"')
                ->queryAll();
            $prosub_pandb = Yii::$app->get('db_pms')->createCommand('SELECT * FROM pms_project_sub INNER JOIN pms_compact_has_prosub ON pms_compact_has_prosub.pms_project_sub_prosub_code = pms_project_sub.prosub_code WHERE pms_project_sub.compact_save = "true_pb" AND pms_compact_has_prosub.status_process = "4" AND pms_compact_has_prosub.status_pandf = "รอหัวหน้าภาคอนุมัติ"')
                ->queryAll();
            return $this->render('index_manager',['calendars'=>$calendars,
                'prosub_offer'=>$prosub_offer,'prosub_place'=>$prosub_place,
                'prosub_budget'=>$prosub_budget,'prosub_pandb'=>$prosub_pandb]);
        }else if($type_permis == 3){
            $prosub_offer = PmsProjectSub::find()->where(['prosub_status_offer'=>"รองานนโยบายและแผนอนุมัติ"])->all();
            $prosub_place = $prosub = PmsProjectSub::find()->where(['compact_save'=>'true','prosub_status_place'=>'รองานนโยบายและแผนอนุมัติ'])->all();
            $prosub_pandb = Yii::$app->get('db_pms')->createCommand('SELECT * FROM pms_project_sub INNER JOIN pms_compact_has_prosub ON pms_compact_has_prosub.pms_project_sub_prosub_code = pms_project_sub.prosub_code WHERE pms_project_sub.compact_save = "true_pb" AND pms_compact_has_prosub.status_process = "4" AND pms_compact_has_prosub.status_pandf = "รองานนโยบายและแผนอนุมัติ"')
                ->queryAll();
            return $this->render('index_planner',['calendars'=>$calendars,
                'prosub_offer'=>$prosub_offer,'prosub_place'=>$prosub_place,
                'prosub_pandb'=>$prosub_pandb]);
        }else if($type_permis == 4){
            $prosub_budget = Yii::$app->get('db_pms')->createCommand('SELECT * FROM pms_project_sub INNER JOIN pms_compact_has_prosub ON pms_compact_has_prosub.pms_project_sub_prosub_code = pms_project_sub.prosub_code WHERE pms_project_sub.compact_save = "true" AND pms_compact_has_prosub.status_finance = "รอการเงินอนุมัติ"')
                ->queryAll();
            $prosub_pandb = Yii::$app->get('db_pms')->createCommand('SELECT * FROM pms_project_sub INNER JOIN pms_compact_has_prosub ON pms_compact_has_prosub.pms_project_sub_prosub_code = pms_project_sub.prosub_code WHERE pms_project_sub.compact_save = "true_pb" AND pms_compact_has_prosub.status_process = "4" AND pms_compact_has_prosub.status_pandf = "รอการเงินอนุมัติ"')
                ->queryAll();
            return $this->render('index_finance',['calendars'=>$calendars,
                'prosub_budget'=>$prosub_budget,'prosub_pandb'=>$prosub_pandb]);
        }else{
        $prosub_offer = PmsProjectSub::find()->where(['prosub_status_offer'=>"รอฝ่ายพัฒนานักศึกษาตรวจสอบ"])->all();
        $prosub_place = $prosub = PmsProjectSub::find()->where(['compact_save'=>'true','prosub_status_place'=>'รอฝ่ายพัฒนานักศึกษาตรวจสอบ'])->all();
        $prosub_budget = Yii::$app->get('db_pms')->createCommand('SELECT * FROM pms_project_sub INNER JOIN pms_compact_has_prosub ON pms_compact_has_prosub.pms_project_sub_prosub_code = pms_project_sub.prosub_code WHERE pms_project_sub.compact_save = "true" AND pms_compact_has_prosub.status_finance = "รอฝ่ายพัฒนานักศึกษาตรวจสอบ"')
            ->queryAll();
        $prosub_pandb = Yii::$app->get('db_pms')->createCommand('SELECT * FROM pms_project_sub INNER JOIN pms_compact_has_prosub ON pms_compact_has_prosub.pms_project_sub_prosub_code = pms_project_sub.prosub_code WHERE pms_project_sub.compact_save = "true_pb" AND pms_compact_has_prosub.status_process = "4" AND pms_compact_has_prosub.status_pandf = "รอฝ่ายพัฒนานักศึกษาตรวจสอบ"')
            ->queryAll();
            return $this->render('index',['calendars'=>$calendars,
                'prosub_offer'=>$prosub_offer,'prosub_place'=>$prosub_place,
                'prosub_budget'=>$prosub_budget,'prosub_pandb'=>$prosub_pandb]);
        }




    }
}