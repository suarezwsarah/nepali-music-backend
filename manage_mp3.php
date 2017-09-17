<?php include("includes/header.php");

	require("includes/function.php");
	require("language/language.php");

	
	   //Get all mp3 
	
      $tableName="tbl_mp3";   
      $targetpage = "manage_mp3.php"; 
      $limit = 10; 
      
      $query = "SELECT COUNT(*) as num FROM $tableName";
      $total_pages = mysqli_fetch_array(mysqli_query($mysqli,$query));
      $total_pages = $total_pages['num'];
      
      $stages = 3;
      $page=0;
      if(isset($_GET['page'])){
      $page = mysqli_real_escape_string($mysqli,$_GET['page']);
      }
      if($page){
        $start = ($page - 1) * $limit; 
      }else{
        $start = 0; 
        } 
      
     $quotes_qry="SELECT * FROM tbl_mp3
                  LEFT JOIN tbl_category ON tbl_mp3.cat_id= tbl_category.cid 
                  ORDER BY tbl_mp3.id DESC LIMIT $start, $limit";
 
     $result=mysqli_query($mysqli,$quotes_qry); 
	 

  if(isset($_GET['mp3_id']))
  {

    $img_res=mysqli_query($mysqli,'SELECT * FROM tbl_mp3 WHERE id='.$_GET['mp3_id'].'');
    $img_res_row=mysqli_fetch_assoc($img_res);
           
    if($img_res_row['mp3_thumbnail']!="")
     {
          unlink('images/thumbs/'.$img_res_row['mp3_thumbnail']);
          unlink('images/'.$img_res_row['mp3_thumbnail']);

          unlink($img_res_row['mp3_url']);
      }
 
    Delete('tbl_mp3','id='.$_GET['mp3_id'].'');
    
    $_SESSION['msg']="12";
    header( "Location:manage_mp3.php");
    exit;
    
  }

  //Active and Deactive status
if(isset($_GET['status_deactive_id']))
{
   $data = array('status'  =>  '0');
  
   $edit_status=Update('tbl_mp3', $data, "WHERE id = '".$_GET['status_deactive_id']."'");
  
   $_SESSION['msg']="14";
   header( "Location:manage_mp3.php");
   exit;
}
if(isset($_GET['status_active_id']))
{
    $data = array('status'  =>  '1');
    
    $edit_status=Update('tbl_mp3', $data, "WHERE id = '".$_GET['status_active_id']."'");
    
    $_SESSION['msg']="13";   
    header( "Location:manage_mp3.php");
    exit;
}  

?>
                
    <div class="row">
      <div class="col-xs-12">
        <div class="card mrg_bottom">
          <div class="page_title_block">
            <div class="col-md-5 col-xs-12">
              <div class="page_title">Manage Mp3</div>
            </div>
            <div class="col-md-7 col-xs-12">
              <div class="search_list">
                
                <div class="add_btn_primary"> <a href="add_mp3.php">Add Mp3</a> </div>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="row mrg-top">
            <div class="col-md-12">
               
              <div class="col-md-12 col-sm-12">
                <?php if(isset($_SESSION['msg'])){?> 
               	 <div class="alert alert-success alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                	<?php echo $client_lang[$_SESSION['msg']] ; ?></a> </div>
                <?php unset($_SESSION['msg']);}?>	
              </div>
            </div>
          </div>
          <div class="col-md-12 mrg-top">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>                  
                  <th>Category</th>
                  <th>Title</th>
                  <th>Status</th>
                   <th class="cat_action_list">Action</th>
                </tr>
              </thead>
              <tbody>
              	<?php	
						$i=0;
						while($row=mysqli_fetch_array($result))
						{					
				?>
                <tr>                 
                  <td><?php echo $row['category_name'];?></td>
                  <td><?php echo $row['mp3_title'];?></td>
                  <td>
                  <?php if($row['status']!="0"){?>
                  <a href="manage_mp3.php?status_deactive_id=<?php echo $row['id'];?>" title="Change Status"><span class="badge badge-success badge-icon"><i class="fa fa-check" aria-hidden="true"></i><span>Enable</span></span></a>

                  <?php }else{?>
                  <a href="manage_mp3.php?status_active_id=<?php echo $row['id'];?>" title="Change Status"><span class="badge badge-danger badge-icon"><i class="fa fa-check" aria-hidden="true"></i><span>Disable </span></span></a>
                  <?php }?>
                  </td>
                   <td><a href="edit_mp3.php?mp3_id=<?php echo $row['id'];?>" class="btn btn-primary">Edit</a>
                    <a href="?mp3_id=<?php echo $row['id'];?>" class="btn btn-default" onclick="return confirm('Are you sure you want to delete this song?');">Delete</a></td>
                </tr>
                <?php
						
						$i++;
				     	}
				?> 
              </tbody>
            </table>
          </div>
           <div class="col-md-12 col-xs-12">
            <div class="pagination_item_block">
              <nav>
                <?php include("pagination.php");?>                 
              </nav>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
        
<?php include("includes/footer.php");?>       
