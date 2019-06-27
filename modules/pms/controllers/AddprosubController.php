<?php
/**
 * Created by PhpStorm.
 * User: alexr
 * Date: 29/1/2561
 * Time: 18:57
 */

namespace app\modules\pms\controllers;

use app\modules\pms\models\BudgetLv3;
use app\modules\pms\models\model_main\EofficeCentralViewPisPerson;
use app\modules\pms\models\model_main\EofficeCentralViewPisBoardOfDirectors;
use app\modules\pms\models\Person;
use app\modules\pms\models\PmsCostPlan;
use app\modules\pms\models\PmsEffect;
use app\modules\pms\models\PmsExecute;
use app\modules\pms\models\PmsProblem;
use app\modules\pms\models\PmsProject;
use app\modules\pms\models\PmsProjectSub;
use app\modules\pms\models\PmsProjectsubBudget;
use app\modules\pms\models\PmsProjectsubBudgets;
use app\modules\pms\models\PmsProjectsubBudgetss;
use app\modules\pms\models\PmsPurpose;
use app\modules\pms\models\PmsResultExpect;
use app\modules\pms\models\PmsStrategicOfYear;
use app\modules\pms\models\PmsGovernanceOfYear;
use app\modules\pms\models\Strategic;
use app\modules\pms\models\PmsGovernanceHasProjectSub;
use app\modules\pms\models\TypePerson;
use app\modules\pms\models\PmsStrategicHasProjectSub;
use app\modules\pms\models\PmsIndicator;
use app\modules\pms\models\PmsPlace;
use yii;
use yii\web\Controller;


use app\modules\pms\models\Budget;
use app\modules\pms\models\Budgets;
use app\modules\pms\models\ModelIndicator;
use app\modules\pms\models\ModelPurpose;
use app\modules\pms\models\ModelPlace;
use app\modules\pms\models\ModelExecute;
use app\modules\pms\models\ModelProbudget;
use app\modules\pms\models\ModelCostplan;
use app\modules\pms\models\ModelResult;
use app\modules\pms\models\ModelEffect;
use app\modules\pms\models\ModelProblem;


use yii\helpers\Json;
use yii\helpers\Html;
use yii\helpers\Url;

class AddprosubController extends Controller
{
    /**
     * @return string|yii\web\Response
     */
    public function actionRuleDatePlace()
    {
        $modelProsub = Yii::$app->request->post('PmsProjectSub');
        $date_prosub = "true";
        if ($modelProsub['compact_start_date'] > $modelProsub['compact_end_date']) {
            $date_prosub = "false";
        } else if ($modelProsub['compact_start_date'] == "" && $modelProsub['compact_end_date'] != "") {
            $date_prosub = "false";
        } else if ($modelProsub['compact_end_date'] == "" && $modelProsub['compact_start_date'] != "") {
            $date_prosub = "true";
        } else {
            $date_prosub = "true";
        }
        echo $date_prosub;
    }


    public function actionRuleDatePandb()
    {
        $modelCompatc = Yii::$app->request->post('PmsCompactHasProsub');
        $date_compact = "true";
        if ($modelCompatc['start_date'] > $modelCompatc['end_date']) {
            $date_compact = "false";
        } else if ($modelCompatc['start_date'] == "" && $modelCompatc['end_date'] != "") {
            $date_compact = "false";
        } else if ($modelCompatc['end_date'] == "" && $modelCompatc['start_date'] != "") {
            $date_compact = "true";
        } else {
            $date_compact = "true";
        }
        echo $date_compact;

    }

    public function actionRuleDate()
    {

        $modelProsub = Yii::$app->request->post('PmsProjectSub');
        $modelExecute = Yii::$app->request->post('PmsExecute');
        $date_prosub = "true";
        $date_execute = "true";
        if ($modelProsub['prosub_start_date'] > $modelProsub['prosub_end_date']) {
            $date_prosub = "false";
        } else if ($modelProsub['prosub_start_date'] == "" && $modelProsub['prosub_end_date'] != "") {
            $date_prosub = "false";
        } else if ($modelProsub['prosub_end_date'] == "" && $modelProsub['prosub_start_date'] != "") {
            $date_prosub = "true";
        } else {
            $date_prosub = "true";
        }

        foreach ($modelExecute as $row) {
            if ($row['execute_timestart'] != "" && $row['execute_timeend'] != "") {
                if ($row['execute_timestart'] > $row['execute_timeend']) {
                    $date_execute = "false";
                }else if ($row['execute_timestart'] == "" && $row['execute_timeend'] != "") {
                    $date_execute = "false";
                } else if ($row['execute_timeend'] == "" && $row['execute_timestart'] != "") {
                    $date_execute = "true";
                }
            }

        }
        if ($date_prosub == "true" && $date_execute == "true") {
            echo "true";
        } else if ($date_prosub == "true" && $date_execute == "false") {
            echo "ระยะเวลาดำเนินงานของกิจกรรมย่อยไม่ถูกต้อง กรุณาตรวจสอบ";
        } else if ($date_prosub == "false" && $date_execute == "true") {
            echo "ระยะเวลาดำเนินงานของโครงการไม่ถูกต้อง กรุณาตรวจสอบ";
        } else if ($date_prosub == "false" && $date_execute == "false") {
            echo "ระยะเวลาดำเนินงานของโครงการและกิจกรรมย่อยไม่ถูกต้อง กรุณาตรวจสอบ";
        }

    }

