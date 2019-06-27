<?php
/**
 * Created by PhpStorm.
 * User: MainUser
 * Date: 26/10/2560
 * Time: 17:21
 */

namespace app\modules\eoffice_eolm\components;


use app\modules\eoffice_eolm\models\EolmSigner;
use app\modules\eoffice_eolm\models\model_main\EofficeMainUser;
use Yii;

class AuthHelper
{
    const TYPE_ADMIN = 0;
    const TYPE_TEACHER = 1;
    const TYPE_STUDENT = 2;
    const TYPE_GUEST = 3;
    const TYPE_APPROVERS = 4;
    public static function getUserType(){
        if(!Yii::$app->user->isGuest) {
            if (Yii::$app->user->can( 'Permit_eolm_Staff' )) {
                $userType = self::TYPE_ADMIN;
            } else if (Yii::$app->user->can( 'Permit_eolm_Teacher' )) {
                $approv = EolmSigner::find()->where(['eolm_signer_type_id'=>1])->one();
                $per = EofficeMainUser::find()->where(['id' => Yii::$app->user->identity->getId()])->one();
                if ($approv->getAttribute('person_id')==$per->getAttribute('person_id')){
                    $userType = self::TYPE_APPROVERS;
                }else{
                    $userType = self::TYPE_TEACHER;
                }

            } else {
                $userType = self::TYPE_GUEST;
            }
        }else {
            $userType = self::TYPE_GUEST;
        }
        return $userType;
    }
}