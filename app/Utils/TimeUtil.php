<?php
namespace App\Utils;

class TimeUtil
{
    public static function getFormatTime($time, $format = "Y-m-d H:i:s", $empty_str = '--')
    {
        if (empty($time)) {
            return $empty_str;
        }
        return date($format, strtotime($time));
    }

    public static function getUsedTimeWithSecond($start_at, $end_at, $empty_str = '--')
    {
        if (empty($start_at) && empty($end_at)) {
            return $empty_str;
        }

        if ($start_at && $end_at) {
            return strtotime($end_at) - strtotime($start_at);
        } else {
            return time() - strtotime($start_at);
        }
    }

    public static function getDateTime($format = "Y-m-d H:i:s")
    {
        return date($format, time());
    }

    /*时间格式化
    * param int $time 以秒为单位的时间
    * return string 格式化后的时间
    * */
    public static function timeformat($time, $type = 1)
    {
        if (is_numeric($time)) {
            $value = array(
                "years" => 0, "days" => 0, "hours" => 0,
                "minutes" => 0, "seconds" => 0,
            );
            if ($time >= 31556926) {
                $value["years"] = floor($time / 31556926);
                $time = ($time % 31556926);
            }
            if ($time >= 86400) {
                $value["days"] = floor($time / 86400);
                $time = ($time % 86400);
            }
            if ($time >= 3600) {
                $value["hours"] = floor($time / 3600);
                $time = ($time % 3600);
            }
            if ($time >= 60) {
                $value["minutes"] = floor($time / 60);
                $time = ($time % 60);
            }
            $value["seconds"] = floor($time);


            $mapping = [
                'years' => '年',
                'days' => '天',
                'hours' => '小时',
                'minutes' => '分钟',
//            'seconds'=>'秒',
            ];

            if ($type == 2) {
                $mapping['seconds'] = '秒';
            }

            $t = '';
            foreach ($mapping as $k => $v) {
                if ($value[$k]) {
                    $t .= $value[$k] . $v;
                }
            }

            return $t;

        } else {
            return (bool)FALSE;
        }
    }

}