    public function actionRuleInput()
    {
        $data = Yii::$app->request->get();
        $modelGrovernance = Yii::$app->request->get('PmsGovernanceHasProjectSub');
        $modelProsub = Yii::$app->request->get('PmsProjectSub');

        $project_code = "true";
        if (!isset($modelProsub['pms_project_project_code'])) {
            $project_code = "false";
        } else if ($modelProsub['pms_project_project_code'] == "") {
            $project_code = "false";
        }

        $strategic_id = "true";
        if (!isset($modelProsub['strategic_id'])) {
            $strategic_id = "false";

        } else if ($modelProsub['strategic_id'] == "") {
            $strategic_id = "false";
        }

        $prosub = "true";

        if ($project_code == "false" || $strategic_id == "false" || $modelProsub['prosub_name'] == "" || $modelProsub['prosub_code'] == "" || $modelProsub['prosub_year'] == "" || $modelProsub['strategic_issues_id'] == "" || $modelProsub['prosub_manager'] == "" || $modelProsub['prosub_operator'] == "") {
            $prosub = "false";
        }

        $Grovernance = "true";
        if (sizeof($modelGrovernance['governance_id']) == 1) {
            if ($modelGrovernance['governance_id'] == "") {
                $Grovernance = "false";
            }
        } else {
            $Grovernance = "true";
        }
        if ($prosub == "false" || $Grovernance == "false") {
            echo "false";
        } else {
            echo "true";
        }


    }

