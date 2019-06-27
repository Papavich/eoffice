<?php

namespace app\modules\eproject\controllers;

use app\modules\eproject\components\ModelHelper;
use app\modules\eproject\models\AdviserBroadcast;
use app\modules\eproject\models\News;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

class SiteController extends Controller
{
    const APPROVED_NEWS = 2;
    const NEWS_SIZE_LIMIT = 10;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $news = News::find()->where( ['status_id' => $this::APPROVED_NEWS] )
            ->orderBy( 'crtime DESC' )
            ->limit( self::NEWS_SIZE_LIMIT )->all();
        $broadcasts=AdviserBroadcast::find()->where( ['year_id' => ModelHelper::getNowYear()] )
            ->andWhere( ['semester_id' => ModelHelper::getNowSemester()] )
            ->orderBy( 'udtime DESC' )
            ->all();
        return $this->render( 'index',
            ['news' => $news,
                'broadcasts'=>$broadcasts] );


    }

    public function actionUpload()
    {

        $uploadedFile = UploadedFile::getInstanceByName('upload');
        $mime = \yii\helpers\FileHelper::getMimeType($uploadedFile->tempName);
        $file = time()."_".$uploadedFile->name;

        $user_id = Yii::$app->user->getId();

        $url = Yii::$app->urlManager->createAbsoluteUrl('/web_eproject/news_images/'.$user_id.'/'.$file);
        $uploadPath = Yii::getAlias('@webroot').'/web_eproject/news_images/'.$user_id.'/'.$file;

        if (!is_dir(Yii::getAlias('@webroot').'/web_eproject/news_images/'.$user_id)) { //ถ้ายังไม่มี folder ให้สร้าง folder ตาม user id

            FileHelper::createDirectory(Yii::getAlias('@webroot').'/web_eproject/news_images/'.$user_id);
        }

        //ตรวจสอบ
        if ($uploadedFile==null)
        {
            $message = "ไม่มีไฟล์ที่ Upload";
        }
        else if ($uploadedFile->size == 0)
        {
            $message = "ไฟล์มีขนาด 0";
        }
        else if ($mime!="image/jpeg" && $mime!="image/png" && $mime != "image/gif")
        {
            $message = "รูปภาพควรเป็น JPG หรือ PNG";
        }
        else if ($uploadedFile->tempName==null)
        {
            $message = "มีข้อผิดพลาด";
        }
        else {
            $message = "";
            $move = $uploadedFile->saveAs($uploadPath);
            if(!$move)
            {
                $message = "ไม่สามารถนำไฟล์ไปไว้ใน Folder ได้กรุณาตรวจสอบ Permission Read/Write/Modify";
            }
        }
        $funcNum = $_GET['CKEditorFuncNum'] ;
        echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";
    }

}