<?php
/**
 * Created by PhpStorm.
 * User: DELLosc
 * Date: 9/3/2561
 * Time: 3:53
 */

namespace app\modules\portfolio\models;

/**
 * This is the ActiveQuery class for [[Project]].
 *
 * @see Project
 */
class ProjectQuery extends \yii\db\ActiveQuery
{
    /*public function active()
        {
            return $this->andWhere('[[status]]=1');
        }*/

    /**
     * @inheritdoc
     * @return Asset[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Project|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}