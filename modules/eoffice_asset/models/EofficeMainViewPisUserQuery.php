<?php

namespace app\modules\eoffice_asset\models;

/**
 * This is the ActiveQuery class for [[EofficeMainViewPisRoom]].
 *
 * @see EofficeMainViewPisRoom
 */
class EofficeMainViewPisUserQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return EofficeMainViewPisRoom[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return EofficeMainViewPisRoom|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
