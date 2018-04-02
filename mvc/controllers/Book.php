<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Book extends Admin_Controller {
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
		$this->load->model("book_m");
		$language = $this->session->userdata('lang');
		$this->lang->load('book', $language);	
	}

	public function index() {
		$this->data['books'] = $this->book_m->get_order_by_book();
		$this->data["subview"] = "book/index";
		$this->load->view('_layout_main', $this->data);
	}

	protected function rules() {
		$rules = array(
				array(
					'field' => 'book', 
					'label' => $this->lang->line("book_name"), 
					'rules' => 'trim|required|xss_clean|max_length[60]|callback_unique_book'
				), 
				array(
					'field' => 'author', 
					'label' => $this->lang->line("book_author"),
					'rules' => 'trim|required|max_length[100]|xss_clean|callback_unique_book'
				), 
				array(
					'field' => 'subject_code', 
					'label' => $this->lang->line("book_subject_code"),
					'rules' => 'trim|required|max_length[20]|xss_clean|callback_unique_book'
				),
				array(
					'field' => 'price', 
					'label' => $this->lang->line("book_price"),
					'rules' => 'trim|required|numeric|max_length[10]|xss_clean|callback_valid_number'
				), 
				array(
					'field' => 'quantity', 
					'label' => $this->lang->line("book_quantity"), 
					'rules' => 'trim|required|numeric|max_length[10]|xss_clean|callback_valid_number_for_quantity'
				),
				array(
					'field' => 'rack', 
					'label' => $this->lang->line("book_rack_no"), 
					'rules' => 'trim|required|max_length[60]|xss_clean'
				),
                array(
                    'field' => 'pdf_book',
                    'label' => $this->lang->line("pdf_book"),
                    'rules' => 'trim|callback_file_upload'
                )
			);
		return $rules;
	}

    public function file_upload() {
        $id = htmlentities(escapeString($this->uri->segment(3)));
        $book = array();
        if((int)$id) {
            $book = $this->book_m->get_book($id);
        }

        $new_file = "default.pdf";
        if($_FILES['pdf_book']['name'] !="") {
            $file_name = $_FILES['pdf_book']['name'];
            $random = rand(1, 10000000);
            $makeRandom = hash('sha512', $random.$this->input->post('title') . config_item("encryption_key"));
            $file_name_rename = $makeRandom;
            $explode = explode('.', $file_name);
            if(count($explode) >= 2) {
                $new_file = $file_name_rename.'.'.end($explode);
                $config['upload_path'] = "./uploads/books";
                $config['allowed_types'] = "pdf|x-pdf";
                $config['file_name'] = $new_file;
//                $config['max_size'] = '999999999';
                $this->load->library('upload', $config);
                if(!$this->upload->do_upload("pdf_book")) {
                    $this->form_validation->set_message("file_upload", $this->upload->display_errors());
                    return FALSE;
                } else {
                    $this->upload_data['file'] =  $this->upload->data();
                    return TRUE;
                }
            } else {
                $this->form_validation->set_message("file_upload", "Invalid file");
                return FALSE;
            }
        } else {
            if(count($book)) {
                $this->upload_data['file'] = array('file_name' => $book->pdf_book);
                return TRUE;
            } else {
                $this->upload_data['file'] = array('file_name' => $new_file);
                return TRUE;
            }
        }
    }

    public function add() {

		if($_POST) {
			$rules = $this->rules();
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run() == FALSE) {
				$this->data["subview"] = "book/add";
				$this->load->view('_layout_main', $this->data);			
			} else {
				$array = array(
					"book" => $this->input->post("book"),
					"author" => $this->input->post("author"),
					"subject_code" => $this->input->post("subject_code"),
					"price" => $this->input->post("price"),
					"quantity" => $this->input->post("quantity"),
					"due_quantity" => 0,
					"rack" => $this->input->post("rack"),
                    "pdf_book" => $this->upload_data['file']['file_name']
				);
				$this->book_m->insert_book($array);
				$this->session->set_flashdata('success', $this->lang->line('menu_success'));
				redirect(base_url("book/index"));
			}
		} else {
			$this->data["subview"] = "book/add";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function edit() {
		$id = htmlentities(escapeString($this->uri->segment(3)));
		if((int)$id) {
			$this->data['book'] = $this->book_m->get_book($id);
			if($this->data['book']) {
				if($_POST) {
					$rules = $this->rules();
					$this->form_validation->set_rules($rules);
					if ($this->form_validation->run() == FALSE) {
						$this->data['form_validation'] = validation_errors(); 
						$this->data["subview"] = "book/add";
						$this->load->view('_layout_main', $this->data);			
					} else {
						$array = array(
							"book" => $this->input->post("book"),
							"author" => $this->input->post("author"),
							"subject_code" => $this->input->post("subject_code"),
							"price" => $this->input->post("price"),
							"quantity" => $this->input->post("quantity"),
							"rack" => $this->input->post("rack"),
                            "pdf_book" => $this->upload_data['file']['file_name']
                        );
						$this->book_m->update_book($array, $id);
						$this->session->set_flashdata('success', $this->lang->line('menu_success'));
						redirect(base_url("book/index"));
					}
				} else {
					$this->data["subview"] = "book/edit";
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
		$id = htmlentities(escapeString($this->uri->segment(3)));
		if((int)$id) {
			$book = $this->book_m->get_book($id);
			if(count($book)) {
				$this->book_m->delete_book($id);
				$this->session->set_flashdata('success', $this->lang->line('menu_success'));
				redirect(base_url("book/index"));
			} else {
				redirect(base_url("book/index"));
			}
		} else {
			redirect(base_url("book/index"));
		}
	}

	public function unique_book() {
		$id = htmlentities(escapeString($this->uri->segment(3)));
		if((int)$id) {
			$student = $this->book_m->get_order_by_book(array("book" => $this->input->post("book"), "bookID !=" => $id, "author" => $this->input->post('author'), "subject_code" => $this->input->post('subject_code')));
			if(count($student)) {
				$this->form_validation->set_message("unique_book", "%s already exists");
				return FALSE;
			}
			return TRUE;
		} else {
			$student = $this->book_m->get_order_by_book(array("book" => $this->input->post("book"), "author" => $this->input->post('author'), "subject_code" => $this->input->post('subject_code')));

			if(count($student)) {
				$this->form_validation->set_message("unique_book", "%s already exists");
				return FALSE;
			}
			return TRUE;
		}	
	}

	function valid_number() {
		if($this->input->post('price') && $this->input->post('price') < 0) {
			$this->form_validation->set_message("valid_number", "%s is invalid number");
			return FALSE;
		}
		return TRUE;
	}

	function valid_number_for_quantity() {
		if($this->input->post('quantity') && $this->input->post('quantity') < 0) {
			$this->form_validation->set_message("valid_number_for_quantity", "%s is invalid number");
			return FALSE;
		}
		return TRUE;
	}
}

/* End of file book.php */
/* Location: .//D/xampp/htdocs/school/mvc/controllers/book.php */