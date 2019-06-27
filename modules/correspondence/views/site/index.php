<?php
/* check permission and role */
echo "avcdsaw";
if (\Yii::$app->authManager->isAdmin()) {
    echo "isAdmin";
    Yii::$app->getResponse()->redirect(['correspondence/staff/index'])->send();
} elseif (\Yii::$app->authManager->isStaffFinance()) {
//เจ้าหน้าที่ทั่วไป
    echo "isStaffFinance";
    Yii::$app->getResponse()->redirect(['correspondence/mail/inbox'])->send();
} elseif (\Yii::$app->authManager->isStudent()) {
    //LEADER staff_a ,staff_b
    echo "isStudent";
    Yii::$app->getResponse()->redirect(['correspondence/mail/inbox'])->send();
} elseif (\Yii::$app->authManager->isStaffGeneral()) {
    //เจ้าหน้าที่ทั่วไป
    echo "isStaffGeneral";
    Yii::$app->getResponse()->redirect(['correspondence/staff/index'])->send();
} elseif (\Yii::$app->authManager->isStaffGs()) {
    //echo "isStaffGs";
    Yii::$app->getResponse()->redirect(['correspondence/mail/inbox'])->send();
} elseif (\Yii::$app->authManager->isParent()) {
    //echo $this->render('../mail/inbox');
    //echo "isParent";
    Yii::$app->getResponse()->redirect(['correspondence/mail/inbox'])->send();
} else {
    //echo $this->render('../mail/inbox');
    Yii::$app->getResponse()->redirect(['correspondence/mail/inbox'])->send();
}

?>
