<?php
/**
 * Created by PhpStorm.
 * User: VaraPhon
 * Date: 9/11/2017
 * Time: 10:34 PM
 */

namespace app\modules\correspondence\controllers;


use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\TemplateProcessor;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Settings;

\Yii::setAlias('@webword', '@web/../modules/correspondence');

class WordController extends Controller
{
    public function actionWord()
    {
        Settings::setTempDir(Yii::getAlias('../modules/correspondence').'/temp/'); //กำหนด folder temp สำหรับ windows server ที่ permission denied temp (อย่ายลืมสร้างใน project ล่ะ)
        $templateProcessor = new TemplateProcessor(Yii::getAlias('../modules/correspondence').'/msword/template_in.docx');//เลือกไฟล์ template ที่เราสร้างไว้
        $templateProcessor->setValue('doc_department', 'สำนักเทคโนโลยีสารสนเทศ');//อัดตัวแปร รายตัว
        $templateProcessor->setValue(
            [
                'doc_no',
                'doc_date',
                'doc_title',
                'doc_to',
                'doc_detail1',
                'doc_detail2',
                'doc_detail3',
                'doc_name',
                'doc_position'
            ],
            [
                'ทน1234/2345',
                '18 กรกฏาคม 2560',
                'การสร้างระบบออกเอกสารราชการ',
                'ผู้อำนวยการสถาบันเทคโนโลยีสารสนเทศแห่งชาติ',
                'เนื่องด้วยการพัฒนาระบบ Web-based Application ในปัจจุบันประสบปัญหาในการสร้างเอกสารราชการ',
                'กระผมนายมานพ กองอุ่น มีความประสงค์จะพัฒนาระบบการออกเอกสารราชการตามแม่แบบราชการสำหรับใช้งานในระบบ Web-based Application ดังนั้น กระผมจึงพัฒนาตัวอย่างของการออกเอกสารหนังสือราชการ เพื่อเป็นแนวทางให้กับหน่วยงานต่างๆ สามารถนำไปปรับใช้ในระบบ Web-based ของตัวเองได้',
                'จึงเรียนมาเพื่อโปรดทราบ',
                'นายมานพ กองอุ่น',
                'นักเทคโนโลยีสารสนเทศแห่งประเทศไทย'
            ]);//อัดตัวแปรแบบชุด
        $templateProcessor->saveAs(Yii::getAlias('../modules/correspondence').'/msword/ms_word_result.docx');//สั่งให้บันทึกข้อมูลลงไฟล์ใหม่

        /*
        //ตัวอย่างการสร้างไฟล์ ms word แบบไม่มี template
        $PHPWord = new PHPWord();
        $PHPWord->setDefaultFontName('TH Sarabun New');
        $PHPWord->setDefaultFontSize(16);

        $section = $PHPWord->createSection();

        $section->addText('ทดสอบข้อความ');
        $section->addTextBreak(2);

        $objWriter = IOFactory::createWriter($PHPWord, 'Word2007');
        $objWriter->save(Yii::getAlias('@webroot').'/msword/ms_word_test.docx');

        $objReader = IOFactory::load(Yii::getAlias('@webroot').'/msword/ms_word_test.docx');
        */

        echo '<p>';

        echo Html::a('ดาวน์โหลดเอกสาร', Url::to(Yii::getAlias('@web').'/msword/ms_word_result.docx'));//สร้าง link download
        echo '</p>';
        //ลองให้ google doc viewer แสดงข้อมูลไฟล์ให้เห็นผ่าน iframe (อาจเพี้ยนๆ บ้าง)
        echo '<iframe src="'.Url::to(Yii::getAlias('@webword').'/msword/ms_word_result.docx', true).'"  style="position: absolute;width:100%; height: 100%;border: none;"></iframe>';
        $path = Yii::getAlias('../modules/correspondence').'/msword';

        $file = $path . '/ms_word_result.docx';
        //$this->Download($file);

    }
    public function Download($file){
        if (file_exists($file)) {
            Yii::$app->response->SendFile($file);
        }
    }
}