<?php
// +------------------------------------------------------------------------+
// | @author        : Michael Arawole
// | @author_url    : https://www.logad.net
// | @author_email  : michael@logad.net
// | @date          : 24 Dec, 2022 12:12 AM
// +------------------------------------------------------------------------+

namespace Michaelthedev\Workershifts;

use DateTime;

class Worker {
	public string $worker_id;

	public function __construct($worker_id) {
		$this->worker_id = $worker_id;
	}

	public function addWorkShift(string $date, string $startTime):array {
		if (!Helper::workDateIsValid($date)) {
			return ['status' => 'error', 'message' => 'Work shift date must be a valid date Y-m-d'];
		}

		// Force only current date and future ones
		if (date('Y-m-d') > $date) {
			return ['status' => 'error', 'message' => 'Please choose current date or a future date'];
		}

		// Check if already has shift same date
		$lastShift = $this->getLastWorkShift();
		if (date('Y-m-d', $lastShift->start_time) == $date) {
			return ['status' => 'error', 'message' => 'Worker already has a shift on selected date'];
		}

		$workShiftID = uniqid();
		$startTimeUnix = DateTime::createFromFormat("Y-m-d H:i", $date .' '. $startTime)->format('U');
		try {
			(new DB('workers_shifts'))->setColumnsAndValues([
				"shift_id" => $workShiftID,
				"worker_id" => $this->worker_id,
				"start_time" => $startTimeUnix,
				'duration' => Helper::workShiftDuration, // 8 hours
				"end_time" => strtotime('+'.Helper::workShiftDuration. ' hours', $startTimeUnix),
				"date" => time()
			])->insert();
			return ['status' => 'success', 'data' => $workShiftID];
		}
		catch (\Exception $e) {
			return ['status' => 'error', 'message' => $e->getMessage()];
		}
	}

	public function getWorkShifts(): array {
		return (new DB('workers_shifts'))->customQuery([
			'query' => 'SELECT * FROM workers_shifts WHERE worker_id = ?',
			'values' => [$this->worker_id],
		]);
	}

	public function getTotalWorkShifts(): int {
		return (new DB('workers_shifts'))->customQuery([
			'query' => 'SELECT count(shift_id) as total_count FROM workers_shifts WHERE worker_id = ?',
			'values' => [$this->worker_id],
			'singleRecord' => true
		])->total_count ?? 0;
	}

	public function getTotalWorkHours(): int {
		return (new DB('workers_shifts'))->customQuery([
			'query' => "SELECT sum(duration) as total_hours FROM workers_shifts WHERE worker_id = ? AND status = 'present'",
			'values' => [$this->worker_id],
			'singleRecord' => true
		])->total_hours ?? 0;
	}

	public function getLastWorkShift() {
		return (new DB('workers_shifts'))->customQuery([
			'query' => "SELECT * FROM workers_shifts WHERE worker_id = ? ORDER BY id DESC LIMIT 1",
			'values' => [$this->worker_id],
			'singleRecord' => true
		]);
	}
}