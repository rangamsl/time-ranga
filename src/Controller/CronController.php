<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityRepository;
use DoctrineDoctrine\ORM\Internal\Hydration\IterableResult;

use Psr\Log\LoggerInterface;


// needed for $entityManager:
use App\Entity\Time;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Repository\TimeRepository;
use App\Controller\EntityManagerInterface;


class CronController extends AbstractController  // AbstractController needed for $entityManager
{


	// ----------------
	// --- Methods ---
	// ----------------

	public function str_contains($haystack, $needle) {
		return strpos($haystack, $needle) !== false;
	}

	public function semicolon($s, $s2) {
		if ($s == '')
			return $s.$s2;
		else
			return $s.'; '.$s2;
	}

	public function getHoursMinutes($start, $end, $less, $amPmChange) {  // ex: 11:45a, 12:15, 0

		if (!$this->str_contains($start, 'am') && !$this->str_contains($start, 'pm')
			&& !$this->str_contains($end, 'am') && !$this->str_contains($end, 'pm')
		) {  // ex: 11:05, 1:25
//			$start = str_replace(array('am', 'pm', 'a', 'p'), array('', '', '', ''), $start);
//			$end = str_replace(array('am', 'pm', 'a', 'p'), array('', '', '', ''), $end);
			if (!$amPmChange) {
				$start .= 'am';
				$end .= 'am';
			}
			else {
				$start .= 'am';
				$end .= 'pm';
			}
		}

		else {
			if (!$amPmChange) {
				if (!$this->str_contains($end, 'am') && $this->str_contains($start, 'am'))
					$end .= 'am';
				else if (!$this->str_contains($end, 'pm') && $this->str_contains($start, 'pm'))
					$end .= 'pm';
			}
			else {  // $amPmChange
				if (!$this->str_contains($end, 'am') && $this->str_contains($start, 'am'))
					$end .= 'pm';
				else if (!$this->str_contains($end, 'pm') && $this->str_contains($start, 'pm'))
					$end .= 'am';
			}
		}

			echo '$start: '.$start.'<br>'.chr(10);
			echo '$end: '.$end.'<br>'.chr(10);
		$start = date('H:i', strtotime($start));
		$end = date('H:i', strtotime($end));

		$a = explode(':', $start);
		$start_hour = $a[0];
		$start_minutes = $a[1];

		$a = explode(':', $end);
		$end_hour = intval($a[0]);
		$end_minutes = intval($a[1]);

		$hours = $end_hour - $start_hour;
		$minutes = $end_minutes - $start_minutes - $less;


		// For Testing:
		if (false) {
			echo '$start: '.$start.'<br>'.chr(10);
			echo '$end: '.$end.'<br>'.chr(10);
			echo '$start_hour: '.$start_hour.'<br>'.chr(10);
			echo '$start_minutes: '.$start_minutes.'<br>'.chr(10);
			echo '$end_hour: '.$end_hour.'<br>'.chr(10);
			echo '$end_minutes: '.$end_minutes.'<br>'.chr(10);
			echo '$less: '.$less.'<br>'.chr(10);
			echo '$hours: '.$hours.'<br>'.chr(10);
			echo '$minutes: '.$minutes.'<br>'.chr(10);
		}

		return array($hours, $minutes);
	}


	// --------------------------------
	// --- Time Tally Method: Begin ---
	// --------------------------------

