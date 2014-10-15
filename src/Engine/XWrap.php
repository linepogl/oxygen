<?php

class XWrap extends stdClass {
	private $__item;
	private $__name;
	public function __construct(XMeta $m,XItem $item,$name){
		$this->__item = $item;
		$this->__name = $name;
		for ($mm = $m; !is_null($mm); $mm = $mm->GetParent()){
			foreach ($mm as $key=>$value){
				if ($value instanceof XMetaField){
					$this->$key = new XWrapField($this,$value);
				}
				elseif ($value instanceof XMetaSlave){
					$this->$key = new XWrapSlave($this,$value);
				}
			}
		}
	}

	public function GetItem(){ return $this->__item; }
	public function GetName(){ return $this->__name; }

	public function Read(Http $http, $control_classname=null){
		if (is_null($control_classname)){
			/** @var $f XWrapField */
			foreach ($this->GetFields() as $f){
				$n = $f->GetName();
				if (isset($http[$n])) {
					$f->SetValue( $http[$n]->CastTo($f->GetType()) );
				}
			}
		}
		else {
			/** @var $c XWrapControl */
			$c = new $control_classname($this);
			$c->Read($http);
		}
	}


	public function GetFields(){
		$r = array();
		foreach ($this as $key=>$value) {
			if ($value instanceof XWrapField) {
				$r[$key] = $value;
			}
		}
		return $r;
	}
	public function GetSlaves(){
		$r = array();
		foreach ($this as $key=>$value) {
			if ($value instanceof XWrapSlave) {
				$r[$key] = $value;
			}
		}
		return $r;
	}
}


