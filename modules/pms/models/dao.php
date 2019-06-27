<?php

namespace app\modules\pms\models;
use Yii;

class dao extends \yii\db\ActiveRecord
{

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_pms');
    }

    public function addproject($data)
	{
		Yii::$app->get('db_pms')->createCommand()->insert('pms_project', $data)->execute();
    }

    public function addstrategicissues($data)
    {
        Yii::$app->get('db_pms')->createCommand()->insert('pms_strategic_issues', $data)->execute();
    }
    public function addstrategic($data)
    {
        Yii::$app->get('db_pms')->createCommand()->insert('pms_strategic', $data)->execute();
    }
    public function addgovernance($data)
    {
        Yii::$app->get('db_pms')->createCommand()->insert('pms_governance', $data)->execute();
    }
    
    public function checkstrategicissues($data)
	{
        $query = PmsStrategicIssues::find()->all();
        $count2 = sizeof($data);
        foreach ($query as $rows){
            for($j=0;$j<$count2;$j++){
                if($rows['strategic_issues_id']==$data[$j]){
                    Yii::$app->get('db_pms')->createCommand()->update('pms_strategic_issues', ['strategic_issues_status' => 'active'],'strategic_issues_id='.$rows['strategic_issues_id'])
                        ->execute();
                    break;
                }else{
                    Yii::$app->get('db_pms')->createCommand()->update('pms_strategic_issues', ['strategic_issues_status' => 'non_active'],'strategic_issues_id='.$rows['strategic_issues_id'])
                        ->execute();
                }
            }
        }
	}

    public function checkallstrategicissues()
    {
        $query = PmsStrategicIssues::find()->all();
        foreach ($query as $rows){
                    Yii::$app->get('db_pms')->createCommand()->update('pms_strategic_issues', ['strategic_issues_status' => 'non_active'],'strategic_issues_id='.$rows['strategic_issues_id'])
                        ->execute();
        }
    }

    public function checkstrategic($data)
    {
        $query = PmsStrategic::find()->all();
        $count2 = sizeof($data);
        foreach ($query as $rows){
            for($j=0;$j<$count2;$j++){
                if($rows['strategic_id']==$data[$j]){
                    Yii::$app->get('db_pms')->createCommand()->update('pms_strategic', ['strategic_status' => 'active'],'strategic_id='.$rows['strategic_id'])
                        ->execute();
                    break;
                }else{
                    Yii::$app->get('db_pms')->createCommand()->update('pms_strategic', ['strategic_status' => 'non_active'],'strategic_id='.$rows['strategic_id'])
                        ->execute();
                }
            }
        }
    }

    public function checkallstrategic()
    {
        $query = PmsStrategic::find()->all();
        foreach ($query as $rows){
            Yii::$app->get('db_pms')->createCommand()->update('pms_strategic', ['strategic_status' => 'non_active'],'strategic_id='.$rows['strategic_id'])
                ->execute();
        }
    }

    public function checkgovernance($data)
    {
        $query = PmsGovernance::find()->all();
        $count2 = sizeof($data);
        foreach ($query as $rows){
            for($j=0;$j<$count2;$j++){
                if($rows['governance_id']==$data[$j]){
                    Yii::$app->get('db_pms')->createCommand()->update('pms_governance', ['governance_status' => 'active'],'governance_id='.$rows['governance_id'])
                        ->execute();
                    break;
                }else{
                    Yii::$app->get('db_pms')->createCommand()->update('pms_governance', ['governance_status' => 'non_active'],'governance_id='.$rows['governance_id'])
                        ->execute();
                }
            }
        }
    }

    public function checkallgovernance()
    {
        $query = PmsGovernance::find()->all();
        foreach ($query as $rows){
            Yii::$app->get('db_pms')->createCommand()->update('pms_governance', ['governance_status' => 'non_active'],'governance_id='.$rows['governance_id'])
                ->execute();
        }
    }

    public function getstrategic($data)
    {
        $result = Yii::$app->get('db_pms')->createCommand('SELECT * FROM pms_strategic WHERE pms_strategic_issues_strategic_issues_id='.$data)
            ->queryAll();
       return $result;
    }

    public function getproname($data)
    {
        $result = Yii::$app->get('db_pms')->createCommand('SELECT * FROM pms_project WHERE project_year='.$data)
            ->queryAll();
        return $result;
    }


}