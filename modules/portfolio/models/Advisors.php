<?php

namespace app\modules\portfolio\models;

use Yii;

/**
 * This is the model class for table "advisors".
 *
 * @property int $advisors_id
 * @property int $person_id
 * @property int $department_id
 * @property int $prefix_id
 * @property int $acadmic_positions_id
 * @property int $expertise_id
 * @property int $areward_order_areward_order_id
 * @property int $project_member_pro_member_id
 * @property int $publication_order_pub_order_id
 */
class Advisors extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'advisors';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_pfo');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['person_id', 'department_id', 'prefix_id', 'acadmic_positions_id', 'expertise_id', 'areward_order_areward_order_id', 'project_member_pro_member_id', 'publication_order_pub_order_id'], 'required'],
            [['person_id', 'department_id', 'prefix_id', 'acadmic_positions_id', 'expertise_id', 'areward_order_areward_order_id', 'project_member_pro_member_id', 'publication_order_pub_order_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'advisors_id' => 'Advisors ID',
            'person_id' => 'Person ID',
            'department_id' => 'Department ID',
            'prefix_id' => 'Prefix ID',
            'acadmic_positions_id' => 'Acadmic Positions ID',
            'expertise_id' => 'Expertise ID',
            'areward_order_areward_order_id' => 'Areward Order Areward Order ID',
            'project_member_pro_member_id' => 'Project Member Pro Member ID',
            'publication_order_pub_order_id' => 'Publication Order Pub Order ID',
        ];
    }
}
