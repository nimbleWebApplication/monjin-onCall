<?php
require APPPATH . 'libraries/REST_Controller.php';
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\HomeModel;
use App\Models\Campaign;
use App\Models\CampaignStudent;
use App\Models\StudentCall;
     
class Campaign_REST extends REST_Controller {

	 https://fba268a787c817b6ef8f45cd8d46f5c4265f5ea2dc7ceaf8:a4f2b3c5eff362665742ef63847219969c8467cef8ad73d9<subdomain>/v2/accounts/<your_sid>/campaigns

	public function synchronize_campaign(){
		$curl = curl_init();
		$accountSid = "monjin1";
		$apiKey = "fba268a787c817b6ef8f45cd8d46f5c4265f5ea2dc7ceaf8";
		$apiToken = "a4f2b3c5eff362665742ef63847219969c8467cef8ad73d9";
		$encoding = base64_encode($apiKey .":". $apiToken);
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://api.exotel.com/v2/accounts/".$accountSid."/campaigns",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => '{
                "campaigns": [{
                "name": "Nimble Test Campaign",
				"type":"trans",
				"call_duplicate_numbers": true,
                "url": "http://my.exotel.com/monjin1/exoml/start_voice/389833",
              	"caller_id": "0XXXXXXXXX1",
			    "lists": [ListSid2],
				"schedule": {"send_at": "2011-08-27T14:20:00+05:30"},
				"status_callback": "https://mycallback.sampledomain.in/1gvta9f1",
				"call_status_callback": "https://mycallback.sampledomain.in/1gvta9f1"}]}',
			  CURLOPT_HTTPHEADER => array(
			    "Authorization: Basic ".$encoding,
			    "Content-Type: application/json"
			  ),
			));
		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);
		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  echo $response;
		}
	}
	public function play_campaign(){
	}

}



