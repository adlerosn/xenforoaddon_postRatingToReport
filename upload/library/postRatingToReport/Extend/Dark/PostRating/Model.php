<?php

class postRatingToReport_Extend_Dark_PostRating_Model extends XFCP_postRatingToReport_Extend_Dark_PostRating_Model {
	public function ratePost(array $post, $user_id, $rating, $ignoreExistingLike = false){
		$successful = parent::ratePost($post, $user_id, $rating, $ignoreExistingLike);
		if($successful===true){
			$xenOpt = XenForo_Application::getOptions();
			$toreport = $xenOpt->postRating_autoreport;
			if(in_array($rating,$toreport)){
				$reportModel = XenForo_Model::create('XenForo_Model_Report');
				$ratingName = $this->getRatings()[$rating]['title'];
				$message = '"'.$ratingName.'" rating was given. Maybe you would like to check the content of their post.';
				(new postRatingToReport_ControllerPublicAbstract())->assertNotFlooding('report');
				$reportModel->reportContent('post', $post, $message);
			}
		}
		return $successful;
	}
}
