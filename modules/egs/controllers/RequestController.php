<?php

namespace app\modules\egs\controllers;

use app\modules\egs\models\EgsAdvisor;
use app\modules\egs\models\EgsAdvisorFee;
use app\modules\egs\models\EgsBranchBinder;
use app\modules\egs\models\EgsPlan;
use app\modules\egs\models\EgsPlanBinder;
use app\modules\egs\models\EgsProgramBinder;
use app\modules\egs\models\EgsSubject;
use app\modules\egs\models\EgsSubjectFor;
use Yii;

use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\Controller;

class RequestController extends Controller
{
    public function actionBypass()
    {
        return $this->render('/default/index');
    }

    public function actionAll()
    {
        return $this->render('/default/index');
    }

    public function actionList()
    {
        return $this->render('/default/index');
    }

    public function actionAdd($owner_id, $calendar_id, $level_id, $semester_id, $action_id)
    {
        $params = ['params' => [
            'owner_id' => $owner_id,
            'calendar_id' => $calendar_id,
            'level_id' => $level_id,
            'semester_id' => $semester_id,
            'action_id' => $action_id
        ]];
        return $this->render('/default/index', $params);
    }
}
