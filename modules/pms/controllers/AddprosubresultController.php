<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 14/2/2561
 * Time: 22:25
 */

namespace app\modules\pms\controllers;
use app\modules\pms\models\File;
use app\modules\pms\models\Model;
use app\modules\pms\models\PmsCompactHasMethod;
use app\modules\pms\models\PmsCompactHasProsub;
use app\modules\pms\models\PmsCompactHasTargetgroup;
use app\modules\pms\models\PmsDocument;
use app\modules\pms\models\PmsExecute;
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

class AddprosubresultController extends Controller
{
    public function YearThai($strDate){
        $dateTh = Yii::$app->formatter->asDate($strDate, 'medium');
        $date = substr($dateTh, -4,4);
        $year = $date+543;
        $reDate = str_replace($date,$year,$dateTh);
        return $reDate;
    }

    public function actionResultadd(){
        $id = Yii::$app->request->get('id');
        $id_compact = Yii::$app->request->get('id_compact');

        $model_file = new File;
        $yearNow = date("Y")+543;
        $Month = date("m");
        $Month = $Month + 0;
        if($Month > 9){
            $yearNow = $yearNow +1;
        }
        $modelcomhasprosub = PmsCompactHasProsub::findOne($id_compact);
        $modeldocument = [];
        $modelsPlace =  PmsPlace::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
        $governanceOfYear = PmsGovernanceOfYear::find()->distinct()->where(['year'=>$yearNow])->orderBy('governance_id')->all();
        $modelprosub = PmsProjectSub::find()->where(['prosub_code'=>$id])->one();

        $modelproblem = [new PmsResultProblem];
        $modelsuggest = [new PmsResultSuggest];
        $modelresult = [new PmsResultQuality];



        $modelexecute = PmsExecute::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
        $checkTargetgroup = PmsCompactHasTargetgroup::find()->where(['pms_compact_has_prosub_id'=>$id_compact])->all();
        if($checkTargetgroup == null){
            foreach($modelexecute as $key => $rows){
                if($rows->execute_targetgroup != "" || $rows->execute_targetgroup != null){
                    $model = new PmsCompactHasTargetgroup();
                    $model->pms_compact_has_prosub_id = $id_compact;
                    $model->targetgroup = $rows->execute_targetgroup;
                    $model->save(false);
                }
            }
        }

        $modeltarget = PmsCompactHasTargetgroup::find()->where(['pms_compact_has_prosub_id'=>$id_compact])->all();
//        $modeltarget = Yii::$app->get('db_pms')->createCommand('SELECT * FROM pms_compact_has_execute INNER JOIN pms_execute ON pms_compact_has_execute.pms_execute_execute_id = pms_execute.execute_id WHERE pms_compact_has_execute.pms_compact_has_prosub_id ="'.$id_compact.'"')
//            ->queryAll();


        $command = Yii::$app->get('db_pms')->createCommand("SELECT SUM(execute_cost) FROM pms_execute WHERE pms_execute.pms_project_sub_prosub_code = '".$id."'");
        $sumCost = $command->queryScalar();
        if (Yii::$app->request->post()) {
            $id = Yii::$app->request->post('id');
            $id_compact = Yii::$app->request->post('id_compact');
            $modelcomhasprosub->load(Yii::$app->request->post());
            $modelcomhasprosub->summary_save = "true";
            $modelcomhasprosub->save(false);
            //echo $modelcomhasprosub->indicator." ".$modelcomhasprosub->result_evaluate." ".$modelcomhasprosub->rate." ".$modelcomhasprosub->sum_payment." end<br>";
            //$modelprosub->save();
            $governancehaspro = PmsGovernanceHasProjectSub::find()->where(['pms_project_sub_prosub_code'=>$id])->all();
            $data = Yii::$app->request->post('governancedetail');
            foreach ($governancehaspro as $key => $row){
                $compactHasmethod = new PmsCompactHasMethod();
                $compactHasmethod->method_detail = $data[$key];
                $compactHasmethod->pms_compact_has_prosub_id = $id_compact;
                $compactHasmethod->pms_governance_has_project_sub_governance_id = $row->governance_id;
                $compactHasmethod->pms_governance_has_project_sub_pms_project_sub_prosub_code = $id;
                echo $data[$key]."//<br>";
                $compactHasmethod->save(false);
            }

            $targetgroup_amount = Yii::$app->request->post('targetgroup_amount');
            foreach($modeltarget as $key => $rows){
                $rows->result_amount = $targetgroup_amount[$key];
                $rows->save(false);
            }

            $modelresult = ModelResultq::createMultiple(PmsResultQuality::classname(), $modelresult);
            ModelResultq::loadMultiple($modelresult, Yii::$app->request->post());
            foreach($modelresult as $key => $rows){
                $model = new PmsResultQuality();
                if($rows->quality_detail != null){
                    $model->pms_compact_has_prosub_id = $id_compact;
                    $model->quality_detail = $rows->quality_detail;
                    echo $rows->quality_detail."<br>";
                    $model->save(false);
                }

            }

            $modelproblem = ModelProblem::createMultiple(PmsResultProblem::classname(), $modelproblem);
            ModelProblem::loadMultiple($modelproblem, Yii::$app->request->post());
            foreach($modelproblem as $key => $rows){
                $model = new PmsResultProblem();
                if($rows->problem_detail != null){
                    $model->pms_compact_has_prosub_id = $id_compact;
                    $model->problem_detail = $rows->problem_detail;
                    echo $rows->problem_detail."<br>";
                    $model->save(false);
                }
            }

            $modelsuggest = ModelSuggest::createMultiple(PmsResultSuggest::classname(), $modelsuggest);
            ModelSuggest::loadMultiple($modelsuggest, Yii::$app->request->post());
            foreach($modelsuggest as $key => $rows){
                $model = new PmsResultSuggest();
                if($rows->suggest_detail != null){
                    $model->pms_compact_has_prosub_id = $id_compact;
                    $model->suggest_detail = $rows->suggest_detail;
                    echo $rows->suggest_detail."<br>";
                    $model->save(false);
                }
            }
            return $this->redirect(['detailprosubresult/detail?id='.$id.'&id_compact='.$id_compact]);

        }
        $this->layout ="main_module";
        return $this->render('result_add'
            ,['modelprosub'=>$modelprosub,'modelsPlace'=>$modelsPlace,'governanceOfYear'=>$governanceOfYear,
                'modelproblem' => (empty($modelproblem)) ? [new PmsResultProblem] : $modelproblem,
                'modelsuggest' => (empty($modelsuggest)) ? [new PmsResultSuggest] : $modelsuggest,
                'modelresult' => (empty($modelresult)) ? [new PmsResultQuality] : $modelresult,
                'modeltarget' => $modeltarget,
                'model_file'=>$model_file,
                'modeldocument' => $modeldocument,
                //'modelExecute'=>$modelExecute,
                'sumCost'=>$sumCost,
                'modelcomhasprosub'=>$modelcomhasprosub,
                'id_compact'=>$id_compact,
                'id'=>$id,
            ]);
    }

