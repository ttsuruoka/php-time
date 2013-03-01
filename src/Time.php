<?php
/**
 * 単純な時間を扱うためのクラス
 *
 * @package Time
 * @author  Tatsuya Tsuruoka <ttsuruoka@php.net>
 * @url     https://github.com/ttsuruoka/php-time
 */

// 時間に関する定数
define('TIME_MIN', 60);
define('TIME_HOUR', 3600);
define('TIME_DAY', 86400);
define('TIME_WEEK', 60 * 60 * 24 * 7);

class Time
{
    protected static $time = null;

    public static function set($time)
    {
        self::$time = $time;
    }

    public static function unix()
    {
        return self::$time;
    }

    public static function now()
    {
        return date('Y-m-d H:i:s', self::$time);
    }

    // 現在時間が与えられた時間より前かどうか
    public static function before($a)
    {
        if (is_null($a)) {
            return false;
        }
        $a = is_int($a) ? $a : strtotime($a);
        return self::$time < $a;
    }

    // 現在時間が与えられた時間より後かどうか
    public static function after($a)
    {
        if (is_null($a)) {
            return false;
        }
        $a = is_int($a) ? $a : strtotime($a);
        return self::$time > $a;
    }

    /**
     * 現在時間が与えられた時間以前かどうか
     *
     * null が与えられたときは、false を返します。
     *
     * @return boolean 現在時間が与えられた時間以前のとき true、それ以外のとき false
     */
    public static function beforeEq($a)
    {
        return is_null($a) ? false : !self::after($a);
    }

    public static function afterEq($a)
    {
        return is_null($a) ? false : !self::before($a);
    }

    public static function between($a, $b = null)
    {
        if (is_array($a) && is_null($b)) {
            list($a, $b) = $a;
        }
        return self::afterEq($a) && self::beforeEq($b);
    }
}
