<?php

header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: GET,HEAD,OPTIONS,POST,PUT');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');

require_once 'application-controller.php';

$applicationControl         =           new ApplicationController();


// ======================= Inserting Post ======================================
if(isset($_REQUEST['action']) && ($_REQUEST['action']) == 'save') {
	$saveResult       =           $applicationControl->savePost($_REQUEST);
	echo json_encode($saveResult);
}


// ========================  Reading Posts ============================================
if(isset($_REQUEST['action']) && ($_REQUEST['action']) == 'listing') {
	$listResult       =	 			$applicationControl->getPosts($_REQUEST);
	echo json_encode($listResult);
}


// ========================  Reading Post By Id ======================================
if(isset($_REQUEST['action']) && ($_REQUEST['action']) == 'list') {
	$id 			  =  			$_REQUEST['id'];
	$listResult 	  = 			$applicationControl->getPostById($id, $_REQUEST);
	echo json_encode($listResult);
}

// ========================  Reading Post By Slug ===================================
if(isset($_REQUEST['action']) && ($_REQUEST['action']) == 'listslug') {
	$slug 			  =  			$_REQUEST['slug'];
	$listResult 	  = 			$applicationControl->getPostBySlug($slug, $_REQUEST);
	echo json_encode($listResult);
}

// =======================  Update Post By Id =======================================
if(isset($_REQUEST['action']) && ($_REQUEST['action']) == 'update') {
	$id 			  =  			$_REQUEST['id'];
	$updateResult 	  = 			$applicationControl->updatePostById($id, $_REQUEST);
	echo json_encode($listResult);
}


// =======================  Update Post By Slug =======================================
if(isset($_REQUEST['action']) && ($_REQUEST['action']) == 'updateslug') {
	$slug 			  =  			$_REQUEST['slug'];
	$updateResult 	  = 			$applicationControl->updatePostBySlug($slug, $_REQUEST);
	echo json_encode($listResult);
}

// =======================  Delete Post By Id =======================================
if(isset($_REQUEST['action']) && ($_REQUEST['action']) == 'delete') {
	$id 			  =  			$_REQUEST['id'];
	$deleteResult 	  = 			$applicationControl->deletePostById($id, $_REQUEST);
	echo json_encode($listResult);
}





?>