<?php

abstract class XPred {


//	/** @return XPred */ public function And_(XPred $pred)    { return new XPredBinaryOp($this,$pred,XPredBinaryOp::OP_AND); }
//	/** @return XPred */ public function Or_(XPred $pred)     { return new XPredBinaryOp($this,$pred,XPredBinaryOp::OP_OR); }
//	/** @return XPred */ public function AndNot(XPred $pred) { return new XPredBinaryOp($this,$pred,XPredBinaryOp::OP_AND_NOT); }
//	/** @return XPred */ public function OrNot(XPred $pred)  { return new XPredBinaryOp($this,$pred,XPredBinaryOp::OP_OR_NOT); }

	/** @return XPred */ public function IsTrue()                 { return $this; } // :-P
	/** @return XPred */ public function IsNotTrue()              { return new XPredUnaryOp($this,XPredUnaryOp::OP_NOT); }

	abstract function ToSql();
	abstract function GetSqlParams();


	/** @return XPredList */ public static function All(){ return new XPredList(func_get_args(),XPredList::OP_AND); }
	/** @return XPredList */ public static function AllX($preds){ return new XPredList($preds,XPredList::OP_AND); }
	/** @return XPredList */ public static function Any(){ return new XPredList(func_get_args(),XPredList::OP_OR); }
	/** @return XPredList */ public static function AnyX($preds){ return new XPredList($preds,XPredList::OP_OR); }




}