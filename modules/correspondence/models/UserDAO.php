<?php
/**
 * Created by PhpStorm.
 * User: VaraPhon
 * Date: 12/9/2017
 * Time: 2:34 PM
 */

namespace app\modules\correspondence\models;

use app\modules\correspondence\models\model_main\EofficeCentralViewPisBoardOfDirectors;
use app\modules\correspondence\models\model_main\EofficeCentralViewPisPerson;
use app\modules\correspondence\models\model_main\EofficeCentralViewPisUser;


class UserDAO
{
    public function createUsername($personcode)
    {
        //TODO ดึงข้อมูลจริง ใครอยู่ตำแหน่งไหน, person position type อะไร
        $viewPisUser = EofficeCentralViewPisUser::findOne($personcode); //call View
        $newUser = new User();
        if($viewPisUser)
        {
            $viewPisBoard = EofficeCentralViewPisBoardOfDirectors::find()
                ->where(['eoffice_central.view_pis_board_of_directors.person_id' => $viewPisUser->person->person_id])
                ->one();
            $newUser->prefix_th = $viewPisUser->PREFIXNAME;
            $newUser->lname = $viewPisUser->person_lname_th;
            $newUser->fname = $viewPisUser->person_fname_th;
            if (is_null($viewPisBoard)) {
                $newUser->person_position = $viewPisUser->person->person_position_staff;
                $newUser->person_type = 4;

            } else {
                $newUser->person_position = $viewPisBoard->position_name;
                $newUser->person_type = $viewPisUser->user_type_id;
            }
            $newUser->username = $viewPisUser->username;
            $newUser->email = $viewPisUser->email;
            $newUser->group_id = null;
            $newUser->personcode = (string)$viewPisUser->person_id;
        }else{
            $viewPisPerson  = EofficeCentralViewPisPerson::findOne($personcode); //call View
            $newUser->prefix_th = $viewPisPerson->viewUser->PREFIXNAME;
            $newUser->lname = $viewPisPerson->viewUser->person_lname_th;
            $newUser->fname = $viewPisPerson->viewUser->person_fname_th;
            if (!$viewPisPerson->boardDirector) {
                if($viewPisPerson->viewUser->person->person_position_staff)
                {
                    $newUser->person_position = $viewPisPerson->viewUser->person->person_position_staff;
                    $newUser->person_type = 4;
                }else
                {
                    $newUser->person_position = "อาจารย์";
                    $newUser->person_type = 2;
                }

            } else {
                //ถ้ามีตำแหน่งเป็นคณะผู้บริหาร
                $newUser->person_position = $viewPisPerson->boardDirector->position_name;
                $newUser->person_type = $viewPisPerson->viewUser->user_type_id;
            }
            $newUser->username = $viewPisPerson->viewUser->username;
            $newUser->email = $viewPisPerson->viewUser->email;
            $newUser->group_id = null;
            $newUser->personcode = (string)$viewPisPerson->person_id;
        }
        if ($newUser->save()) {
            return $newUser->id;
        }else{
            return false;
        }
    }

    public function updateUsername($personcode)
    {
        if(\Yii::$app->user->identity->username != "admin"){
            $viewPisUser = EofficeCentralViewPisUser::findOne($personcode); //call View
            $viewPisBoard = EofficeCentralViewPisBoardOfDirectors::find()
                ->where(['eoffice_central.view_pis_board_of_directors.person_id' => $viewPisUser->person->person_id])
                ->one();
            $newUser = User::find()->where(['personcode'=>$viewPisUser->person_id])->one();
            $newUser->prefix_th = $viewPisUser->PREFIXNAME;
            $newUser->lname = $viewPisUser->person_lname_th;
            $newUser->fname = $viewPisUser->person_fname_th;
            if (is_null($viewPisBoard)) {
                //Staff
                if($viewPisUser->person->person_position_staff)
                {
                    $newUser->person_position = $viewPisUser->person->person_position_staff;
                    $newUser->person_type = 4;
                }else
                {
                    $newUser->person_position = "อาจารย์";
                    $newUser->person_type = 2;
                }

            } else {
                //user อยู่ในบอร์ด
                $newUser->person_position = $viewPisBoard->position_name;
                $newUser->person_type = $viewPisUser->user_type_id;
            }

            $newUser->username = $viewPisUser->username;
            $newUser->email = $viewPisUser->email;
            $newUser->group_id = null;
            $newUser->personcode = (string)$viewPisUser->person_id;
            if ($newUser->save()) {
                return $newUser->id;
            }else{
                return false;
            }
        }

    }
    public static function findUser()
    {
        $model_user = EofficeCentralViewPisPerson::find()->all();
        return $model_user;
    }

    public static function getCurentUser()
    {
        if(\Yii::$app->authManager->isAdmin() || \Yii::$app->authManager->isStaffGeneral())
        {
            $user = User::findOne(1);
        }else
        {
            $user = User::find()->where(['username' => \Yii::$app->user->identity->username])->one();
        }
        return $user;
    }

}