<?php

// For Testing:

$s = '8:30p-10:10 less ~20m, 8:35p-10:20 less ~5m';
//$s = '11:10a-12:25 less ~10m, ~5m, 3:25p-4:50 less ~5m';
// $s = '~5m, ~10:45a-11:25 less ~10m, ~10m';
// $s = '~2:50p-5:30, ~20m, ~7:20p-7:35';
// $s = '2:25p-~2:50, 5:55p-6:50, ~10m, 7:35p-7:50';
// $s = '12:20p-12:40, 12:55p-1:10 less ~5m';
// $s = '~5m, 1:15p-3:25 less ~20m, 4:55p-5:10, ~10m, 6:55p-7:35';
// $s = '~5m, 8:05a-9:50 less 1h ~15m, 10:15a-10:35 less ~5m';
// $s = '~20m, 3:45p-5:05, 5:45p-7:15, 7:30p-7:50, ~10m';
// $s = '9a-9:10, 10a-11:55 less ~5m, 1:25p-1:40, 2:20p-6:05 less ~10m';
// $s = '~30m, ~5:20p-~5:35, ~5m, 5:50p-6:35 less ~10m, ~15m';
// $s = '1h 15m, 4:25p-5:30, 5:45p-6:25, 7:05p-9 less ~20m';

time_tally($s);



// -----------------
// --- Functions ---
// -----------------

function str_contains($haystack, $needle) {
	return strpos($haystack, $needle) !== false;
}

function semicolon($s, $s2) {
	if ($s == '')
		return $s.$s2;
	else
		return $s.'; '.$s2;
}


// -----------------------------------
// --- Time Tally Function:  Begin ---
// -----------------------------------

function time_tally($time_notes) {


	$malformed = false;
	$malformed_notes = '';

	$tally_hours = 0;
	$tally_minutes = 0;


	$items = explode(',', $time_notes);
	$count = 0;


	// ------------
	// --- Loop ---
	// ------------

	foreach($items as $item) {


		// --- Vars ---

		$count++;

		$start = '';
		$end = '';

		$hours = 0;
		$minutes = 0;

		$start_hour = 0;
		$start_minutes = 0;
		$end_hour = 0;
		$end_minutes = 0;

		$less = 0;


		// --- Strip Extras ---

		// trim leading & trailing whitespace:
		$s = trim($item);

		// replace all multiple whitespace characters with a single space character:
		$s = preg_replace('/\s+/', ' ', $s);

		// remove all tilde characters '~'
		$s = str_replace('~', '', trim($s));

		// For Testing:
		$s_orig = $s;


		// ----------------------
		// --- Hours, Minutes ---
		// ----------------------


		// --- Hours OR Minutes ---

		if (!str_contains($s, '-') && !str_contains($s, ' ')) {

			// 
			if (str_contains($s, 'h'))
				$hours = intval($s);
			else if (str_contains($s, 'm'))
				$minutes = intval($s);
			else {
				$malformed = true;
				$minutes = intval($s);
				$malformed_notes = semicolon($malformed_notes, "No 'h' or 'm' at item $count, assumed minutes");
			}
		}


		// --- Hours & Minutes ---

		else if (!str_contains($s, '-') && str_contains($s, ' ')) {

			// get hours and minutes
			$a = explode(' ', $s);
			$hours = intval($a[0]);
			$minutes = intval($a[1]);
		}


		// -------------------
		// --- Start & End ---
		// -------------------

		else {  // str_contains($s, '-')


			// --- Less --

			// parse out 'less', ex: 'less 20m'
			if (str_contains($s, 'less')) {
				$a = explode('less', $s);
				$s = trim($a[0]);
				// not needed:
				//$less = str_replace(array('less', 'm'), array('', ''), $a[1]);
				$less = trim($a[1]);

				// get hours and minutes
				if (str_contains($less, ' ')) {
					$a = explode(' ', $less);
					$less = (intval($a[0]) * 60) + intval($a[1]);
				}
				else
					$less = intval($less);
			}


			// --- Parse and Calc ---

			// convert 'p' to 'pm' and 'a' to 'am'
			$s = str_replace('p', 'pm', $s);
			$s = str_replace('a', 'am', $s);

			// get start and end times
			$a = explode('-', $s);
			$start = $a[0];
			$end = $a[1];
			if (!str_contains($end, 'am') && str_contains($start, 'am'))
				$end .= 'am';
			if (!str_contains($end, 'pm') && str_contains($start, 'pm'))
				$end .= 'pm';

			$start = date('H:i', strtotime($start));
			$end = date('H:i', strtotime($end));

			$a = explode(':', $start);
			$start_hour = $a[0];
			$start_minutes = $a[1];

			$a = explode(':', $end);
			$end_hour = $a[0];
			$end_minutes = $a[1];

			$hours = $end_hour - $start_hour;
			$minutes = $end_minutes - $start_minutes - $less;

			if ($minutes < 0) {
				$hours -= 1;
				$minutes = 60 + $minutes;
			}
		}


		// -------------
		// --- Tally ---
		// -------------

		$tally_hours += $hours;
		$tally_minutes += $minutes;


		// For Testing:

		echo '<br>$s_orig: '.$s_orig.'<br>'.chr(10);
		/*
		echo '<br>$s: '.$s.'<br>'.chr(10);
		echo '$start: '.$start.'<br>'.chr(10);
		echo '$end: '.$end.'<br>'.chr(10);
		echo '$start_hour: '.$start_hour.'<br>'.chr(10);
		echo '$start_minutes: '.$start_minutes.'<br>'.chr(10);
		echo '$end_hour: '.$end_hour.'<br>'.chr(10);
		echo '$end_minutes: '.$end_minutes.'<br>'.chr(10);
		*/
		echo '$less: '.$less.'<br>'.chr(10);
		echo '$hours: '.$hours.'<br>'.chr(10);
		echo '$minutes: '.$minutes.'<br>'.chr(10);
		//echo '$tally_hours: '.$tally_hours.'<br>'.chr(10);
		//echo '$tally_minutes: '.$tally_minutes.'<br>'.chr(10);

	}

	// --- Total Hours & Minutes ---

	if ($tally_minutes >= 60) {
		$tally_hours += floor($tally_minutes / 60);
		$tally_minutes = $tally_minutes % 60;
	}


	// For Testing:

	echo '<br>';
	if ($malformed) {
		echo '<b>$malformed: '.($malformed ? 'true' : 'false').'<br>'.chr(10);
		echo '$malformed_notes: '.$malformed_notes.'<br>'.chr(10);
		echo '</b><br>';
	}
	echo '$tally_hours: '.$tally_hours.'<br>'.chr(10);
	echo '$tally_minutes: '.$tally_minutes.'<br>'.chr(10);

}  // end function: time_tally()


// --- Time Tally Function:  End ---

?>
