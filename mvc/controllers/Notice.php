<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notice extends Admin_Controller {
/*
| -----------------------------------------------------
| PRODUCT NAME: 	INILABS SCHOOL MANAGEMENT SYSTEM
| -----------------------------------------------------
| AUTHOR:			INILABS TEAM
| -----------------------------------------------------
| EMAIL:			info@inilabs.net
| -----------------------------------------------------
| COPYRIGHT:		RESERVED BY INILABS IT
| -----------------------------------------------------
| WEBSITE:			http://inilabs.net
| -----------------------------------------------------
*/
	function __construct() {
		parent::__construct();
		$this->load->model("notice_m");
		$this->load->model("alert_m");
		$language = $this->session->userdata('lang');
		$this->lang->load('notice', $language);
	}

	public function index() {
		$schoolyearID = $this->session->userdata("defaultschoolyearID");
		$this->data['notices'] = $this->notice_m->get_order_by_notice(array('schoolyearID' => $schoolyearID));
		$this->data["subview"] = "notice/index";
		$this->load->view('_layout_main', $this->data);

	}

	protected function rules() {
		$rules = array(
				 array(
					'field' => 'title',
					'label' => $this->lang->line("notice_title"),
					'rules' => 'trim|required|xss_clean|max_length[128]'
				),
				array(
					'field' => 'date',
					'label' => $this->lang->line("notice_date"),
					'rules' => 'trim|required|max_length[10]|xss_clean|callback_date_valid'
				),
                array(
                    'field' => 'photo',
                    'label' => $this->lang->line("notice_photo"),
                    'rules' => 'trim|max_length[200]|xss_clean|callback_photoupload'
                ),
				array(
					'field' => 'notice',
					'label' => $this->lang->line("notice_notice"),
					'rules' => 'trim|required|xss_clean'
				)
			);
		return $rules;
	}

    public function photoupload() {
        $id = htmlentities(escapeString($this->uri->segment(3)));
        $notice = array();
        if((int)$id) {
            $notice = $this->notice_m->get_notice($id);
        }

        $new_file = "holiday.png";
        if($_FILES["photo"]['name'] !="") {
            $file_name = $_FILES["photo"]['name'];
            $random = rand(1, 10000000000000000);
            $makeRandom = hash('sha512', $random.$this->input->post('title') . config_item("encryption_key"));
            $file_name_rename = $makeRandom;
            $explode = explode('.', $file_name);
            if(count($explode) >= 2) {
                $new_file = $file_name_rename.'.'.end($explode);
                $config['upload_path'] = "./uploads/images";
                $config['allowed_types'] = "gif|jpg|png";
                $config['file_name'] = $new_file;
                $config['max_size'] = '4096';
                $config['max_width'] = '10000';
                $config['max_height'] = '10000';
                $this->load->library('upload', $config);
                if(!$this->upload->do_upload("photo")) {
                    $this->form_validation->set_message("photoupload", $this->upload->display_errors());
                    return FALSE;
                } else {
                    $this->upload_data['file'] =  $this->upload->data();
                    return TRUE;
                }
            } else {
                $this->form_validation->set_message("photoupload", "Invalid file");
                return FALSE;
            }
        } else {
            if(count($notice)) {
                $this->upload_data['file'] = array('file_name' => $notice->photo);
                return TRUE;
            } else {
                $this->upload_data['file'] = array('file_name' => $new_file);
                return TRUE;
            }
        }
    }

    public function add() {
		$this->data['headerassets'] = array(
			'css' => array(
				'assets/datepicker/datepicker.css',
				'assets/editor/jquery-te-1.4.0.css'
			),
			'js' => array(
				'assets/editor/jquery-te-1.4.0.min.js',
				'assets/datepicker/datepicker.js'
			)
		);

		if($_POST) {
            $rules = $this->rules();
            $this->form_validation->set_rules($rules);
			if ($this->form_validation->run() == FALSE) {
				$this->data['form_validation'] = validation_errors();
				$this->data["subview"] = "notice/add";
				$this->load->view('_layout_main', $this->data);
			} else {
				$array = array(
					"title" => $this->input->post("title"),
					"notice" => $this->input->post("notice"),
					"photo"  => $this->upload_data['file']['file_name'],
					'schoolyearID' =>  $this->data['siteinfos']->school_year,
					"date" => date("Y-m-d", strtotime($this->input->post("date")))
				);
                $this->notice_m->insert_notice($array);
				$this->session->set_flashdata('success', $this->lang->line('menu_success'));
				redirect(base_url("notice/index"));
			}
		} else {
			$this->data["subview"] = "notice/add";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function edit() {
		$this->data['headerassets'] = array(
			'css' => array(
				'assets/datepicker/datepicker.css',
				'assets/editor/jquery-te-1.4.0.css'
			),
			'js' => array(
				'assets/editor/jquery-te-1.4.0.min.js',
				'assets/datepicker/datepicker.js'
			)
		);
		$schoolyearID = $this->session->userdata('defaultschoolyearID');
		$id = htmlentities(escapeString($this->uri->segment(3)));
		if((int)$id) {
			$this->data['notice'] = $this->notice_m->get_single_notice(array('noticeID' => $id, 'schoolyearID' => $schoolyearID));
			if($this->data['notice']) {
				if($_POST) {
					$rules = $this->rules();
					$this->form_validation->set_rules($rules);
					if ($this->form_validation->run() == FALSE) {
						$this->data["subview"] = "notice/edit";
						$this->load->view('_layout_main', $this->data);
					} else {
						$array = array(
							"title" => $this->input->post("title"),
							"notice" => $this->input->post("notice"),
							"date" => date("Y-m-d", strtotime($this->input->post("date")))
						);

                        $array['photo'] = $this->upload_data['file']['file_name'];

						$this->notice_m->update_notice($array, $id);
						$this->session->set_flashdata('success', $this->lang->line('menu_success'));
						redirect(base_url("notice/index"));
					}
				} else {
					$this->data["subview"] = "notice/edit";
					$this->load->view('_layout_main', $this->data);
				}
			} else {
				$this->data["subview"] = "error";
				$this->load->view('_layout_main', $this->data);
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function view() {
		$schoolyearID = $this->session->userdata('defaultschoolyearID');
		$id = htmlentities(escapeString($this->uri->segment(3)));
		if((int)$id) {
			$this->data['notice'] = $this->notice_m->get_single_notice(array('noticeID' => $id, 'schoolyearID' => $schoolyearID));
			if($this->data['notice']) {
				$alert = $this->alert_m->get_alert_by_notic($id);
				if(!count($alert)) {
					$array = array(
						"noticeID" => $id,
						"username" => $this->session->userdata("username"),
						"usertype" => $this->session->userdata("usertype")
					);
					$this->alert_m->insert_alert($array);
					$this->data["subview"] = "notice/view";
					$this->load->view('_layout_main', $this->data);
				} else {
					$this->data["subview"] = "notice/view";
					$this->load->view('_layout_main', $this->data);
				}
			} else {
				$this->data["subview"] = "error";
				$this->load->view('_layout_main', $this->data);
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function delete() {
		$schoolyearID = $this->session->userdata('defaultschoolyearID');
		$id = htmlentities(escapeString($this->uri->segment(3)));
		if((int)$id) {
			$this->data['notice'] = $this->notice_m->get_single_notice(array('noticeID' => $id, 'schoolyearID' => $schoolyearID));
			if($this->data['notice']) {
				$this->notice_m->delete_notice($id);
				$this->session->set_flashdata('success', $this->lang->line('menu_success'));
				redirect(base_url("notice/index"));
			} else {
				redirect(base_url("notice/index"));
			}
		} else {
			redirect(base_url("notice/index"));
		}
	}

	function date_valid($date) {
		if(strlen($date) <10) {
			$this->form_validation->set_message("date_valid", "%s is not valid dd-mm-yyyy");
	     	return FALSE;
		} else {
	   		$arr = explode("-", $date);
	        $dd = $arr[0];
	        $mm = $arr[1];
	        $yyyy = $arr[2];
	      	if(checkdate($mm, $dd, $yyyy)) {
	      		return TRUE;
	      	} else {
	      		$this->form_validation->set_message("date_valid", "%s is not valid dd-mm-yyyy");
	     		return FALSE;
	      	}
	    }
	}

	public function print_preview() {
		$schoolyearID = $this->session->userdata('defaultschoolyearID');
		$id = htmlentities(escapeString($this->uri->segment(3)));
		if((int)$id) {
			$this->data['notice'] = $this->notice_m->get_single_notice(array('noticeID' => $id, 'schoolyearID' => $schoolyearID));
			if($this->data['notice']) {
			    $this->data['panel_title'] = $this->lang->line('panel_title');
				$this->printView($this->data, 'notice/print_preview');
			} else {
				$this->data["subview"] = "error";
				$this->load->view('_layout_main', $this->data);
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function send_mail() {
		$schoolyearID = $this->session->userdata('defaultschoolyearID');
		$id = $this->input->post('id');
		if ((int)$id) {
			$this->data['notice'] = $this->notice_m->get_single_notice(array('noticeID' => $id, 'schoolyearID' => $schoolyearID));
			if($this->data['notice']) {
				$email = $this->input->post('to');
				$subject = $this->input->post('subject');
				$message = $this->input->post('message');

				$this->viewsendtomail($this->data['notice'], 'notice/print_preview', $email, $subject, $message);
			} else {
				$this->data["subview"] = "error";
				$this->load->view('_layout_main', $this->data);
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}

	}

    /**
     *
     */
}

/* End of file notice.php */
/* Location: .//D/xampp/htdocs/school/mvc/controllers/notice.php */
