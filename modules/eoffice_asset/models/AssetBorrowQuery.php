<?php

namespace app\modules\eoffice_asset\models;

/**
 * This is the ActiveQuery class for [[AssetBorrow]].
 *
 * @see AssetBorrow
 */
class AssetBorrowQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return AssetBorrow[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return AssetBorrow|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
