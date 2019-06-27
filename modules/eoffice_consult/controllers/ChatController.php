<?php

namespace app\modules\eoffice_consult\controllers;

use app\modules\eoffice_consult\models\ConsultChatRoom;
use app\modules\eoffice_consult\models\ConsultChatDetail;
use app\modules\eoffice_consult\models\ConsultUserRoom;
use app\modules\eoffice_consult\models\ViewPisUser;
use app\modules\eoffice_consult\models\EofficeCentralViewPisUser;
use yii\web\Controller;
use Yii;

class ChatController extends Controller
{
  // ฟังค์ชันเช็ค ID user
  public function actionIndex()
  {
      $this->layout = "main_modules";
      //Yii::$app->user->getId();
      $session = Yii::$app->session;
      $chat_room = ConsultUserRoom::find()->where("user_id like :b",[":b"=> /*Yii::$app->user->getId()*/  "1" ])->all(); //เปลี่ยน"1"ตามข้างบน รับค่าอะไรมาก็เอามาเช็ค  //UserRoom เอามาเช็ค
      $session->set('chat_room_id', $chat_room[0]->chat_room_id);


      if($chat_room != null) {
          if($chat_room[0]->chat_room_id != null) {
              $chat_detail = ConsultChatDetail::find()->where("chat_room_id like :b", [":b" => $chat_room[0]->chat_room_id])->all();
              return $this->render('chat', [
                  'chat_msg' => $chat_detail,
              ]);
          }
      }else{
          $chat_room_add = New ConsultChatRoom();
          $chat_room_add->chat_room_id = $user_id/*Yii::$app->user->getId()*/.'_ChatRoom';
          $chat_room_add->chat_room_date = date("Y/m/d");
        //  $consult_chat_room_add->consult_user_id = $project_id;
          $chat_room_add->save();
        return $this->redirected(['chat', 'user_id' => $user_id/*Yii::$app->user->getId()*/]);
      }
      return $this->render('chat', [
          'user_id' => $user_id,
      ]);
  }

  // ฟังค์ชันบันทึกข้อความที่ได้มาจาก user ลง DB
  public function actionChat_send(){
      $msg_add = New ConsultChatDetail();
      $session = Yii::$app->session;
      $msg_add->chat_detail_name = "อาจารย์"; //$session->get('name');
      $msg_add->chat_detail_message = $_POST['msg'];//$_POST['msg']'';
      $msg_add->chat_detail_message_date = date("Y-m-d");
      $msg_add->chat_room_id = "1";//$session->get('consult_chat_room_id');
      if(!$msg_add->save()) echo var_dump($msg_add->errors);
  }

  // ฟังค์ชัน ดึงข้อความจาก DB
  public function actionChat_msg(){
      $last_id = null;
      $session = Yii::$app->session;
      $chat_room = ConsultUserRoom::find()->where("user_id like :b",[":b"=>"1"])->all(); //"1" เก็บจากsession
      $chat_detail = ConsultChatDetail::find()->where("chat_room_id like :b", [":b" => "1"])->all();
      if(isset($chat_detail)) {
          echo '{ "msg" :"';
          foreach ($chat_detail as $item):
              if ($item['chat_detail_name'] == "อาจารย์") {
                  $type = "right";
              } else {
                  $type = "left";
              }
              echo "<li class='message $type appeared'><div class='avatar'></div><div class='text_wrapper'><div class='text'>{$item['chat_detail_message']}</div></div></li>";
              $last_id = $item['chat_detail_id'];
          endforeach; echo '", "last_id" :'.$last_id.'}';
      }
  }


}
