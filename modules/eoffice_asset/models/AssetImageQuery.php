<?php

namespace app\modules\eoffice_asset\models;

/**
 * This is the ActiveQuery class for [[AssetImage]].
 *
 * @see AssetImage
 */
class AssetImageQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return AssetImage[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return AssetImage|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