    public function actionProsubAdd()
    {
        $yearNow = date("Y") + 543;
        $Month = date("m");
        $Month = $Month + 0;
        if ($Month > 9) {
            $yearNow = $yearNow + 1;
        }

        $modelprosub = new PmsProjectSub;
        $modelgovernance = new PmsGovernanceHasProjectSub();
        //$dis = Strategic::find()->select(['strategic_issues_strategic_issues_id'])->distinct()->all();
        $strtegicisOfYear = PmsStrategicOfYear::find()->distinct()->where(['year' => $yearNow])->orderBy('strategic_issues_id')->all();
        $governanceOfYear = PmsGovernanceOfYear::find()->distinct()->where(['year' => $yearNow])->orderBy('governance_id')->all();
        //$modelstrategicHasPro = new PmsStrategicHasProjectSub;
        $modelsPurpose = [new PmsPurpose];
        $modelsIndicator = [new PmsIndicator];
        $modelsPlace = [new PmsPlace];
        $modelsExecute = [new PmsExecute];
        $modelProbudget = [new PmsProjectsubBudget];
        $modelProbudget2 = [new PmsProjectsubBudgets];
        $modelProbudget3 = [new PmsProjectsubBudgetss];
        $modelCostplan = [new PmsCostPlan];
        $modelResult = [new PmsResultExpect];
        $modelEffect = [new PmsEffect];
        $modelProblem = [new PmsProblem];

//---------------
        $datah = EofficeCentralViewPisBoardOfDirectors::find()->select('person_id')->distinct()->all();
        foreach ($datah as $row) {
            $datas = EofficeCentralViewPisBoardOfDirectors::find()->where(['person_id' => $row->person_id])->orderBy(['period_describe' => SORT_DESC])->one();
            //echo $datas->academic_positions_abb_thai.$datas->person_name." ".$datas->person_surname." (".$datas->position_name.")<br>";
            $manager[$row->person_id] = $datas->academic_positions_abb_thai . $datas->person_name . " " . $datas->person_surname . " (" . $datas->position_name . ")";
        }


        $datas = EofficeCentralViewPisPerson::find()->where(['person_type' => '2'])->orderBy(['academic_positions' => SORT_DESC])->all();
        $datat = EofficeCentralViewPisPerson::find()->where(['person_type' => '1'])->orderBy(['PREFIXABB' => SORT_DESC])->all();

        foreach ($datat as $row) {
            //echo $row->PREFIXNAME.$row->person_name." ".$row->person_surname."  (อาจารย์สาขาประจำวิชา".$row->academic_positions.")<br>";
            $operator[$row->person_id] = $row->PREFIXABB . $row->person_name . " " . $row->person_surname . "  (อาจารย์สาขาประจำวิชา" . $row->major_name . ")";

        }
        foreach ($datas as $row) {
            //echo $row->PREFIXABB.$row->person_name." ".$row->person_surname."  (".$row->person_position_staff.")<br>";
            $operator[$row->person_id] = $row->PREFIXABB . $row->person_name . " " . $row->person_surname . "  (" . $row->person_position_staff . ")";
        }
        //-----------------------

        if ($modelprosub->load(Yii::$app->request->post())) {
            $modelprosub->prosub_responsible_id = Yii::$app->user->identity->id;
            $modelprosub->save();
            $modelgovernance->load(Yii::$app->request->post());
            //echo $modelprosub->prosub_code."governance <br>";
            foreach ($modelgovernance->governance_id as $key => $row) {
                echo $row . " " . $modelprosub->prosub_code . "<br>";
                $models = new PmsGovernanceHasProjectSub;
                $models->governance_id = $row;
                $models->pms_project_sub_prosub_code = $modelprosub->prosub_code;
                $models->save();
                //unset($models);
            }

            $modelsPurpose = ModelPurpose::createMultiple(PmsPurpose::classname(), $modelsPurpose);
            ModelPurpose::loadMultiple($modelsPurpose, Yii::$app->request->post());
            //echo "<br>";
            foreach ($modelsPurpose as $key => $row) {
                //echo $row->purpose_detail."<br>";
                $models = new PmsPurpose;
                $models->pms_project_sub_prosub_code = $modelprosub->prosub_code;
                $models->purpose_detail = $row->purpose_detail;
                if ($row->purpose_detail != "") {
                    $models->save();
                }
            }

            $modelsIndicator = ModelIndicator::createMultiple(PmsIndicator::classname(), $modelsIndicator);
            ModelIndicator::loadMultiple($modelsIndicator, Yii::$app->request->post());
            //echo "<br>";
            foreach ($modelsIndicator as $key => $row) {
                //echo $row->indicator_detail." ".$row->indicator_goalValue."<br>";
                $models = new PmsIndicator;
                $models->pms_project_sub_prosub_code = $modelprosub->prosub_code;
                $models->indicator_detail = $row->indicator_detail;
                $models->indicator_goalValue = $row->indicator_goalValue;
                if ($row->indicator_detail != "" && $row->indicator_goalValue != "") {
                    $models->save();
                }
            }

            //echo "<br><br>";
            //echo $modelprosub->prosub_timeend." - ".$modelprosub->prosub_timestart."<br>";


            $modelsPlace = ModelPlace::createMultiple(PmsPlace::classname(), $modelsPlace);
            ModelPlace::loadMultiple($modelsPlace, Yii::$app->request->post());
            //echo "<br>";
            foreach ($modelsPlace as $key => $row) {
                //echo $row->place_name."<br>";
                $models = new PmsPlace;
                $models->pms_project_sub_prosub_code = $modelprosub->prosub_code;
                $models->place_name = $row->place_name;
                if ($row->place_name != "") {
                    $models->save();
                }
            }

            $modelsExecute = ModelExecute::createMultiple(PmsExecute::classname(), $modelsExecute);
            ModelExecute::loadMultiple($modelsExecute, Yii::$app->request->post());
            //echo "<br>";
            foreach ($modelsExecute as $key => $row) {
                echo $row->execute_name . " " . $row->execute_timestart . " " . $row->execute_timeend . " " . $row->execute_cost . " " . $row->execute_targetgroup . " " . $row->execute_amount . " " . $row->execute_operationplan . "<br>";
                $models = new PmsExecute;
                $models->pms_project_sub_prosub_code = $modelprosub->prosub_code;
                $models->execute_name = $row->execute_name;
                $models->execute_timestart = $row->execute_timestart;
                $models->execute_timeend = $row->execute_timeend;
                $models->execute_cost = $row->execute_cost;
                $models->execute_targetgroup = $row->execute_targetgroup;
                $models->execute_amount = $row->execute_amount;
                $models->execute_operationplan = $row->execute_operationplan;
                $models->execute_no = $key + 1;
                if ($row->execute_name != "") {
                    $models->save(false);
                }
            }


            $modelProbudget = ModelProbudget::createMultiple(PmsProjectsubBudget::classname(), $modelProbudget);
            ModelProbudget::loadMultiple($modelProbudget, Yii::$app->request->post());
            echo sizeof($modelProbudget) . "b1<br>";
            foreach ($modelProbudget as $key => $row) {
                echo $row->budget_sub . " " . $row->budget_limit . "<br>";
                $models = new PmsProjectsubBudget;
                $models->pms_project_sub_prosub_code = $modelprosub->prosub_code;
                $models->budget_sub = $row->budget_sub;
                $models->budget_limit = $row->budget_limit;
                $models->budget_main = 1;
                if ($row->budget_sub != "" && $row->budget_limit != "") {
                    $models->save(false);
                }
            }

            $modelProbudget2 = ModelProbudget::createMultiple(PmsProjectsubBudgets::classname(), $modelProbudget2);
            ModelProbudget::loadMultiple($modelProbudget2, Yii::$app->request->post());
            echo sizeof($modelProbudget2) . "b2<br>";
            foreach ($modelProbudget2 as $key => $row) {
                echo $row->budget_sub . "- -" . $row->budget_limit . "<br>";
                $models = new PmsProjectsubBudgets;
                $models->pms_project_sub_prosub_code = $modelprosub->prosub_code;
                $models->budget_sub = $row->budget_sub;
                $models->budget_limit = $row->budget_limit;
                $models->budget_main = 2;
                if ($row->budget_sub != "" && $row->budget_limit != "") {
                    $models->save(false);
                }
            }

            $modelProbudget3 = ModelProbudget::createMultiple(PmsProjectsubBudgetss::classname(), $modelProbudget3);
            ModelProbudget::loadMultiple($modelProbudget3, Yii::$app->request->post());
            echo sizeof($modelProbudget3) . "b3<br>";
            foreach ($modelProbudget3 as $key => $row) {
                // echo $row->budget_other."- -".$row->budget_limit."<br>";
                $models = new PmsProjectsubBudgetss;
                $models->pms_project_sub_prosub_code = $modelprosub->prosub_code;
                $models->budget_other = $row->budget_other;
                $models->budget_limit = $row->budget_limit;
                $models->budget_main = 3;
                if ($row->budget_other != "" && $row->budget_limit != "") {
                    $models->save(false);
                }
            }

            //echo "--------------<br><br>";
            $modelCostplan = ModelCostplan::createMultiple(PmsCostPlan::classname(), $modelCostplan);
            ModelCostplan::loadMultiple($modelCostplan, Yii::$app->request->post());
            //echo sizeof($modelCostplan)."<br>";
            foreach ($modelCostplan as $key => $row) {
                //echo $row->cost_detail." ".$row->cost_price."<br>";
                $models = new PmsCostPlan;
                $models->pms_project_sub_prosub_code = $modelprosub->prosub_code;
                $models->cost_detail = $row->cost_detail;
                $models->cost_price = $row->cost_price;
                if ($row->cost_detail != "") {
                    $models->save();
                }
            }

            //echo "--------------<br><br>";
            $modelResult = ModelResult::createMultiple(PmsResultExpect::classname(), $modelResult);
            ModelResult::loadMultiple($modelResult, Yii::$app->request->post());
            //echo sizeof($modelResult)."<br>";
            foreach ($modelResult as $key => $row) {
                //echo $row->result_detail."<br>";
                $models = new PmsResultExpect;
                $models->pms_project_sub_prosub_code = $modelprosub->prosub_code;
                $models->result_detail = $row->result_detail;
                if ($row->result_detail != "") {
                    $models->save();
                }
            }

            //echo "--------------<br><br>";
            $modelEffect = ModelEffect::createMultiple(PmsEffect::classname(), $modelEffect);
            ModelEffect::loadMultiple($modelEffect, Yii::$app->request->post());
            //echo sizeof($modelEffect)."<br>";
            foreach ($modelEffect as $key => $row) {
                //echo $row->effect_detail."<br>";
                $models = new PmsEffect;
                $models->pms_project_sub_prosub_code = $modelprosub->prosub_code;
                $models->effect_detail = $row->effect_detail;
                if ($row->effect_detail != "") {
                    $models->save();
                }
            }

            //echo "--------------<br><br>";
            $modelProblem = ModelProblem::createMultiple(PmsProblem::classname(), $modelProblem);
            ModelProblem::loadMultiple($modelProblem, Yii::$app->request->post());
            //echo sizeof($modelProblem)."<br>";
            foreach ($modelProblem as $key => $row) {
                //echo $row->problem_detail."<br>";
                $models = new PmsProblem;
                $models->pms_project_sub_prosub_code = $modelprosub->prosub_code;
                $models->problem_detail = $row->problem_detail;
                if ($row->problem_detail != "") {
                    $models->save();
                }
            }


            return $this->redirect(['detailpro/detailpro?id=' . $modelprosub->prosub_code]);
        }


        $this->layout = "main_module";
        return $this->render('prosub_add',
            ['modelprosub' => $modelprosub,
                'strtegicisOfYear' => $strtegicisOfYear,
                'governanceOfYear' => $governanceOfYear,
                'modelgovernance' => $modelgovernance,
                //'modelstrategicHasPro'=>$modelstrategicHasPro,
                'modelsPurpose' => (empty($modelsPurpose)) ? [new PmsPurpose] : $modelsPurpose,
                'modelsIndicator' => (empty($modelsIndicator)) ? [new PmsIndicator] : $modelsIndicator,
                'modelsPlace' => (empty($modelsPlace)) ? [new PmsPlace] : $modelsPlace,
                'modelsExecute' => (empty($modelsExecute)) ? [new PmsExecute] : $modelsExecute,
                'modelProbudget' => (empty($modelProbudget)) ? [new PmsProjectsubBudget] : $modelProbudget,
                'modelProbudget2' => (empty($modelProbudget2)) ? [new PmsProjectsubBudgets] : $modelProbudget2,
                'modelProbudget3' => (empty($modelProbudget3)) ? [new PmsProjectsubBudgetss] : $modelProbudget3,
                'modelCostplan' => (empty($modelCostplan)) ? [new PmsCostPlan] : $modelCostplan,
                'modelResult' => (empty($modelResult)) ? [new PmsResultExpect] : $modelResult,
                'modelEffect' => (empty($modelEffect)) ? [new PmsEffect] : $modelEffect,
                'modelProblem' => (empty($modelProblem)) ? [new PmsProblem] : $modelProblem,
                'manager' => $manager,
                'operator' => $operator,
            ]);
    }

