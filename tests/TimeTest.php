<?php
/**
 * @file TimeTest.php
 */

use Cxj\Metrics\Time;
use PHPUnit\Framework\TestCase;

class TimeTest extends TestCase
{
    private Time $metric;

    public function setUp(): void
    {
        $this->metric = new Time();
    }

    public function testConstruct(): void
    {
        $this->assertInstanceOf(Time::class, $this->metric);
        // Make sure the clocks tick to be non-zero.  Could be improved.
        sleep(1);
        $this->assertGreaterThan(0, $this->metric->getTotalCpu(), "cpu");
        $this->assertGreaterThan(0, $this->metric->getTotalWall(), "wall");
    }

    public function testReset(): void
    {
        $this->metric->resetCpu();
        // Assumes we can finish call in less than 100 microseconds.
        $this->assertLessThan(100, $this->metric->getDeltaCpu());

        $this->metric->resetWall();
        // Assumes we can finish call in less than 100 microseconds.
        $this->assertLessThan(100, $this->metric->getDeltaWall());
    }
}
