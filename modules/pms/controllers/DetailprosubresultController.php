<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 22/11/2560
 * Time: 5:03
 */

namespace app\modules\pms\controllers;
use app\modules\pms\models\File;
use app\modules\pms\models\PmsCompactHasMethod;
use app\modules\pms\models\PmsCompactHasProsub;
use app\modules\pms\models\PmsCompactHasTargetgroup;
use app\modules\pms\models\PmsDocument;
use app\modules\pms\models\PmsGovernanceHasProjectSub;
use app\modules\pms\models\PmsGovernanceOfYear;
use app\modules\pms\models\PmsPlace;
use app\modules\pms\models\PmsProblemResult;
use app\modules\pms\models\PmsProjectSub;
use app\modules\pms\models\PmsResultProblem;
use app\modules\pms\models\PmsResultQuality;
use app\modules\pms\models\PmsResultSuggest;
use app\modules\pms\models\PmsStrategicHasProjectSub;
use app\modules\pms\models\PmsSuggestResult;
use app\modules\pms\models\PmsTargetgroup;
use app\modules\pms\models\Year;
use app\modules\pms\models\ModelTarget;
use app\modules\pms\models\ModelResultq;
use app\modules\pms\models\ModelProblem;
use app\modules\pms\models\ModelSuggest;
use yii;
use yii\helpers\FileHelper;
use yii\web\Controller;
use yii\helpers\Json;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\UploadedFile;
use Mpdf\Mpdf;

class DetailprosubresultController extends Controller
{
    public function actionDetail(){
        $id = Yii::$app->request->get('id');
        $id_compact = Yii::$app->request->get('id_compact');


        $model_file = new File;
        $yearNow = date("Y")+543;
        $Month = date("m");
        $Month = $Month + 0;
        if($Month > 9){
            $yearNow = $yearNow +1;
        }
        $modeldocument = PmsDocument::find()->where(['pms_compact_has_prosub_id'=>$id_compact])->all();
        $modelcompacthasprosub = PmsCompactHasProsub::findOne($id_compact);
        $modelsPlace =  PmsPlace::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
        $governanceOfYear = PmsGovernanceOfYear::find()->distinct()->where(['year'=>$yearNow])->orderBy('governance_id')->all();
        $modelprosub = PmsProjectSub::find()->where(['prosub_code'=>$id])->one();
        $modelproblem = PmsResultProblem::find()->where(['pms_compact_has_prosub_id'=>$id_compact])->all();
//        if($modelproblem == null){
//            $modelproblem = [new PmsResultProblem];
//        }
        $modelsuggest = PmsResultSuggest::find()->where(['pms_compact_has_prosub_id'=>$id_compact])->all();
//        if($modelsuggest == null){
//            $modelsuggest = [new PmsResultSuggest];
//        }
        $modelresult = PmsResultQuality::find()->where(['pms_compact_has_prosub_id'=>$id_compact])->all();
//        if($modelresult == null){
//            $modelresult = [new PmsResultQuality];
//        }

        $modeltarget = PmsCompactHasTargetgroup::find()->where(['pms_compact_has_prosub_id'=>$id_compact])->all();
//        if($modeltarget == null){
//            $modeltarget = [new PmsCompactHasTargetgroup];
//        }

        $modelcomhasprosub = PmsCompactHasProsub::findOne($id_compact);
        $modelcompacthasmethod = PmsCompactHasMethod::find()->where(['pms_compact_has_prosub_id'=>$id_compact])->all();

        $command = Yii::$app->get('db_pms')->createCommand("SELECT SUM(budget_limit) FROM pms_projectsub_budget WHERE pms_projectsub_budget.pms_project_sub_prosub_code = '".$id."'");
        $sumCost = $command->queryScalar();

        $this->layout ="main_module";
        return $this->render('detail_result'
            ,['modelprosub'=>$modelprosub,'modelsPlace'=>$modelsPlace,'governanceOfYear'=>$governanceOfYear,
                'modelproblem' => (empty($modelproblem)) ? [new PmsResultProblem] : $modelproblem,
                'modelsuggest' => (empty($modelsuggest)) ? [new PmsResultSuggest] : $modelsuggest,
                'modelresult' => (empty($modelresult)) ? [new PmsResultQuality] : $modelresult,
                'modeltarget' => (empty($modeltarget)) ? [new PmsCompactHasTargetgroup] : $modeltarget,
                'model_file'=>$model_file,
                'modelcomhasprosub'=>$modelcomhasprosub,
                'modelcompacthasmethod'=>$modelcompacthasmethod,
                'sumCost'=>$sumCost,
                'id'=>$id,
                'id_compact'=>$id_compact,
                'modelcompacthasprosub'=>$modelcompacthasprosub,
                'modeldocument' => $modeldocument,
            ]);
    }

