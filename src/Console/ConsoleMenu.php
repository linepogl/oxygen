<?php

class ConsoleMenu extends Menu {
	public function __construct(){

		$this[] = new ActionOxygen();
		$this[] = new ActionOxygenErrs();
		$this[] = new ActionOxygenLogs();
		$this[] = new ActionOxygenPrfs();
		$this[] = new ActionOxygenDocs();



	}
}