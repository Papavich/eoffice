<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 26/10/2560
 * Time: 15:15
 */

namespace app\modules\scholar_b\controllers;


use app\modules\scholar_b\models\model_main\EofficeCentralViewPisUser;
use app\modules\scholar_b\models\ScbNews;
use app\modules\scholar_b\models\ScbCalendar;
use app\modules\scholar_b\models\ScbProject;
use app\modules\scholar_b\models\ScbStudent;
use app\modules\scholar_b\models\ScbStudentHasProject;
use app\modules\scholar_b\models\ScbStudentHasTeacher;
use yii\web\Controller;
use yii\data\Pagination;
use yii\helpers\Json;
use Yii;


class SiteController extends Controller
{
    const NEWS_PAGE_SIZE = 10;

    /**
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = "main_module";

        $personId = EofficeCentralViewPisUser::findOne(\Yii::$app->user->identity->getId())->username;

        //check project
        $student = ScbStudentHasProject::find()->where(['student_id'=>$personId])->all();

        // Advisor from student
        $student_teacher = ScbStudent::findOne($personId);


        /* CALENDAR */
        $calendars = "[";
        $model = ScbCalendar::find()->all();
        foreach ($model as $row) {
            $name = ScbCalendar::findOne($row['calendar_id']);
            $stgs = "" . $row['calendar_date_start'];
            $datestart = substr($stgs, 0, 10);
            $stge = "" . $row['calendar_date_end'];
            $dateend = substr($stge, 0, 10);
            //$dateend = date('Y-m-d', strtotime($dateend. ' + 1 days'));
            $calendars = $calendars . "{";
            $calendars = $calendars . "title:\"" . $name->calendar_topic . "\",";
            $calendars = $calendars . "start:\"" . $datestart . "\",";
            $calendars = $calendars . "end:\"" . $dateend . "\",";
            $calendars = $calendars . "className:[\"bg-info\"],";
            $calendars = $calendars . "icon:\"fa-clock-o\"";

            $calendars = $calendars . "}";
            if (sizeof($model) > 1) {
                $calendars = $calendars . ",";
            }
        }
        $calendars = $calendars . "]";

        /* NEWS */
        $query = ScbNews::find()->orderBy('crtime DESC');
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => self::NEWS_PAGE_SIZE]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        /* END NEWS */

        return $this->render('index', [
            'model' => $models,
            'pages' => $pages,
            'calendars' => $calendars,
            'student_teacher' => $student_teacher,
            'student' => $student,
        ]);
    }



    // ตั้งแต่ตรงนี้ลงไปเป็นส่วนของการสมัครทุน
    // main_guest , main_user เป็นส่วนของการสมัครทุน
    public function actionIndexOther()
    {
        $this->layout = "main_guest";
        return $this->render('index-other');
    }

    public function actionLogout()
    {
        session_destroy();
        $this->layout = "main_guest";
        return $this->render('index-other');
    }


    public function actionError500()
    {
        $this->layout = "main_guest";
        return $this->render('error500');
    }

    public function actionError404()
    {
        $this->layout = "main_guest";
        return $this->render('error404');
    }

}