    public function actionDetailStaff(){
        $id = Yii::$app->request->get('id');
        $id_compact = Yii::$app->request->get('id_compact');
        $model_file = new File;
        $yearNow = date("Y")+543;
        $Month = date("m");
        $Month = $Month + 0;
        if($Month > 9){
            $yearNow = $yearNow +1;
        }
        // $modeldocument = PmsDocument::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
        $modelcompacthasprosub = PmsCompactHasProsub::findOne($id_compact);
        $modelsPlace =  PmsPlace::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
        $governanceOfYear = PmsGovernanceOfYear::find()->distinct()->where(['year'=>$yearNow])->orderBy('governance_id')->all();
        $modelprosub = PmsProjectSub::find()->where(['prosub_code'=>$id])->one();
        $modelproblem = PmsResultProblem::find()->where(['pms_compact_has_prosub_id'=>$id_compact])->all();
        if($modelproblem == null){
            $modelproblem = [new PmsResultProblem];
        }
        $modelsuggest = PmsResultSuggest::find()->where(['pms_compact_has_prosub_id'=>$id_compact])->all();
        if($modelsuggest == null){
            $modelsuggest = [new PmsResultSuggest];
        }
        $modelresult = PmsResultQuality::find()->where(['pms_compact_has_prosub_id'=>$id_compact])->all();
        if($modelresult == null){
            $modelresult = [new PmsResultQuality];
        }

        $modeltarget = PmsCompactHasTargetgroup::find()->where(['pms_compact_has_prosub_id'=>$id_compact])->all();
        if($modeltarget == null){
            $modeltarget = [new PmsCompactHasTargetgroup];
        }
        $modelcomhasprosub = PmsCompactHasProsub::findOne($id_compact);
        $modelcompacthasmethod = PmsCompactHasMethod::find()->where(['pms_compact_has_prosub_id'=>$id_compact])->all();

        $command = Yii::$app->get('db_pms')->createCommand("SELECT SUM(execute_cost) FROM pms_execute WHERE pms_execute.pms_project_sub_prosub_code = '".$id."'");
        $sumCost = $command->queryScalar();

        $this->layout ="main_module";
        return $this->render('detail_result_staff'
            ,['modelprosub'=>$modelprosub,'modelsPlace'=>$modelsPlace,'governanceOfYear'=>$governanceOfYear,
                'modelproblem' => (empty($modelproblem)) ? [new PmsResultProblem] : $modelproblem,
                'modelsuggest' => (empty($modelsuggest)) ? [new PmsResultSuggest] : $modelsuggest,
                'modelresult' => (empty($modelresult)) ? [new PmsResultQuality] : $modelresult,
                'modeltarget' => (empty($modeltarget)) ? [new PmsCompactHasTargetgroup] : $modeltarget,
                'model_file'=>$model_file,
                'modelcomhasprosub'=>$modelcomhasprosub,
                'modelcompacthasmethod'=>$modelcompacthasmethod,
                'sumCost'=>$sumCost,
                'id'=>$id,
                'id_compact'=>$id_compact,
                'modelcompacthasprosub'=>$modelcompacthasprosub,
                //'modeldocument' => $modeldocument,
            ]);
    }

