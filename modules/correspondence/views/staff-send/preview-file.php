<?php
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\modules\correspondence\controllers;

$query = \app\modules\correspondence\models\CmsFile::find()
    ->from(['cms_doc_file', 'cms_file', 'cms_document'])
    ->where("cms_doc_file.doc_id = '" . $doc_id . "'")
    ->andWhere("cms_doc_file.file_id = cms_file.file_id")
    ->groupBy(['cms_file.file_name'])
    ->one();
if ($query) {
    $exts = array('gif', 'png', 'jpg','pdf','txt');
    if(in_array(substr($query->file_name,-3),$exts)) {
        ?>
        <div>
            <iframe src="<?= Url::to(Yii::getAlias('@web') . '/web_cms/uploads/' .
                $query->file_path . '/' . $query->file_name); ?>" height="700" width="100%"></iframe>
        </div>
        <?php
    }
} else {
    echo "
                <div style='border: 2px solid darkgrey; background-color: darkgrey; width: 100%;'>
                <h3 style='color: white; text-align: center'><br>".controllers::t('menu','Sorry, this file does not exist.')."</h3></div> ";
}
?>
