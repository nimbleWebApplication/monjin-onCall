<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use \App\Models\HomeModel;

class Home extends Controller
{
	function index()
	{
		return redirect()->route('login');
	}

	public function login_details()
	{
		$data = [];
		helper(['form']);

		$data = [
			"success" => session()->getFlashdata('success'),
			"error" => session()->getFlashdata('error'),
			"info" => session()->getFlashdata('info'),
		];

		if (isset($_GET['q'])) {
			$verify = (new HomeModel())->getData(array('links_verifi_code'=>$this->request->getGet('q'),'links_isDelete'=>0),'jinlms_user_login_links');
			if (!empty($verify)) {
				$user_log_check = (new HomeModel())->getData(array('user_id'=>$verify[0]['links_user_id']),'jinlms_user_session');
				if(empty($user_log_check) && date('Y-m-d') > date('Y-m-d', strtotime('+7 day',strtotime($verify[0]['links_gen_date'])))){					
					session()->setFlashdata('info','Sorry, this link is not valid.');
					return redirect()->to('login');
				}
			}
		}

		if($this->request->getMethod() == 'post'){
			// let's do the validation rule
			$rules = [
				'user_email' => 'required|valid_email',
				'user_password' => 'required|validateUser[user_email,user_password]',
			];

			$errors = [
				'user_password' => [
					'validateUser' => "Email or Password don't match"
				],
			];
			// session()->setFlashdata('error',`Email or Password don't match`);

			if($this->validate($rules, $errors)){
				$data['validation'] = $this->validator;
			}else{
				$home = new HomeModel();
				$user = $home->where(array('user_email'=>$this->request->getVar('user_email')))
							->first();
				$this->setUserSession($user);
				session()->setFlashdata('success','Welcome to Monjin eLMS');
				if (session()->get('role_id') == 1) {
					return redirect()->to('campaign/campaign_details');
				}else if(session()->get('role_id') == 2) {
					return redirect()->to('campaign/campaign_details');
				}else if(session()->get('role_id') == 3) {
					return redirect()->to('campaign/campaign_details');
				}else if(session()->get('role_id') == 4) {
					return redirect()->to('campaign/campaign_details');
				}else if(session()->get('role_id') == 5) {
					return redirect()->to('campaign/campaign_details');
					// return redirect()->to('program/avilable_programs');
				}
			}	
		}			
		// print_r($this->request->getVar());die();
		return view('home/signIn', $data);
	}

	private function setUserSession($user)
	{
		$data = [
			'id'=>$user['user_id'],
			'role_id'=>$user['user_role_id'],
			'language'=>'eng',
			'isLoggedIn'=>true,
		];
		session()->set($data);
		$agent = $this->request->getUserAgent();
		$user_session = [
			'user_id' => $user['user_id'],
			'islogedinn' => 1,
			'ip_address' => $this->request->getIPAddress(),
			'login_time' => date('Y-m-d H:i:s'),
			'os' => $agent->getPlatform(),
			'hash' => password_hash("".date('Y-m-d-H:i:s')."_".$user['user_id']."_".$this->request->getIPAddress()."_".$agent->getPlatform()."", PASSWORD_DEFAULT),
		];
		(new HomeModel())->insertData($user_session,'jinlms_user_session');
		return true;
	}

	function dashboard()
	{	
		$home = new HomeModel();
		$data = [
			"success"=>session()->getFlashdata('success'),
			"user" => (new HomeModel())->where(array('user_id'=>session()->get('id'),'user_isDelete'=> 0))->findAll(),			
		];
		// print_r($data['success']);die();
		return view('home/dashboard', $data);
	}

	public function logout()
	{
		session()->destroy();
		session()->setFlashdata('info','Thank You..!');
		return redirect()->route('login');
	}

}
