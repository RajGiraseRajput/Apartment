<?php include('../header_owner.php');
include(ROOT_PATH.'language/'.$lang_code_global.'/lang_owner_fund_details.php');
include(ROOT_PATH.'language/'.$lang_code_global.'/lang_common.php');
if(!isset($_SESSION['objLogin'])){
	header("Location: " . WEB_URL . "logout.php");
	die();
}
?>
<!-- Content Header (Page header) -->

<section class="content-header">
  <h1> <?php echo $_data['text_1'];?> </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo WEB_URL?>dashboard.php"><i class="fa fa-dashboard"></i> <?php echo $_data['home_breadcam'];?></a></li>
    <li class="active"><?php echo $_data['text_1'];?></li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
<!-- Full Width boxes (Stat box) -->
<div class="row">
  <div class="col-xs-12">
    <div align="right" style="margin-bottom:1%;"> <a class="btn btn-primary" data-toggle="tooltip" href="<?php echo WEB_URL; ?>o_dashboard.php" data-original-title="<?php echo $_data['owner_dashboard'];?>"><i class="fa fa-dashboard"></i></a> </div>
    <div class="box box-danger">
      <div class="box-header">
        <h3 class="box-title"><?php echo $_data['text_1'];?></h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table class="table sakotable table-bordered table-striped dt-responsive">
          <thead>
            <tr>
              <th><?php echo $_data['image'];?></th>
              <th><?php echo $_data['text_2'];?></th>
              <th><?php echo $_data['text_3'];?></th>
              <th><?php echo $_data['text_4'];?></th>
              <th><?php echo $_data['text_5'];?></th>
              <th><?php echo $_data['text_6'];?></th>
              <th><?php echo $_data['text_7'];?></th>
              <th><?php echo $_data['action_text'];?></th>
            </tr>
          </thead>
          <tbody>
        <?php
		$result = mysql_query("Select *,ow.o_name,ow.image,m.month_name,y.xyear as y_xyear from tbl_add_fund fu inner join tbl_add_owner ow on ow.ownid = fu.owner_id inner join tbl_add_month_setup m on m.m_id = fu.month_id inner join tbl_add_year_setup y on y.y_id = fu.xyear order by fund_id desc",$link);
				while($row = mysql_fetch_array($result)){
					$image = WEB_URL . 'img/no_image.jpg';	
					if(file_exists(ROOT_PATH . '/img/upload/' . $row['image']) && $row['image'] != ''){
						$image = WEB_URL . 'img/upload/' . $row['image'];
					}
				?>
            <tr>
            <td><img class="photo_img_round" style="width:50px;height:50px;" src="<?php echo $image;  ?>" /></td>
            <td><?php echo $row['o_name']; ?></td>
            <td><?php echo $row['month_name']; ?></td>
            <td><?php echo $row['y_xyear']; ?></td>
            <td><?php echo $row['f_date']; ?></td>
			<td><?php echo $row['total_amount'].' '.CURRENCY; ?></td>
            <td><?php echo $row['purpose']; ?></td>
            <td>
            <a class="btn btn-success" data-toggle="tooltip" href="javascript:;" onclick="$('#nurse_view_<?php echo $row['fund_id']; ?>').modal('show');" data-original-title="Details View"><i class="fa fa-eye"></i></a>
            <div id="nurse_view_<?php echo $row['fund_id']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header orange_header">
                    <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>
                    <h3 class="modal-title"><?php echo $_data['text_8'];?></h3>
                  </div>
                  <div class="modal-body model_view" align="center">&nbsp;
                    <div><img class="photo_img_round" style="width:100px;height:100px;" src="<?php echo $image;  ?>" /></div>
                    <div class="model_title"><?php echo $row['o_name']; ?></div>
                  </div>
				  <div class="modal-body">
                    <h3 style="text-decoration:underline;"><?php echo $_data['details_information'];?></h3>
                    <div class="row">
                      <div class="col-xs-6"> 
					    <b><?php echo $_data['text_2'];?> :</b> <?php echo $row['o_name']; ?><br/>
                        <b><?php echo $_data['text_3'];?> :</b> <?php echo $row['month_name'];?><br/>
                      </div>
                      
                      <div class="col-xs-6"> 
                        <b><?php echo $_data['text_9'];?> :</b> <?php echo $row['total_amount'].' '.CURRENCY;?><br/>
                        <b><?php echo $_data['text_10'];?> :</b> <?php echo $row['f_date']; ?><br/>
                      </div>
                      
                    </div>
                  </div>
				  
                </div>
                <!-- /.modal-content -->
              </div>
            </div>
            </td>
            </tr>
            <?php } mysql_close($link); ?>
          </tbody>
          <tfoot>
            <tr>
              <th>Image</th>
              <th>Owner Name</th>
              <th>Month</th>
              <th>Year</th>
              <th>Date</th>
              <th>Amount</th>
              <th>Purpose</th>
              <th>Action</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
<script type="text/javascript">
function deleteOwnerUtility(Id){
  	var iAnswer = confirm("Are you sure you want to delete this delete Owner Utility ?");
	if(iAnswer){
		window.location = '<?php echo WEB_URL; ?>owner_utility/owner_utility_list.php?id=' + Id;
	}
  }
  
  $( document ).ready(function() {
	setTimeout(function() {
		  $("#me").hide(300);
		  $("#you").hide(300);
	}, 3000);
});
</script>
<?php include('../footer.php'); ?>
