<?php
Yii::setAlias('@myweb', '@web/../modules/scholar_b/option');
Yii::getAlias('@myweb');
$this->registerCssFile('@myweb/scb_login.css');
?>
<div class="padding-15">

    <div class="login-box">

        <!-- login form -->
        <form class="sky-form boxed" method="post" action="../login/check-login">
            <input type="hidden" name="_csrf" value="<?php echo Yii::$app->request->getCsrfToken() ?>"/>
            <header><i class="fa fa-users"></i> เข้าสู่ระบบ</header>
            <fieldset>

                <section>
                    <label class="label">เลขบัตรประจำตัวประชาชน</label>
                    <label class="input">
                        <i class="icon-append fa fa-user"></i>
                        <input type="text" name="id_card" class="form-control masked"
                               data-format="9-9999-99999-99-9">
                        <span class="tooltip tooltip-top-right">กรุณาใส่เลขบัตรประชาชน</span>
                    </label>
                </section>

                <section>
                    <label class="label">รหัสผ่าน</label>
                    <label class="input">
                        <i class="icon-append fa fa-lock"></i>
                        <input type="password" name="password">
                        <b class="tooltip tooltip-top-right">กรุณาใส่รหัสผ่าน</b>
                    </label>
                </section>
                <button type="submit" value="submit" class="btn btn-info pull-right">เข้าสู่ระบบ</button>
            </fieldset>
        </form>
        <!-- /login form -->
    </div>
</div>