    public function actionResultedit($id,$id_compact)
    {
        $model_file = new File;
        $yearNow = date("Y")+543;
        $Month = date("m");
        $Month = $Month + 0;
        if($Month > 9){
            $yearNow = $yearNow +1;
        }
        $modelcomhasprosub = PmsCompactHasProsub::findOne($id_compact);
        $modeldocument = PmsDocument::find()->where(['pms_compact_has_prosub_id'=>$id_compact])->all();
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
        $modelExecute = PmsExecute::find()->select(['execute_targetgroup'])->where(['pms_project_sub_prosub_code'=>$id])->distinct()->all();
        $command = Yii::$app->get('db_pms')->createCommand("SELECT SUM(execute_cost) FROM pms_execute WHERE pms_execute.pms_project_sub_prosub_code = '".$id."'");
        $sumCost = $command->queryScalar();
        $modeltarget = PmsCompactHasTargetgroup::find()->where(['pms_compact_has_prosub_id'=>$id_compact])->all();


        if ($modelcomhasprosub->load(Yii::$app->request->post())) {
            if($modelcomhasprosub->status_result == "รอปรับแก้ไขโครงการ"){
                $modelcomhasprosub->status_result = "ยังไม่ดำเนินการ";
            }
            $modelcomhasprosub->save();
            $governancehaspro = PmsGovernanceHasProjectSub::find()->where(['pms_project_sub_prosub_code'=>$modelprosub->prosub_code])->all();
            $data = Yii::$app->request->post('governancedetail');
            PmsCompactHasMethod::deleteAll(['pms_compact_has_prosub_id'=>$id_compact]);
            foreach ($governancehaspro as $key => $row){
                $compactHasmethod = new PmsCompactHasMethod();
                $compactHasmethod->method_detail = $data[$key];
                $compactHasmethod->pms_compact_has_prosub_id = $id_compact;
                $compactHasmethod->pms_governance_has_project_sub_governance_id = $row->governance_id;
                $compactHasmethod->pms_governance_has_project_sub_pms_project_sub_prosub_code = $id;
                echo $data[$key]."//<br>";
                $compactHasmethod->save(false);
            }

            $targetgroup_amount = Yii::$app->request->post('targetgroup_amount');
            foreach($modeltarget as $key => $rows){
                $rows->result_amount = $targetgroup_amount[$key];
                $rows->save(false);
                echo $rows->result_amount." ".$targetgroup_amount[$key]." <br>";
            }

            $modelresult = ModelResultq::createMultiple(PmsResultQuality::classname(), $modelresult);
            ModelResultq::loadMultiple($modelresult, Yii::$app->request->post());
            PmsResultQuality::deleteAll(['pms_compact_has_prosub_id'=>$id_compact]);
            foreach($modelresult as $key => $rows){
                $model = new PmsResultQuality();
                if($rows->quality_detail != null){
                    $model->pms_compact_has_prosub_id = $id_compact;
                    $model->quality_detail = $rows->quality_detail;
                    $model->save(false);
                }

            }

            $modelproblem = ModelProblem::createMultiple(PmsResultProblem::classname(), $modelproblem);
            ModelProblem::loadMultiple($modelproblem, Yii::$app->request->post());
            PmsResultProblem::deleteAll(['pms_compact_has_prosub_id'=>$id_compact]);
            foreach($modelproblem as $key => $rows){
                $model = new PmsResultProblem();
                if($rows->problem_detail != null){
                    $model->pms_compact_has_prosub_id = $id_compact;
                    $model->problem_detail = $rows->problem_detail;
                    $model->save(false);
                }

            }

            $modelsuggest = ModelSuggest::createMultiple(PmsResultSuggest::classname(), $modelsuggest);
            ModelSuggest::loadMultiple($modelsuggest, Yii::$app->request->post());
            PmsResultSuggest::deleteAll(['pms_compact_has_prosub_id'=>$id_compact]);
            foreach($modelsuggest as $key => $rows){
                $model = new PmsResultSuggest();
                if($rows->suggest_detail != null){
                    $model->pms_compact_has_prosub_id = $id_compact;
                    $model->suggest_detail = $rows->suggest_detail;
                    $model->save(false);
                }

            }

            return $this->redirect(['detailprosubresult/detail?id='.$id.'&id_compact='.$id_compact]);
        }
        $this->layout ="main_module";
        return $this->render('result_edit'
            ,['modelprosub'=>$modelprosub,'modelsPlace'=>$modelsPlace,'governanceOfYear'=>$governanceOfYear,
                'modelproblem' => (empty($modelproblem)) ? [new PmsResultProblem] : $modelproblem,
                'modelsuggest' => (empty($modelsuggest)) ? [new PmsResultSuggest] : $modelsuggest,
                'modelresult' => (empty($modelresult)) ? [new PmsResultQuality] : $modelresult,
                'modeltarget' => $modeltarget,
                'model_file'=>$model_file,
                'modeldocument' => $modeldocument,'modelExecute'=>$modelExecute,'sumCost'=>$sumCost,
                'id_compact'=>$id_compact,
                'id'=>$id,
                'modelcomhasprosub'=>$modelcomhasprosub,
            ]);
    }