    public function actionProsubUpdate()
    {
        $this->layout = "main_module";
        return $this->redirect(['prosub-show']);
    }

    public function actionProsubShow()
    {
        $this->layout = "main_module";
        return $this->render('prosub_show');
    }

    public function actionJsYear()
    {
        $year = Yii::$app->request->get('year');
        $project = PmsProject::find()->where(['project_year' => $year])->all();
        $projectShow = "<select class=\"form-control\" name='project_id'>";
        if (sizeof($project) == 0) {
            $projectShow = $projectShow . "<option selected disabled>------ ไม่พบโครงการหลักประจำปีนี้ -----</option>";
        } else {
            foreach ($project as $rows) {
                $projectShow = $projectShow . "<option value='" . $rows->project_code . "' >" . $rows->project_name . "</option>";
            }
        }

        $projectShow = $projectShow . "</select>";
        echo $projectShow;
    }

    public function actionJsStrategicissues()
    {
        $strategicissues = Yii::$app->request->get('strategicissues');
        $strategic = Strategic::find()->where(['strategic_issues_strategic_issues_id' => $strategicissues])->all();
        $strategicShow = "<select class=\"form-control\" name='project_id'>";
        if (sizeof($strategic) == 0) {
            $strategicShow = $strategicShow . "<option selected disabled>------ ไม่พบกล -----</option>";
        } else {
            foreach ($strategic as $rows) {
                $strategicShow = $strategicShow . "<option value='" . $rows->strategic_id . "' >" . $rows->strategic_name . "</option>";
            }
        }
        $strategicShow = $strategicShow . "</select>";
        echo $strategicShow;
    }

