<?php

use Michaelthedev\Workershifts\Worker;
use PHPUnit\Framework\TestCase;

class WorkerTest extends TestCase {
	public string $worker_id = 'WRK202212728';

	public function testClassConstructor() {
		$worker = new Worker($this->worker_id);
		$this->assertSame($this->worker_id, $worker->worker_id);
	}


	/*public function testGetWorkShifts() {
		$worker = new Worker($this->worker_id);

		$this->assertEmpty($worker->getWorkShifts());

		$createShift = $worker->addWorkShift('2022-12-24', '11:00');
		$this->assertSame('success', $createShift['status']);

		$expected = [
			["shift_id"=>"63a753d20e311","worker_id"=>"WRK202212728","duration"=>"8","start_time"=>"1671910320","end_time"=>"1671939120","status"=>"present","date"=>"1671910354"]];
		$this->assertSame($expected, $worker->getWorkShifts());
	}*/
}
