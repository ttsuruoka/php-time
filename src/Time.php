<?php
/**
 * 単純な時間を扱うためのクラス
 *
 * @package Time
 * @author  Tatsuya Tsuruoka <ttsuruoka@php.net>
 * @url     https://github.com/ttsuruoka/php-time
 */

// 時間に関する定数 (deprecated)
define('TIME_MIN', 60);
define('TIME_HOUR', 3600);
define('TIME_DAY', 86400);
define('TIME_WEEK', 60 * 60 * 24 * 7);

class Time
{
    protected static $time = null;

    const MIN = 60;
    const HOUR = 3600;
    const DAY = 86400;
    const WEEK = 604800; // 60 * 60 * 24 * 7

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

    /**
     * 現在時間が与えられた時間より前かどうか
     *
     * 引数としてnull が与えられたときは、false を返します。
     *
     * @param $a unixtimeを表す整数、または日付として解釈可能な文字列
     * @return boolean 現在時間が与えられた時間より前のとき true、それ以外のとき false
     */
    public static function before($a)
    {
        if (is_null($a)) {
            return false;
        }
        $a = is_int($a) ? $a : strtotime($a, self::$time);
        return self::$time < $a;
    }

    /**
     * 現在時間が与えられた時間より後かどうか
     *
     * 引数としてnull が与えられたときは、false を返します。
     *
     * @param $a unixtimeを表す整数、または日付として解釈可能な文字列
     * @return boolean 現在時間が与えられた時間より後のとき true、それ以外のとき false
     */
    public static function after($a)
    {
        if (is_null($a)) {
            return false;
        }
        $a = is_int($a) ? $a : strtotime($a, self::$time);
        return self::$time > $a;
    }

    /**
     * 現在時間が与えられた時間以前かどうか
     *
     * null が与えられたときは、false を返します。
     *
     * @param $a unixtimeを表す整数、または日付として解釈可能な文字列
     * @return boolean 現在時間が与えられた時間以前のとき true、それ以外のとき false
     */
    public static function beforeEq($a)
    {
        return is_null($a) ? false : !self::after($a);
    }

    /**
     * 現在時間が与えられた時間より以後かどうか
     *
     * 引数としてnull が与えられたときは、false を返します。
     *
     * @param $a unixtimeを表す整数、または日付として解釈可能な文字列
     * @return boolean 現在時間が与えられた時間以後のとき true、それ以外のとき false
     */
    public static function afterEq($a)
    {
        return is_null($a) ? false : !self::before($a);
    }

    /**
     * 現在時間が引数2つの時間の範囲内かどうか
     *
     * 現在時間が第1引数または第2引数と等しい場合は範囲内とみなしてtrueを返します。
     *
     * 第1引数が配列で第2引数がnullだった場合、
     * 第1引数を(開始時間,終了時間)とみなします。
     * それ以外の組み合わせ引数にnullが渡された場合はfalseを返します。
     *
     * @param $a unixtimeを表す整数、または日付として解釈可能な文字列
     * @param $b unixtimeを表す整数、または日付として解釈可能な文字列
     * @return boolean 現在時間が与えられた時間以後のとき true、それ以外のとき false
     */
    public static function between($a, $b = null)
    {
        if (is_array($a) && is_null($b)) {
            list($a, $b) = $a;
        }
        return self::afterEq($a) && self::beforeEq($b);
    }
}
