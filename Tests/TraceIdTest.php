<?php

namespace Xincheng\YiiTrace\Tests;

use PHPUnit\Framework\TestCase;
use Xincheng\YiiTrace\TraceId;

class TraceIdTest extends TestCase
{

    public function testGenerate()
    {
        $d = TraceId::generate();

        self::assertIsString($d);
    }


    public function testNewTraceId()
    {
        $s = TraceId::generate();

        $traceId = TraceId::newTraceId($s);
        self::assertEquals($s, $traceId);

        $traceId = TraceId::getTraceId();
        self::assertEquals($s, $traceId);
    }

    public function testGetTraceId()
    {
        $traceId = TraceId::getTraceId();

        self::assertIsString($traceId);
        self::assertEquals(strlen($traceId), 36);
    }
}