    public function actionGetProject()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $year_id = $parents[0];
                $out = $this->getProject($year_id);
                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }

        echo Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionGetBudget()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $budget_lv3 = $parents[0];
                $out = $this->getBudgetLv($budget_lv3);
                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }

        echo Json::encode(['output' => '', 'selected' => '']);
    }

    protected function getBudgetLv($id)
    {
        $datas = BudgetLv3::find()->where(['budget_lv2_budget_id' => $id])->all();
        return $this->MapData($datas, 'budget_id', 'budget_name');
    }

    protected function getProject($id)
    {
        $datas = PmsProject::find()->where(['project_year' => $id])->all();

        $obj = [];
        foreach ($datas as $row) {
            array_push($obj, ['id' => $row->project_code, 'name' => $row->project_name]);
        }

        return $obj;
        //return $this->MapData($datas,'project_code','project_name');
    }

    public function actionGetStrategic()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $strategicIssues_id = $parents[0];
                $out = $this->getStrategic($strategicIssues_id);
                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }

        echo Json::encode(['output' => '', 'selected' => '']);
    }

    protected function getStrategic($id)
    {
        $obj = [];
        $yearNow = date("Y") + 543;
        $Month = date("m");
        $Month = $Month + 0;
        if ($Month > 9) {
            $yearNow = $yearNow + 1;
        }
        $fieldId = 'strategic_id';
        $fieldName = 'strategic_name';
        $datas = PmsStrategicOfYear::find()->where(['year' => $yearNow, 'strategic_issues_id' => $id])->all();
        foreach ($datas as $row) {
            $data = Strategic::find()->where(['strategic_id' => $row->strategic_id, 'strategic_issues_strategic_issues_id' => $row->strategic_issues_id])->one();
            $array[$data->strategic_id] = $data->strategic_name;
            array_push($obj, ['id' => $data->strategic_id, 'name' => $data->strategic_id . ". " . $data->strategic_name]);
        }

        return $obj;
    }

    protected function MapData($datas, $fieldId, $fieldName)
    {
        $obj = [];
        foreach ($datas as $key => $value) {
            array_push($obj, ['id' => $value->{$fieldId}, 'name' => $value->{$fieldName}]);
        }
        return $obj;
    }

    public function actionGetPosition()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $person_id = $parents[0];
                $out = $this->getPosition($person_id);
                echo Json::encode(['output' => $out, 'selected' => $out]);
                return;
            }
        }

        echo Json::encode(['output' => '', 'selected' => '']);
    }

    protected function getPosition($id)
    {
        $obj = [];
        $datas = Person::find()->where(['id' => $id])->all();

        foreach ($datas as $row) {
            //$array[$row->id]=$row->position;
            array_push($obj, ['id' => $row->id, 'name' => $row->position]);
        }
        return $obj;
    }

    public function actionProsubEdit($id)
    {

        $yearNow = date("Y") + 543;
        $Month = date("m");
        $Month = $Month + 0;
        if ($Month > 9) {
            $yearNow = $yearNow + 1;
        }
        $modelprosub = PmsProjectSub::find()->where(['prosub_code' => $id])->one();
        $modelgovernance = new PmsGovernanceHasProjectSub;
        $strtegicisOfYear = PmsStrategicOfYear::find()->distinct()->where(['year' => $yearNow])->orderBy('strategic_issues_id')->all();
        $governanceOfYear = PmsGovernanceOfYear::find()->distinct()->where(['year' => $yearNow])->orderBy('governance_id')->all();
//        $modelstrategicHasPro = PmsStrategicHasProjectSub::find()->where(['pms_project_sub_prosub_code'=>$id])->one();
//
//        if($modelstrategicHasPro == null){
//            $modelstrategicHasPro = new PmsStrategicHasProjectSub;
//        }
        $modelsPurpose = PmsPurpose::find()->where(['pms_project_sub_prosub_code' => $id])->all();
        if ($modelsPurpose == null) {
            $modelsPurpose = [new PmsPurpose];
        }
        $modelsIndicator = PmsIndicator::find()->where(['pms_project_sub_prosub_code' => $id])->all();
        if ($modelsIndicator == null) {
            $modelsIndicator = [new PmsIndicator];
        }
        $modelsPlace = PmsPlace::find()->where(['pms_project_sub_prosub_code' => $id])->all();
        if ($modelsPlace == null) {
            $modelsPlace = [new PmsPlace];
        }
        $modelsExecute = PmsExecute::find()->where(['pms_project_sub_prosub_code' => $id])->all();
        if ($modelsExecute == null) {
            $modelsExecute = [new PmsExecute];
        }
        $modelProbudget = PmsProjectsubBudget::find()->where(['pms_project_sub_prosub_code' => $id, 'budget_main' => 1])->all();
        if ($modelProbudget == null) {
            $modelProbudget = [new PmsProjectsubBudget];
        }


        $modelProbudget2 = PmsProjectsubBudgets::find()->where(['pms_project_sub_prosub_code' => $id, 'budget_main' => 2])->all();
        if ($modelProbudget2 == null) {
            $modelProbudget2 = [new PmsProjectsubBudgets];
        }

        $modelProbudget3 = PmsProjectsubBudgetss::find()->where(['pms_project_sub_prosub_code' => $id, 'budget_main' => 3])->all();
        if ($modelProbudget3 == null) {
            $modelProbudget3 = [new PmsProjectsubBudgetss];
        }

        $modelCostplan = PmsCostPlan::find()->where(['pms_project_sub_prosub_code' => $id])->all();
        if ($modelCostplan == null) {
            $modelCostplan = [new PmsCostPlan];
        }
        $modelResult = PmsResultExpect::find()->where(['pms_project_sub_prosub_code' => $id])->all();
        if ($modelResult == null) {
            $modelResult = [new PmsResultExpect];
        }
        $modelEffect = PmsEffect::find()->where(['pms_project_sub_prosub_code' => $id])->all();
        if ($modelEffect == null) {
            $modelEffect = [new PmsEffect];
        }
        $modelProblem = PmsProblem::find()->where(['pms_project_sub_prosub_code' => $id])->all();
        if ($modelProblem == null) {
            $modelProblem = [new PmsProblem];
        }
//---------------
        $datah = EofficeCentralViewPisBoardOfDirectors::find()->select('person_id')->distinct()->all();
        foreach ($datah as $row) {
            $datas = EofficeCentralViewPisBoardOfDirectors::find()->where(['person_id' => $row->person_id])->orderBy(['period_describe' => SORT_DESC])->one();
            //echo $datas->academic_positions_abb_thai.$datas->person_name." ".$datas->person_surname." (".$datas->position_name.")<br>";
            $manager[$row->person_id] = $datas->academic_positions_abb_thai . $datas->person_name . " " . $datas->person_surname . " (" . $datas->position_name . ")";
        }


        $datas = EofficeCentralViewPisPerson::find()->where(['person_type' => '2'])->orderBy(['academic_positions' => SORT_DESC])->all();
        $datat = EofficeCentralViewPisPerson::find()->where(['person_type' => '1'])->orderBy(['PREFIXABB' => SORT_DESC])->all();

        foreach ($datat as $row) {
            //echo $row->PREFIXNAME.$row->person_name." ".$row->person_surname."  (อาจารย์สาขาประจำวิชา".$row->academic_positions.")<br>";
            $operator[$row->person_id] = $row->PREFIXABB . $row->person_name . " " . $row->person_surname . "  (อาจารย์สาขาประจำวิชา" . $row->major_name . ")";

        }
        foreach ($datas as $row) {
            //echo $row->PREFIXABB.$row->person_name." ".$row->person_surname."  (".$row->person_position_staff.")<br>";
            $operator[$row->person_id] = $row->PREFIXABB . $row->person_name . " " . $row->person_surname . "  (" . $row->person_position_staff . ")";
        }
        //-----------------------
        if ($modelprosub->load(Yii::$app->request->post())) {
            $modelprosub->save();

            //PmsStrategicHasProjectSub::deleteAll(['pms_project_sub_prosub_code'=>$id]);
//            $modelstrategicHasPro->load(Yii::$app->request->post());
            //echo $modelstrategicHasPro->strategic_id." ".$modelstrategicHasPro->strategic_issues_id;
//            $modelstrategicHasPro->save();

            $modelgovernance->load(Yii::$app->request->post());
            PmsGovernanceHasProjectSub::deleteAll(['pms_project_sub_prosub_code' => $modelprosub->prosub_code]);
            foreach ($modelgovernance->governance_id as $key => $row) {
                $models = new PmsGovernanceHasProjectSub;
                $models->governance_id = $row;
                $models->pms_project_sub_prosub_code = $modelprosub->prosub_code;
                $models->save();
            }

            $modelsPurpose = ModelPurpose::createMultiple(PmsPurpose::classname(), $modelsPurpose);
            ModelPurpose::loadMultiple($modelsPurpose, Yii::$app->request->post());
            //echo "<br>";
            PmsPurpose::deleteAll(['pms_project_sub_prosub_code' => $modelprosub->prosub_code]);
            foreach ($modelsPurpose as $key => $row) {
                //echo $row->purpose_detail."<br>";
                $models = new PmsPurpose;
                $models->pms_project_sub_prosub_code = $modelprosub->prosub_code;
                $models->purpose_detail = $row->purpose_detail;
                if ($row->purpose_detail != "") {
                    $models->save();
                }
            }

            $modelsIndicator = ModelIndicator::createMultiple(PmsIndicator::classname(), $modelsIndicator);
            ModelIndicator::loadMultiple($modelsIndicator, Yii::$app->request->post());
            //echo "<br>";
            PmsIndicator::deleteAll(['pms_project_sub_prosub_code' => $modelprosub->prosub_code]);
            foreach ($modelsIndicator as $key => $row) {
                //echo $row->indicator_detail." ".$row->indicator_goalValue."<br>";
                $models = new PmsIndicator;
                $models->pms_project_sub_prosub_code = $modelprosub->prosub_code;
                $models->indicator_detail = $row->indicator_detail;
                $models->indicator_goalValue = $row->indicator_goalValue;
                if ($row->indicator_detail != "" && $row->indicator_goalValue != "") {
                    $models->save();
                }
            }

            //echo "<br><br>";
            //echo $modelprosub->prosub_timeend." - ".$modelprosub->prosub_timestart."<br>";


            $modelsPlace = ModelPlace::createMultiple(PmsPlace::classname(), $modelsPlace);
            ModelPlace::loadMultiple($modelsPlace, Yii::$app->request->post());
            //echo "<br>";
            PmsPlace::deleteAll(['pms_project_sub_prosub_code' => $modelprosub->prosub_code]);
            foreach ($modelsPlace as $key => $row) {
                //echo $row->place_name."<br>";
                $models = new PmsPlace;
                $models->pms_project_sub_prosub_code = $modelprosub->prosub_code;
                $models->place_name = $row->place_name;
                if ($row->place_name != "") {
                    $models->save();
                }
            }

            $modelsExecute = ModelExecute::createMultiple(PmsExecute::classname(), $modelsExecute);
            ModelExecute::loadMultiple($modelsExecute, Yii::$app->request->post());
            //echo "<br>";
            PmsExecute::deleteAll(['pms_project_sub_prosub_code' => $modelprosub->prosub_code]);
            foreach ($modelsExecute as $key => $row) {
                //echo $row->execute_name." ".$row->execute_timestart." ".$row->execute_timeend." ".$row->execute_cost." ".$row->execute_targetgroup." ".$row->execute_amount." ".$row->execute_operationplan."<br>";
                $models = new PmsExecute;
                $models->pms_project_sub_prosub_code = $modelprosub->prosub_code;
                $models->execute_name = $row->execute_name;
                $models->execute_timestart = $row->execute_timestart;
                $models->execute_timeend = $row->execute_timeend;
                $models->execute_cost = $row->execute_cost;
                $models->execute_targetgroup = $row->execute_targetgroup;
                $models->execute_amount = $row->execute_amount;
                $models->execute_operationplan = $row->execute_operationplan;
                $models->execute_no = $key + 1;
                if ($row->execute_name != "") {
                    $models->save();
                }
            }


            $modelProbudget = ModelProbudget::createMultiple(PmsProjectsubBudget::classname(), $modelProbudget);
            ModelProbudget::loadMultiple($modelProbudget, Yii::$app->request->post());
            PmsProjectsubBudget::deleteAll(['pms_project_sub_prosub_code' => $modelprosub->prosub_code, 'budget_main' => 1]);
            foreach ($modelProbudget as $key => $row) {
                echo $row->budget_sub . " " . $row->budget_limit . "<br>";
                $models = new PmsProjectsubBudget;
                $models->pms_project_sub_prosub_code = $modelprosub->prosub_code;
                $models->budget_sub = $row->budget_sub;
                $models->budget_main = 1;
                $models->budget_limit = $row->budget_limit;
                if ($row->budget_sub != "" && $row->budget_limit != "") {
                    $models->save(false);
                }
            }

            $modelProbudget2 = ModelProbudget::createMultiple(PmsProjectsubBudgets::classname(), $modelProbudget2);
            ModelProbudget::loadMultiple($modelProbudget2, Yii::$app->request->post());
            PmsProjectsubBudget::deleteAll(['pms_project_sub_prosub_code' => $modelprosub->prosub_code, 'budget_main' => 2]);
            echo sizeof($modelProbudget2);
            foreach ($modelProbudget2 as $key => $row) {
                echo $row->budget_sub . " " . $row->budget_limit . "<br>";
                $models = new PmsProjectsubBudget;
                $models->pms_project_sub_prosub_code = $modelprosub->prosub_code;
                $models->budget_sub = $row->budget_sub;
                $models->budget_main = 2;
                $models->budget_limit = $row->budget_limit;
                if ($row->budget_sub != "" && $row->budget_limit != "") {
                    echo "fsdfdsf";
                    $models->save(false);
                }
            }
            $modelProbudget3 = ModelProbudget::createMultiple(PmsProjectsubBudgetss::classname(), $modelProbudget3);
            ModelProbudget::loadMultiple($modelProbudget3, Yii::$app->request->post());
            PmsProjectsubBudget::deleteAll(['pms_project_sub_prosub_code' => $modelprosub->prosub_code, 'budget_main' => 3]);
            foreach ($modelProbudget3 as $key => $row) {
                $models = new PmsProjectsubBudgetss;
                $models->pms_project_sub_prosub_code = $modelprosub->prosub_code;
                $models->budget_other = $row->budget_other;
                $models->budget_main = 3;
                $models->budget_limit = $row->budget_limit;
                if ($row->budget_other != "" && $row->budget_limit != "") {
                    $models->save(false);
                }
            }

            //echo "--------------<br><br>";
            $modelCostplan = ModelCostplan::createMultiple(PmsCostPlan::classname(), $modelCostplan);
            ModelCostplan::loadMultiple($modelCostplan, Yii::$app->request->post());
            //echo sizeof($modelCostplan)."<br>";
            PmsCostPlan::deleteAll(['pms_project_sub_prosub_code' => $modelprosub->prosub_code]);
            foreach ($modelCostplan as $key => $row) {
                //echo $row->cost_detail." ".$row->cost_price."<br>";
                $models = new PmsCostPlan;
                $models->pms_project_sub_prosub_code = $modelprosub->prosub_code;
                $models->cost_detail = $row->cost_detail;
                $models->cost_price = $row->cost_price;
                if ($row->cost_detail != "") {
                    $models->save();
                }
            }

            //echo "--------------<br><br>";
            $modelResult = ModelResult::createMultiple(PmsResultExpect::classname(), $modelResult);
            ModelResult::loadMultiple($modelResult, Yii::$app->request->post());
            //echo sizeof($modelResult)."<br>";
            PmsResultExpect::deleteAll(['pms_project_sub_prosub_code' => $modelprosub->prosub_code]);
            foreach ($modelResult as $key => $row) {
                //echo $row->result_detail."<br>";
                $models = new PmsResultExpect;
                $models->pms_project_sub_prosub_code = $modelprosub->prosub_code;
                $models->result_detail = $row->result_detail;
                if ($row->result_detail != "") {
                    $models->save();
                }
            }

            //echo "--------------<br><br>";
            $modelEffect = ModelEffect::createMultiple(PmsEffect::classname(), $modelEffect);
            ModelEffect::loadMultiple($modelEffect, Yii::$app->request->post());
            //echo sizeof($modelEffect)."<br>";
            PmsEffect::deleteAll(['pms_project_sub_prosub_code' => $modelprosub->prosub_code]);
            foreach ($modelEffect as $key => $row) {
                //echo $row->effect_detail."<br>";
                $models = new PmsEffect;
                $models->pms_project_sub_prosub_code = $modelprosub->prosub_code;
                $models->effect_detail = $row->effect_detail;
                if ($row->effect_detail != "") {
                    $models->save();
                }
            }

            //echo "--------------<br><br>";
            $modelProblem = ModelProblem::createMultiple(PmsProblem::classname(), $modelProblem);
            ModelProblem::loadMultiple($modelProblem, Yii::$app->request->post());
            //echo sizeof($modelProblem)."<br>";
            PmsProblem::deleteAll(['pms_project_sub_prosub_code' => $modelprosub->prosub_code]);
            foreach ($modelProblem as $key => $row) {
                //echo $row->problem_detail."<br>";
                $models = new PmsProblem;
                $models->pms_project_sub_prosub_code = $modelprosub->prosub_code;
                $models->problem_detail = $row->problem_detail;
                if ($row->problem_detail != "") {
                    $models->save();
                }
            }

            if ($modelprosub->prosub_status_offer == "รอปรับแก้ไขโครงการ") {
                Yii::$app->get('db_pms')->createCommand()->update('pms_project_sub', ['prosub_status_offer' => "ยังไม่ดำเนินการ", 'prosub_status_insystem' => "none_system"], 'prosub_code="' . $modelprosub->prosub_code . '"')->execute();
            }
            return $this->redirect(['detailpro/detailpro?id=' . $modelprosub->prosub_code]);
        }


        $this->layout = "main_module";
        return $this->render('prosub_update',
            ['modelprosub' => $modelprosub,
                'strtegicisOfYear' => $strtegicisOfYear,
                'governanceOfYear' => $governanceOfYear,
                'modelgovernance' => $modelgovernance,
                //'modelstrategicHasPro'=>$modelstrategicHasPro,
                'modelsPurpose' => (empty($modelsPurpose)) ? [new PmsPurpose] : $modelsPurpose,
                'modelsIndicator' => (empty($modelsIndicator)) ? [new PmsIndicator] : $modelsIndicator,
                'modelsPlace' => (empty($modelsPlace)) ? [new PmsPlace] : $modelsPlace,
                'modelsExecute' => (empty($modelsExecute)) ? [new PmsExecute] : $modelsExecute,
                'modelProbudget' => (empty($modelProbudget)) ? [new PmsProjectsubBudget] : $modelProbudget,
                'modelProbudget2' => (empty($modelProbudget2)) ? [new PmsProjectsubBudgets] : $modelProbudget2,
                'modelProbudget3' => (empty($modelProbudget3)) ? [new PmsProjectsubBudgetss] : $modelProbudget3,
                'modelCostplan' => (empty($modelCostplan)) ? [new PmsCostPlan] : $modelCostplan,
                'modelResult' => (empty($modelResult)) ? [new PmsResultExpect] : $modelResult,
                'modelEffect' => (empty($modelEffect)) ? [new PmsEffect] : $modelEffect,
                'modelProblem' => (empty($modelProblem)) ? [new PmsProblem] : $modelProblem,
                'manager' => $manager,
                'operator' => $operator,
            ]);
    }

    public function actionAddprosubDelete($id)
    {
        $data = PmsProjectSub::findOne($id);
        $data->delete();
        return $this->redirect(['tablepro/track-project']);
    }

