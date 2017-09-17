<?php include("includes/connection.php");
 	  include("includes/function.php"); 	
	
	$file_path = 'http://'.$_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']).'/';
 	 
	if(isset($_GET['cat_list']))
 	{
 		$jsonObj= array();
		
		$cat_order=API_CAT_ORDER_BY;


		$query="SELECT cid,category_name FROM tbl_category ORDER BY tbl_category.".$cat_order."";
		$sql = mysqli_query($mysqli,$query)or die(mysql_error());

		while($data = mysqli_fetch_assoc($sql))
		{ 
			$row['cid'] = $data['cid'];
			$row['category_name'] = $data['category_name'];
  
			array_push($jsonObj,$row);
		
		}

		$set['ONLINE_MP3'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
 	}
	else if(isset($_GET['cat_id']))
	{
		$post_order_by=API_CAT_POST_ORDER_BY;

		$cat_id=$_GET['cat_id'];	

		$jsonObj= array();	
	
	    $query="SELECT * FROM tbl_mp3
		LEFT JOIN tbl_category ON tbl_mp3.cat_id= tbl_category.cid 
		where tbl_mp3.cat_id='".$cat_id."' AND tbl_mp3.status='1' ORDER BY tbl_mp3.id ".$post_order_by."";

		$sql = mysqli_query($mysqli,$query)or die(mysqli_error());

		while($data = mysqli_fetch_assoc($sql))
		{
			$row['id'] = $data['id'];
			$row['cat_id'] = $data['cat_id'];
			$row['mp3_type'] = $data['mp3_type'];
			$row['mp3_title'] = $data['mp3_title'];
			$row['mp3_url'] = $data['mp3_url'];
 			
			 
			$row['mp3_thumbnail_b'] = $file_path.'images/'.$data['mp3_thumbnail'];
			$row['mp3_thumbnail_s'] = $file_path.'images/thumbs/'.$data['mp3_thumbnail'];
			 
			$row['mp3_duration'] = $data['mp3_duration'];
			$row['mp3_artist'] = $data['mp3_artist'];
			$row['mp3_description'] = $data['mp3_description'];

			$row['cid'] = $data['cid'];
			$row['category_name'] = $data['category_name'];
			 

			array_push($jsonObj,$row);
		
		}

		$set['ONLINE_MP3'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();

		
	}	 
	else if(isset($_GET['latest']))
	{
		//$limit=$_GET['latest'];	 

		$limit=API_LATEST_LIMIT;

		$jsonObj= array();	
   
		$query="SELECT * FROM tbl_mp3
		LEFT JOIN tbl_category ON tbl_mp3.cat_id= tbl_category.cid 
		WHERE tbl_mp3.status='1' ORDER BY tbl_mp3.id DESC LIMIT $limit";

		$sql = mysqli_query($mysqli,$query)or die(mysqli_error());

		while($data = mysqli_fetch_assoc($sql))
		{
			$row['id'] = $data['id'];
			$row['cat_id'] = $data['cat_id'];
			$row['mp3_type'] = $data['mp3_type'];
			$row['mp3_title'] = $data['mp3_title'];
			$row['mp3_url'] = $data['mp3_url'];
 			
			 
			$row['mp3_thumbnail_b'] = $file_path.'images/'.$data['mp3_thumbnail'];
			$row['mp3_thumbnail_s'] = $file_path.'images/thumbs/'.$data['mp3_thumbnail'];
			 
			$row['mp3_duration'] = $data['mp3_duration'];
			$row['mp3_artist'] = $data['mp3_artist'];
			$row['mp3_description'] = $data['mp3_description'];

			$row['cid'] = $data['cid'];
			$row['category_name'] = $data['category_name'];
			 

			array_push($jsonObj,$row);
		
		}

		$set['ONLINE_MP3'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();

	} 
	else if(isset($_GET['mp3_id']))
	{
		  
				 
		$jsonObj= array();	

		 
		$query="SELECT * FROM tbl_mp3
		LEFT JOIN tbl_category ON tbl_mp3.cat_id= tbl_category.cid 
		WHERE tbl_mp3.id='".$_GET['mp3_id']."' AND tbl_mp3.status='1'";

		$sql = mysqli_query($mysqli,$query)or die(mysqli_error());

		while($data = mysqli_fetch_assoc($sql))
		{
			$row['id'] = $data['id'];
			$row['cat_id'] = $data['cat_id'];
			$row['mp3_type'] = $data['mp3_type'];
			$row['mp3_title'] = $data['mp3_title'];
			$row['mp3_url'] = $data['mp3_url'];
 			
			 
			$row['mp3_thumbnail_b'] = $file_path.'images/'.$data['mp3_thumbnail'];
			$row['mp3_thumbnail_s'] = $file_path.'images/thumbs/'.$data['mp3_thumbnail'];
			 
			$row['mp3_duration'] = $data['mp3_duration'];
			$row['mp3_artist'] = $data['mp3_artist'];
			$row['mp3_description'] = $data['mp3_description'];

			$row['cid'] = $data['cid'];
			$row['category_name'] = $data['category_name'];
			 

			array_push($jsonObj,$row);
		
		}
 

		$set['ONLINE_MP3'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();	
 

	}
	else if(isset($_GET['artist_list']))
 	{
 		$jsonObj= array();
		
		$cat_order=API_CAT_ORDER_BY;


		$query="SELECT id,artist_name,artist_image FROM tbl_artist ORDER BY tbl_artist.id";
		$sql = mysqli_query($mysqli,$query)or die(mysql_error());

		while($data = mysqli_fetch_assoc($sql))
		{
			 

			$row['id'] = $data['id'];
			$row['artist_name'] = $data['artist_name'];
			$row['artist_image'] = $file_path.'images/'.$data['artist_image'];
			$row['artist_image_thumb'] = $file_path.'images/thumbs/'.$data['artist_image'];
 
			array_push($jsonObj,$row);
		
		}

		$set['ONLINE_MP3'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
 	}
 	else if(isset($_GET['artist_name']))
	{
		$post_order_by=API_CAT_POST_ORDER_BY;

		$artist_name=$_GET['artist_name'];	

		$jsonObj= array();	
	
	    $query="SELECT * FROM tbl_mp3
		LEFT JOIN tbl_category ON tbl_mp3.cat_id= tbl_category.cid
 		WHERE tbl_mp3.mp3_artist LIKE '%".$artist_name."%' AND tbl_mp3.status='1' ORDER BY tbl_mp3.id DESC";

		$sql = mysqli_query($mysqli,$query)or die(mysqli_error());

		while($data = mysqli_fetch_assoc($sql))
		{
			$row['id'] = $data['id'];
			$row['cat_id'] = $data['cat_id'];
			$row['mp3_type'] = $data['mp3_type'];
			$row['mp3_title'] = $data['mp3_title'];
			$row['mp3_url'] = $data['mp3_url'];
 			
			 
			$row['mp3_thumbnail_b'] = $file_path.'images/'.$data['mp3_thumbnail'];
			$row['mp3_thumbnail_s'] = $file_path.'images/thumbs/'.$data['mp3_thumbnail'];
			 
			$row['mp3_duration'] = $data['mp3_duration'];
			$row['mp3_artist'] = $data['mp3_artist'];
			$row['mp3_description'] = $data['mp3_description'];

			$row['cid'] = $data['cid'];
			$row['category_name'] = $data['category_name'];
			 

			array_push($jsonObj,$row);
		
		}

		$set['ONLINE_MP3'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();

		
	}	  	 
	else 
	{
		$jsonObj= array();	

		$query="SELECT * FROM tbl_settings WHERE id='1'";
		$sql = mysqli_query($mysqli,$query)or die(mysqli_error());

		while($data = mysqli_fetch_assoc($sql))
		{
			 
			$row['app_name'] = $data['app_name'];
			$row['app_logo'] = $data['app_logo'];
			$row['app_version'] = $data['app_version'];
			$row['app_author'] = $data['app_author'];
			$row['app_contact'] = $data['app_contact'];
			$row['app_email'] = $data['app_email'];
			$row['app_website'] = $data['app_website'];
			$row['app_description'] = $data['app_description'];
 			$row['app_developed_by'] = $data['app_developed_by'];

			$row['app_privacy_policy'] = $data['app_privacy_policy'];
	

			array_push($jsonObj,$row);
		
		}

		$set['ONLINE_MP3'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();	
	}		
	 
	 
?>