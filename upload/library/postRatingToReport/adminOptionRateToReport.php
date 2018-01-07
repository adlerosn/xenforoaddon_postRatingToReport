<?php

class postRatingToReport_adminOptionRateToReport {
	public static function renderView(XenForo_View $view, $fieldPrefix, array $preparedOption, $canEdit){
		$editLink = $view->createTemplateObject('option_list_option_editlink', array(
			'preparedOption' => $preparedOption,
			'canEditOptionDefinition' => $canEdit
		));
		$t = $preparedOption['option_value'];
		$model = XenForo_Model::create('Dark_PostRating_Model');
		$ratings = $model->getRatings();
		usort($ratings,function($a,$b){return $a['display_order']-$b['display_order'];});
		//*
		$rt = [];
		foreach($ratings as $rating){
			$rt[]=[
				'nm'=>$rating['title'],
				'id'=>$rating['id'],
				'ck'=>in_array($rating['id'],$t),
			];
		}
		/*
		homeOrServer_DownloadHelper::sendAsDownload(
		json_encode(
		$ratings
		,JSON_PRETTY_PRINT)
		,'a','',false);
		//*/
		return $view->createTemplateObject('kiror_option_template_ratingLukeF_autoreport', array(
			'fieldPrefix' => $fieldPrefix,
			'listedFieldName' => $fieldPrefix . '_listed[]',
			'preparedOption' => $preparedOption,
			'formatParams' => $preparedOption['formatParams'],
			'editLink' => $editLink,
			
			'ratings' => $rt
		));
	}
	
	public static function validate(array &$fields, XenForo_DataWriter $dw, $fieldName){
		$output = array();
		
		foreach($fields as $k=>$v)
			if($v=='on')
				$output[]=$k;
		$fields = $output;
		
		/*
		homeOrServer_DownloadHelper::sendAsDownload(
		json_encode(
		$fields
		,JSON_PRETTY_PRINT)
		,'a','',false);
		//*/
		
		return true;
	}
}
