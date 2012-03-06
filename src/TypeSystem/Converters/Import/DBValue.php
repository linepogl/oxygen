<?php

class DBValue extends ImportConverter {


	public function CastTo(XType $type) {
		return $type->ImportDBValue($this->value);
	}
}
