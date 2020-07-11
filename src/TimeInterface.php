<?php
/**
 * @file TimeInterface.php
 */

namespace Cxj\Metrics;


interface TimeInterface
{
    public function resetCpu(): void;

    public function resetWall(): void;

    public function startCpu(): void;

    public function startWall(): void;

    public function stopCpu(): void;

    public function stopWall(): void;

    public function getDeltaCpu(): int;

    public function getDeltaWall(): int;

    public function getTotalCpu(): int;

    public function getTotalWall(): int;
}
