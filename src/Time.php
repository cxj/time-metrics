<?php
/**
 * @file Time.php
 * Replace with one line description.
 */

namespace Cxj\Metrics;


class Time implements TimeInterface
{
    private int $cpu;
    private int $wall;

    private int $startCpu;
    private int $startWall;

    public function __construct()
    {
        $this->startCpu  = $this->makeCpu();
        $this->startWall = microtime(true);
        $this->cpu       = $this->startCpu;
        $this->wall      = $this->startWall;
    }

    /**
     * Returns current process total CPU usage in integer microseconds.
     * @return int
     */
    private function makeCpu(): int
    {
        $usage = getrusage();
        $cpu   = $usage['ru_utime.tv_usec'];
        $cpu   += $usage['ru_utime.tv_sec'] * 1000000;
        $cpu   += $usage['ru_stime.tv_usec'];

        return $cpu;
    }

    /**
     * Resets CPU microsecond counter to "current" process value.
     */
    public function resetCpu(): void
    {
        $this->cpu = $this->makeCpu();
    }

    /**
     * Resets Wall clock microsecond counter to current system value.
     */
    public function resetWall(): void
    {
        $this->wall = microtime(true);
    }

    public function startCpu(): void
    {
        // TODO: Implement startCpu() method.
    }

    public function startWall(): void
    {
        // TODO: Implement startWall() method.
    }

    public function stopCpu(): void
    {
        // TODO: Implement stopCpu() method.
    }

    public function stopWall(): void
    {
        // TODO: Implement stopWall() method.
    }

    /**
     * Returns delta CPU microseconds since last set (reset).
     * @return int
     */
    public function getDeltaCpu(): int
    {
        $delta = $this->makeCpu() - $this->cpu;
        $this->resetCpu();

        return $delta;
    }

    /**
     * Returns delta wall clock microseconds since last set (reset).
     * @return int
     */
    public function getDeltaWall(): int
    {
        $delta = microtime(true) - $this->wall;
        $this->resetWall();

        return $delta;
    }

    /**
     * Returns CPU microseconds since this class was constructed.
     * @return int
     */
    public function getTotalCpu(): int
    {
        return $this->makeCpu() - $this->startCpu;
    }

    /**
     * Returns wall clock microseconds since this class was constructed.
     * @return int
     */
    public function getTotalWall(): int
    {
        return microtime(true) - $this->startWall;
    }
}
