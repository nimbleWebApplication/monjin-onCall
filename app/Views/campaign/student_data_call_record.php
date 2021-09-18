<?= view('home/dash_header'); 
	use App\models\HomeModel;
	use App\Models\CampaignStudent;
	use App\Models\UserModel;
	// print_r($student);
?>

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
						<li class="breadcrumb-item active">Data on call</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>
	<section>		
		<!-- Main content -->
		<div class="content">
			<div class="container">
				<div class="row">
					<div class="col-8">
						<div class="card">
							<div class="card-header">
								<div class="row"> 
								<div class="col-10">
									<h3 class="card-title"><b>Call History - <?php echo $student[0]['student_name']; ?></b></h3>
								</div>
								<div class="col-2" style="text-align: right;">
									<span class="btn btn-primary btn-sm">
										<i class="fa fa-file-excel" aria-hidden="true">  Export</i>
									</span>
								</div>
								</div>
							</div>
							<!-- /.card-header -->
							<div class="card-body table-responsive p-0">
								<table class="table table-responsive table-head-fixed text-nowrap table-striped table-bordered">
									<thead>
										<tr>
											<th style="width: 1%;text-align: center;">#</th>
											<th>Date</th>
											<th>Action</th>
											<th>Remark</th>
											<th>Action By</th>
										</tr>					
									</thead>
									<tbody>   
										<?php if(empty($dataCall)) { ?>
											<tr><td colspan="5" style="color: red;font-size: large;font-weight: bold;text-align: center;">No Records Found...!!</td></tr>
										<?php } else{ $i=0; foreach(array_reverse($dataCall) as $data_call) { 
											$call_person = (new UserModel())->where(array('user_id'=>$data_call['call_createdBy']))->findAll();
										?>										
											<tr>
												<td><?= ++$i;?></td>
												<td><?= $data_call['call_createdon']; ?></td>
												<td><?= $data_call['call_status']; ?></td>
												<td><?= $data_call['call_remark']; ?></td>
												<td><?= $call_person[0]['user_firstName']." ".$call_person[0]['user_lastName']; ?></td>
											</tr>
										<?php } } ?>			
									</tbody>
								</table>
							</div>              
							<!-- /.card-body -->
						</div>
						<!-- /.card -->
					</div>
					<div class="col-4">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title"><b>New History Details</b></h3>
							</div>
							<!-- /.card-header -->
							<form role="form" id="" method="post" action="<?= site_url('campaign/student_data_calls/'.service('uri')->getSegment(3).''); ?>">
								<div class="card-body p-0" >
									<div class="card-body">
										<div class="row hidden">
											<div class="col-sm-12">
												<!-- text input -->
												<div class="form-group">
													<label>Student Id <span class="mandatory"> * </span></label> 
													<input type="text" name="student_id" class="form-control" readonly="" value="<?php echo $student[0]['student_id']; ?>">
												</div>
											</div>
										</div>
										
										<div class="row">
											<div class="col-sm-12">
												<!-- text input -->
												<div class="form-group">
													<label>Candidate response <span class="mandatory"> * </span></label> 
													<select name="call_status" class="form-control">
														<option>Please Select</option>
														<option value="CC">Candidate Confirm</option>
														<option value="CBL">Call Back Later</option>
														<option value="CNI">Candidate Not Interested</option>
														<option value="CNR">Candidate Not Responding</option>
														<option value="CNA">Candidate Not Available</option>
														<option value="ER">Erroneous Name / Mobile / Emai</option>
													</select>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-sm-12">
												<!-- text input -->
												<div class="form-group">
													<label>Remark <span class="mandatory"> * </span></label> 
													<textarea class="form-control" placeholder="Action Remark ..." name="call_remark"></textarea>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- /.card-body -->
								<div class="card-footer" style="text-align: right;">
									<button type="submit" class="btn btn-primary btn-sm">Add History</button>
									<button type="reset" class="btn btn-default btn-sm">Reset</button>
								</div>
							</form>             
							<!-- /.card-body -->
						</div>
						<!-- /.card -->
					</div>
				</div>
				<!-- /.row -->
			</div><!-- /.container-fluid -->
		</div>
	<!-- /.content -->

	</section>
</div>

<?= view('campaign/footer'); ?>