<?php

namespace app\modules\correspondence;
use app\modules\correspondence\models\model_main\EofficeCentralViewPisUser;

/**
 * correspondence module definition class
 */
class controllers extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\correspondence\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->registerTranslations();
        // \Yii::$app->language = "en";
        $this->layout = "main";
    }

    public function registerTranslations()
    {
        \Yii::$app->i18n->translations['modules/correspondence/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@app/modules/correspondence/messages',
            'fileMap' => [
                'modules/correspondence/menu' => 'menu.php',
            ],
        ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return \Yii::t('modules/correspondence/' . $category, $message, $params, $language);
    }

    public static function getNameuser($user_id){
        $name = EofficeCentralViewPisUser::find()->select(['student_fname_th','student_lname_th','person_lname_th','person_fname_th'])->where(['id'=>$user_id])->one();
        $nameuser = \Yii::$app->user->identity->username;
        if($name->student_fname_th!=null){
            $nameuser = $name->student_fname_th." ".$name->student_lname_th;
        }elseif ($name->person_lname_th!=null){
            $nameuser = $name->person_fname_th." ".$name->person_lname_th;
        }
        return $nameuser;
    }

    public static function DateThai($strDate)
    {
        $strYear = date("Y", strtotime($strDate)) + 543;
        $strMonth = date("n", strtotime($strDate));
        $strDay = date("j", strtotime($strDate));
        $strHour = date("H", strtotime($strDate));
        $strMinute = date("i", strtotime($strDate));
        $strSeconds = date("s", strtotime($strDate));
        $strMonthCut = Array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
        $strMonthThai = $strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear $strHour:$strMinute";
    }

    public static function DateThaiForMail($strDate)
    {
        $strYear = date("Y", strtotime($strDate)) + 543;
        $strMonth = date("n", strtotime($strDate));
        $strDay = date("j", strtotime($strDate));
        $strHour = date("H", strtotime($strDate));
        $strMinute = date("i", strtotime($strDate));
        $strSeconds = date("s", strtotime($strDate));
        $strMonthCut = Array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
        $strMonthThai = $strMonthCut[$strMonth];

        date_default_timezone_set("Asia/Bangkok");
        date('Y-m-d H:i:s');
        if (substr($strDate, 0, 10) == date('Y-m-d')) {
            return "$strHour:$strMinute";
        } elseif (substr($strDate, 0, 10) < date('Y-m-d') && substr($strDate, 0, 4) == date('Y')) {
            return "$strDay" . "-" . " $strMonthThai";
        } else {
            return "$strDay" . "-" . " $strMonthThai" . "-" . $strYear;
        }
    }
}
