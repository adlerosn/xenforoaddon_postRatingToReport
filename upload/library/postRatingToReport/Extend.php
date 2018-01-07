<?php

class postRatingToReport_Extend {
	public static function getExtensions(){
		return [
			['Dark_PostRating_Model', 'postRatingToReport_Extend_Dark_PostRating_Model'],
		];
	}
	public static function callback($class, array &$extend){
		$xtds = static::getExtensions();
		foreach($xtds as $xtd){
			$baseClass = $xtd[0];
			$toExtend = $xtd[1];
			if($class==$baseClass && !in_array($toExtend, $extend)){
				$extend[]=$toExtend;
			}
		}
	}
}
