<?php

class LinqSkipIterator extends LinqIterator {
	private $how_many;
	public function __construct(Iterator $iterator, $how_many){ parent::__construct($iterator); $this->how_many = $how_many; }
	public function rewind(){
		$i = 0;
		for($this->iterator->rewind(); $this->iterator->valid(); $this->iterator->next())
			if (++$i > $this->how_many) return;
	}
}

?>