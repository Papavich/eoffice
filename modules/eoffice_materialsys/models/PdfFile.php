<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 8/3/2561
 * Time: 11:58
 */

namespace app\modules\eoffice_materialsys\models;


use app\modules\pms\models\Model;

class PdfFile extends Model
{
    /**
     * @var UploadedFile
     */
    public $file;

    public function rules()
    {
        return [
            [['file'], 'file', 'skipOnEmpty' => false, 'maxFiles' => 4],
        ];
    }

}