    public function actionDetailManager(){
        $id = Yii::$app->request->get('id');
        $id_compact = Yii::$app->request->get('id_compact');
        $model_file = new File;
        $yearNow = date("Y")+543;
        $Month = date("m");
        $Month = $Month + 0;
        if($Month > 9){
            $yearNow = $yearNow +1;
        }
        // $modeldocument = PmsDocument::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
        $modelcompacthasprosub = PmsCompactHasProsub::findOne($id_compact);
        $modelsPlace =  PmsPlace::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
        $governanceOfYear = PmsGovernanceOfYear::find()->distinct()->where(['year'=>$yearNow])->orderBy('governance_id')->all();
        $modelprosub = PmsProjectSub::find()->where(['prosub_code'=>$id])->one();
        $modelproblem = PmsResultProblem::find()->where(['pms_compact_has_prosub_id'=>$id_compact])->all();
        if($modelproblem == null){
            $modelproblem = [new PmsResultProblem];
        }
        $modelsuggest = PmsResultSuggest::find()->where(['pms_compact_has_prosub_id'=>$id_compact])->all();
        if($modelsuggest == null){
            $modelsuggest = [new PmsResultSuggest];
        }
        $modelresult = PmsResultQuality::find()->where(['pms_compact_has_prosub_id'=>$id_compact])->all();
        if($modelresult == null){
            $modelresult = [new PmsResultQuality];
        }

        $modeltarget = PmsCompactHasTargetgroup::find()->where(['pms_compact_has_prosub_id'=>$id_compact])->all();
        if($modeltarget == null){
            $modeltarget = [new PmsCompactHasTargetgroup];
        }
        $modelcomhasprosub = PmsCompactHasProsub::findOne($id_compact);
        $modelcompacthasmethod = PmsCompactHasMethod::find()->where(['pms_compact_has_prosub_id'=>$id_compact])->all();

        $command = Yii::$app->get('db_pms')->createCommand("SELECT SUM(execute_cost) FROM pms_execute WHERE pms_execute.pms_project_sub_prosub_code = '".$id."'");
        $sumCost = $command->queryScalar();

        $this->layout ="main_module";
        return $this->render('detail_result_manager'
            ,['modelprosub'=>$modelprosub,'modelsPlace'=>$modelsPlace,'governanceOfYear'=>$governanceOfYear,
                'modelproblem' => (empty($modelproblem)) ? [new PmsResultProblem] : $modelproblem,
                'modelsuggest' => (empty($modelsuggest)) ? [new PmsResultSuggest] : $modelsuggest,
                'modelresult' => (empty($modelresult)) ? [new PmsResultQuality] : $modelresult,
                'modeltarget' => (empty($modeltarget)) ? [new PmsCompactHasTargetgroup] : $modeltarget,
                'model_file'=>$model_file,
                'modelcomhasprosub'=>$modelcomhasprosub,
                'modelcompacthasmethod'=>$modelcompacthasmethod,
                'sumCost'=>$sumCost,
                'id'=>$id,
                'id_compact'=>$id_compact,
                'modelcompacthasprosub'=>$modelcompacthasprosub,
                //'modeldocument' => $modeldocument,
            ]);
    }

