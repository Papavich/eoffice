<?php

namespace app\modules\portfolio\controllers;

//use common\models\User;
//use common\models\UserSearch;
//use common\rbac\models\Role;
use yii\base\Model;
use yii\web\NotFoundHttpException;
use Yii;
use app\modules\portfolio\models\Person;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends BackendController {

    /**
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex() {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     *
     * @param  integer $id The user id.
     * @return string
     *
     * @throws NotFoundHttpException
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return string|\yii\web\Response
     */
    public function actionCreate() {

        $user = new User(['scenario' => 'create']);
        $role = new Role();
        $person = new Person();
        
        

        if ($user->load(Yii::$app->request->post()) &&
                $role->load(Yii::$app->request->post()) &&
                $person->load(Yii::$app->request->post()) &&
                Model::validateMultiple([$user, $role, $person])) {
            $user->setPassword($user->password);
            $user->generateAuthKey();

            if ($user->save()) {
                $role->user_id = $user->getId();
                $role->save();
            }
            
            //update user_id ให้กับ ตาราง person จะได้รู้ว่าบุคลากรคนนี้ใช้ user อะไร
            $person = Person::findOne(['person_id' => $person->person_id]);
            $person->user_id = $user->getID();
            $person->update();


            return $this->redirect('index');
        } else {
            return $this->render('create', [
                        'user' => $user,
                        'role' => $role,
                        'person' => $person,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param  integer $id The user id.
     * @return string|\yii\web\Response
     *
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id) {
        // get role
        $role = Role::findOne(['user_id' => $id]);

        // get user details
        $user = $this->findModel($id);
        
              
        $person = new Person();
        //dropdownlist selected to form
        $person = Person::findOne(['user_id' => $id]);
        
        //หา person เดิม เพื่อเตรียม update ให้เป็นค่าว่างก่อน เดี๋ยวชนกันกับคนใหม่
        $person2 = Person::findOne(['user_id' => $id]);
        
        
        // only The Creator can update everyone`s roles
        // admin will not be able to update role of theCreator
        if (!Yii::$app->user->can('theCreator')) {
            if ($role->item_name === 'theCreator') {
                return $this->goHome();
            }
        }

        // load user data with role and validate them
        if ($user->load(Yii::$app->request->post()) &&
                $person->load(Yii::$app->request->post()) &&
                $role->load(Yii::$app->request->post()) && Model::validateMultiple([$user, $role, $person])) {
            // only if user entered new password we want to hash and save it
            if ($user->password) {
                $user->setPassword($user->password);
            }

            // if admin is activating user manually we want to remove account activation token
            if ($user->status == User::STATUS_ACTIVE && $user->account_activation_token != null) {
                $user->removeAccountActivationToken();
            }

            $user->save(false);
            $role->save(false);
            
            //update user_id เดิม ให้เป็น null
            $person2->user_id = NULL;
            $person2->update();
            
            //update user_id ให้กับ ตาราง person จะได้รู้ว่าบุคลากรคนนี้ใช้ user อะไร
            $person = Person::findOne(['person_id' => $person->person_id]);
            $person->user_id = $user->getID();
            $person->update(false);

            
           return $this->redirect(['view', 'id' => $user->id]);
        } else {
            return $this->render('update', [
                        'user' => $user,
                        'role' => $role,
                        'person' => $person,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param  integer $id The user id.
     * @return \yii\web\Response
     *
     * @throws NotFoundHttpException
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        // delete this user's role from auth_assignment table
        if ($role = Role::find()->where(['user_id' => $id])->one()) {
            $role->delete();
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param  integer $id The user id.
     * @return User The loaded model.
     *
     * @throws NotFoundHttpException
     */
    protected function findModel($id) {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
