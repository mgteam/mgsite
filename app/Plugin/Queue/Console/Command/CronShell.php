<?php
App::uses('Folder', 'Utility');
App::uses('AppShell', 'Console/Command');

/**
 * Cronjob via crontab etc triggering this script every few minutes
 * Alternative to indefinitly running queues
 * based on the idea of
 * - https://github.com/csrui/cron-mailer
 *
 * crontab (in this example running every 30 minutes):
 * 0,30 * * * * cake cron run -app /full/path/to/app
 *
 * probably less memory consuming
 * 2011-07-17 ms
 *
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link http://github.com/MSeven/cakephp_queue
 */
class CronShell extends AppShell {

	public $uses = array(
		'Queue.CronTask'
	);
	/**
	 * Codecomplete Hint
	 *
	 * @var QueuedTask
	 */
	public $QueuedTask;

	protected $taskConf;

	/**
	 * Overwrite shell initialize to dynamically load all Queue Related Tasks.
	 */
	public function initialize() {
		$this->_loadModels();

		$x = App::objects('Queue.Task'); //'Console/Command/Task'
		//$x = App::path('Task', 'Queue');

		$paths = App::path('Console/Command/Task');
		foreach ($paths as $path) {
			$Folder = new Folder($path);
			$this->tasks = array_merge($this->tasks, $Folder->find('Queue.*\.php'));
		}

		$plugins = App::objects('plugin');
		foreach ($plugins as $plugin) {
			$pluginPaths = App::path('Console/Command/Task', $plugin);
			foreach ($pluginPaths as $pluginPath) {
				$Folder = new Folder($pluginPath);
				$res = $Folder->find('Queue.*Task\.php');
				foreach ($res as &$r) {
					$r = $plugin . '.' . basename($r, 'Task.php');
				}
				$this->tasks = array_merge($this->tasks, $res);
			}
		}

		//Config can be overwritten via local app config.
		Configure::load('Queue.queue');

		$conf = (array)Configure::read('queue');
		//merge with default configuration vars.
		Configure::write('queue', array_merge(array(
			'maxruntime' => DAY,
			'cleanuptimeout' => MONTH,
		/*
			'sleeptime' => 10,
			'gcprop' => 10,
			'defaultworkertimeout' => 120,
			'defaultworkerretries' => 4,

			'exitwhennothingtodo' => false
		*/
		), $conf));
	}

	/**
	 * Output some basic usage Info.
	 */
	public function main() {
		$this->out('CakePHP Cronjobs:');
		$this->hr();
		$this->out('Usage:');
		$this->out('	cake cron help');
		$this->out('		-> Display this Help message');
		$this->out('	cake cron run <taskname> (no tasks = will call ALL at once)');
		$this->out('		-> Try to call the cli add() function on a task');
		$this->out('		-> tasks may or may not provide this functionality.');
		$this->out('	cake cron stats');
		$this->out('		-> Display some general Statistics.');
		$this->out('	cake cron clean');
		$this->out('		-> Manually call cleanup function to delete task data of completed tasks.');
		$this->out('Notes:');
		$this->out('	<taskname> may either be the complete classname (eg. queue_example)');
		$this->out('	or the shorthand without the leading "queue_" (eg. example)');
		$this->out('Available Tasks:');
		foreach ($this->taskNames as $loadedTask) {
			$this->out('	->' . $loadedTask);
		}
	}

	/**
	 * Look for a Queue Task of hte passed name and try to call add() on it.
	 * A QueueTask may provide an add function to enable the user to create new jobs via commandline.
	 *
	 */
	public function add() {
		if (count($this->args) < 1) {
			$this->out('Please call like this:');
			$this->out('       cake queue add <taskname>');
		} else {

			if (in_array($this->args[0], $this->taskNames)) {
				$this->{$this->args[0]}->add();
			} elseif (in_array('queue_' . $this->args[0], $this->taskNames)) {
				$this->{'queue_' . $this->args[0]}->add();
			} else {
				$this->out('Error: Task not Found: ' . $this->args[0]);
				$this->out('Available Tasks:');
				foreach ($this->taskNames as $loadedTask) {
					$this->out(' * ' . $loadedTask);
				}
			}
		}
	}

	/**
	 * Select all active and due cronjobs and execute them
	 * 2011-07-18 ms
	 */
	public function run() {
		// Enable Garbage Collector (PHP >= 5.3)
		if (function_exists('gc_enable')) {
			gc_enable();
		}


	}