//    public function actionAddprosubDelete(){
//        $datah = EofficeCentralViewPisBoardOfDirectors::find()->select('person_id')->distinct()->all();
//        foreach ($datah as $row){
//            $datas = EofficeCentralViewPisBoardOfDirectors::find()->where(['person_id'=>$row->person_id])->orderBy(['period_describe'=>SORT_DESC])->one();
//            //echo $datas->academic_positions_abb_thai.$datas->person_name." ".$datas->person_surname." (".$datas->position_name.")<br>";
//            $manager[$row->person_id]=$datas->academic_positions_abb_thai.$datas->person_name." ".$datas->person_name." (".$datas->position_name.")";
//        }
//
//
//        $datas = EofficeCentralViewPisPerson::find()->where(['person_type'=>'2'])->orderBy(['academic_positions'=>SORT_DESC])->all();
//        $datat = EofficeCentralViewPisPerson::find()->where(['person_type'=>'1'])->orderBy(['PREFIXABB'=>SORT_DESC])->all();
//
//        foreach ($datat as $row){
//            //echo $row->PREFIXNAME.$row->person_name." ".$row->person_surname."  (อาจารย์สาขาประจำวิชา".$row->academic_positions.")<br>";
//            $manager[$row->person_id]=$row->PREFIXABB.$row->person_name." ".$row->person_surname."  (อาจารย์สาขาประจำวิชา".$row->major_name.")";
//
//        }
//        foreach ($datas as $row){
//            //echo $row->PREFIXABB.$row->person_name." ".$row->person_surname."  (".$row->person_position_staff.")<br>";
//            $manager[$row->person_id]=$row->PREFIXABB.$row->person_name." ".$row->person_surname."  (".$row->person_position_staff.")";
//        }
//            exit;
//    }

}