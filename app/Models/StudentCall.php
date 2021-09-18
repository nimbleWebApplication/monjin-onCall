<?php 
	namespace App\Models;
	use CodeIgniter\Model;

	class StudentCall extends Model
	{		
		protected $table = "jinlms_student_call";
		protected $primaryKey = 'call_id';

    	protected $returnType     = 'array';
		protected $allowedFields = ['call_student_id','call_status','call_remark','call_createdBy','call_isDelete','call_createdon'];
	}
?>