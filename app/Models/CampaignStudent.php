<?php 
	namespace App\Models;
	use CodeIgniter\Model;

	class CampaignStudent extends Model
	{		
		protected $table = "jinlms_campaign_student";
		protected $primaryKey = 'student_id';

    	protected $returnType     = 'array';
		protected $allowedFields = ['student_campaign_id','student_ref_code','student_name','student_contact','student_email','student_schedule_date','	student_isDelete','student_createdon'];
	}
?>