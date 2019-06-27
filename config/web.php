<?php

$params = require(__DIR__ . '/params.php');  // database ของแต่ละ โมดูล
$db = require(__DIR__ . '/db.php');
$db_eproject = require(__DIR__ . '/db/db_eproject.php');
$db_eolm = require(__DIR__ . '/db/db_eolm.php');
$db_eolmv2 = require(__DIR__ . '/db/db_eolmv2.php');
$db_cms = require(__DIR__ . '/db/db_cms.php');
$db_pms = require(__DIR__ . '/db/db_pms.php');
$db_scb = require(__DIR__ . '/db/db_scb.php');
$db_ta = require(__DIR__ . '/db/db_ta.php');
$db_mat = require(__DIR__ . '/db/db_mat.php');
$db_asset = require(__DIR__ . '/db/db_asset.php');
$db_pfo = require(__DIR__ . '/db/db_pfo.php');
$db_kku30 = require(__DIR__ . '/db/db_kku30.php');
$db_repair = require(__DIR__ . '/db/db_repair.php');
$db_pfc = require(__DIR__ . '/db/db_pfc.php');
$db_form = require(__DIR__ . '/db/db_form.php');
$db_exam = require(__DIR__ . '/db/db_exam.php');
$db_consult = require(__DIR__ . '/db/db_consult.php');
$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log',
        [
            'class' => 'app\components\LanguageSelector',
            'supportedLanguages' => ['en', 'th'],
        ]
    ],
    'modules' => [
        'pfc' => [
            'class' => 'app\modules\pfc\controllers',
        ],
        'eoffice_consult' => [
            'class' => 'app\modules\eoffice_consult\controllers',
        ],
        'Consulting' => [
            'class' => 'app\modules\consulting\controllers',
        ],
        'eoffice_exam' => [
            'class' => 'app\modules\eoffice_exam\controllers',
        ],
        'eoffice_asset' => [
            'class' => 'app\modules\eoffice_asset\controllers',
        ],
        'repairsystem' => [
            'class' => 'app\modules\repairsystem\repair',
        ],
        'eoffice_repair' => [
            'class' => 'app\modules\eoffice_repair\controllers',
        ],
        'eoffice_form' => [
            'class' => 'app\modules\eoffice_form\controllers',
        ],
        'eoffice_ta' => [
            'class' => 'app\modules\eoffice_ta\controllers',
        ],
        'eoffice_eolm' => [
            'class' => 'app\modules\eoffice_eolm\controllers',
        ],
        'eoffice_eolmv2' => [
            'class' => 'app\modules\eoffice_eolmv2\controllers',
        ],
        'personsystem' => [
            'class' => 'app\modules\personsystem\controllers',
        ],
        'eproject' => [
            'class' => 'app\modules\eproject\controllers',
        ],
        'correspondence' => [
            'class' => 'app\modules\correspondence\controllers',
        ],
        'audit' => [
            'class' => 'bedezign\yii2\audit\Audit',
            // the layout that should be applied for views within this module
            // Name of the component to use for database access
            'db' => 'db_cms',
            // List of actions to track. '*' is allowed as the last character to use as wildcard
            'trackActions' => ['correspondence/*'],
            // Actions to ignore. '*' is allowed as the last character to use as wildcard (eg 'debug/*')
            'ignoreActions' => ['*'],
            // Role or list of roles with access to the viewer, null for everyone (if the user matches)
            'accessRoles' => null,
            // User ID or list of user IDs with access to the viewer, null for everyone (if the role matches)
            'accessUsers' => null,
            // Compress extra data generated or just keep in text? For people who don't like binary data in the DB
            'compressData' => true,
        ],
        'scholar_b' => [
            'class' => 'app\modules\scholar_b\controllers',
        ],
        'pms' => [
            'class' => 'app\modules\pms\controllers',
        ],
        'materialsystem' => [
            'class' => 'app\modules\materialsystem\controllers',
        ],
        'portfolio' => [
            'class' => 'app\modules\portfolio\controllers',
        ],
        'kku30' => [
            'class' => 'app\modules\kku30\controllers',
            'defaultRoute' => 'table/createtable'
        ],
        'eoffice_materialsys' => [
            'class' => 'app\modules\eoffice_materialsys\controllers',
        ],
        'rbac' => 'dektrium\rbac\RbacWebModule',
        'user' => [
            'class' => 'dektrium\user\Module',
            'modelMap' => [
                'Profile' => 'app\models\Profile',
            ],
            'enableUnconfirmedLogin' => true,
            'confirmWithin' => 21600,
            'cost' => 12,
            'admins' => ['admin']
        ],
        'admin'=>[
            'class' => 'mdm\admin\Module',
            'layout' => 'left-menu',
        ],
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ],
        'gridviewKrajee' =>  [
            'class' => '\kartik\grid\Module',
        ]

    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/*',
            'user/profile/*',
            'gii/*',
            'debug/*',
            'language/*',
            'api/*',
            'gridview/*',
        ],
    ],

    'components' => [
        'elasticsearch' => [
            'class' => 'yii\elasticsearch\Connection',
            'nodes' => [
                ['http_address' => '10.199.66.53:9200'],
                // configure more hosts if you have a cluster
            ],
        ],

        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    // 'sourceLanguage' => 'th',
                    'fileMap' => [
                        'app' => 'menu.php'

                    ],
                ],
            ],
        ],
        'authManager' => [
            'class' => 'app\components\MyManager',
            'defaultRoles' => ['Guest']
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '8W-cTZNt8QvXwPw_wEtulRQasreztPRo',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@app/mail',
            'useFileTransport' => false,
            // setting mail for send notification
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'cskku01@gmail.com',
                'password' => 'cskku0102',
                'port' => '465',
                'encryption' => 'ssl',
                'streamOptions' => [
                    'ssl' => [
                        'allow_self_signed' => true,
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                    ],
                ],
            ],
        ],
        'image' => [
            'class' => 'yii\image\ImageDriver',
            'driver' => 'GD',  //GD or Imagick
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'db_eproject' => $db_eproject,
        'db_cms' => $db_cms,
        'db_eolm' => $db_eolm,
        'db_eolmv2' => $db_eolmv2,
        'db_pms' => $db_pms,
        'db_scb' => $db_scb,
        'db_ta' => $db_ta,
        'db_asset' => $db_asset,
        'db_mat' => $db_mat,
        'db_pfo' => $db_pfo,
        'db_kku30' => $db_kku30,
        'db_repair' => $db_repair,
        'db_form' => $db_form,
        'db_exam' => $db_exam,
        'db_consult' => $db_consult,
        'db_pfc' => $db_pfc,
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            //'enableStrictParsing' => true,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'thaiFormatter' => [
            'class' => 'dixonsatit\thaiYearFormatter\ThaiYearFormatter',
        ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
