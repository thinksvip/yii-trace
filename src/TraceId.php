<?php

namespace Xincheng\YiiTrace;

use yii\base\BaseObject;

class TraceId extends BaseObject
{
    public static string $traceId;

    /**
     * 生成TraceID
     *
     * @param string $traceId
     * @return string
     * @throws \Random\RandomException
     */
    public static function newTraceId(string $traceId = ''): string
    {
        self::$traceId = empty($traceId) ? self::generate() : $traceId;

        return self::$traceId;
    }

    /**
     * 获取TraceID
     *
     * @return string
     * @throws \Random\RandomException
     */
    public static function getTraceId(): string
    {
        if (!self::$traceId) {
            self::$traceId = self::generate();
        }

        return self::$traceId;
    }

    /**
     * 生成
     *
     * @return string
     * @throws \Random\RandomException
     */
    public static function generate(): string
    {
        mt_srand(random_int(PHP_INT_MIN, PHP_INT_MAX));

        $chard = strtolower(md5(uniqid((string)mt_rand(), true)));

        $hyphen = chr(45);

        return
            substr($chard, 0,  8) . $hyphen .
            substr($chard, 8,  4) . $hyphen .
            substr($chard, 12, 4) . $hyphen .
            substr($chard, 16, 4) . $hyphen .
            substr($chard, 20, 12);
    }
}