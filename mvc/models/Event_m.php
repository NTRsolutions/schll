<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event_m extends MY_Model {

	protected $_table_name = 'event';
	protected $_primary_key = 'eventID';
	protected $_primary_filter = 'intval';

	function __construct() {
		parent::__construct();
	}

	function get_event($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}

	function get_order_by_event($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}

	function get_single_event($array) {
        $query = parent::get_single($array);
        return $query;
    }

	function insert_event($array) {
		$error = parent::insert($array);
		return TRUE;
	}

	function update_event($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	public function delete_event($id){
		parent::delete($id);
	}

    function get_last_events() {
        $query = $this->db->order_by('fdate', 'asc')->get('event', 3);
        return $query->result();
    }

}

/* End of file holiday_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/holiday_m.php */
