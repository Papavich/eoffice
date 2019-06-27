<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\models\LoginForm */
$this->title = Html::encode($this->title) . 'โปรไฟล์';
?>

<!doctype html>
<html lang="en-US">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
    <title>โปรไฟล์user</title>
</head>
<!--
    .boxed = boxed version
-->
<body>

<!--
    MIDDLE
-->
<section id="middle" style="padding-left:20% ;">
    <div id="content">

        <div class="page-profile">

            <div class="row">

                <!-- COL 2 -->
                <div class="col-md-10 col-lg-8" align="center">
                    <div class="tabs white nomargin-top">
                        <div class="tab-content">
                            <!-- Overview -->
                            <div id="overview" class="tab-pane active">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 toppad">

                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                <h1 class="panel-title" style="font-size: 25px">User User</h1>
                                            </div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-3 col-lg-3 " align="center">
                                                        <img alt="User Pic" src="../../../../../eoffice/modules/correspondence/style/assets/images/girl.png"
                                                             class="img-circle img-responsive">
                                                    </div>
                                                    <div class=" col-md-9 col-lg-9 ">
                                                        <table class="table table-user-information">
                                                            <tbody>
                                                            <tr>
                                                                <td>Department:</td>
                                                                <td>Programming</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Hire date:</td>
                                                                <td>06/23/2013</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Date of Birth</td>
                                                                <td>01/24/1988</td>
                                                            </tr>

                                                            <tr>
                                                            <tr>
                                                                <td>Gender</td>
                                                                <td>Female</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Home Address</td>
                                                                <td>Kathmandu,Nepal</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Email</td>
                                                                <td>
                                                                    <a href="mailto:info@support.com">info@support.com</a>
                                                                </td>
                                                            </tr>
                                                            <td>Phone Number</td>
                                                            <td>123-4567-890(Landline)<br><br>555-4567-890(Mobile)
                                                            </td>

                                                            </tr>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div><!-- /COL 3 -->

                        </div>

                    </div>

                </div>
</section>
<!-- /MIDDLE -->

</div>
</body>
</html>