    public function actionAddFile($id_compact)
    {

        $model = new File();
        $file = UploadedFile::getInstance($model, 'file');
        $directory = \Yii::getAlias('../web/web_pms/uploads/').DIRECTORY_SEPARATOR;

        if ($file) {
            $fileName = date("dmYHis") . '-' . $file;
            $filePath = $directory . $fileName;
            if ($file->saveAs($filePath)) {
                $path = 'uploads' . \Yii::$app->session->id . DIRECTORY_SEPARATOR . $fileName;
                $models = new PmsDocument;
                $models->pms_compact_has_prosub_id=$id_compact;
                $models->document_name=$fileName;
                $models->save(false);

                //insert in DB

                return Json::encode([
                    'files' => [
                        [
                            'name' => $fileName,
                            'size' => $file->size,
                            'thumbnailUrl' => $path,
                            'deleteUrl' => 'delete-file?name=' . $fileName,
                            'deleteType' => 'POST',
                        ],
                    ],
                ]);
            }

        }

        return '';
    }

    public function actionDeleteFile($name)
    {

        //ลบไฟล์ขณะที่กำลังเพิ่มข้อมูล
        $directory = \Yii::getAlias('../web/web_pms/uploads/' ). DIRECTORY_SEPARATOR;
        if (is_file($directory . DIRECTORY_SEPARATOR . $name)) {
            unlink($directory . DIRECTORY_SEPARATOR . $name);
        }

        $modeldoc = PmsDocument::find()->where(['document_name'=>$name])->one();
        $modeldoc->delete();
        $files = FileHelper::findFiles($directory);
        $output = [];
        foreach ($files as $file) {
            $fileName = basename($file);
            $path = 'uploads' . \Yii::$app->session->id . DIRECTORY_SEPARATOR . $fileName;
            $output['files'][] = [
                'name' => $fileName,
                'size' => filesize($file),
                'url' => $path,
                'thumbnailUrl' => $path,
                'deleteUrl' => 'image-delete?name=' . $fileName,
                'deleteType' => 'POST',
            ];
        }
        return Json::encode($output);
    }

