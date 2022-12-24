<?php
// +------------------------------------------------------------------------+
// | @author        : Michael Arawole (Logad Networks)
// | @author_url    : https://www.logad.net
// | @author_email  : michael@logad.net
// | @date          : 24 Dec, 2022 12:35 AM
// +------------------------------------------------------------------------+

namespace Michaelthedev\Workershifts;

use DateTime;
class Helper {
	const workShiftDuration = 8; // 8 hours

	public static function workDateIsValid($date): bool {
		$dt = DateTime::createFromFormat("Y-m-d", $date);
		return $dt !== false && !array_sum($dt::getLastErrors());
	}

	public static function formatTimeStamp($timestamp, $format = 'd M, Y'): string
	{
		return date($format, $timestamp);
	}
}