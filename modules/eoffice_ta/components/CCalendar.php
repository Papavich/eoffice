<?php
/**
 * Created by PhpStorm.
 * User: pink
 * Date: 1/2/2561
 * Time: 19:42
 */
namespace app\modules\eoffice_ta\components;
use yii\base\Component;
use app\modules\eoffice_ta\models\TaSchedule;

class CCalendar extends Component
{

    public function setCalendar()
    {
        $find = TaSchedule::find()->where('YEAR(time_start)<=:yearSelect',
            [':yearSelect'=>$this->getYearNow()])->andWhere('MONTH(time_start)<=:monthSelect',
            [':monthSelect'=>$this->getMonthNow()])->andWhere('DAY(time_start)<:daySelect',
            [':daySelect'=>$this->getDayNow()])->andWhere(['active_status'=>'1'])->all();
        if(!empty($find)){
            foreach ($find as $record){
                $model = TaSchedule::findOne($record->ta_schedule_id);
                $model->active_status = '2';
                $model->update();
                unset($model);
            }
        }
    }
    public function setCalendar2()
    {
        $find = TaSchedule::find()->where('YEAR(time_end)<=:yearSelect',
            [':yearSelect'=>$this->getYearNow()])->andWhere('MONTH(time_end)<=:monthSelect',
            [':monthSelect'=>$this->getMonthNow()])->andWhere('DAY(time_end)<:daySelect',
            [':daySelect'=>$this->getDayNow()])->andWhere(['active_status'=>'1'])->all();
        if(!empty($find)){
            foreach ($find as $record){
                $model = TaSchedule::findOne($record->ta_schedule_id);
                $model->active_status = '2';
                $model->update();
                unset($model);
            }
        }
    }
    public function getYear($year = null)
    {
        $years = [
            2006 => ['en'=>2006,'th'=>2549,'days'=>365],
            2007 => ['en'=>2007,'th'=>2550,'days'=>365],
            2008 => ['en'=>2008,'th'=>2551,'days'=>365],
            2009 => ['en'=>2009,'th'=>2552,'days'=>365],
            2010 => ['en'=>2010,'th'=>2553,'days'=>365],
            2011 => ['en'=>2011,'th'=>2554,'days'=>365],
            2012 => ['en'=>2012,'th'=>2555,'days'=>365],
            2013 => ['en'=>2013,'th'=>2556,'days'=>365],
            2014 => ['en'=>2014,'th'=>2557,'days'=>365],
            2015 => ['en'=>2015,'th'=>2558,'days'=>365],
            2016 => ['en'=>2016,'th'=>2559,'days'=>365],
            2017 => ['en'=>2017,'th'=>2560,'days'=>365],
            2018 => ['en'=>2018,'th'=>2561,'days'=>365],
            2019 => ['en'=>2019,'th'=>2562,'days'=>365],
            2020 => ['en'=>2020,'th'=>2563,'days'=>365],
            2021 => ['en'=>2021,'th'=>2564,'days'=>365],
            2022 => ['en'=>2022,'th'=>2565,'days'=>365],
            2023 => ['en'=>2023,'th'=>2566,'days'=>365],
            2024 => ['en'=>2024,'th'=>2567,'days'=>365],
            2025 => ['en'=>2025,'th'=>2568,'days'=>365],
            2026 => ['en'=>2026,'th'=>2569,'days'=>365],
            2027 => ['en'=>2027,'th'=>2570,'days'=>365],
            2028 => ['en'=>2028,'th'=>2571,'days'=>365],
            2029 => ['en'=>2029,'th'=>2572,'days'=>365],
            2030 => ['en'=>2030,'th'=>2573,'days'=>365],
            2031 => ['en'=>2031,'th'=>2574,'days'=>365],
            2032 => ['en'=>2032,'th'=>2575,'days'=>365],
            2033 => ['en'=>2033,'th'=>2576,'days'=>365],

        ];
        return (!empty($year)) ? $years[$year] : $year;
    }
    public function getMonth($month = null)
    {
        $months = [
            1 =>['th'=>'มกราคม','en'=>'January','days'=>31],
            2 =>['th'=>'กุมภาพันธ์','en'=>'February','days'=>28],
            3 =>['th'=>'มีนาคม','en'=>'March','days'=>31],
            4 =>['th'=>'เมษายน','en'=>'April','days'=>30],
            5 =>['th'=>'พฤษภาคม','en'=>'May','days'=>31],
            6 =>['th'=>'มิถุนายน','en'=>'June','days'=>30],
            7 =>['th'=>'กรกฎาคม','en'=>'July','days'=>31],
            8 =>['th'=>'สิงหาคม','en'=>'August','days'=>31],
            9 =>['th'=>'กันยายน','en'=>'September','days'=>30],
            10 =>['th'=>'ตุลาคม','en'=>'October','days'=>31],
            11 =>['th'=>'พฤศจิกายน','en'=>'November','days'=>30],
            12 =>['th'=>'ธันวาคม','en'=>'December','days'=>31],
        ];
        return (!empty($month)) ? $months[$month] : $months;
    }
    public function getDay($dayCount = 0)
    {
        if(!empty($dayCount)){
            $days = array();
            for($i=1;$i<=$dayCount;$i++){
                $days[$i] = $i;
            }
            return $days;
        }else{
            return false;
        }
    }
    public function getYearNow()
    {
        return date("Y",time());
    }
    public function getMonthNow()
    {
        return intval(date("m",time()));
    }
    public function getDayNow()
    {
        return date("d",time());
    }
    public function setCalendarSelect($result,$year = NULL,$month = NULL)
    {
        if (!empty($year) && !empty($month)) {
            $find = TaSchedule::find()->where('YEAR(time_start)=:yearSelect', [':yearSelect' => $year])
                ->andWhere('MONTH(time_start)=:monthSelect', [':monthSelect' => $month])->all();
            if (!empty($find)) {
                foreach ($find as $record) {
                    $daySelect = explode('-', $record->time_start);
                    if (!empty($result[$month]['days'][$daySelect[2]])) {
                        $result[$month]['days'][$daySelect[2]] = (object)[
                            'id' => $record->ta_schedule_id,
                            'message' => $record->ta_schedule_title,
                            'date' => $record->time_start,
                            'day'=> $daySelect[2],
                            'status'=> $record->active_status
                        ];
                    } else if (!empty($result[$daySelect[2]])) {
                        $result[$daySelect[2]] = (object)[
                            'id' => $record->ta_schedule_id,
                            'message' => $record->ta_schedule_title,
                            'date' => $record->time_start,
                            'day'=> $daySelect[2],
                            'status'=> $record->active_status
                        ];
                    }
                }
            }
        }
        return $result;
    }
    public function setCalendarSelect2($result,$year = NULL,$month = NULL)
    {
        if (!empty($year) && !empty($month)) {
            $find = TaSchedule::find()->where('YEAR(time_end)=:yearSelect', [':yearSelect' => $year])
                ->andWhere('MONTH(time_end)=:monthSelect', [':monthSelect' => $month])->all();
            if (!empty($find)) {
                foreach ($find as $record) {
                    $daySelect = explode('-', $record->time_end);
                    if (!empty($result[$month]['days'][$daySelect[2]])) {
                        $result[$month]['days'][$daySelect[2]] = (object)[
                            'id' => $record->ta_schedule_id,
                            'message' => $record->ta_schedule_title,
                            'date' => $record->time_start,
                            'day'=> $daySelect[2],
                            'status'=> $record->active_status
                        ];
                    } else if (!empty($result[$daySelect[2]])) {
                        $result[$daySelect[2]] = (object)[
                            'id' => $record->ta_schedule_id,
                            'message' => $record->ta_schedule_title,
                            'date' => $record->time_start,
                            'day'=> $daySelect[2],
                            'status'=> $record->active_status
                        ];
                    }
                }
            }
        }
        return $result;
    }
    public function getCalendar($year = null,$month = null)
    {
        $result = array();
        if(empty($year) && empty($month)){
            $arrYear = $this->getYear($this->getYearNow());
            foreach ($this->getMonth() as $month => $value){
                $result[$month] = ['th'=>$value['th'],'en'=>$value['en'],
                    'days'=>$this->getDay($value['days'])];
            }
            $result[2]['days'] = ($arrYear['days'] == 365) ? $this->getDay(28) :$this->getDay(29);
            return $this->setCalendarSelect($result,$this->getYearNow(),$this->getMonthNow());
        } else {
            if(!empty($year) && empty($month)){
                $arrYear = $this->getYear($year);
                foreach ($this->getMonth() as $month =>$value){
                    $result[$month]=['th'=>$value['th'],'en'=>$value['en'],'days'=>$value['days']];
                }
                $result[2]['days'] = ($arrYear['days']==365) ? 28:29;
                return $this->setCalendarSelect($result,$year,$this->getMonthNow());
            } else {
                $arrYear = $this->getYear($year);
                $arrMonth = $this->getMonth($month);
                $arrMonth['days'] = ($month ==2)?
                    (($arrYear['days']==365)?28:29): $arrMonth['days'];
                foreach ($this->getDay($arrMonth['days']) as $value){
                    $result[$value] = $value;
                }
                return $this->setCalendarSelect($result,$year,$month);
            }
        }

    }

}