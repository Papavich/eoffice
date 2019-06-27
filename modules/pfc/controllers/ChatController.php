<?php
/**
 * Created by PhpStorm.
 * User: pessm
 * Date: 9/1/2017
 * Time: 11:33 AM
 */

namespace app\modules\pfc\controllers;
use app\modules\pfc\models\ChatRoom;
use app\modules\pfc\models\ChatDetail;
use app\modules\pfc\models\ViewProject;
use yii\web\Controller;
use Yii;
use app\modules\personsystem\controllers\FunctionController;


class ChatController extends Controller
{
    // ฟังค์ชันเช็ค ID user
    public function actionChat($project_id){
        $session = Yii::$app->session;
        $project = ViewProject::find()->where("id like :b", [":b" => $project_id])->all();
        $chat_room = ChatRoom::find()->where("project_id like :b", [":b" => $project_id])->all();
        $session->set('pfc_project_id', $project_id);

        if ($chat_room != null) {
            if ($chat_room[0]->chat_room_id != null) {
                $chat_detail = ChatDetail::find()->where("chat_room_id like :b", [":b" => $chat_room[0]->chat_room_id])->all();
                return $this->render('chat', [
                    'chat_msg' => $chat_detail,
                    'project' => $project[0]->name_th,
                ]);
            }
        } else {
            $chat_room_add = New ChatRoom();
            $chat_room_add->chat_room_id = $project_id . '_ChatRoom';
            $chat_room_add->chat_date = date("Y/m/d");
            $chat_room_add->project_id = $project_id;
            $chat_room_add->save();
            return $this->redirect(['chat', 'project_id' => $project_id]);
        }
    }

    // ฟังค์ชันบันทึกข้อความที่ได้มาจาก user ลง DB
    public function actionChat_send(){
        date_default_timezone_set("Asia/bangkok");
        $msg_add = New ChatDetail();
        $session = Yii::$app->session;
        $msg_add->chat_name = FunctionController::getNameuser(Yii::$app->user->identity->id);
        $msg_add->chat_message = $_POST['msg'];
        $msg_add->chat_message_date = date("Y-m-d h:i:s a");
        $msg_add->chat_room_id = $session->get('pfc_project_id') . '_ChatRoom';
        $msg_add->save();

    }

    // ฟังค์ชัน ดึงข้อความจาก DB
    public function actionChat_msg(){
        $i = 0;
        $last_id = null;
        $msg_box = [];
        $session = Yii::$app->session;
        $chat_room = ChatRoom::find()->where("project_id like :b", [":b" => $session->get('pfc_project_id')])->all();
        $chat_detail = ChatDetail::find()->where("chat_room_id like :b", [":b" => $chat_room[0]->chat_room_id])->all();
        if (isset($chat_detail)) {
            foreach ($chat_detail as $item):
                if ($item['chat_name'] == FunctionController::getNameuser(Yii::$app->user->identity->id)) {
                    $type = "right";
                    $msg_box[$i] = "<div style='margin-bottom: 5px; margin-right: 10px; color:#969696;' align='right'>{$item['chat_name']}</div><li class='message $type appeared'><div class='avatar'></div><div class='text_wrapper'><div class='text'>{$item['chat_message']}</div></div></li>";
                } else {
                    $type = "left";
                    $msg_box[$i] = "<div style='margin-bottom: 5px; margin-left: 10px; color:#969696;' align='left'  >{$item['chat_name']}</div><li class='message $type appeared'><div class='avatar'></div><div class='text_wrapper'><div class='text'>{$item['chat_message']}</div></div></li>";
                }
                $last_id = $item['chat_id'];
                $i++;
            endforeach;
            return json_encode(['msg' => $msg_box, 'last_id' => $last_id, 'i' => $i]);



//            echo '{ "msg" :"';
//            foreach ($chat_detail as $item):
//                if ($item['chat_name'] == $session->get('pfc_name')) {
//                    $type = "right";
//                    echo "<div style='margin-bottom: 5px; margin-right: 10px; color:#969696;' align='right'>{$item['chat_name']}</div><li class='message $type appeared'><div class='avatar'></div><div class='text_wrapper'><div class='text'>{$item['chat_message']}</div></div></li>";
//                } else {
//                    $type = "left";
//                    echo "<div style='margin-bottom: 5px; margin-left: 10px; color:#969696;' align='left'  >{$item['chat_name']}</div><li class='message $type appeared'><div class='avatar'></div><div class='text_wrapper'><div class='text'>{$item['chat_message']}</div></div></li>";
//                }
//                $last_id = $item['chat_id'];
//            endforeach; echo '", "last_id" :'.$last_id.'}';

        }

    }

}