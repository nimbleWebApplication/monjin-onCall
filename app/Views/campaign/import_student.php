<?= view('home/dash_header'); 
	use App\models\HomeModel;
	use App\models\UserModel;
	use App\models\StudentCall;
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
						<li class="breadcrumb-item"><a href="<?= site_url('campaign/campaign_details') ?>">Campaign</a>
						</li>
						<li class="breadcrumb-item active">Import</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row" id="import_profiles" style="display: none">
				<div class="col-md-12">
					<!-- general form elements disabled -->
					<div class="card card-default">
						<div class="card-header">
							<h3 class="card-title">Import Campaign Data</h3>
						</div>
						<!-- /.card-header -->
						<form role="form" id="createProfile" method="post" action="<?= site_url('campaign/import_data/'.service('uri')->getSegment(3).''); ?>" enctype="multipart/form-data">
							<div class="card-body">
								<div class="row">
									<div class="col-sm-2 hidden">
										<label>Campaign <span class="mandatory"> * </span></label>
										<input type="text" name="campaign_id" class="form-control" readonly="" value="<?= service('uri')->getSegment(3);?>">
									</div>
									<div class="col-sm-3">
										<!-- text input -->
										<label>Select Excel File <span class="mandatory"> * </span></label>
										<div class="form-group">
						                    <div class="custom-file">
						                      <input type="file" class="custom-file-input" id="customFile" name="user_file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
						                      <label class="custom-file-label" for="customFile">Choose file</label>
						                    </div>
						                </div>							
									</div>
									
									<div class="col-sm-3">
										<div class="form-group">
											<button type="submit" class="btn btn-primary btn-sm" style="margin-top: 30px;">Import</button>
										</div>
									</div>
								</div>
							</div>
								<!-- /.card-body -->
						</form>
					</div>
					<!-- /.card -->
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<!-- general form elements disabled -->
					<div class="card card-default">
						<div class="card-header">
							<?php 
							$c_details=(new HomeModel())->getData(array('campaign_id'=>service('uri')->getSegment(3),'campaign_isDelete'=>0),'jinlms_campaign');
							$co_user=(new UserModel())->where(array('user_id'=>$c_details[0]['campaign_co_ordinator'],'user_isDelete'=> 0))->findAll();

							?>
							<h3 class="card-title">Campaign / Client - <b><?= $c_details[0]['campaign_name'];?> </b> | Co-ordinator - <b><?php echo $co_user[0]['user_firstName'].' '.$co_user[0]['user_lastName'];?></b></h3>
							<div class="card-tools">
								<?php ?>
					            <span class="btn btn-primary btn-sm" id="import_users"><i class="fas fa-plus fa-sm"></i>
					            <?php 
					            $total=(new HomeModel())->getData(array('student_campaign_id'=>service('uri')->getSegment(3),'student_isDelete'=>0),'jinlms_campaign_student');
					            if(count($total) == 0 )
					            	echo " Add Data";
					            else
					            	echo " Append Data";
					            ?>
					            </span>
				            </div>							
						</div>
						<!-- /.card-header -->
						<!-- .card-body -->
						<div class="card-body">
							<form>
								<div class="row">
									<div class="col-sm-4 hidden"></div>
									<div class="col-sm-2 hidden">
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
						<!-- /.card-body -->

						<table class="table table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>Candidates Details</th>
									<th>Interviewer Details</th>
									<th>Campaign Status</th>
									<th>Outcome</th>
									<th>Job Description</th>
									<th>Interview Schedule</th>
									<th style="text-align: center;">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $i=1;foreach (array_reverse($campaign) as $key) { 
									//echo $key['student_id'];
									$student = (new HomeModel())->getData(array('user_id'=>$key['user_vendor_id']),'jinlms_user');
									$stud_call=(new HomeModel())->getData(array('call_student_id'=>$key['student_id'],'call_isDelete'=>0),'jinlms_student_call');

									//(new StudentCall())->where(array('call_student_id'=>$key['student_id'],'call_isDelete'=>0));
									//print_r($stud_call);
									//count($stud_call);
									$r= count($stud_call);

								?>
								<tr>
									<td><?= $i++; ?></td>
									<td><?= $key['student_name']."<br>".$key['student_email'].'<br>'.$key['student_contact'].'  <i class="fa fa-phone btn-play fa-sm" aria-hidden="true"></i> <br>'.$key['student_ref_code'];?></td>	
									<td></td>
									<td>
										<?php if($key['student_status'] == 0) {
											echo "Processing "; 
										}else if($key['student_status'] == 1) { 
											echo "Interested and confirmed"; 
										} else if($key['student_status'] == 2) { 
											echo "Not Interested and confirmed"; 
										} else if($key['student_status'] == 3) { 
											echo "Rescheduling required"; 
										} else { 
											echo "Invalid"; 
										} ?>
									</td>
									<td>
										<?php 
											echo $stud_call[$r-1]['call_status']; 
										 ?>
									</td>
									<td></td>
									<td><?= $key['student_schedule_date']; ?></td>
									<td style="text-align: center;">
										<!-- <span class="btn btn-icon btn-xs"><i class="fa fa-trash-alt" title="Delete Profile"></i></span> -->

										<!-- <span class="btn btn-icon btn-xs"><i class="fa fa-unlock-alt" title="Change Password"></i></span> -->
										<a href="<?php echo site_url('campaign/student_data_calls/'.$key["student_id"].'')?>">
											<span class="btn btn-icon btn-sm"><i class="fas fa-headset fa-sm" title="Data on Call"></i></span>
										</a>
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
<?= view('campaign/footer'); ?>