<?php

	require_once '../config/db-controller.php';

	class ApplicationController {

		/*
			 C   =   CREATE
		   	 R   =   READ
		   	 U   =   UPDATE
		   	 D   =   DELETE
		*/
		
		// ====================================== Create/Save data  ==========================================
		public function savePost($dataArray) {
				$data  				=		array();
				$db 				=		new DBController();
				$conn 				=		$db->connect();

				$title 				=		mysqli_real_escape_string($conn, $dataArray['title']);
				$slug				=		str_replace(' ', '-', strtolower($title));
				$slug               =       preg_replace('/[^A-Za-z0-9\-]/', '', $slug);
				$slug               =       preg_replace('/-+/', '-', $slug);

				$description 		=		mysqli_real_escape_string($conn, $dataArray['description']);
				$featured 			=		$dataArray['featured'];
				// $featured_img		=		
				$status 			=		$dataArray['status'];


				if(isset($title) && ($title!="")) {
					if(is_numeric($featured)) {
						$sql 			=		"INSERT INTO post (title, slug, description, featured, status) VALUES ('".$title."', '".$slug."', '".$description."', '".$featured."', '".$status."')";
						$result  		=	$conn->query($sql);
						if($result) {
							$data['status']   =  "SUCCESS";
							$data['message']  =  "Post successfully added";
						}
						else {
							$data['status']   =  "FAILURE";
							$data['message']  =  "Failed to save due to server error";
							$data['error']    =   "ERROR ! ".mysqli_error($conn);
						}
					}

					else {
						$data['status']       =  "FAILURE";
						$data['message']      =  "Featured value should be an integer(0-1)";
						$data['error']    	  =  "ERROR ! ".mysqli_error($conn);
					}

				}
				else {
					$data['status'] =		'FAILURE';
					$data['message']=		'Please enter the post title';
					$data['error']	=		'ERROR '.mysqli_error($conn);
				}

				$db->close($conn);
				return $data;

		}

		//================================= READ Data ===========================================
		public function getPosts() {
			$data 					=			array();
			$db 					=			new DBController();
			$conn 					=			$db->connect();

			$sql 					=			"SELECT * FROM `post`";
			$result					=			$conn->query($sql);
			if($total  =  $result->num_rows > 0) {
				while($row   =  $result->fetch_assoc()) {
					$data[]      =              array(
							'id' 			=>     $row['id'],
							'title'     	=>     $row['title'],
							'slug'      	=>     $row['slug'],
							'description'   => 	   $row['description'],
							'featured'      =>     $row['featured'],
							'featured_img'  =>     $row['featured_img'],
							'status'        =>     $row['status'],
							'add_on'		=>     $row['add_on']
					);
				}				
			}
			$db->close($conn);
			return $data;
		}

		
	// ====================================== Read data by post id =====================================
		 public function getPostById($id) {
			$data 					=			array();
			$db 					=			new DBController();
			$conn 					=			$db->connect();

			$sql 					=			"SELECT * FROM post WHERE id = '".$id."' ";
			$result					=			$conn->query($sql);
			if($total  =  $result->num_rows > 0) {
				while($row   =  $result->fetch_assoc()) {
					$data     =              array(
							'id' 			=>     $row['id'],
							'title'     	=>     $row['title'],
							'slug'      	=>     $row['slug'],
							'description'   => 	   $row['description'],
							'featured'      =>     $row['featured'],
							'featured_img'  =>     $row['featured_img'],
							'status'        =>     $row['status'],
							'add_on'		=>     $row['add_on']
					);
				}				
			}
			$db->close($conn);
			return $data;
		}

	// ====================================== Read data by post slug =====================================
		 public function getPostBySlug($slug) {
			$data 					=			array();
			$db 					=			new DBController();
			$conn 					=			$db->connect();

			$sql 					=			"SELECT * FROM post WHERE slug = '".$slug."' ";
			$result					=			$conn->query($sql);
			if($total  =  $result->num_rows > 0) {
				while($row   =  $result->fetch_assoc()) {
					$data     =              array(
							'id' 			=>     $row['id'],
							'title'     	=>     $row['title'],
							'slug'      	=>     $row['slug'],
							'description'   => 	   $row['description'],
							'featured'      =>     $row['featured'],
							'featured_img'  =>     $row['featured_img'],
							'status'        =>     $row['status'],
							'add_on'		=>     $row['add_on']
					);
				}				
			}
			$db->close($conn);
			return $data;
		}

// =================================== Update Post By Id ====================================================

		public function updatePostById($id, $dataArray) {
				$data  				=		array();
				$db 				=		new DBController();
				$conn 				=		$db->connect();

				$title 				=		mysqli_real_escape_string($conn, $dataArray['title']);
				$slug				=		str_replace(' ', '-', strtolower($title));
				$slug               =       preg_replace('/[^A-Za-z0-9\-]/', '', $slug);
				$slug               =       preg_replace('/-+/', '-', $slug);

				$description 		=		mysqli_real_escape_string($conn, $dataArray['description']);
				$featured 			=		$dataArray['featured'];
				$status 			=		$dataArray['status'];

				if(isset($title) && ($title!="")) {
					if(is_numeric($featured)) {
						$sql 			=		"UPDATE post SET title = '".$title."', slug = '".$slug."', description = '".$description."', featured = '".$featured."', status = '".$status."' WHERE id = '".$dataArray['id']."' ";
						$result  		=	$conn->query($sql);
						if($result) {
							$data['status']   =  "SUCCESS";
							$data['message']  =  "Post successfully updated";
						}
						else {
							$data['status']   =  "FAILURE";
							$data['message']  =  "Failed to update due to server error";
							$data['error']    =   "ERROR ! ".mysqli_error($conn);
						}
					}

					else {
						$data['status']       =  "FAILURE";
						$data['message']      =  "Featured value should be an integer(0-1)";
						$data['error']    	  =  "ERROR ! ".mysqli_error($conn);
					}

				}
				else {
					$data['status'] =		'FAILURE';
					$data['message']=		'Please enter the post title';
					$data['error']	=		'ERROR '.mysqli_error($conn);
				}

				$db->close($conn);
				return $data;

		}

// =============================== Update Post By slug =================================================

		public function updatePostById($slug, $dataArray) {
				$data  				=		array();
				$db 				=		new DBController();
				$conn 				=		$db->connect();

				$title 				=		mysqli_real_escape_string($conn, $dataArray['title']);
				$slug				=		str_replace(' ', '-', strtolower($title));
				$slug               =       preg_replace('/[^A-Za-z0-9\-]/', '', $slug);
				$slug               =       preg_replace('/-+/', '-', $slug);

				$description 		=		mysqli_real_escape_string($conn, $dataArray['description']);
				$featured 			=		$dataArray['featured'];
				$status 			=		$dataArray['status'];

				if(isset($title) && ($title!="")) {
					if(is_numeric($featured)) {
						$sql 			=		"UPDATE post SET title = '".$title."', slug = '".$slug."', description = '".$description."', featured = '".$featured."', status = '".$status."' WHERE slug = '".$dataArray['slug']."' ";
						$result  		=	$conn->query($sql);
						if($result) {
							$data['status']   =  "SUCCESS";
							$data['message']  =  "Post successfully updated";
						}
						else {
							$data['status']   =  "FAILURE";
							$data['message']  =  "Failed to update due to server error";
							$data['error']    =   "ERROR ! ".mysqli_error($conn);
						}
					}

					else {
						$data['status']       =  "FAILURE";
						$data['message']      =  "Featured value should be an integer(0-1)";
						$data['error']    	  =  "ERROR ! ".mysqli_error($conn);
					}

				}
				else {
					$data['status'] =		'FAILURE';
					$data['message']=		'Please enter the post title';
					$data['error']	=		'ERROR '.mysqli_error($conn);
				}

				$db->close($conn);
				return $data;

		}



	// ============================  Delete Post By Id ========================================

		public function deletePostById($id) {
			$data 					=			array();
			$db 					=			new DBController();
			$conn 					=			$db->connect();

			if(isset($id) && ($id != "")) {
				$sql 				=			"DELETE FROM post WHERE id = '".$id."' ";
				$result 			=			$conn->query($sql);
				if($result) {
					$data['status']  =          "SUCCESS";
					$data['message'] = 			"Post deleted successfully";
				}
				else {
					$data['status']  =           "FAILURE";
					$data['message'] =           "Failed to delete due to server error";
					$data['error']   =           "ERROR ! ".mysqli_error($conn);
				}
			}
			else {
				$data['status']      =           "FAILURE";
				$data['message']     =           "Please enter the Post id to delete the post";
			}

			$db->close($conn);
			return $data;
			
		}


	}

?>