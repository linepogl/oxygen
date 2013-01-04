<?php

class DBValue extends ImportValue {


	public function CastTo(XType $type) {
		return $type->ImportDBValue($this->value);
	}
}
