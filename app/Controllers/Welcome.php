<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Welcome extends CI_Controller {

   public function index(){
      $token = $this->get_access_token();
      $rowperpage = 10;
      $rowno = $this->input->get('rowno');;
      if($rowno != 0){
         $rowno = ($rowno-1) * $rowperpage;
      }else{
         $rowno = 0;
      }
      $strt = $rowno+1;
      $limit = $rowno+10;
      // print_r($limit);die();

      $total_records = $this->fetch_count();
      // print_r($total_records);die();
      $job_data = $this->callAPI('GET', 'https://api.monjin.com/f/22/1/1/list/published-job?sort=-createdOn', $token,$strt,$limit);
      $data['response'] = json_decode($job_data, true);
      $config = $this->pagination();
      $config['base_url'] = site_url('Welcome');
      $config['query_string_segment'] = 'rowno';
      $config['page_query_string'] = TRUE;
      $config['use_page_numbers'] = TRUE;
      $config['total_rows'] = $total_records;
      $config['per_page'] = $rowperpage;
      $this->pagination->initialize($config);
      $data['row'] = $rowno;
      $data['pagination'] = $this->pagination->create_links();

      // print_r($data['pagination']);die();
      $this->load->view('welcome_message',$data);
   }

   public function job_details($key){
      if(isset($_GET['s'])){
          switch($_GET['s']) {
              case 'l':
                $data['sourceType'] = 'linkedin';
                break;
              case 'm':
                $data['sourceType'] = 'link';
                break;
              default:
                $data['sourceType'] = 'website';
            }
        }else{
            $data['sourceType'] = 'website';
        }
      $data['flash']['active'] = $this->session->flashdata('active');
      $data['flash']['title'] = $this->session->flashdata('title');
      $data['flash']['text'] = $this->session->flashdata('text');
      $data['flash']['type'] = $this->session->flashdata('type');
      $token = $this->get_access_token();
      $strt = 1;
      $limit = 10;
      $filter_data = $this->callAPI('GET', 'https://api.monjin.com/f/22/1/1/list/published-job?filter=code['.$key.']', $token,$strt,$limit);
      $data['response'] = json_decode($filter_data, true);
      $this->load->view('job_details',$data);
   }

   public function callAPI($method, $url, $data,$strt,$limit)
   {
      $curl = curl_init();
      switch ($method){
         case "GET":
            if ($data)
               curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                  "Accept: application/json",
                  "Authorization: Bearer ".$data."",
                  "Range: items=".$strt."-".$limit.""
               ));
            break;
         default:
      }
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
      $result = curl_exec( $curl );
      curl_setopt( $curl, CURLOPT_CONNECTTIMEOUT, 15);
      curl_setopt( $curl, CURLOPT_TIMEOUT, 15);
      $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
      // EXECUTE:
      if(!$result){
         echo json_encode(array(
         'success' => false,
         'error' => array(
            'msg' => "Error while retrieving the published-job.",
            'code' => $httpCode,
            ),
         ));
      }
      curl_close($curl);
      return $result;
   }

   public function fetch_count()
   {
      $token = $this->get_access_token();

      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.monjin.com/f/22/1/1/list/published-job?sort=-createdOn",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_HEADER=> true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
          "Accept: application/json",
          "Authorization: Bearer ".$token."",
          "Range: items=1-10"
        ),

      ));
      $response = curl_exec($curl);
      $header_size = curl_getinfo($curl,CURLINFO_HEADER_SIZE);
      $headers = substr($response,0, $header_size);
      $body = substr($response, $header_size);
      $err = curl_error($curl);

      curl_close($curl);
      $start_str = strpos("".$headers."","items") + 5;
      $end_str = (strpos("".$headers."","Server")-2)-$start_str;
      $value = substr($headers, $start_str,$end_str);
      $total = substr($value,(strpos("".$value."","/")+1),(strlen($value)-strpos("".$value."","/")));

      if ($err) {
        echo "cURL Error #:" . $err;
      } else {
        return $total;
        // echo $value."<br>";
        // echo strlen($value)."<br>"
      }
   }

   public function apply_job()
   {
      $strt = 1;
      $limit = 10;
      $token = $this->get_access_token();
      $job_details = $this->callAPI('GET', 'https://api.monjin.com/f/22/1/1/list/published-job?filter=code['.$this->input->post('stud_jdCode').']', $token,$strt,$limit);
      $job = json_decode($job_details,true);
      $data = array(
               "firstName" => "".$this->input->post('stud_first')."",
               "lastName" => "".$this->input->post('stud_last')."",
               "email" => "".$this->input->post('stud_email')."",
               "jobDescriptionId" => $job[0]['id'],
               "dialCode" => "".$this->input->post('stud_code')."",
               "contactNumber" => "".$this->input->post('stud_contact')."",
               "apexBusinessModelId" => $job[0]['apexBusinessModelId'],
               "sourceType" => "".$this->input->post('stud_SourceType').""
            );
      $payload = json_encode($data);
      $curl = curl_init();
      curl_setopt_array($curl, array(
         CURLOPT_URL => "https://api.monjin.com/a/22/".$job[0]['aId']."/1/".$job[0]['scId']."/Itv/Invite",
         CURLOPT_RETURNTRANSFER => true,
         CURLOPT_CUSTOMREQUEST => "POST",
         CURLOPT_POSTFIELDS => "[".$payload."]",
         CURLOPT_HTTPHEADER => array(
            "Authorization:Bearer ".$token."",
            "Content-Type: application/json",
        ),
      ));

      $response = curl_exec($curl);
      $err = curl_error($curl);

      curl_close($curl);

      if ($err) {
        echo "cURL Error #:" . $err;
      }
      $status = json_decode($response,true);
      if(array_key_exists('code', $status[0]) == 1){
            redirect('https://uni.monjin.com/public/invitations/'.$status[0]['code'].'');
        }else{
         $this->session->set_flashdata('active',1);
         $this->session->set_flashdata('title',"");
         $this->session->set_flashdata('text',"".strip_tags($status[0]['infoList'][0]['Info']).";");
         $this->session->set_flashdata('type',"warning");
         redirect('Welcome/job_details/'.$this->input->post('stud_jdCode').'');
      }
   }

   private function get_access_token() {
      // $curl = curl_init('https://auth-int.monj.in/connect/token');
      $curl = curl_init('https://auth.monjin.com/connect/token');
      curl_setopt( $curl, CURLOPT_POST, true );
      curl_setopt( $curl, CURLOPT_POSTFIELDS, array(
         'client_id' => '871cf94a-d4a0-4ee6-8906-674c055e777f',
         'client_secret' => '046e1da8-d424-42ef-aec5-402e62b63714',
         'scope' => 'MonjinApi',
         'grant_type' => 'client_credentials'
      ));
      curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1);
      $oauth = curl_exec( $curl );
      curl_setopt( $curl, CURLOPT_CONNECTTIMEOUT, 15);
      curl_setopt( $curl, CURLOPT_TIMEOUT, 15);
      $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
      curl_close($curl);
      if (!($httpCode >= 200 & $httpCode < 300)) {
         echo json_encode(array(
         'success' => false,
         'error' => array(
            'msg' => "Error while retrieving the access token.",
            'code' => $httpCode,
            ),
         ));
      }
      $secret = json_decode($oauth);
      return trim($secret->access_token);
   }

   public function pagination()
   {
      $config['full_tag_open'] = "<ul class='pagination'>";
      $config['full_tag_close'] = '</ul>';
      $config['num_tag_open'] = '<li>';
      $config['num_tag_close'] = '</li>';
      $config['cur_tag_open'] = '<li class="active"><a href="#">';
      $config['cur_tag_close'] = '</a></li>';
      $config['prev_tag_open'] = '<li>';
      $config['prev_tag_close'] = '</li>';
      $config['first_tag_open'] = '<li>';
      $config['first_tag_close'] = '</li>';
      $config['last_tag_open'] = '<li>';
      $config['last_tag_close'] = '</li>';

      // $config['next_link'] = 'Next Page';
      $config['next_tag_open'] = '<li>';
      $config['next_tag_close'] = '</li>';

      // $config['prev_link'] = 'Previous Page';
      $config['prev_tag_open'] = '<li>';
      $config['prev_tag_close'] = '</li>';
      return $config;
      }



}?>
