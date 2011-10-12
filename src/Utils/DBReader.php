<?php

class DBReader implements ArrayAccess {
	private $record;
  private $data;
	private $max_index;
	private $index = -1;
	private $columns;


	public function __construct(PDOStatement $stmt){
		$this->data = $stmt->fetchAll();
		//$stmt->closeCursor();
		$this->max_index = count($this->data) - 1;
		if ($this->max_index >= 0) {
			$this->columns = array_keys( $this->data[0] );
		}
	}

  public function Read(){
	  if ($this->index >= $this->max_index) return false;
	  $this->index++;
	  $this->record =& $this->data[$this->index];
		return true;
  }
	public function Close(){
	}

	// buggy and slow
	public function &GetRecord(){ return $this->record; }

	public function offsetExists($offset) {
		try {
			return array_key_exists($offset,$this->record);
		}
		catch (Exception $ex){
			if (is_null($this->record)) throw new Exception('DBReader is not initialised');
		}
	}
	/** @return DBValue */
	public function offsetGet($offset) {
		try {
			$r = $this->record[$offset];
			if (!($r instanceof DBValue)) { $r = new DBValue($r); $this->record[$offset] = $r; }
			return $r;
		}
		catch (Exception $ex){
			if (is_null($this->record)) throw new Exception('DBReader is not initialised');
			if (!array_key_exists($offset,$this->record)) throw new Exception('Field '.$offset.' not found.');
		}
	}
  public function offsetSet($offset, $value) {	throw new Exception('DBReader is readonly.'); }
	public function offsetUnset($offset) { throw new Exception('DBReader is readonly.'); }

}

