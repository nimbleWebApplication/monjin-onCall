<?php 
	namespace App\Controllers;
	use CodeIgniter\Controller;
	use App\Models\HomeModel;
	use App\Models\CampaignStudent;
	use App\Models\StudentCall;
	use PHPExcel;
	use PHPExcel_IOFactory;
	
	class Campaign extends Controller
	{
		function create_campaign_details()
		{
			$data = [
				'success' => session()->getFlashdata('success'),
				'info' => session()->getFlashdata('info'),
				'error' => session()->getFlashdata('error'),
				"user" => (new HomeModel())->where(array('user_id'=>session()->get('id'),'user_isDelete'=> 0))->findAll(),
				"campaign" => (new HomeModel())->getData(array('campaign_isDelete'=>0),'jinlms_campaign'),
				 "co_user" => (new HomeModel())->where(array('user_role_id'=>3,'user_isDelete'=> 0))->findAll(),
			];

			if($this->request->getMethod() == 'post'){
				$campaign = [
					'campaign_name' => $this->request->getVar('campaign_name'),
					'campaign_schedule' => $this->request->getVar('campaign_schedule'),
					'campaign_co_ordinator' => $this->request->getVar('campaign_co_ordinator'),
					'campaign_createdon' => date('Y-m-d H:i:s'),
					'campaign_synchronise' => 0,
				];
				(new HomeModel())->insertData($campaign,'jinlms_campaign');
				session()->setFlashdata('success','Campaign successfully created..!');
				return redirect()->route('campaign/campaign_details');
			}
			return view('campaign/create_campaign_details', $data);
		}

		public function import_data()
		{
			helper('text');
			$home = new HomeModel();
			$data = [
				"success" => session()->getFlashdata('success'),
				"error" => session()->getFlashdata('error'),
				"info" => session()->getFlashdata('info'),
				"user" => (new HomeModel())->where(array('user_id'=>session()->get('id'),'user_isDelete'=> 0))->findAll(),
		        "campaign" => $home->getData(array('student_isDelete'=>0,'student_campaign_id'=>service('uri')->getSegment(3)),'jinlms_campaign_student'),
		      
			];

			if($this->request->getMethod() == 'post'){				

				$file = $this->request->getFile('user_file');

				echo $co_user = $this->request->getVar('co_user');
				echo $campaign_id = $this->request->getVar('campaign_id'); //die();

				if($file){
					$excelReader  = new PHPExcel();
					//mengambil lokasi temp file
					$fileLocation = $file->getTempName();
					//baca file
					$objPHPExcel = PHPExcel_IOFactory::load($fileLocation);
					$sheet	= $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
					$insertedRows = 0;
					$duplicateRows = 0;
					$rejectedRows = 0;

					//print_r($sheet); die();
					foreach ($sheet as $key => $data) {
						// skip
						if ($key == 1) {
							continue;
						}
						// $check_user = (new UserModel())->where(array('user_email'=>$data['D'],'user_isDelete'=>0))->findAll();
						// if ($data['D'] == $check_user[0]['user_email']) {
						// 	// print_r($check_user);
						// 	$duplicateRows++;
						// 	continue;
						// }
						
						//$random_pwd = random_string('alnum', 8);
						$userRecords = [
							'student_campaign_id' => $campaign_id,
							'student_ref_code' => $data['B'],
							'student_name' => $data['A'],
							'student_contact' => $data['C'],
							'student_email' => $data['D'],
							'student_schedule_date' => $data['E'],
							'student_isDelete' => 0,
							'student_createdon' =>date('Y-m-d H:i:s'),
						];
						print_r($userRecords);
						//die();
						(new HomeModel())->insertData($userRecords,'jinlms_campaign_student');
						// 	$random_code = "".random_string('alnum', 32)."%20".random_string('alnum', 16)."%20".random_string('alnum', 8)."";
						// 	$validUser = [
						// 		'links_user_id' => (new HomeModel())->insertID(),
						// 		'links_verifi_code' => $random_code,
						// 		'links_gen_date' => date('Y-m-d'),
						// 	];
						// 	if((new HomeModel())->insertData($validUser,'jinlms_user_login_links')){
						// 		$message = "Dear ".$data['B'].", <br>url:<a href='".base_url()."/login?q=".$random_code."' target='_blank'>".base_url()."/login?q=".$random_code."</a><br>UN : ".$data['D']." <br>PW : ".$random_pwd."<br><br>Thanks & Regards, <br> Monjin eLMS";
						// 		(new HomeModel())->sendMail($data['D'],"Account Login Details",$message,'');
						// 	}
						// }else{
						// 	$rejectedRows++;
						// }
					}
				}
				session()->setFlashdata('info',"".$insertedRows." Records inserted successfully.");
				// return redirect()->route('campaign/import_data');
				return redirect()->to(service('uri')->getSegment(3));
			}
			return view('campaign/import_student', $data);
		}


		function student_data_call_records()
		{
			// print_r((service('uri'))->getSegment(2));
			$data = [
				"success" => session()->getFlashdata('success'),
				"error" => session()->getFlashdata('error'),
				"info" => session()->getFlashdata('info'),
				"user" => (new HomeModel())->where(array('user_id'=>session()->get('id'),'user_isDelete'=> 0))->findAll(),
				"dataCall" => (new HomeModel())->getData(array('call_isDelete'=>0,'call_student_id'=>service('uri')->getSegment(3)),'jinlms_student_call'),
				"student" => (new HomeModel())->getData(array('student_isDelete'=>0,'student_id'=>service('uri')->getSegment(3)),'jinlms_campaign_student'),
			];

			if($this->request->getMethod() == 'post'){
				$student_id = $this->request->getVar('student_id');
				$dataCall = [					
					'call_student_id' => $this->request->getVar('student_id'),
					'call_status' => $this->request->getVar('call_status'),
					'call_remark' => $this->request->getVar('call_remark'),
					'call_createdBy' => session()->get('id'),
					'call_createdon' => date('Y-m-d H:i:s'),
				];
				//print_r($dataCall);die();
				(new StudentCall())->insert($dataCall);
				session()->setFlashdata('success','Data Call Updated...!!');
				return redirect()->to(service('uri')->getSegment(3));
			}
			return view('campaign/student_data_call_record',$data);
		}
	}
?>