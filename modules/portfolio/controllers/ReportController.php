<?php

namespace app\modules\portfolio\controllers;
use app\modules\portfolio\models\Project;
use app\modules\portfolio\models\Dissemination;
use app\modules\portfolio\models\ProjectOrder;
use app\modules\portfolio\models\Publication;
use app\modules\portfolio\models\PublicationOrder;
use app\modules\portfolio\models\PublicationsType;
use app\modules\portfolio\models\PublicationType;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\helpers\Json;
use app\modules\portfolio\models\Person;
use app\modules\portfolio\models\Department;
use sanex\simplefilter\SimpleFilter;
use yii\base\Component;
use yii\caching\DbCache;

/**
 * PrefixController implements the CRUD actions for Prefix model.
 */
class ReportController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Prefix models.
     * @return mixed
     */
    public function actionIndex()
    {

    }

    public function actionReport1()
    {
        $model = new PublicationOrder();

        $query = new \yii\db\ActiveQuery($model);
        // return Json::encode($query);
        $query->select(['id', 'name', 'size', 'price', 'country'])->where(['country' => 'Canada'])->orderBy(['price' => SORT_ASC]);

        $ajaxViewFile = '@sanex/catalog/views/catalog/catalog-ajax';

        $filter = SimpleFilter::getInstance();
        $filter->setParams([
            'model' => $model,
            'query' => $query,
            'useAjax' => true,
            'useCache' => true,
            'useDataProvider' => true,
        ]);

        //$searchModel = new PublicationOrder();


        $pubs = PublicationOrder::find()->where(['YEAR(date)' => 2018])->all();


        $current_year = date("Y");


        $publication_order_count = [];

        $public_types = PublicationType::find()->all();
//        return Json::encode($public_types);
        $disseminations = Dissemination::find()->all();
//                return Json::encode($disseminations);
        $persons = Yii::$app->getDb()->createCommand('SELECT * FROM view_pis_user WHERE user_type_id = 1')->queryAll();


        foreach ($persons as $key => $person) {
            $per = [];
            $per['name'] = $person['person_fname_th'] . '  ' . $person['person_lname_th'];
            $per['dept'] = $person['major_code'];
            $per['years'] = [];
            $i = 0;
            for ($year = $current_year; $year >= $current_year - 2; $year--) {
                $year__ = [];
                $year__['disses'] = [];
                array_push($per['years'], $year__);
                foreach ($disseminations as $diss_key => $dissemination) {
                    $diss = [];
                    $diss['types'] = [];
                    array_push($per['years'][$i]['disses'], $diss);
                    foreach ($public_types as $type_key => $public_type) {
//                        return $year . '';
                        $type = [];
                        $count = PublicationOrder::find()
                            // ->joinWith(['publicationOrder order'])
                            ->where([
                                'YEAR(date)' => $year . '',
                                'publications_type_pub_type_id' => $public_type->pub_type_id,
                                'dissemination_id' => $dissemination->id,
                                'person_id' => $person['id']
                            ])->count();
                        //   echo $count.' | ';
                        $type['count'] = $count;
                        array_push($per['years'][$i]['disses'][$diss_key]['types'], $type);
                    }
                }
                $i++;
            }
            array_push($publication_order_count, $per);
        }
//        return Json::encode($publication_order_count);
        //  return Json::encode(null);


        return $this->render('report1', [
            //'year' => $year,
            'public_types' => $public_types,
            'persons' => $persons,
            'disseminations' => $disseminations,
            'publication_order_count' => $publication_order_count,
            'pubs' => $pubs,
            'current_year' => $current_year,
            //  ' searchModel'=>$searchModel

        ]);
//    }
//    public function actionReportVal()
//    {
//
//
//        /*
//          SELECT
//             department.department_name
//             FROM
//             person
//             INNER JOIN department ON person.department_id = department.department_id
//             GROUP BY
//             department.department_name
//          */
//        $query = new Query();
//        $department = Yii::$app->getDb()->createCommand('SELECT major_name FROM view_pis_user WHERE user_type_id = 0 ')->queryAll();
//
//            ->innerJoin($department,'person.department_id = department.department_id')
//            ->groupBy('department.department_name')
//            ->all();
//
//        //Count(person.person_id) AS countperson
//        $query2 = new Query();
//        $count = $query2->select('Count(person.person_id) AS countperson')
//            ->from('person')
//            ->innerJoin('department','person.department_id = department.department_id')
//            ->groupBy('department.department_name')
//            ->all();
//
//
//
//        return $this->render('reportval',[
//            'department' => $department,
//            'count' => $count,
//        ]);
//    }


    }


    public function actionReportStd()
    {


        $pub_order = PublicationOrder::find()->where('person_id IS NOT NULL')->groupBy(['person_id'])->all();
        //return Json::encode($pub_order);


        $pubs = PublicationOrder::find()->where(['YEAR(date)' => 2018])->all();


        $current_year = date("Y");


        $publication_order_count = [];

        $public_types = PublicationType::find()->all();
        $disseminations = Dissemination::find()->all();
        $persons = Yii::$app->getDb()->createCommand('SELECT * FROM view_pis_user WHERE user_type_id = 0  ')->queryAll();
        $query2 = PublicationOrder::find()
            ->where(['!=', 'pub_order_id', NULL])->all();


//        $ssssssss = [];

        foreach ($pub_order as $order) {
            $person = Yii::$app->getDb()->createCommand('SELECT * FROM view_pis_user WHERE id = ' . $order->person_id)->queryOne();
            if ($person['user_type_id'] == '0') {
//                array_push($ssssssss, $person);
                $per = [];
                $per['name'] = $person['student_fname_th'] . ' ' . $person['student_lname_th'];
                $per['dept'] = $person['major_code'];
                $per['years'] = [];
                $i = 0;
                for ($year = $current_year; $year >= $current_year - 2; $year--) {
                    $year__ = [];
                    $year__['disses'] = [];
                    array_push($per['years'], $year__);
                    foreach ($disseminations as $diss_key => $dissemination) {
                        $diss = [];
                        $diss['types'] = [];
                        array_push($per['years'][$i]['disses'], $diss);
                        foreach ($public_types as $type_key => $public_type) {
                            $type = [];
                            $count = PublicationOrder::find()
                                // ->joinWith(['publicationOrder order'])
                                ->where([
                                    'YEAR(date)' => $year . '',
                                    'publications_type_pub_type_id' => $public_type->pub_type_id,
                                    'dissemination_id' => $dissemination->id,
                                    'person_id' => $person['id']
                                ])->count();
                            $type['count'] = $count;
                            array_push($per['years'][$i]['disses'][$diss_key]['types'], $type);
                        }
                    }
                    $i++;
                }
                array_push($publication_order_count, $per);
            }
        }

        // return Json::encode($p);

        return $this->render('reportstd', [
            //'year' => $year,
            'public_types' => $public_types,
            'persons' => $persons,
            'disseminations' => $disseminations,
            'publication_order_count' => $publication_order_count,
            'pubs' => $pubs,
            'current_year' => $current_year,
        ]);

//        foreach ($persons as $key => $person) {
//            $per = [];
//            $per['name'] = $person['person_fname_th'] . ' ' . $person['person_lname_th'] or $person['student_fname_th'] . ' ' . $person['student_lname_th'];
//            $per['dept'] = $person['major_code'];
//            $per['years'] = [];
//            $i = 0;
//            for ($year = $current_year; $year >= $current_year - 1; $year--) {
//                $year__ = [];
//                $year__['disses'] = [];
//                array_push($per['years'], $year__);
//                foreach ($disseminations as $diss_key => $dissemination) {
//                    $diss = [];
//                    $diss['types'] = [];
//                    array_push($per['years'][$i]['disses'], $diss);
//                    foreach ($public_types as $type_key => $public_type) {
//                        $type = [];
//                        $count = PublicationOrder::find()
//                            // ->joinWith(['publicationOrder order'])
//                            ->where([
//                                'YEAR(date)' => $year . '',
//                                'publications_type_pub_type_id' => $public_type->pub_type_id,
//                                'dissemination_id' => $dissemination->id,
//                                'person_id' => $person['person_id']
//                            ])->count();
//                        $type['count'] = $count;
//                        array_push($per['years'][$i]['disses'][$diss_key]['types'], $type);
//                    }
//                }
//                $i++;
//            }
//            array_push($publication_order_count, $per);
//        }
//        return Json::encode($publication_order_count);


//        return $this->render('reportstd', [
//            //'year' => $year,
//            'public_types' => $public_types,
//            'persons' => $persons,
//            'disseminations' => $disseminations,
//            'publication_order_count' => $publication_order_count,
//            'pubs' => $pubs,
//            'current_year' => $current_year,
//
//
//        ]);
    }

    /**
     * @return string
     */
    public function actionReportMe()
    {


        $pubs = PublicationOrder::find()->where(['YEAR(date)' => 2018])->all();


        $current_year = date("Y");


        $publication_order_count = [];

        $public_types = PublicationType::find()->all();
        $disseminations = Dissemination::find()->all();
        $id = Yii::$app->user->getId();

        $query = Yii::$app->getDb()->createCommand("SELECT * FROM view_pis_user where id=$id")->queryOne();

        //return Json::encode($query);


        $query2 = PublicationOrder::find()
            // ->joinWith(['publicationPub pub'])
            ->asArray()
            ->where([

                'person_id' => $query['id']
            ])->all();
        //   return Json::encode($query2);
        $person = [];

        foreach ($query2 as $key => $person['person_id']) {
//            $per = [];
//           $per['name'] = $person['person_fname_th'].'  '.$person['person_lname_th'] or  $person['student_fname_th'] . ' ' . $person['student_lname_th'];
//           $per['dept'] = $person['major_code'];
            $per['years'] = [];
            $i = 0;
            for ($year = $current_year; $year >= $current_year - 4; $year--) {
                $year__ = [];
                $year__['disses'] = [];
                array_push($per['years'], $year__);
                foreach ($disseminations as $diss_key => $dissemination) {
                    $diss = [];
                    $diss['types'] = [];
                    array_push($per['years'][$i]['disses'], $diss);
                    foreach ($public_types as $type_key => $public_type) {
                        $type = [];
                        $count = PublicationOrder::find()
                            // ->joinWith(['publicationOrder order'])
                            ->where([
                                'YEAR(date)' => $year . '',
                                'publications_type_pub_type_id' => $public_type->pub_type_id,
                                'dissemination_id' => $dissemination->id,
                                'person_id' => $person['person_id']
                            ])->count();
                        $type['count'] = $count;
                        array_push($per['years'][$i]['disses'][$diss_key]['types'], $type);
                    }
                }
                $i++;
            }
            array_push($publication_order_count, $per);
        }
        //return Json::encode();


        return $this->render('reportme', [
            // 'year' => $year,
            'public_types' => $public_types,
            'query2' => $query2,
            'disseminations' => $disseminations,
            'publication_order_count' => $publication_order_count,
            'pubs' => $pubs,
            'current_year' => $current_year,

        ]);
    }

    public function actionReport2()
    {
        $departments = Yii::$app->getDb()->createCommand("SELECT * FROM view_pis_major")->queryAll();

        $current_year = date("Y");

        $pub_order = PublicationOrder::find()->where('person_id IS NOT NULL')->groupBy(['person_id'])->all();

        $publication_order_count = [];

        foreach ($pub_order as $order) {
            $person = Yii::$app->getDb()->createCommand('SELECT * FROM view_pis_user WHERE user_id = ' . $order->person_id)->queryOne();
            for ($year = $current_year; $year >= $current_year - 4; $year--) {
                $yearx = [];
                $count = PublicationOrder::find()
                    ->where([
                        'YEAR(date)' => $year . '',
//                        'person_id' => $person['person_id']
                    ])
                    ->count();
                $yearx['year'] = $year;
                $yearx['count'] = $count;
                array_push($publication_order_count, $yearx);
            }

            //   return Json::encode($publication_order_count);


            /*
     SELECT
        department.department_name
        FROM
        person
        INNER JOIN department ON person.department_id = department.department_id
        GROUP BY
        department.department_name
     */


//            $query = new PublicationsType();
//            $department = $query->select('pub_type_name')
//                ->from('publication_order')
//                ->innerJoin('publications_type', 'publication_order.publications_type_pub_type_id = publications_type.pub_type_id')
//                ->groupBy('publications_type.pub_type_name')
//                ->all();
//
//            //Count(person.person_id) AS countperson
//            $query2 = new PublicationOrder();
//            $count = $query2->select('Count(publication_order.pub_order_id) AS countpublication_order')
//                ->from('publication_order')
//                ->innerJoin('publications_type', 'publication_order.publications_type_pub_type_id = publications_type.pub_type_id')
//                ->groupBy('publications_type.pub_type_name')
//                ->all();

            //return Json::encode($publication_order_count);
            return $this->render('report2', [
                'publication_order_count' => $publication_order_count
                //'count' => $count,


            ]);
        }
    }


    public function actionReport3()
    {
        $sql = Yii::$app->getDb()->createCommand("SELECT COUNT(publication_order.publication_order_id) AS  pub_id, view_pis_person.major_name
                 FROM publication
                 LEFT JOIN view_pis_person ON view_pis_person.person_id = publication_order.person_id")->queryAll();

        return Json::encode($sql);


        $data = $query2->select(['major_name', 'count' => 'Count(view_pis_person.person_id)'])
            ->from('view_pis_person')
            ->innerJoin('view_pis_major', 'view_pis_person.id = view_pis_major.id')
            ->groupBy('view_pis_major.name_th')
            ->all();
        $graph = [];
        return Json::encode($sql);

        foreach ($sql as $d) {
            $graph [] = [
                'type' => 'column',
                'name' => $d['name'],
                'data' => [intval($d['pub_id'])]

            ];
        }
        return $this->render('report3', [
            'graph' => $graph,

        ]);


        //return Json::encode($data);
    }

    //งานส่วนที่ 2/


    public
    function actionReport7()
    {
        /*
         SELECT
            department.department_name
            FROM
            person
            INNER JOIN department ON person.department_id = department.department_id
            GROUP BY
            department.department_name
         */
        $query = new Query();
        $department = $query->select('department_name')
            ->from('person')
            ->innerJoin('department', 'person.department_id = department.department_id')
            ->groupBy('department.department_name')
            ->all();

        //Count(person.person_id) AS countperson
        $query2 = new Query();
        $count = $query2->select('Count(person.person_id) AS countperson')
            ->from('person')
            ->innerJoin('department', 'person.department_id = department.department_id')
            ->groupBy('department.department_name')
            ->all();


        return $this->render('report1', [
            'department' => $department,
            'count' => $count,
        ]);
    }

    public
    function actionReport8()
    {
        /*
         SELECT
            department.department_name
            FROM
            person
            INNER JOIN department ON person.department_id = department.department_id
            GROUP BY
            department.department_name
         */
        $query = new Query();
        $department = $query->select('department_name')
            ->from('person')
            ->innerJoin('department', 'person.department_id = department.department_id')
            ->groupBy('department.department_name')
            ->all();

        //Count(person.person_id) AS countperson
        $query2 = new Query();
        $count = $query2->select('Count(person.person_id) AS countperson')
            ->from('person')
            ->innerJoin('department', 'person.department_id = department.department_id')
            ->groupBy('department.department_name')
            ->all();


        return $this->render('report2', [
            'department' => $department,
            'count' => $count,
        ]);
    }


    public
    function actionReport9()
    {
        /*
            SELECT
            position.position_name,
            Count(person.person_id)
            FROM
            person
            INNER JOIN position ON person.position_id = position.position_id
            GROUP BY
            position.position_name
         */
        $query2 = new Query();
        $data = $query2->select(['member_name', 'member_lname', 'count' => 'Count(publication_order.project_member_pro_member_id)'])
            ->from('eoffice_pfo.member')
            ->innerJoin('eoffice_pfo.publication_order', 'publication_order.project_member_pro_member_id = member.member_id')
            ->groupBy('member.member_name')
            ->all();
        return Json::encode($data);

//        return $this->render('report9',[
//            'data' => $data,
//        ]);
    }




    public function actionReportOne()
    {
        $departments = Yii::$app->getDb()->createCommand("SELECT * FROM view_pis_major")->queryAll();

        $current_year = date("Y");

        //$pub_order = Project::find()->all();

        $publication_order_count = [];

       // foreach ($pub_order as $order) {
            //$person = Yii::$app->getDb()->createCommand('SELECT * FROM view_pis_user WHERE user_id = ' . $order->person_id)->queryOne();
            for ($year = $current_year; $year >= $current_year - 4; $year--) {
                $yearx = [];
                $count = Project::find()
                    ->where([
                        'YEAR(project_end)' => $year . '',
//                        'person_id' => $person['person_id']
                    ])
                    ->count();
                $yearx['year'] = $year;
                $yearx['count'] = $count;
                array_push($publication_order_count, $yearx);
            }
            //   return Json::encode($publication_order_count);


            //return Json::encode($publication_order_count);
            return $this->render('report11', [
                'publication_order_count' => $publication_order_count,




            ]);
       // }

    }

    public function actionReport12()
    {


        $pubs = ProjectOrder::find()->where(['YEAR(date)' => 2018])->all();


        $current_year = date("Y");


        $project_order_count = [];


//        return Json::encode($public_types);

        $persons = Yii::$app->getDb()->createCommand('SELECT * FROM view_pis_user WHERE user_type_id = 1')->queryAll();


        foreach ($persons as $key => $person) {
            $per = [];
            $per['name'] = $person['person_fname_th'] . '  ' . $person['person_lname_th'];
            $per['dept'] = $person['major_code'];
            $per['years'] = [];
            $i = 0;


            for ($year = $current_year; $year >= $current_year - 4; $year--) {
                $yearx = [];

//
                $count = ProjectOrder::find()
                    // ->joinWith(['publicationOrder order'])
                    ->where([
                        'YEAR(date)' => $current_year . '',


                        'person_id' => $person['id']
                    ])->count();
                //   echo $count.' | ';
                $type['count'] = $count;
                array_push($per['years'], $type);
                $yearx['year'] = $year;
                $yearx['count'] = $count;
                //array_push($publication_order_count, $yearx);
            }


            array_push($project_order_count, $per);
        }
        //return Json::encode($project_order_count);
        //  return Json::encode(null);


        return $this->render('report12', [

            'type' => $type,
            'persons' => $persons,

            'project_order_count' => $project_order_count,
            'pubs' => $pubs,
            'current_year' => $current_year,
            //  ' searchModel'=>$searchModel

        ]);

    }


}