    public function actionDetailPlanner(){
        $id = Yii::$app->request->get('id');
        $id_compact = Yii::$app->request->get('id_compact');
        $model_file = new File;
        $yearNow = date("Y")+543;
        $Month = date("m");
        $Month = $Month + 0;
        if($Month > 9){
            $yearNow = $yearNow +1;
        }
        // $modeldocument = PmsDocument::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
        $modelcompacthasprosub = PmsCompactHasProsub::findOne($id_compact);
        $modelsPlace =  PmsPlace::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
        $governanceOfYear = PmsGovernanceOfYear::find()->distinct()->where(['year'=>$yearNow])->orderBy('governance_id')->all();
        $modelprosub = PmsProjectSub::find()->where(['prosub_code'=>$id])->one();
        $modelproblem = PmsResultProblem::find()->where(['pms_compact_has_prosub_id'=>$id_compact])->all();
        if($modelproblem == null){
            $modelproblem = [new PmsResultProblem];
        }
        $modelsuggest = PmsResultSuggest::find()->where(['pms_compact_has_prosub_id'=>$id_compact])->all();
        if($modelsuggest == null){
            $modelsuggest = [new PmsResultSuggest];
        }
        $modelresult = PmsResultQuality::find()->where(['pms_compact_has_prosub_id'=>$id_compact])->all();
        if($modelresult == null){
            $modelresult = [new PmsResultQuality];
        }

        $modeltarget = PmsCompactHasTargetgroup::find()->where(['pms_compact_has_prosub_id'=>$id_compact])->all();
        if($modeltarget == null){
            $modeltarget = [new PmsCompactHasTargetgroup];
        }
        $modelcomhasprosub = PmsCompactHasProsub::findOne($id_compact);
        $modelcompacthasmethod = PmsCompactHasMethod::find()->where(['pms_compact_has_prosub_id'=>$id_compact])->all();

        $command = Yii::$app->get('db_pms')->createCommand("SELECT SUM(execute_cost) FROM pms_execute WHERE pms_execute.pms_project_sub_prosub_code = '".$id."'");
        $sumCost = $command->queryScalar();

        $this->layout ="main_module";
        return $this->render('detail_result_planner'
            ,['modelprosub'=>$modelprosub,'modelsPlace'=>$modelsPlace,'governanceOfYear'=>$governanceOfYear,
                'modelproblem' => (empty($modelproblem)) ? [new PmsResultProblem] : $modelproblem,
                'modelsuggest' => (empty($modelsuggest)) ? [new PmsResultSuggest] : $modelsuggest,
                'modelresult' => (empty($modelresult)) ? [new PmsResultQuality] : $modelresult,
                'modeltarget' => (empty($modeltarget)) ? [new PmsCompactHasTargetgroup] : $modeltarget,
                'model_file'=>$model_file,
                'modelcomhasprosub'=>$modelcomhasprosub,
                'modelcompacthasmethod'=>$modelcompacthasmethod,
                'sumCost'=>$sumCost,
                'id'=>$id,
                'id_compact'=>$id_compact,
                'modelcompacthasprosub'=>$modelcompacthasprosub,
                //'modeldocument' => $modeldocument,
            ]);
    }

