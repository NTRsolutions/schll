<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class studentrelation_m extends MY_Model {

	protected $_table_name = 'studentrelation';
	protected $_primary_key = 'studentrelationID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "studentrelationID desc";
	

	function __construct() {
		parent::__construct();
	}

	function get_studentrelation_join_student($arrays = array(), $single = FALSE) {
		$reArray = array();
		if(count($arrays)) {
			foreach ($arrays as $key => $array) {
				$reArray['studentrelation.'.$key] = $array; 		
			}
		}

		$this->db->select('*');
		$this->db->from('studentrelation');
		$this->db->join('student', 'student.studentID = studentrelation.srstudentID', 'LEFT');
		if(count($arrays)) {
			$this->db->where($arrays);
		}
		$query = $this->db->get();

		if($single) {
			return $query->row();
		} else {
			return $query->result();
		}

	}	
	
	function update_studentrelation_with_multicondition($array, $multiCondition) {
		$this->db->update($this->_table_name, $array, $multiCondition);
	}

	function get_studentrelation($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}

	function get_order_by_studentrelation($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}

	function get_single_studentrelation($array=NULL) {
		$query = parent::get_single($array);
		return $query;
	}

	function insert_studentrelation($array) {
		$error = parent::insert($array);
		return $error;
	}

	function update_studentrelation($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	public function delete_studentrelation($id){
		parent::delete($id);
	}
}

/* End of file invoice_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/invoice_m.php */