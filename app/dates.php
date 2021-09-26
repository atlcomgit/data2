<?php
//______________________________________________________________________________________________________________________________________________________________

namespace App;

define('NORMAL', false);
define('REVERSE', true);

class Dates
{
    static function monthName($num)
    {
        return App\Strings::caseStr($num, array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12), array('Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'));
    }
    static function monthNameRoditelniyPadezh($num)
    {
        return App\Strings\caseStr($num, array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12), array('Января', 'Февраля', 'Марта', 'Апреля', 'Мая', 'Июня', 'Июля', 'Августа', 'Сентября', 'Октября', 'Ноября', 'Декабря'));
    }

    static function dateformat($date = null, $id = null)
    {
        $result = date("d", $date);
        switch ((int) date('m', $date)) {
            case  1:
                $result .= ' января ';
                break;
            case  2:
                $result .= ' февраля ';
                break;
            case  3:
                $result .= ' марта ';
                break;
            case  4:
                $result .= ' апреля ';
                break;
            case  5:
                $result .= ' мая ';
                break;
            case  6:
                $result .= ' июня ';
                break;
            case  7:
                $result .= ' июля ';
                break;
            case  8:
                $result .= ' августа ';
                break;
            case  9:
                $result .= ' сентября ';
                break;
            case 10:
                $result .= ' октября ';
                break;
            case 11:
                $result .= ' ноября ';
                break;
            case 12:
                $result .= ' декабря ';
                break;
        }
        $result .= date("Y", $date);
        return $result;
    }

    //Переводит timestamp в дату в формате, указанном в параметре $dateformat
    //Если $dateformat опущен, то используется формат даты 'Y/m/d H:i:s'
    static function toDateTime($timestamp, $dateformat = null)
    {
        if ($dateformat == '') $dateformat = 'Y/m/d H:i:s';
        return date($dateformat, $timestamp);
    }

    //Переводит дату $datetime в timestamp
    //Принимает дату в стандартном виде 'Y/m/d HH:ii:ss'
    static function toTimeStamp($datetime)
    {
        $date_time_string = $datetime;
        $dt_elements = explode(' ', $date_time_string);
        $date_elements = explode('.', $dt_elements[0]);
        $time_elements =  explode(':', $dt_elements[1]);
        if ($date_elements[0] > 2030) $date_elements[0] = 2030;
        $timestamp = mktime($time_elements[0], $time_elements[1], $time_elements[2], $date_elements[1], $date_elements[2], $date_elements[0]);
        return $timestamp;
    }

    static function year4leap($getYear)
    {
        if ($getYear % 4 == 0 && (($getYear % 100 != 0) || ($getYear % 400 == 0))) $result = true;
        else $result = false;
        return $result;
    }

    static function date2days($getDay, $getMonth, $getYear)
    {

        $daysNorm = array(1 => 0, 2 => 31, 3 => 59, 4 => 90, 5 => 120, 6 => 151, 7 => 181, 8 => 212, 9 => 243, 10 => 273, 11 => 304, 12 => 334);
        $daysLeap = array(1 => 0, 2 => 31, 3 => 60, 4 => 91, 5 => 121, 6 => 152, 7 => 182, 8 => 213, 9 => 244, 10 => 274, 11 => 305, 12 => 335);
        $yearsNorm = array(0 => 0, 1 => 365, 2 => 730, 3 => 1095);
        $yearsLeap = array(0 => 0, 1 => 366, 2 => 731, 3 => 1096);
        $centArry = array(0 => 0, 1 => 36525, 2 => 73049, 3 => 109573);

        $quadDays = 0;
        $totalYears = $getYear - 1900;
        $megYears = floor($totalYears / 400);
        $totalYears = $totalYears - ($megYears * 400);
        $centYears = floor($totalYears / 100);
        $totalYears = $totalYears - ($centYears * 100);
        $quadYears = floor($totalYears / 4);
        $totalYears = $totalYears - ($quadYears * 4);

        switch ($centYears) {
            case 0:
                $quadDays = $quadYears * 1461;
                break;
            case 1:
            case 2:
            case 3:
                switch ($quadYears) {
                    case 1:
                        $quadDays = 1460;
                        break;
                    default:
                        $quadDays = ($quadYears * 1461) - 1;
                        break;
                }
                break;
        }
        switch ($centYears) {
            case 0:
                $yearDays = $yearsLeap[$totalYears];
                break;
            case 1:
            case 2:
            case 3:
                switch ($quadYears) {
                    case 0:
                        $yearDays = $yearsNorm[$totalYears];
                        break;
                    default:
                        $yearDays = $yearsLeap[$totalYears];
                        break;
                }
                break;
        }

        $subDays = ($megYears * 146097) + $centArry[$centYears] + $quadDays + $yearDays;
        if (self::year4leap($getYear)) $monthDays = $daysLeap[(int) $getMonth];
        else $monthDays = $daysNorm[(int) $getMonth];

        return $subDays + $monthDays + $getDay;
    }

    static function countDays($getMonth, $getYear)
    {
        $days = 0;
        if (($getYear <= 0) || ($getMonth < 1) || ($getMonth > 12)) return 0;

        switch ($getMonth) {
            case 1:
                $days = 31;
                break;
            case 2:
                if (self::year4leap($getYear) == true) $days = 29;
                else $days = 28;
                break;
            case 3:
                $days = 31;
                break;
            case 4:
                $days = 30;
                break;
            case 5:
                $days = 31;
                break;
            case 6:
                $days = 30;
                break;
            case 7:
                $days = 31;
                break;
            case 8:
                $days = 31;
                break;
            case 9:
                $days = 30;
                break;
            case 10:
                $days = 31;
                break;
            case 11:
                $days = 30;
                break;
            case 12:
                $days = 31;
                break;
        }

        return $days;
    }

    static function dayOfweek($getDate)
    {
        $getDate = self::date2reverse($getDate, REVERSE);
        $spl = explode('.', $getDate);
        $yy = $spl[0];
        $mm = $spl[1];
        $dd = $spl[2];
        //$result = ((self::date2days($dd,$mm,$yy) + 4) % 7) + 1;
        $result = date('w', mktime(0, 0, 0, $mm, $dd, $yy));
        if ($result == 0) $result = 7;
        return $result;
    }
    static function date2week($getDate)
    {
        return date('W', strtotime(self::date2reverse($getDate, NORMAL)));
    }
    static function daysOfmonth($getDate)
    {
        return date('t', strtotime(self::date2reverse($getDate, NORMAL)));
    }
    static function dayHoliday($getDate)
    {
        return (in_array(substr(self::date2reverse($getDate, NORMAL), 0, 5), ['01.01', '02.01', '03.01', '04.01', '05.01', '23.02', '08.03', '01.05', '02.05', '09.05', '10.05', '31.12']));
    }

    static function hourNow()
    {
        return date('H');
    }
    static function timeNow($gmt = 0)
    {
        if ($gmt > 0) $gmt = '+' . $gmt . ' hours';
        if ($gmt < 0) $gmt = $gmt . ' hours';
        if ($gmt == 0) $gmt = '';
        return date('H:i:s', strtotime(date('d.m.Y H:i:s') . $gmt));
    }
    static function today($reverse = REVERSE)
    {
        return self::date2reverse(date('d.m.Y'), $reverse);
    }
    static function yesterday($reverse = REVERSE)
    {
        return self::inc2date(self::today(), '-1 day', $reverse);
    }
    static function tomorrow($reverse = REVERSE)
    {
        return self::inc2date(self::today(), '+1 day', $reverse);
    }
    static function now($reverse = REVERSE)
    {
        return self::date2reverse(date('d.m.Y H:i:s'), $reverse);
    }
    static function date2reverse($date, $reverse = REVERSE)
    {
        if (trim($date) == '') return '';
        $dts = explode(' ', $date);
        if (count($dts) > 1) {
            $tmask = ' H:i:s';
            $dts[1] = ' ' . $dts[1];
        } else {
            $tmask = '';
            $dts[1] = '';
        }
        if ($reverse) $dmask = 'Y.m.d';
        else $dmask = 'd.m.Y';
        $mds = explode('.', $dts[0]);
        if (preg_match('/[0-9]{4}.[0-9]{2}.[0-9]{2}/', $dts[0])) {
            $ss = $mds[0];
            $mds[0] = $mds[2] ?? '';
            $mds[2] = $ss;
        }
        if ($mds[2] >= 2038) $mds[2] = '2037';

        return date($dmask . $tmask, strtotime($mds[0] . '.' . $mds[1] . '.' . $mds[2] . $dts[1]));
    }
    static function date2normal($date)
    {
        return self::date2reverse($date, NORMAL);
    }
    static function inc2date($date, $inc, $reverse = REVERSE)
    {
        if (trim($date) == '') return '';
        $dts = explode(' ', $date);
        if (count($dts) > 1) $tmask = ' H:i:s';
        else $tmask = '';
        if ($reverse) $dmask = 'Y.m.d';
        else $dmask = 'd.m.Y';
        return date($dmask . $tmask, strtotime(trim(self::date2reverse($date, NORMAL) . ' ' . $inc)));
    }
    static function inc2time($time, $inc)
    {
        if (trim($time) == '') return '';
        return date('H:i:s', strtotime(trim($time . ' ' . $inc)));
    }
    static function gmt2date($date, $gmt, $reverse = REVERSE)
    {
        if (trim($date) == '') return '';
        $dts = explode(' ', $date);
        if (count($dts) > 1) $tmask = ' H:i:s';
        else $tmask = '';
        if ($reverse) $dmask = 'Y.m.d';
        else $dmask = 'd.m.Y';
        if ($gmt > 0) $gmt = '+' . $gmt . ' hours';
        if ($gmt < 0) $gmt = $gmt . ' hours';
        if ($gmt == 0) $gmt = '';
        return date($dmask . $tmask, strtotime(trim(self::date2reverse($date, NORMAL) . ' ' . $gmt)));
    }
    static function date2interval($firstDate, $date, $lastDate, $include = true)
    {
        if (trim($firstDate) == '' || trim($date) == '' || trim($lastDate) == '') return false;
        $firstDate = self::date2reverse($firstDate, REVERSE);
        $date = self::date2reverse($date, REVERSE);
        $lastDate = self::date2reverse($lastDate, REVERSE);
        return (($include && $date >= $firstDate && $date <= $lastDate) || (!$include && $date > $firstDate && $date < $lastDate));
    }
    static function date2monthName($date)
    {
        if (trim($date) == '') return '';
        $date = explode('.', self::date2reverse($date, NORMAL));
        switch ((int) $date[1]) {
            case  1:
                $date[1] = 'Января';
                break;
            case  2:
                $date[1] = 'Февраля';
                break;
            case  3:
                $date[1] = 'Марта';
                break;
            case  4:
                $date[1] = 'Апреля';
                break;
            case  5:
                $date[1] = 'Мая';
                break;
            case  6:
                $date[1] = 'Июня';
                break;
            case  7:
                $date[1] = 'Июля';
                break;
            case  8:
                $date[1] = 'Августа';
                break;
            case  9:
                $date[1] = 'Сентября';
                break;
            case 10:
                $date[1] = 'Октября';
                break;
            case 11:
                $date[1] = 'Ноября';
                break;
            case 12:
                $date[1] = 'Декабря';
                break;
        }
        return $date[0] . ' ' . $date[1] . ' ' . $date[2];
    }
    static function getDateFromStr($date, $reverse = REVERSE)
    {
        if (trim($date) == '') return '';
        $dts = explode(' ', $date);
        if (count($dts) > 1) $tmask = ' H:i:s';
        else $tmask = '';
        if ($reverse) $dmask = 'Y.m.d';
        else $dmask = 'd.m.Y';
        return date($dmask/*.$tmask*/, strtotime(self::date2reverse($date, NORMAL)));
    }
    static function getTimeFromStr($date)
    {
        if (trim($date) == '') return '';
        return date('H:i:s', strtotime(self::date2reverse($date, NORMAL)));
    }
    static function replaceDateConsts($str, $datetime, $gmt = 0)
    {
        $datetime = self::gmt2date($datetime, $gmt, NORMAL);
        $dts = explode(' ', $datetime);
        $date = $dts[0];
        if (count($dts) > 1) $time = $dts[1];
        else $time = '';
        return str_ireplace(
            array('[$DBDATER$]', '[$DBDATE$]', '[$DBTIME$]'),
            array(self::date2reverse($date, REVERSE), self::date2reverse($date, NORMAL), $time),
            $str
        );
    }
    static function differDates2days($date1, $date2)
    {
        $date1 = self::date2reverse($date1, REVERSE);
        $date2 = self::date2reverse($date2, REVERSE);
        $spl1 = explode('.', $date1);
        $yy1 = $spl1[0];
        $mm1 = $spl1[1];
        $dd1 = $spl1[2];
        $spl2 = explode('.', $date2);
        $yy2 = $spl2[0];
        $mm2 = $spl2[1];
        $dd2 = $spl2[2];
        $result = self::date2days($dd2, $mm2, $yy2) - self::date2days($dd1, $mm1, $yy1);
        return $result;
    }

    static function differDates2months($date1, $date2)
    {
        $date1 = self::date2reverse($date1, REVERSE);
        $date2 = self::date2reverse($date2, REVERSE);
        if ($date1 > $date2) App\Strings\swapStr($date1, $date2);
        $spl1 = explode('.', $date1);
        $yy1 = $spl1[0];
        $mm1 = $spl1[1];
        $dd1 = $spl1[2];
        $spl2 = explode('.', $date2);
        $yy2 = $spl2[0];
        $mm2 = $spl2[1];
        $dd2 = $spl2[2];
        $result = (12 * ($yy2 - $yy1) + ($mm2 - $mm1)) + (($dd2 < $dd1) ? -1 : 0);
        return $result;
    }

    static function differDateTime2secs($datetime1, $datetime2)
    {
        $timer1 = strtotime(self::date2reverse($datetime1, NORMAL));
        $timer2 = strtotime(self::date2reverse($datetime2, NORMAL));
        $result = abs($timer2 - $timer1);
        return $result;
    }
    static function secs2timeArray($seconds)
    {
        $_result = array();
        $count_zero = false;
        $periods = [60, 3600, 86400, 31536000];

        for ($i = 3; $i >= 0; $i--) {
            $period = floor($seconds / $periods[$i]);
            if (($period > 0) || ($period == 0 && $count_zero)) {
                $_result[$i + 1] = $period;
                $seconds -= $period * $periods[$i];
                $count_zero = true;
            }
        }
        $_result[0] = $seconds;
        return $_result;
    }
    static function secs2str($seconds, $zero_add = true, $time_names = [' сек', ' мин', ' час', ' дн', ' лет'])
    {
        $result = '';
        $_timerArray = self::secs2timeArray($seconds);
        for ($i = count($_timerArray) - 1; $i >= 0; $i--) if (($zero_add && $i > 0) || $_timerArray[$i] > 0) $result .= $_timerArray[$i] . $time_names[$i] . " ";
        $result = str_replace(["0$time_names[1] 0$time_names[0]", "0$time_names[2] 0$time_names[1]", "0$time_names[3] 0$time_names[2]"], ["", "", ""], $result);
        return trim($result);
    }

    static function explodeDateTime($datetime, &$date, &$time, $reverse = REVERSE)
    {
        $date = '';
        $time = '';
        if (trim($datetime) == '') return '';
        $dts = explode(' ', $datetime);
        $date = self::date2reverse($dts[0], $reverse);
        if (count($dts) > 1) $time = $dts[1];
    }

    static function time2microsecs($date = "", $time = "")
    {
        if ($date == "") $date = date('Y.m.d');
        if ($time == "") $time = date('H:i:s');

        $date = explode('.', self::date2reverse($date, NORMAL));
        $days = self::date2days($date[0], $date[1], $date[2]);
        $time = explode(':', $time);
        return ($days * 86400 + $time[0] * 3600 + $time[1] * 60 + $time[2]) . substr(microtime(false), 1, 4);
    }
    static function time2secs($time = "")
    {
        if ($time == "") $time = date('H:i:s');
        $time = explode(':', $time);
        return floor($time[0] * 3600 + $time[1] * 60 + $time[2]);
    }

    static function time2check($time1, $time2, $time = "")
    {
        if ($time == "") $time = date('H:i:s');
        return ($time  >= $time1  && $time <= $time2) ? true : false;
    }

    static function day2name($date = '', $short = false)
    {
        if ($date == '') $date = date('d.m.Y');
        else $date = self::date2reverse($date, NORMAL);
        if ($short) $names = ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'];
        else $names = ['Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота', 'Воскресенье'];
        return App\Strings\caseStr(self::dayOfweek($date), array(1, 2, 3, 4, 5, 6, 7), $names);
    }
    static function date2name($date = '')
    {
        $result = "";
        if ($date == '') $date = date('d.m.Y');
        else $date = self::date2reverse($date, NORMAL);
        $result .= App\Strings\caseStr(self::dayOfweek($date), array(1, 2, 3, 4, 5, 6, 7), ['Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота', 'Воскресенье']) . ", ";
        $date = explode('.', $date);
        $result .= ((int) $date[0]) . "-ое " . self::monthNameRoditelniyPadezh((int) $date[1]);
        return $result;
    }
    static function dateIsHoliday($date = '')
    {
        if ($date == '') $date = date('d.m.Y');
        else $date = self::date2reverse($date, NORMAL);
        $date2 = substr($date, 0, 5);
        $result = false;
        if (in_array($date2, ['01.01', '02.01', '03.01', '04.01', '05.01', '06.01', '07.01', '08.01', '23.02', '08.03', '01.05', '09.05'])) $result = true;
        return $result;
    }

    //______________________________________________________________________________________________________________________________________________________________
}