	public function time_tally($time_notes) {


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

			if (!$this->str_contains($s, '-') && !$this->str_contains($s, ' ')) {

				// 
				if ($this->str_contains($s, 'h'))
					$hours = intval($s);
				else if ($this->str_contains($s, 'm'))
					$minutes = intval($s);
				else if ($s != '') {  // not malformed if empty
					$malformed = true;
					$minutes = intval($s);
					$malformed_notes = $this->semicolon($malformed_notes, "No 'h' or 'm' at item $count, assumed minutes");
				}
			}


			// --- Hours & Minutes ---

			else if (!$this->str_contains($s, '-') && $this->str_contains($s, ' ')) {

				// get hours and minutes
				$a = explode(' ', $s);
				$hours = intval($a[0]);
				$minutes = intval($a[1]);
			}


			// -------------------
			// --- Start & End ---
			// -------------------

			else {  // $this->str_contains($s, '-')


				// --- Less --

				// parse out 'less', ex: 'less 20m'
				if ($this->str_contains($s, 'less')) {
					$a = explode('less', $s);
					$s = trim($a[0]);
					// not needed:
					//$less = str_replace(array('less', 'm'), array('', ''), $a[1]);
					$less = trim($a[1]);

					// get hours and minutes
					if ($this->str_contains($less, ' ')) {
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

				list($hours, $minutes) = $this->getHoursMinutes($start, $end, $less, false);

				if ($hours < 0 || $hours === '')
					list($hours, $minutes) = $this->getHoursMinutes($start, $end, $less, true);

				if ($minutes < 0) {
					$hours -= 1;
					$minutes = 60 + $minutes;
				}

				if ($hours < 0) {
					$malformed = true;
					$malformed_notes = $this->semicolon($malformed_notes, "'$s_orig' at item $count");
				}
			}


			// -------------
			// --- Tally ---
			// -------------

			$tally_hours += $hours;
			$tally_minutes += $minutes;


			// For Testing:
echo '<br>$s_orig: '.$s_orig.'<br>'.chr(10);
			if (TRUE) {
//				echo '<br>$s_orig: '.$s_orig.'<br>'.chr(10);
				echo '$less: '.$less.'<br>'.chr(10);
				echo '$hours: '.$hours.'<br>'.chr(10);
				echo '$minutes: '.$minutes.'<br>'.chr(10);
				//echo '$tally_hours: '.$tally_hours.'<br>'.chr(10);
				//echo '$tally_minutes: '.$tally_minutes.'<br>'.chr(10);
			}
		}

		// --- Total Hours & Minutes ---

		if ($tally_minutes >= 60) {
			$tally_hours += floor($tally_minutes / 60);
			$tally_minutes = $tally_minutes % 60;
		}


		// For Testing:

		if (TRUE) {
			echo '<br>';
			if ($malformed) {
				echo '<b>$malformed: '.($malformed ? 'true' : 'false').'<br>'.chr(10);
				echo '$malformed_notes: '.$malformed_notes.'<br>'.chr(10);
				echo '</b><br>';
			}
			echo '$tally_hours: '.$tally_hours.'<br>'.chr(10);
			echo '$tally_minutes: '.$tally_minutes.'<br>'.chr(10);
		}
		return array($tally_hours, $tally_minutes, $malformed_notes);

	}  // end function: time_tally()


	// --- Time Tally Method: End ---



	// -----------------------
	// --- Cron Controller ---
	// -----------------------

    /**
     * @var TimeRepository
     */
    private $timeRepository;

    private $logger;

    /*
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
    */

    public function __construct(LoggerInterface $logger, TimeRepository $timeRepository)
    {
        $this->logger = $logger;
        $this->timeRepository = $timeRepository;
    }


	// ------------
	// --- Cron ---
	// ------------

	/**
	 * @Route("/cron")
	 */
	public function cron()
	{

		// --- Logger Tests ---

		/*
		$this->logger->info('Information logged');
		$this->logger->error('An error occurred');

		$this->logger->critical('Critical message logged!', array(
			// include extra "context" info in your logs
			'additional_info' => 'more_details',
		));
		*/


		// --- Database ---

		$entityManager = $this->getDoctrine()->getManager();

//		$results = $this->timeRepository->findRecent(10);
//		$results = $this->timeRepository->findAll();
		$results = $this->timeRepository->findHourMinutesToDo();
		foreach ($results as $entity) {
			$id = $entity->getId();

			$timenotes = $entity->getTimenotes();
			list($hours, $minutes, $malformed_notes) = $this->time_tally($timenotes);

			// for testing:
			echo $id.' '.$hours.' '.$minutes.' '.$malformed_notes.'<br>';

			//if ($entity -> getHours() === NULL && $entity -> getHours() === NULL) {  // to start: make sure not to overwrite manually entered values

				$entity->setHours($hours);
				$entity->setMinutes($minutes);
				if ($malformed_notes != '')
					$entity->setMalformed($malformed_notes);

				$entity->setTemp(true);

				$entityManager->persist($entity);
				$entityManager->flush();
			//}
		}


		// --- Complete ---

		$cron = random_int(0, 100);

		return new Response(
			'Cron process complete.'
		);

	}

}
