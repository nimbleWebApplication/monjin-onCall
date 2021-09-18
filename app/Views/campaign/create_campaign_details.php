<?= view('home/dash_header'); 
	use App\models\HomeModel;
	use App\models\UserModel;
?>

<style type="text/css">
	.btn-play{
		color: #f7992b;
    	border-color: #f7992b;
	}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<!-- <h1>General Form</h1> -->
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= site_url('home') ?>">Home</a></li>
						<li class="breadcrumb-item active">Campaign</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row" id="import_profiles" style="display: none;">
				<div class="col-md-12">
					<!-- general form elements disabled -->
					<div class="card card-primary">
						<div class="card-header">
							<h3 class="card-title">Create Campaign</h3>
						</div>
						<!-- /.card-header -->
						<form role="form" id="createCampaign" method="post" action="<?= site_url('campaign/campaign_details'); ?>">
							<div class="card-body">
								<div class="row">
									<div class="col-sm-4">
										<!-- text input -->
										<div class="form-group">
											<label>Campaign Name <span class="mandatory"> * </span></label>
											<input type="text" class="form-control" placeholder="Enter campaign name ..." name="campaign_name">
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label>Select Co- ordinator <span class="mandatory"> * </span></label>
											<select class="form-control" name="campaign_co_ordinator">
												<option value="" disabled="" selected="">Please Select</option>
											<?php if($co_user) { foreach($co_user as $cokey){ ?>
												<option value="<?php echo $cokey['user_id']; ?>"><?php echo $cokey['user_firstName']." ".$cokey['user_lastName'];?> </option>
											<?php }	} ?>
											</select>
										</div>									
									</div>
									<div class="col-sm-4">
										<!-- text input -->
										<div class="form-group">
											<label>Campaign Schedule <span class="mandatory"> * </span></label>
											<input type="date" placeholder="Enter Campaign Schedule" class="form-control datepicker" name="campaign_schedule" required="true">
										</div>
									</div>
								</div>
							</div>
							<!-- /.card-body -->
							<div class="card-footer">
								<button type="submit" class="btn btn-primary">Create Campaign</button>
								<button type="reset" class="btn btn-default">Reset</button>
							</div>
						</form>
					</div>
					<!-- /.card -->
				</div>
			</div>
			<!-- /.row -->
			<div class="row">
				<div class="col-md-12">
					<!-- general form elements disabled -->
					<div class="card card-default">
						<div class="card-header">
							<h3 class="card-title">Campaign Details</h3>
							<div class="card-tools">
								<span class="btn btn-primary btn-sm" id="import_users"><i class="fas fa-plus fa-sm"></i> New Campaign</span>
							</div>							
						</div>						
						<!-- /.card-header -->
						<div class="card-body">
							<form>
								<div class="row">
									<div class="col-sm-4 hidden"></div>
									<div class="col-sm-2">
										<label>Select Co- ordinator <span class="mandatory"> * </span></label>
										<select class="form-control" name="co_user">
											<option value="" disabled="" selected="">Please Select</option>
											<?php if($co_user) { foreach($co_user as $cokey){ ?>
												<option value="<?php echo $cokey['user_id']; ?>"><?php echo $cokey['user_firstName']." ".$cokey['user_lastName'];?> </option>
											<?php }	} ?>
										</select>
									</div>
									<div class="col-sm-2">
										<label>Start Date<span class="mandatory"> * </span></label>	
										<input type="date" name="start_date" class="form-control">	
									</div>
									<div class="col-sm-2">
										<label>End Date<span class="mandatory"> * </span></label>	
										<input type="date" name="end_date" class="form-control">
									</div>
									<div class="col-sm-2"><span class="btn btn-primary btn-sm"  style="margin-top:18%">Search</span></div>
								</div>
							</form> 
						</div>
						<table class="table table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>Campaign</th>
									<th>Co-ordinator</th>
									<th>Schedule</th>
									<th>Status</th>
									<th></th>
									<th style="text-align: center;">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1; foreach (array_reverse($campaign) as $key) {
										if($key['campaign_synchronise'] == 3){  ?>
											<tr style="background-color: #a0e69873;">
										<?php }else { ?>
												<tr style="background-color: #eae7e75e;">
										<?php }	?>

								
										<td><?= $i++; ?></td>
										<td><a href="<?= site_url('campaign/import_data/'.$key['campaign_id'].''); ?>"><?php echo $key['campaign_name']; ?></a></td>
										<td><?php
											$co_user=(new UserModel())->where(array('user_id'=>$key['campaign_co_ordinator'],'user_isDelete'=> 0))->findAll();
											//print_r($co_user);
											echo $co_user[0]['user_firstName'].' '.$co_user[0]['user_lastName'];
										?></td>
										<td><?= $key['campaign_schedule']; ?></td>
										<td>
										<?php 
																			
											$total=(new HomeModel())->getData(array('student_campaign_id'=>$key['campaign_id'],'student_isDelete'=>0),'jinlms_campaign_student');
											$suceess=(new HomeModel())->getData(array('student_campaign_id'=>$key['campaign_id'],'student_isDelete'=>0,'student_status'=>1),'jinlms_campaign_student');
											$failed=(new HomeModel())->getData(array('student_campaign_id'=>$key['campaign_id'],'student_isDelete'=>0,'student_status'=>2),'jinlms_campaign_student');
											$reschedule=(new HomeModel())->getData(array('student_campaign_id'=>$key['campaign_id'],'student_isDelete'=>0,'student_status'=>3),'jinlms_campaign_student');
											echo "Total : ".count($total);
											echo " | Sucess : ".count($suceess);
											echo "<br>Failed : ".count($failed);
											echo " | Reschedule : ".count($reschedule);
										
										?>
											
										</td>
										<td></td>
										<td>
										<?php
										if(count($total) == 0){ ?>
											<i class="fa fa-view btn-play fa-lg" title="Synchronize with Exotel" aria-hidden="true"></i>
										<?php }else { if($key['campaign_synchronise'] == 1){ ?>
											<i class="fa fa-play btn-play fa-lg" aria-hidden="true"></i>
										<?php }else if($key['campaign_synchronise'] == 0) {?>
											<i class="fa fa-sync btn-play fa-lg" title="Synchronize with Exotel" aria-hidden="true"></i>
										<?php } }?>
											
										<?php  ?>

										</td>
										
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
					<!-- /.card -->
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?= view('campaign/footer'); ?>