	/**
	 * Run a QueueWorker loop.
	 * Runs a Queue Worker process which will try to find unassigned jobs in the queue
	 * which it may run and try to fetch and execute them.
	 */
	public function runOld() {
		// Enable Garbage Collector (PHP >= 5.3)
		if (function_exists('gc_enable')) {
			gc_enable();
		}
		$exit = false;
		$starttime = time();
		$group = null;
		if (isset($this->params['group']) && !empty($this->params['group'])) {
			$group = $this->params['group'];
		}
		while (!$exit) {
			$this->out('Looking for Job....');
			$data = $this->QueuedTask->requestJob($this->_getTaskConf(), $group);
			if ($this->QueuedTask->exit === true) {
				$exit = true;
			} else {
				if ($data !== false) {
					$this->out('Running Job of type "' . $data['jobtype'] . '"');
					$taskname = 'queue_' . strtolower($data['jobtype']);
					$return = $this->{$taskname}->run(unserialize($data['data']));
					if ($return == true) {
						$this->QueuedTask->markJobDone($data['id']);
						$this->out('Job Finished.');
					} else {
						$failureMessage = null;
						if (isset($this->{$taskname}->failureMessage) && !empty($this->{$taskname}->failureMessage)) {
							$failureMessage = $this->{$taskname}->failureMessage;
						}
						$this->QueuedTask->markJobFailed($data['id'], $failureMessage);
						$this->out('Job did not finish, requeued.');
					}
				} elseif (Configure::read('queue.exitwhennothingtodo')) {
					$this->out('nothing to do, exiting.');
					$exit = true;
				} else {
					$exit = true;
				}

				// check if we are over the maximum runtime and end processing if so.
				if (Configure::read('queue.maxruntime') != 0 && (time() - $starttime) >= Configure::read('queue.maxruntime')) {
					$exit = true;
					$this->out('Reached runtime of ' . (time() - $starttime) . ' Seconds (Max ' . Configure::read('queue.maxruntime') . '), terminating.');
				}
				if ($exit || rand(0, 100) > (100 - Configure::read('queue.gcprop'))) {
					$this->out('Performing Old job cleanup.');
					$this->QueuedTask->cleanOldJobs();
				}
				$this->hr();
			}
		}
	}

	/**
	 * Manually trigger a Finished job cleanup.
	 * @return null
	 */
	public function clean() {
		$this->out('Deleting old jobs, that have finished before ' . date('Y-m-d H:i:s', time() - Configure::read('queue.cleanuptimeout')));
		$this->QueuedTask->cleanOldJobs();
	}

	/**
	 * Display Some statistics about Finished Jobs.
	 * @return null
	 */
	public function stats() {
		$this->out('Jobs currenty in the Queue:');

		$types = $this->QueuedTask->getTypes();

		foreach ($types as $type) {
			$this->out("      " . str_pad($type, 20, ' ', STR_PAD_RIGHT) . ": " . $this->QueuedTask->getLength($type));
		}
		$this->hr();
		$this->out('Total unfinished Jobs      : ' . $this->QueuedTask->getLength());
		$this->hr();
		$this->out('Finished Job Statistics:');
		$data = $this->QueuedTask->getStats();
		foreach ($data as $item) {
			$this->out(" " . $item['QueuedTask']['jobtype'] . ": ");
			$this->out("   Finished Jobs in Database: " . $item[0]['num']);
			$this->out("   Average Job existence    : " . $item[0]['alltime'] . 's');
			$this->out("   Average Execution delay  : " . $item[0]['fetchdelay'] . 's');
			$this->out("   Average Execution time   : " . $item[0]['runtime'] . 's');
		}
	}

	/**
	 * Returns a List of available QueueTasks and their individual configurations.
	 * @return array
	 */
	protected function _getTaskConf() {
		if (!is_array($this->taskConf)) {
			$this->taskConf = array();
			foreach ($this->tasks as $task) {
				$this->taskConf[$task]['name'] = $task;
				if (property_exists($this->{$task}, 'timeout')) {
					$this->taskConf[$task]['timeout'] = $this->{$task}->timeout;
				} else {
					$this->taskConf[$task]['timeout'] = Configure::read('queue.defaultworkertimeout');
				}
				if (property_exists($this->{$task}, 'retries')) {
					$this->taskConf[$task]['retries'] = $this->{$task}->retries;
				} else {
					$this->taskConf[$task]['retries'] = Configure::read('queue.defaultworkerretries');
				}
				if (property_exists($this->{$task}, 'rate')) {
					$this->taskConf[$task]['rate'] = $this->{$task}->rate;
				}
			}
		}
		return $this->taskConf;
	}
}

