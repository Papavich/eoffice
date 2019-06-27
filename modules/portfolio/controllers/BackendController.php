<?php

namespace app\modules\portfolio\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;
use Yii;

/**
 * BackendController extends Controller and implements the behaviors() method
 * where you can specify the access control ( AC filter + RBAC) for 
 * your controllers and their actions.
 */
class BackendController extends Controller {

    /**
     * Returns a list of behaviors that this component should behave as.
     * Here we use RBAC in combination with AccessControl filter.
     *
     * @return array
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'denyCallback' => function ($rule, $action) {
                    throw new ForbiddenHttpException('คุณไม่มีสิทธิ์ใช้งานในส่วนนี้!');
                },
                'rules' => [
                    [
                        'controllers' => ['user'],
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'controllers' => ['department'],
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'controllers' => ['leave'],
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'controllers' => ['position'],
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                       [
                        'controllers' => ['person'],
                        'actions' => ['index', 'view', 'create', 'update', 'delete','pdf','excel'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'controllers' => ['prefix'],
                        'actions' => ['index', 'update', 'view', 'delete', 'create', 'excel', 'import'],
                        'allow' => true,
                        'roles' => ['admin', 'support'],
                    // other rules
                    ],

                    [
                        'controllers' => ['project'],
                        'actions' => ['index', 'update', 'view',  'create', 'excel', 'import'],
                        'allow' => true,
                        'roles' => ['member' ],
                        // other rules
                    ],

                ], // rules
            ], // access
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ], // verbs
        ]; // return
    }

// behaviors
}

// BackendController