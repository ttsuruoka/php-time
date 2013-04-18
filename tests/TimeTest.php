<?php
class TimeTest extends PHPUnit_Framework_TestCase
{
    public function test_before()
    {
        Time::set(strtotime('2011-11-01 15:00:00'));

        $this->assertEquals('2011-11-01 15:00:00', Time::now());
        $this->assertTrue(Time::before('2011-11-01 16:00:00'));
        $this->assertTrue(Time::before('2011-11-01 15:00:01'));
        $this->assertFalse(Time::before('2011-11-01 15:00:00'));
        $this->assertFalse(Time::before('2011-11-01 14:59:59'));
    }

    public function test_after()
    {
        Time::set(strtotime('2011-11-01 15:00:00'));

        $this->assertEquals('2011-11-01 15:00:00', Time::now());
        $this->assertFalse(Time::after('2011-11-01 16:00:00'));
        $this->assertFalse(Time::after('2011-11-01 15:00:01'));
        $this->assertFalse(Time::after('2011-11-01 15:00:00'));
        $this->assertTrue(Time::after('2011-11-01 14:59:59'));
    }

    public function test_between()
    {
        Time::set(strtotime('2011-11-01 15:00:00'));

        $this->assertEquals('2011-11-01 15:00:00', Time::now());
        $this->assertTrue(Time::between('2011-11-01 15:00:00', '2011-11-01 16:00:00'));
        $this->assertTrue(Time::between('2011-11-01 14:00:00', '2011-11-01 15:00:00'));
        $this->assertFalse(Time::between('2011-11-01 14:00:00', '2011-11-01 14:59:59'));
        $this->assertFalse(Time::between('2011-11-01 15:00:01', '2011-11-01 16:00:00'));
    }

    public function test_between_array()
    {
        Time::set(strtotime('2011-11-01 15:00:00'));

        $this->assertEquals('2011-11-01 15:00:00', Time::now());
        $this->assertTrue(Time::between(array('2011-11-01 15:00:00', '2011-11-01 16:00:00')));
        $this->assertTrue(Time::between(array('2011-11-01 14:00:00', '2011-11-01 15:00:00')));
        $this->assertFalse(Time::between(array('2011-11-01 14:00:00', '2011-11-01 14:59:59')));
        $this->assertFalse(Time::between(array('2011-11-01 15:00:01', '2011-11-01 16:00:00')));
    }
}
