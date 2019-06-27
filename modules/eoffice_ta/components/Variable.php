<?php
/**
 * Created by PhpStorm.
 * User: pink
 * Date: 30/4/2561
 * Time: 12:53
 */

namespace app\modules\eoffice_ta\components;


interface Variable
{

    const WLoad = 'WLoad';
    const HCb   = 'HCb';
    const HLb   = 'HLb';
    //const C     = 'C';
    const CLec  = 'CLec';
    const CLab  = 'CLab';
    const NRS   = 'NRS';
    const NGSc  = 'NGSc';
    const NGSl  = 'NGSl';
    //const P     = 'P';
    const RB    = 'RB';
    const RG    = 'RG';
    const BP    = 'BP';
    const GP    = 'GP';
    const PHrn  = 'PHrn';
    const PHrs  = 'PHrs';
    const BN    = 'BN';
    const Hweek = 'Hweek';
    const Nsec  = 'Nsec';
    const HC    = 'HC';
    const HL    = 'HL';
    const hrD   = 'hrD';
   /* const SYMBOL     = [
                        Variable::X,Variable::A, Variable::B,Variable::WLoad, Variable::HCb,Variable::HLb,
                        Variable::C,Variable::CLec, Variable::NRS,Variable::NGSc, Variable::NGSl,Variable::P,
                        Variable::RB,Variable::RG, Variable::BP,Variable::GP, Variable::PHrn,Variable::PHrs,
                        Variable::BN,Variable::Hweek, Variable::Nsec,Variable::hrD,Variable::CLab ,Variable::b
                    ];*/
/*1*/    const a     = 'a';//จำนวนรหัสวิชาที่สามารถเป็นผู้ช่วยสอนได้ในแต่ละเทอม
/*2*/    const A     = 'A'; //ชั่วโมงเรียนบรรยาย
/*3*/    const b     = 'b';//ค่าตอบแทนต่อภาระงานต่อเดือน ของผู้ช่วยสอนระดับปริญญาตรี
/*4*/    const B     = 'B'; //ชั่วโมงเรียนปฏิบัติการ
/*5*/    const c     = 'c'; //จำนวนนักศึกษาต่อกลุ่มเรียนบรรยาย
/*6*/    const C     = 'C';//หน่วยกิตบรรยาย
/*7*/    const d     = 'd'; //ค่าตอบแทน ป.ตรี (ภาคปกติ) (กรณีรายวิชานั้นมีผู้ช่วยสอนเป็น ป.ตรีทั้งหมด)
/*8*/    const D     = 'D'; //ชั่วโมงสอนสูงสุดต่อวันของผู้ช่วยสอน (ไม่เกินนี้)
/*9*/    const e     = 'e'; //ค่าตอบแทน ป.ตรี (โครงการพิเศษ) (กรณีรายวิชานั้นมีผู้ช่วยสอนเป็น ป.ตรีทั้งหมด)
/*10*/   const E     = 'E'; //เบิกจ่าย (โครงการพิเศษ) TA ป.โท ไม่เกิน 4000 บาท/เดือน
/*11*/   //const f     = 'f';
/*12*/   //const F     = 'F';
/*13*/   const g     = 'g'; //จำนวน Section ที่สอน
/*14*/   const G     = 'G'; //เบิกจ่าย (ภาคปกติ) TA ป.โท ไม่เกิน400บาท/เดือน
/*15*/   const h     = 'h'; //	จำนวนชั่วโมงปฏิบัติงานทั้งหมด ต่อเทอม(ภาคปกติ)
/*16*/   const H     = 'H'; //	ชั่วโมงทำการในการสอนแบบบรรยายในหนึ่งหน่วยกิต (ระดับปริญญาตรี) 3.00
/*17*/   const i     = 'i'; //  ค่าตอบแทนของผู้ช่วยสอนระดับปริญญาตรีต่อคน
/*18*/   //const I     = 'I';
/*19*/   const j     = 'j'; //จำนวนวิชาที่เป็นผู้ช่วยสอน (ภาคปกติ)
/*20*/   const J     = 'J'; //ค่าตอบแทนผู้ช่วยสอนบัณฑิต (ภาคปกติ)
/*21*/   const k     = 'k'; //จำนวนวิชาที่เป็นผู้ช่วยสอน (โครงการพิเศษ)
/*22*/   const K     = 'K'; //ค่าตอบแทนผู้ช่วยสอนบัณฑิต (โครงการพิเศษ)
/*23*/   const l     = 'l'; // หน่วยกิตปฏิบัติการ
/*24*/   const L     = 'L'; //	จำนวนนักศึกษาต่อกลุ่มเรียนปฏิบัติการ
/*25*/   const m     = 'm'; //	ชั่วโมงศึกษาด้วยตัวเอง
/*26*/   //const M     = 'M';
/*27*/   const n     = 'n'; // อัตราค่าตอบแทนต่อชัวโมง ของปริญญาตรีที่สอนภาคปกติ
/*28*/   const N     = 'N'; // จำนวนนักศึกษาที่ลงทะเบียน
/*29*/   //const o     = 'o';
/*30*/   //const O     = 'O';
/*31*/   //const p     = 'p';
/*32*/   const P     = 'P'; // กรอบค่าตอบแทนของผู้ช่วยสอนต่อเดือน คิดจากภาระงานรวม
/*33*/   //const q     = 'q';
/*34*/   //const Q     = 'Q';
/*35*/    const r     = 'r'; // จำนวนชั่วโมงปฏิบัติงานทั้งหมด ต่อเทอม(โครงการพิเศษ)
/*36*/    const R     = 'R'; // สัดส่วนผู้ช่วยสอนของบัณฑิตศึกษา
/*37*/    const s     = 's'; //อัตราค่าตอบแทนต่อชัวโมง ของปริญญาตรีที่สอนโครงการพิเศษ
/*38*/    //const S     = 'S';
/*39*/    //const t     = 't'; //
/*40*/    const T     = 'T'; // สัดส่วนผู้ช่วยสอนของปริญญาตรี
/*41*/    const u     = 'u'; // 	ชั่วโมงหน่วยกิตของปฏิบัติการ
/*42*/    const U     = 'U'; // 	ชั่วโมงหน่วยกิตของบรรยาย
/*43*/    //const v     = 'v';
/*44*/    const V     = 'V'; //	ชั่วโมงทำการสอนแบบปฏิบัติการในหนึ่งหน่วยกิต (ระดับปริญญาตรี)  4.5
/*45*/    const w     = 'w'; // 	ชั่วโมงต่อสัปดาห์
/*46*/    const W     = 'W'; // ภาระงานสอนตามรายวิชา
/*47*/    const x     = 'x'; //เบิกจ่าย (ภาคปกติ) TA ป.โท ไม่เกิน 3000 บาท/เดือน
/*48*/    const X     = 'X'; //หน่วยกิตรวมของรายวิชา
/*49*/    const y     = 'y'; //คำตอบภาระงาน บรรยาย LEC
/*50*/    const z     = 'z'; //คำตอบภาระงาน LAB
/*51*/    const Y     = 'Y'; //กรอบเงิน ภาระงาน บรรยาย LEC
/*52*/    const Z     = 'Z'; //กรอบเงิน ภาระงาน LAB
}