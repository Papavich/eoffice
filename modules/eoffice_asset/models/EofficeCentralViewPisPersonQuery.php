<?php

namespace app\modules\eoffice_asset\models;

/**
 * This is the ActiveQuery class for [[EofficeCentralViewPisRoom]].
 *
 * @see EofficeCentralViewPisRoom
 */
class EofficeCentralViewPisPersonQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return EofficeCentralViewPisRoom[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return EofficeCentralViewPisRoom|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
