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

    public static function strings_to_arrays($string, $by){

        $arr = rtrim($string,',');
        $arr = rtrim($arr,'=');
        //remove before and after comma white spaces
        $arr = preg_replace('/\s*'.$by.'\s*/', ',', $arr);
        //split the string into arrays by ENTER
        $arr = explode(PHP_EOL, $arr);
        //split array of string into array values
        foreach ($arr as $key => $val){
            $arr[$key]= explode($by, $val);
        }

        return $arr;
    }

    public static function is_serialized( $data, $strict = true ) {
        // if it isn't a string, it isn't serialized.
        if ( ! is_string( $data ) ) {
            return false;
        }
        $data = trim( $data );
        if ( 'N;' == $data ) {
            return true;
        }
        if ( strlen( $data ) < 4 ) {
            return false;
        }
        if ( ':' !== $data[1] ) {
            return false;
        }
        if ( $strict ) {
            $lastc = substr( $data, -1 );
            if ( ';' !== $lastc && '}' !== $lastc ) {
                return false;
            }
        } else {
            $semicolon = strpos( $data, ';' );
            $brace     = strpos( $data, '}' );
            // Either ; or } must exist.
            if ( false === $semicolon && false === $brace ) {
                return false;
            }
            // But neither must be in the first X characters.
            if ( false !== $semicolon && $semicolon < 3 ) {
                return false;
            }
            if ( false !== $brace && $brace < 4 ) {
                return false;
            }
        }
        $token = $data[0];
        switch ( $token ) {
            case 's':
                if ( $strict ) {
                    if ( '"' !== substr( $data, -2, 1 ) ) {
                        return false;
                    }
                } elseif ( false === strpos( $data, '"' ) ) {
                    return false;
                }
            // or else fall through
            case 'a':
            case 'O':
                return (bool) preg_match( "/^{$token}:[0-9]+:/s", $data );
            case 'b':
            case 'i':
            case 'd':
                $end = $strict ? '$' : '';
                return (bool) preg_match( "/^{$token}:[0-9.E-]+;$end/", $data );
        }
        return false;
    }

    /**
     * Converts array of variables to camel case
     * and add Get keywork at the first
     *
     * @param array $list
     */
    public static function var_array(Array $list)
    {
        $rList = array();

        foreach ($list as $item){

            if (preg_match('/_/', $item)) {

                $str_arr = preg_split ("/\_/", $item);

                $str_arr = array_map('ucfirst', $str_arr);

                $rList[$item] = 'get'.implode($str_arr);

            }else{

                $rList[$item] = 'get'.ucfirst($item);

            }

        }

        return $rList;

    }
}