    public function actionPdfprosubresult($id){
        $model_file = new File;
        $year = Year::find()->all();
        $yearNow = date("Y")+543;
        $Month = date("m");
        $Month = $Month + 0;
        if($Month > 9){
            $yearNow = $yearNow +1;
        }
       // $modeldocument = PmsDocument::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
        $modelsPlace =  PmsPlace::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
        $governanceOfYear = PmsGovernanceOfYear::find()->distinct()->where(['year_id'=>$yearNow])->orderBy('governance_id')->all();
        $modelprosub = PmsProjectSub::find()->where(['prosub_code'=>$id])->one();
        $modelproblem = PmsProblemResult::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
        if($modelproblem == null){
            $modelproblem = [new PmsProblemResult];
        }
        $modelsuggest = PmsSuggestResult::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
        if($modelsuggest == null){
            $modelsuggest = [new PmsSuggestResult];
        }
        $modelresult = PmsResultQuality::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
        if($modelresult == null){
            $modelresult = [new PmsResultQuality];
        }

        $modeltarget = PmsTargetgroup::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
        if($modeltarget == null){
            $modeltarget = [new PmsTargetgroup];
        }

        $modelstrategicHasPro = PmsStrategicHasProjectSub::find()->where(['pms_project_sub_prosub_code'=>$id])->one();


        if ($modelprosub->load(Yii::$app->request->post())) {
            $modelprosub->save();
            $governancehaspro = PmsGovernanceHasProjectSub::find()->where(['pms_project_sub_prosub_code'=>$modelprosub->prosub_code])->all();
            $data = Yii::$app->request->post('governancedetail');
            foreach ($governancehaspro as $key => $row){
                $row->method_detail = $data[$key];
                $row->save();
            }

            $modeltarget = ModelTarget::createMultiple(PmsTargetgroup::classname(), $modeltarget);
            ModelTarget::loadMultiple($modeltarget, Yii::$app->request->post());
            PmsTargetgroup::deleteAll(['pms_project_sub_prosub_code'=>$modelprosub->prosub_code]);
            foreach($modeltarget as $key => $rows){
                if($rows->target_detail != null && $rows->target_amount != null ){
                    $rows->pms_project_sub_prosub_code = $modelprosub->prosub_code;
                    $rows->save();
                }

            }

            $modelresult = ModelResultq::createMultiple(PmsResultQuality::classname(), $modelresult);
            ModelResultq::loadMultiple($modelresult, Yii::$app->request->post());
            PmsResultQuality::deleteAll(['pms_project_sub_prosub_code'=>$modelprosub->prosub_code]);
            foreach($modelresult as $key => $rows){
                if($rows->quality_detail != null){
                    $rows->pms_project_sub_prosub_code = $modelprosub->prosub_code;
                    $rows->save();
                }

            }

            $modelproblem = ModelProblem::createMultiple(PmsProblemResult::classname(), $modelproblem);
            ModelProblem::loadMultiple($modelproblem, Yii::$app->request->post());
            PmsProblemResult::deleteAll(['pms_project_sub_prosub_code'=>$modelprosub->prosub_code]);
            foreach($modelproblem as $key => $rows){
                if($rows->problem_detail != null){
                    $rows->pms_project_sub_prosub_code = $modelprosub->prosub_code;
                    $rows->save();
                }

            }

            $modelsuggest = ModelSuggest::createMultiple(PmsSuggestResult::classname(), $modelsuggest);
            ModelSuggest::loadMultiple($modelsuggest, Yii::$app->request->post());
            PmsSuggestResult::deleteAll(['pms_project_sub_prosub_code'=>$modelprosub->prosub_code]);
            foreach($modelsuggest as $key => $rows){
                if($rows->suggest_detail != null){
                    $rows->pms_project_sub_prosub_code = $modelprosub->prosub_code;
                    $rows->save();
                }

            }

            exit;
        }

        $mpdf = new Mpdf([
           'format' => 'A4',
            /*'default_font' => 'thsarabunnew',*/
            'default_font' => 'thsarabunnew',
           'table_error_report' => false
        ]); // ขนาด A4 font Garuda

       $mpdf->WriteHTML($this->renderPartial('pdf_result'
           ,['modelprosub'=>$modelprosub,'modelsPlace'=>$modelsPlace,'governanceOfYear'=>$governanceOfYear,
               'modelproblem' => (empty($modelproblem)) ? [new PmsProblemResult] : $modelproblem,
               'modelsuggest' => (empty($modelsuggest)) ? [new PmsSuggestResult] : $modelsuggest,
               'modelresult' => (empty($modelresult)) ? [new PmsResultQuality] : $modelresult,
               'modeltarget' => (empty($modeltarget)) ? [new PmsTargetgroup] : $modeltarget,
               'modelstrategicHasPro' => $modelstrategicHasPro,'model_file'=>$model_file,
               //'modeldocument' => $modeldocument,
           ])); // หน้า View สำหรับ export
        $mpdf->Output();
        exit();
    }
}