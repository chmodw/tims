<?php


namespace App;


class Helpers
{
    /**
     * Generate unique id from the given data
     * @param array $params
     * @return string
     */
    public static function u_id(Array $params){
        array_push($params, date("M,d,Y h:i:s A"), rand(1,9999999));
        $str = implode($params);
        $str = str_replace(",","",$str);
        $str = str_replace(":","",$str);
        $str = str_replace(" ","",$str);

        return md5($str);
    }

    /**
     * @param $date
     * @param $time
     * @return false|string
     */
    public static function joint_date_time($date, $time)
    {
        $timestamp = strtotime($date . " " . $time);

        return date("Y-m-d H:i:s", $timestamp);
    }

    public static function array_un_setter(Array $array, Array $params)
    {
        foreach ($params as $param) {
            if (array_key_exists($param, $array)) {
                unset($array[$param]);
            }
        }
        return $array;
    }
}