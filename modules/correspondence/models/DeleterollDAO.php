<?php

namespace app\modules\correspondence\models;


use Codeception\Module\Yii1;
use yii\helpers\FileHelper;
use Yii;

class DeleterollDAO
{
    /**
     * Created by PhpStorm.
     * User: HP
     * Date: 14/12/2560
     * Time: 16:27
     */

    /* public function findDeleteroll()
     {
         $model_delete = CmsDeleteRoll::find()->where(['delete_id' => Yii::$app->deleterolls->identity->delete_id])->one();
         return $model_delete;
     }*/
    public function findUser()
    {
        $user = User::find()->where(['username' => Yii::$app->user->identity->username])->one();
        return $user;
    }
    /* Insert Delete Update */
    public function createDeleteroll(Array $doc_id)
    {
        $model_board= \app\modules\correspondence\models\model_main\EofficeCentralViewPisBoardOfDirectors::find()
            ->where("position_name ='หัวหน้าภาควิชาวิทยาการคอมพิวเตอร์'")
            ->andWhere("period_describe ='สมัยปัจจุบัน'")
            ->one();
        date_default_timezone_set("Asia/Bangkok");
        $model = new CmsDeleteRoll();
        //if listmail is not empty, next we will find id of user and get user_id
        if (!empty($doc_id)) {
            $roll = CmsDeleteRoll::find()->orderBy(['roll' => SORT_DESC])->limit(1)->one();
            foreach ($doc_id as $rows) {
                $user = $this->findUser();
                $model->setIsNewRecord(true);
                $model->delete_id = "DEL" . date('is').$model_board->person_id;
                $model->time_start = date('Y-m-d H:i:s');
                $model->time_end = date('Y-m-d H:i:s');
                $model->status = "รออนุมัติ";
                $model->user_id=$user->id;
                $model->amount = 1;
                $model->doc_id = $rows;
                if ($roll == null ) {
                    $model->roll = 1;
                } else {
                    $model->roll = $roll->roll + 1;
                }
                $model->save();
            }
        }
}

public
function Deleteroll($roll)
{
    $model_delete = CmsDeleteRoll::find()->where(['roll' => $roll])->all();
    foreach ($model_delete as $item) {
        $model = CmsDeleteRoll::findOne($item['delete_id']);
        $model->delete();
    }


}

public
function Editdeleteroll($roll, $select)
{
    date_default_timezone_set("Asia/Bangkok");
    if ($select == 2) {

        \Yii::$app->db_cms->createCommand()
            ->update('cms_delete_roll', ['status' => 'กำลังทำลาย'], 'roll=' . $roll . '')
            ->execute();
    } else if ($select == 3) {

        \Yii::$app->db_cms->createCommand()
            ->update('cms_delete_roll', ['status' => 'ทำลายเสร็จสิ้น' ,'time_end'=>date('Y-m-d H:i:s')], 'roll=' . $roll . '')
            ->execute();
    } else if ($select == 1) {

        \Yii::$app->db_cms->createCommand()
            ->update('cms_delete_roll', ['status' => 'รออนุมัติ'], 'roll=' . $roll . '')
            ->execute();
    }


}
}