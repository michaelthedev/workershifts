<?php
// +------------------------------------------------------------------------+
// | @author        : Michael Arawole (Logad Networks)
// | @author_url    : https://www.logad.net
// | @author_email  : michael@logad.net
// | @date          : 24 Dec, 2022 5:39 PM
// +------------------------------------------------------------------------+


namespace Michaelthedev\Workershifts;

use Exception;
use JetBrains\PhpStorm\NoReturn;

class Admin {

	public static function handleFormSubmit(): void
	{
		$post = new \stdClass();
		foreach ($_POST as $key => $value) {
			$post->{$key} = htmlentities($value);
		}

		if (empty($post->submittedFormType)) {
			self::returnMessage('Form type is required');
		}

		$returnMsg = "Failed to process form submission";
		if ($post->submittedFormType == 'createWorker') {
			if (empty($post->first_name) || empty($post->last_name)) {
				$returnMsg = 'First name and last name are required';
			} else {
				$request = self::addWorker($post->first_name, $post->last_name);
				$returnMsg = $request['message'] ?? $returnMsg;
			}
		}
		elseif ($post->submittedFormType == 'createWorkShift') {
			if (empty($post->worker_id) || empty($post->start_time)|| empty($post->start_date)) {
				$returnMsg = 'Worker ID, Start Time and start date are required';
			} else {
				$worker = new Worker($post->worker_id);
				$request = $worker->addWorkShift($post->start_date, $post->start_time);
				if ($request['status'] == 'success') {
					$returnMsg = 'Work shift created successfully';
				} else {
					$returnMsg = $request['message'];
				}
			}
		}
		self::returnMessage($returnMsg);
	}

	public static function returnMessage($message): void
	{
		header('Location: ./?returnMsg='.$message);
		exit;
	}

	public function getAllWorkers(): array {
		return (new DB('workers'))->customQuery([
			'query' => 'SELECT * FROM workers ORDER BY date DESC',
		]);
	}

	## Total number of workers ##
	public function getTotalWorkers(): int {
		return (new DB('workers'))->customQuery([
			'query' => 'SELECT count(worker_id) as total_count FROM workers',
			'singleRecord' => true
		])->total_count;
	}

	public static function addWorker($firstName, $lastName, $roleId = 1):array {
		try {
			$workerID = "WRK".date('Ym').sprintf("%03d", mt_rand(1, 999));;
			(new DB('workers'))->setColumnsAndValues([
				"worker_id" => $workerID,
				"first_name" => $firstName,
				"last_name" => $lastName,
				"role_id" => $roleId,
				"date" => time()
			])->insert();

			return ['status' => 'success', 'message' => 'Worker added successfully'];
		}
		catch (Exception $e) {
			return ['status' => 'error', 'message' => $e->getMessage()];
		}
	}

	public function getTotalWorkersShifts(): int
	{
		return (new DB('workers_shifts'))->customQuery([
			'query' => 'SELECT count(*) as total_count FROM workers_shifts',
			'singleRecord' => true
		])->total_count ?? 0;
	}

	public function getTotalWorkersShiftHours(): int
	{
		return (new DB('workers_shifts'))->customQuery([
			"query" => "SELECT sum(duration) as total_hours FROM workers_shifts WHERE status = 'present'",
			"singleRecord" => true
		])->total_hours ?? 0;
	}

	public function getAllWorkShifts(): array {
		return (new DB('workers_shifts'))->customQuery([
			'query' => 'SELECT * FROM workers_shifts ORDER BY id DESC',
		]);
	}
}