    public function actionDeleteFilesystem($name,$id_compact)
    {

        //ลบไฟล์ขณะที่กำลังเพิ่มข้อมูล
        $directory = \Yii::getAlias('../web/web_pms/uploads/' ). DIRECTORY_SEPARATOR;
        if (is_file($directory . DIRECTORY_SEPARATOR . $name)) {
            unlink($directory . DIRECTORY_SEPARATOR . $name);
        }

        $modeldoc = PmsDocument::find()->where(['document_name'=>$name])->one();
        if($modeldoc){
            $modeldoc->delete();
        }
        $files = FileHelper::findFiles($directory);
        $output = [];
        foreach ($files as $file) {
            $fileName = basename($file);
            $path = 'uploads' . \Yii::$app->session->id . DIRECTORY_SEPARATOR . $fileName;
            $output['files'][] = [
                'name' => $fileName,
                'size' => filesize($file),
                'url' => $path,
                'thumbnailUrl' => $path,
                'deleteUrl' => 'image-delete?name=' . $fileName,
                'deleteType' => 'POST',
            ];
        }
        $data = "<a></a>";
        $modeldocument = PmsDocument::find()->where(['pms_compact_has_prosub_id'=>$id_compact])->all();
        if($modeldocument == null){
            echo $data;
        }else{
            $data="";
            foreach ($modeldocument as $row){
                $data = $data. "<a>".$row->document_name."</a> <a class=\"btn deletedoc btn-xs btn-danger\" data=\"".$row->document_name."\" ><i class=\"glyphicon glyphicon-minus\"></i>ลบ</a><br>";
            }
            echo $data;
        }

    }

    public function actionResultSelect(){
        $user_id = Yii::$app->user->identity->id;
        $listProsub = Yii::$app->get('db_pms')->createCommand("SELECT * FROM pms_project_sub INNER JOIN pms_compact_has_prosub ON pms_project_sub.prosub_code = pms_compact_has_prosub.pms_project_sub_prosub_code WHERE (( pms_project_sub.prosub_status_place = 'อนุมัติสำเร็จ' AND pms_compact_has_prosub.status_finance = 'อนุมัติสำเร็จ' ) OR pms_compact_has_prosub.status_pandf = 'อนุมัติสำเร็จ')  AND summary_save = 'false' AND prosub_responsible_id = '".$user_id."' GROUP BY (pms_project_sub.prosub_name)")
        ->queryAll();

        $prosub = Yii::$app->get('db_pms')->createCommand('SELECT * FROM pms_project_sub INNER JOIN pms_compact_has_prosub ON pms_compact_has_prosub.pms_project_sub_prosub_code = pms_project_sub.prosub_code WHERE  summary_save ="true" AND prosub_responsible_id = "'.$user_id.'"')
            ->queryAll();
        $this->layout ="main_module";
        return $this->render('result_select',['listProsub'=>$listProsub,'prosub'=>$prosub]);
    }

    public function actionResultSelectJs(){
        $id = Yii::$app->request->get('prosub');
        $prosub = PmsProjectSub::findOne($id);
        $listProsub = Yii::$app->get('db_pms')->createCommand("SELECT * FROM pms_compact_has_prosub  WHERE pms_project_sub_prosub_code = '".$id."' AND (status_finance = 'อนุมัติสำเร็จ' OR status_pandf = 'อนุมัติสำเร็จ') AND summary_save = 'false'")
            ->queryAll();
        $content = "";


        if($id != 0){
            if($listProsub){
                foreach ($listProsub as $row){
                    if($row['start_date']){
                        $content = $content."<option value='".$row['id']."'>ครั้งที่ ".$row['round'].", วันที่ ".$this->YearThai($row['start_date'])."</option>";
                    }else{
                        $content = $content."<option value='".$row['id']."'>ครั้งที่ ".$row['round'].", วันที่ ".$this->YearThai($prosub->prosub_start_date)."</option>";
                    }
                }
                echo $content;
            }else{
                echo "<option>ไม่พบโครงการ</option>";
            }

        }else{
            echo "<option>กรุณาเลือกโครงการ</option>";
        }


    }

    public function actionChangeStatus()
    {
        $id = Yii::$app->request->post('id');
        $id_compact = Yii::$app->request->post('id_compact');
        $model = PmsCompactHasProsub::findOne($id_compact);
        $model->status_result = "เสร็จสิ้น";
        $model->save(false);
        return $this->redirect(['detailprosubresult/detail?id='.$id.'&id_compact='.$id_compact]);

    }

}