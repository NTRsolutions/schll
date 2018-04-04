<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Frontend extends Frontend_Controller {
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

    protected $_pageName;
    protected $_templateName;

    function __construct() {
        parent::__construct();
        $this->load->model('pages_m');
        $this->load->model('media_gallery_m');
        $this->load->model('slider_m');
        $this->load->model('event_m');
        $this->load->model('notice_m');
        $this->load->model('user_m');
        $this->load->model('book_m');
        $this->load->model('teacher_m');
        $this->load->library('session');
        $this->load->helper('form');

    }

    public function page() {
        $url = htmlentities(escapeString($this->uri->segment(3)));
        if($url) {

            if($url == 'login') {
                redirect(base_url('signin/index'));
            }

            $pages = $this->pages_m->get_pages();
            $page = $this->pages_m->get_single_pages(array('url' => $url));
            $featured_image = array();

            if(count($page)) {

                if(!empty($page->featured_image)) {
                    $featured_image = $this->media_gallery_m->get_single_media_gallery(array('media_galleryID' => $page->featured_image));
                }   

                $last_events    = $this->event_m->get_last_events();
                $last_news      = $this->notice_m->get_last_news();
                $team           = $this->user_m->get_user_by_usertype();
                $books          = $this->book_m->get_book();
                $sliders        = $this->slider_m->get_slider_join_with_media_gallery($page->pagesID);

                $this->_pageName = $page->title;
                $this->_templateName = $page->template;
                if($page->template == 'none') {
                    $this->bladeView->render('views/templates/none', compact('page', 'featured_image', 'sliders', 'last_events', 'team', 'last_news'));
                } else {
                    $this->bladeView->render('views/templates/'.$this->_templateName, compact('page', 'featured_image', 'sliders', 'last_events', 'team', 'books', 'last_news'));
                }
            } else {
                $this->_templateName = 'page404';
                $this->bladeView->render('views/templates/'.$this->_templateName);
            }
        } else {
            if(count($this->data['homepage'])) {
                $this->_templateName = 'home';

                $pages = $this->pages_m->get_pages();
                $page = $this->pages_m->get_single_pages(array('url' => $this->data['homepage']->url));
                $featured_image = array();

                if(!empty($page->featured_image)) {
                    $featured_image = $this->media_gallery_m->get_single_media_gallery(array('media_galleryID' => $page->featured_image));
                }

                $last_events = $this->event_m->get_last_events();
                $last_news      = $this->notice_m->get_last_news();

                $sliders = $this->slider_m->get_slider_join_with_media_gallery($page->pagesID);

                $this->bladeView->render('views/templates/'.$this->_templateName, compact('page', 'featured_image', 'sliders', 'last_events', 'last_news'));
            } else {
                $this->_templateName = 'homeempty';
                $this->bladeView->render('views/templates/'.$this->_templateName);
            }
        }       
    }

    function event()
    {
        $id = htmlentities(escapeString($this->uri->segment(3)));
        if((int)$id) {
            $eventView = $this->event_m->get_single_event(array('eventID' => $id));
            if(count($eventView)) {
                $this->bladeView->render('views/templates/eventview', compact('eventView'));
            } else {
                $this->_templateName = 'page404';
                $this->bladeView->render('views/templates/'.$this->_templateName);
            }
        } else {
            $this->_templateName = 'page404';
            $this->bladeView->render('views/templates/'.$this->_templateName);
        }
    }

    function eventGoing()
    {
        $status = FALSE;
        $message = '';
        $id = $this->input->post('id');

        if((int)$id) {
            if($this->session->userdata('loggedin')) {

                $event = $this->event_m->get_single_event(array('eventID' => $id));

                if(count($event)) {
                    $username = $this->session->userdata("username");
                    $usertype = $this->session->userdata("usertype");
                    $photo = $this->session->userdata("photo");
                    $name = $this->session->userdata("name");

                    $this->load->model('eventcounter_m');
                    $have = $this->eventcounter_m->get_order_by_eventcounter(array("eventID" => $id, "username" => $username, "type" => $usertype),TRUE);

                    if(count($have)) {
                        $array = array('status' => 1);
                        $this->eventcounter_m->update($array,$have[0]->eventcounterID);
                        $status = TRUE;
                        $message = 'You are add this event';
                    } else {
                        $array = array('eventID' => $id,
                            'username' => $username,
                            'type' => $usertype,
                            'photo' => $photo,
                            'name' => $name,
                            'status' => 1
                        );
                        $this->eventcounter_m->insert($array);
                        $status = TRUE;
                        $message = 'You are add this event';
                    }
                } else {
                    $message = 'Event id does not found';
                }
            } else {
                $message = 'Please login';
            }
        } else {
            $message = 'ID is not int';
        }

        $json = array(
            "message" => $message, 
            'status' => $status,
        );
        header("Content-Type: application/json", true);
        echo json_encode($json);
        exit;
    }

    function notice()
    {
        $id = htmlentities(escapeString($this->uri->segment(3)));
        if((int)$id) {
            $noticeView = $this->notice_m->get_single_notice(array('noticeID' => $id));
            if(count($noticeView)) {
                $pageName = 'noticeView';
                $this->bladeView->render('views/templates/noticeview', compact('noticeView', 'pageName'));
            } else {
                $this->_templateName = 'page404';
                $this->bladeView->render('views/templates/'.$this->_templateName);
            }
        } else {
            $this->_templateName = 'page404';
            $this->bladeView->render('views/templates/'.$this->_templateName);
        }
    }

    function teacher()
    {
        $id = htmlentities(escapeString($this->uri->segment(3)));
        if((int)$id) {
            $teacherView = $this->teacher_m->get_single_teacher(array('teacherID' => $id));
            if(count($teacherView)) {
                $pageName = 'teacherView';
                $this->bladeView->render('views/templates/teacherview', compact('teacherView', 'pageName'));
            } else {
                $this->_templateName = 'page404';
                $this->bladeView->render('views/templates/'.$this->_templateName);
            }
        } else {
            $this->_templateName = 'page404';
            $this->bladeView->render('views/templates/'.$this->_templateName);
        }
    }

    function contactMailSend() {

        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $subject = $this->input->post('subject');
        $message = $this->input->post('message');

        if($name && $email && $phone && $subject && $message) {
            $this->load->library('email');
            $this->email->set_mailtype("html");

            if(frontendData::get_backend('email')) {
                $this->email->from($email, frontendData::get_backend('sname'));
                $this->email->to(frontendData::get_backend('email'));
                $this->email->subject($phone);
                $this->email->subject($subject);
                $this->email->message($message);
                $this->email->send();
                $this->session->set_flashdata('success', 'Email send successfully!');
                echo 'success';
            } else {
                $this->session->set_flashdata('error', 'Set your email in general setting');
            }
        } else {
            $this->session->set_flashdata('error', 'oops! Email not send!');
        }
    }

    public function book_search()
    {
        $search_data = $this->input->post('search_data');

        if (empty($search_data)){
            $result = $this->book_m->get_book();
            if (!empty($result))
            {
                foreach ($result as $book):
                    echo '<div class="col-12 col-md-4">
                            <div class="single_courses item">
                                <!-- Single Courses Image Area End -->
                                <div class="single_courses_desc">
                                    <!-- Single Courses Title Area End -->
                                    <div class="title">
                                        <a href="'. base_url('uploads/books/'.$book->pdf_book) .'" target="_blank"><h5>'. $book->book .'</h5></a>
                                        <p><i class="fa fa-user" aria-hidden="true"></i> '. $book->author .'</p>
                                        <p>'. namesorting($book->subject_code, 100) .'</p>
                                    </div>
                                    <!-- Single Courses Blog Title Area End -->
                                    <div class="price_rating_area">
                                        <div class="seat">
                                                <span>
                                                    <a href="'. base_url('uploads/books/'.$book->pdf_book) .'" download>
                                                        <i class="fa fa-download" aria-hidden="true"></i>
                                                        Vəsaiti Yüklə
                                                    </a>
                                                </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
                endforeach;
            }
        }
        elseif (!empty($search_data)) {
            $result = $this->book_m->get_autocomplete($search_data);
            if (!empty($result))
            {
                foreach ($result as $book):
                    echo '<div class="col-12 col-md-4">
                            <div class="single_courses item">
                                <!-- Single Courses Image Area End -->
                                <div class="single_courses_desc">
                                    <!-- Single Courses Title Area End -->
                                    <div class="title">
                                        <a href="'. base_url('uploads/books/'.$book->pdf_book) .'" target="_blank"><h5>'. $book->book .'</h5></a>
                                        <p><i class="fa fa-user" aria-hidden="true"></i> '. $book->author .'</p>
                                        <p>'. namesorting($book->subject_code, 100) .'</p>
                                    </div>
                                    <!-- Single Courses Blog Title Area End -->
                                    <div class="price_rating_area">
                                        <div class="seat">
                                                <span>
                                                    <a href="'. base_url('uploads/books/'.$book->pdf_book) .'" download>
                                                        <i class="fa fa-download" aria-hidden="true"></i>
                                                        Vəsaiti Yüklə
                                                    </a>
                                                </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
                endforeach;
            }
            else
            {
                echo "<div class='col-12'><h5><em>Məlumat tapılmadı</em></h5></div>";
            }
        }
    }

    public function teacher_search()
    {
        $search_data = $this->input->post('search_data');

        if (empty($search_data)){
            $result = $this->teacher_m->get_teacher();
            if (!empty($result))
            {
                foreach ($result as $teacher):
                    echo '<div class="col-12 col-md-6 col-lg-4">
                                <!-- Single Blog Post Area Start -->
                                <div class="single_latest_news_area item  clearfix wow fadeInUp" data-wow-delay="0.2s">
                                    <div class="single_latest_news_img_area">
                                        <!-- Single Blog Post Image Start -->
                                        <img src="'. base_url('uploads/images/'.$teacher->photo) .'" alt="">
                                        <!-- Single Blog Post Published Date -->
                                    </div>
                                    <div class="single_latest_news_text_area">
                                        <!-- Single Blog Post Title -->
                                        <div class="news_title">
                                            <a href="'. base_url('frontend/teacher/'.$teacher->teacherID) .'"><h4>'. $teacher->name .'</h4></a>
                                            <p>'. $teacher->designation .'</p>
                                        </div>
                                        <!-- Single Blog Post excerpt -->

                                    </div>
                                </div>
                            </div>';
                endforeach;
            }
        }
        elseif (!empty($search_data)) {
            $result = $this->teacher_m->get_autocomplete($search_data);
            if (!empty($result))
            {
                foreach ($result as $teacher):
                    echo '<div class="col-12 col-md-6 col-lg-4">
                                <!-- Single Blog Post Area Start -->
                                <div class="single_latest_news_area item  clearfix wow fadeInUp" data-wow-delay="0.2s">
                                    <div class="single_latest_news_img_area">
                                        <!-- Single Blog Post Image Start -->
                                        <img src="'. base_url('uploads/images/'.$teacher->photo) .'" alt="">
                                        <!-- Single Blog Post Published Date -->
                                    </div>
                                    <div class="single_latest_news_text_area">
                                        <!-- Single Blog Post Title -->
                                        <div class="news_title">
                                            <a href="'. base_url('frontend/teacher/'.$teacher->teacherID) .'"><h4>'. $teacher->name .'</h4></a>
                                            <p>'. $teacher->designation .'</p>
                                        </div>
                                        <!-- Single Blog Post excerpt -->

                                    </div>
                                </div>
                            </div>';
                endforeach;
            }
            else
            {
                echo "<div class='col-12'><h5><em>Məlumat tapılmadı</em></h5></div>";
            }
        }
    }

    public function notice_search()
    {
        $search_data = $this->input->post('search_data');

        if (empty($search_data)){
            $result = $this->notice_m->get_notice();
            if (!empty($result))
            {
                foreach ($result as $news):
                    echo '
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single_courses">
                        <div class="single_courses_thumb">
                            <img src="'.base_url('uploads/images/'.$news->photo).'" alt="">
                            <div class="hover_overlay">
                                <div class="links">
                                    <a class="magnific-popup" href="'.base_url('uploads/images/'.$news->photo).'"><i class="fa fa-search" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- Single Courses Image Area End -->
                        <div class="single_courses_desc">
                            <!-- Single Courses Title Area End -->
                            <div class="title">
                                <a href="'.base_url('frontend/notice/'.$news->noticeID).'"><h5>'.$news->title.'</h5></a>
                                <div class="date_time">
                                    <div class="date">
                                        <p><span class="icon-calendar"></span> '.date('d M Y', strtotime($news->create_date)).'</p>
                                    </div>
                                    <div class="time">
                                        <p><span class="icon-clock"></span> '.date('G:i', strtotime($news->create_date)).'</p>
                                    </div>
                                </div>
                                <p>'.namesorting($news->notice).'</p>
                            </div>
                            <!-- Single Courses Blog Title Area End -->
                     </div>
                    </div>
                </div>'
                    ;
                endforeach;
            }
        }
        elseif (!empty($search_data)) {
            $result = $this->notice_m->get_autocomplete($search_data);
            if (!empty($result))
            {
                foreach ($result as $news):
                    echo '
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single_courses">
                        <div class="single_courses_thumb">
                            <img src="'.base_url('uploads/images/'.$news->photo).'" alt="">
                            <div class="hover_overlay">
                                <div class="links">
                                    <a class="magnific-popup" href="'.base_url('uploads/images/'.$news->photo).'"><i class="fa fa-search" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- Single Courses Image Area End -->
                        <div class="single_courses_desc">
                            <!-- Single Courses Title Area End -->
                            <div class="title">
                                <a href="'.base_url('frontend/notice/'.$news->noticeID).'"><h5>'.$news->title.'</h5></a>
                                <div class="date_time">
                                    <div class="date">
                                        <p><span class="icon-calendar"></span> '.date('d M Y', strtotime($news->create_date)).'</p>
                                    </div>
                                    <div class="time">
                                        <p><span class="icon-clock"></span> '.date('G:i', strtotime($news->create_date)).'</p>
                                    </div>
                                </div>
                                <p>'.namesorting($news->notice).'</p>
                            </div>
                            <!-- Single Courses Blog Title Area End -->
                     </div>
                    </div>
                </div>';
                endforeach;
            }
            else
            {
                echo "<div class='col-12'><h5><em>Məlumat tapılmadı</em></h5></div>";
            }
        }
    }

    // Contact
    protected function rules() {
        $rules = array(
            array(
                'field' => 'userGroup',
                'label' => $this->lang->line("select_group"),
                'rules' => 'trim|required|xss_clean|max_length[128]|callback_unique_userGroup'
            ),
            array(
                'field' => 'message',
                'label' => $this->lang->line("message"),
                'rules' => 'trim|required|xss_clean'
            ),
            array(
                'field' => 'subject',
                'label' => $this->lang->line("subject"),
                'rules' => 'trim|required|xss_clean'
            ),
            array(
                'field' => 'attachment',
                'label' => $this->lang->line("attachment"),
                'rules' => 'trim|xss_clean'
            )
        );
        return $rules;
    }

    public function ontactMailSend() {
        if($_POST) {
            $rules = $this->rules();
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() == FALSE) {
                $this->data['form_validation'] = validation_errors();
                $this->data['GroupID'] = $this->input->post('userGroup');
                $this->data["subview"] = "conversation/add_group";
                $this->load->view('_layout_main', $this->data);
            } else {
                $conversation_user = array();
                $conversations = array(
                    "create_date" => date("Y-m-d h:i:s"),
                    "modify_date" => date("Y-m-d h:i:s"),
                    "draft"       => 0
                );

                $conversation_msg = array(
                    "user_id" => $userID,
                    "usertypeID" => $usertypeID,
                    "subject" => $this->input->post('subject'),
                    "msg" => $this->input->post('message'),
                    "create_date" => date("Y-m-d h:i:s"),
                    "modify_date" => date("Y-m-d h:i:s"),
                    "start" => 1
                );


                if ($this->input->post('userGroup')) {
                    $convID = '';
                    $convID = $this->conversation_m->insert_conversation($conversations);
                    $conversation_user = array(
                        "conversation_id" => $convID,
                        "user_id" => $userID,
                        "usertypeID" => $usertypeID,
                        "is_sender" => 1,
                    );
                    $this->conversation_m->insert_conversation_user($conversation_user);

                    if ($this->input->post('userGroup')== 3) {
                        if (!$this->input->post('classID')) {
                            $students = $this->conversation_m->get_all_student();
                            if ($students) {
                                foreach ($students as $student) {
                                    $conversation_user = array(
                                        "conversation_id" => $convID,
                                        "user_id" => $student->studentID,
                                        "usertypeID" => $student->usertypeID
                                    );
                                    $userAdd = $this->conversation_m->insert_conversation_user($conversation_user);
                                }
                                $conversation_msg['conversation_id'] = $convID;
                                $msgAdd = $this->conversation_m->insert_conversation_msg($conversation_msg);
                                if ($msgAdd==true) {
                                    $this->session->set_flashdata('success', $this->lang->line("success_msg"));
                                    redirect(base_url('conversation/index'));
                                } else {
                                    $this->session->set_flashdata('error', $this->lang->line("error_msg"));
                                    redirect(base_url('conversation/create'));
                                }
                            } else {
                                $this->session->set_flashdata('error', $this->lang->line("error_msg_not_found"));
                                redirect(base_url('conversation/create'));
                            }
                        } else {
                            $classID = $this->input->post('classID');
                            $studentID = $this->input->post('studentID');
                            $students = array();
                            if ($studentID) {
                                $students = $this->conversation_m->get_student_by_class($studentID);
                            } else {
                                $students = $this->conversation_m->get_order_by_student_class($classID);
                            }
                            if ($students) {
                                foreach ($students as $student) {
                                    $conversation_user = array(
                                        "conversation_id" => $convID,
                                        "user_id" => $student->studentID,
                                        "usertypeID" => $student->usertypeID
                                    );
                                    $userAdd = $this->conversation_m->insert_conversation_user($conversation_user);
                                }
                                $conversation_msg['conversation_id'] = $convID;
                                $msgAdd = $this->conversation_m->insert_conversation_msg($conversation_msg);
                                if ($msgAdd==true) {
                                    $this->session->set_flashdata('success', $this->lang->line("success_msg"));
                                    redirect(base_url('conversation/index'));
                                } else {
                                    $this->session->set_flashdata('error', $this->lang->line("error_msg"));
                                    redirect(base_url('conversation/create'));
                                }
                            } else {
                                $this->session->set_flashdata('error', $this->lang->line("error_msg_not_found"));
                                redirect(base_url('conversation/create'));
                            }
                        }
                    } elseif($this->input->post('userGroup') == 1) {
                        if (!$this->input->post('systemadminID')) {
                            $systemadmins = $this->systemadmin_m->get_systemadmin();
                            if ($systemadmins) {
                                foreach ($systemadmins as $systemadmin) {
                                    $conversation_user = array(
                                        "conversation_id" => $convID,
                                        "user_id" => $systemadmin->systemadminID,
                                        "usertypeID" => $systemadmin->usertypeID
                                    );
                                    $userAdd = $this->conversation_m->insert_conversation_user($conversation_user);
                                }
                                $conversation_msg['conversation_id'] = $convID;
                                $msgAdd = $this->conversation_m->insert_conversation_msg($conversation_msg);
                                if ($msgAdd==true) {
                                    $this->session->set_flashdata('success', $this->lang->line("success_msg"));
                                    redirect(base_url('conversation/index'));
                                } else {
                                    $this->session->set_flashdata('error', $this->lang->line("error_msg"));
                                    redirect(base_url('conversation/create'));
                                }
                            } else {
                                $this->session->set_flashdata('error', $this->lang->line("error_msg_not_found"));
                                redirect(base_url('conversation/create'));
                            }

                        } else {
                            $systemadminID = $this->input->post('systemadminID');
                            $systemadmin = $this->systemadmin_m->get_systemadmin($systemadminID);
                            if (count($systemadmin)) {
                                $conversation_user = array(
                                    "conversation_id" => $convID,
                                    "user_id" => $systemadmin->systemadminID,
                                    "usertypeID" => $systemadmin->usertypeID
                                );
                                $userAdd = $this->conversation_m->insert_conversation_user($conversation_user);

                                $conversation_msg['conversation_id'] = $convID;
                                $msgAdd = $this->conversation_m->insert_conversation_msg($conversation_msg);
                                if ($msgAdd==true) {
                                    $this->session->set_flashdata('success', $this->lang->line("success_msg"));
                                    redirect(base_url('conversation/index'));
                                } else {
                                    $this->session->set_flashdata('error', $this->lang->line("error_msg"));
                                    redirect(base_url('conversation/create'));
                                }
                            } else {
                                $this->session->set_flashdata('error', $this->lang->line("error_msg_not_found"));
                                redirect(base_url('conversation/create'));
                            }
                        }
                    } elseif ($this->input->post('userGroup') == 2) {
                        if (!$this->input->post('teacherID')) {
                            $teachers = $this->teacher_m->get_teacher();
                            if ($teachers) {
                                foreach ($teachers as $teacher) {
                                    $conversation_user = array(
                                        "conversation_id" => $convID,
                                        "user_id" => $teacher->teacherID,
                                        "usertypeID" => $teacher->usertypeID
                                    );
                                    $userAdd = $this->conversation_m->insert_conversation_user($conversation_user);
                                }
                                $conversation_msg['conversation_id'] = $convID;
                                $msgAdd = $this->conversation_m->insert_conversation_msg($conversation_msg);
                                if ($msgAdd==true) {
                                    $this->session->set_flashdata('success', $this->lang->line("success_msg"));
                                    redirect(base_url('conversation/index'));
                                } else {
                                    $this->session->set_flashdata('error', $this->lang->line("error_msg"));
                                    redirect(base_url('conversation/create'));
                                }
                            } else {
                                $this->session->set_flashdata('error', $this->lang->line("error_msg_not_found"));
                                redirect(base_url('conversation/create'));
                            }

                        } else {
                            $teacherID = $this->input->post('teacherID');
                            $teacher = $this->teacher_m->get_teacher($teacherID);
                            if (count($teacher)) {
                                $conversation_user = array(
                                    "conversation_id" => $convID,
                                    "user_id" => $teacher->teacherID,
                                    "usertypeID" => $teacher->usertypeID
                                );
                                $userAdd = $this->conversation_m->insert_conversation_user($conversation_user);

                                $conversation_msg['conversation_id'] = $convID;
                                $msgAdd = $this->conversation_m->insert_conversation_msg($conversation_msg);
                                if ($msgAdd==true) {
                                    $this->session->set_flashdata('success', $this->lang->line("success_msg"));
                                    redirect(base_url('conversation/index'));
                                } else {
                                    $this->session->set_flashdata('error', $this->lang->line("error_msg"));
                                    redirect(base_url('conversation/create'));
                                }
                            } else {
                                $this->session->set_flashdata('error', $this->lang->line("error_msg_not_found"));
                                redirect(base_url('conversation/create'));
                            }
                        }
                    } else if($this->input->post('userGroup') == 4) {
                        if (!$this->input->post('parentsID')) {
                            $parents = $this->parents_m->get_parents();
                            if ($parents) {
                                foreach ($parents as $parent) {
                                    $conversation_user = array(
                                        "conversation_id" => $convID,
                                        "user_id" => $parent->parentsID,
                                        "usertypeID" => $parent->usertypeID
                                    );
                                    $userAdd = $this->conversation_m->insert_conversation_user($conversation_user);
                                }
                                $conversation_msg['conversation_id'] = $convID;
                                $msgAdd = $this->conversation_m->insert_conversation_msg($conversation_msg);
                                if ($msgAdd==true) {
                                    $this->session->set_flashdata('success', $this->lang->line("success_msg"));
                                    redirect(base_url('conversation/index'));
                                } else {
                                    $this->session->set_flashdata('error', $this->lang->line("error_msg"));
                                    redirect(base_url('conversation/create'));
                                }
                            } else {
                                $this->session->set_flashdata('error', $this->lang->line("error_msg_not_found"));
                                redirect(base_url('conversation/create'));
                            }

                        } else {
                            $parentsID = $this->input->post('parentsID');
                            $parent = $this->parents_m->get_parents($parentsID);
                            if (count($parent)) {
                                $conversation_user = array(
                                    "conversation_id" => $convID,
                                    "user_id" => $parent->parentsID,
                                    "usertypeID" => $parent->usertypeID
                                );
                                $userAdd = $this->conversation_m->insert_conversation_user($conversation_user);

                                $conversation_msg['conversation_id'] = $convID;
                                $msgAdd = $this->conversation_m->insert_conversation_msg($conversation_msg);
                                if ($msgAdd==true) {
                                    $this->session->set_flashdata('success', $this->lang->line("success_msg"));
                                    redirect(base_url('conversation/index'));
                                } else {
                                    $this->session->set_flashdata('error', $this->lang->line("error_msg"));
                                    redirect(base_url('conversation/create'));
                                }
                            } else {
                                $this->session->set_flashdata('error', $this->lang->line("error_msg_not_found"));
                                redirect(base_url('conversation/create'));
                            }
                        }
                    } else {
                        if (!$this->input->post('userID')) {
                            $users = $this->user_m->get_user();
                            if ($users) {
                                foreach ($users as $user) {
                                    $conversation_user = array(
                                        "conversation_id" => $convID,
                                        "user_id" => $user->userID,
                                        "usertypeID" => $user->usertypeID
                                    );
                                    $userAdd = $this->conversation_m->insert_conversation_user($conversation_user);
                                }
                                $conversation_msg['conversation_id'] = $convID;
                                $msgAdd = $this->conversation_m->insert_conversation_msg($conversation_msg);
                                if ($msgAdd==true) {
                                    $this->session->set_flashdata('success', $this->lang->line("success_msg"));
                                    redirect(base_url('conversation/index'));
                                } else {
                                    $this->session->set_flashdata('error', $this->lang->line("error_msg"));
                                    redirect(base_url('conversation/create'));
                                }
                            } else {
                                $this->session->set_flashdata('error', $this->lang->line("error_msg_not_found"));
                                redirect(base_url('conversation/create'));
                            }

                        } else {

                            $userID = $this->input->post('userID');
                            $user = $this->user_m->get_user($userID);
                            if (count($user)) {
                                $conversation_user = array(
                                    "conversation_id" => $convID,
                                    "user_id" => $user->userID,
                                    "usertypeID" => $user->usertypeID
                                );
                                $userAdd = $this->conversation_m->insert_conversation_user($conversation_user);

                                $conversation_msg['conversation_id'] = $convID;
                                $msgAdd = $this->conversation_m->insert_conversation_msg($conversation_msg);
                                if ($msgAdd==true) {
                                    $this->session->set_flashdata('success', $this->lang->line("success_msg"));
                                    redirect(base_url('conversation/index'));
                                } else {
                                    $this->session->set_flashdata('error', $this->lang->line("error_msg"));
                                    redirect(base_url('conversation/create'));
                                }
                            } else {
                                $this->session->set_flashdata('error', $this->lang->line("error_msg_not_found"));
                                redirect(base_url('conversation/create'));
                            }
                        }
                    }
                }
            }
        }
    }

    public function send_mail() {
        $this->load->library('email');

        $config = array();
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'smtp.gmail.com';
        $config['smtp_user'] = 'cinzadeh@gmail.com';
        $config['smtp_pass'] = 'ZdH-6547896321';
        $config['smtp_port'] = 456;
        $this->email->initialize($config);

        $this->email->set_newline("\r\n");


        $from_email = "cinzadeh@gmail.com";
        $to_email = "cinzadeh@gmail.com";

        $this->email->from($from_email, 'Identification');
        $this->email->to($to_email);
        $this->email->subject('Send Email Codeigniter');
        $this->email->message('The email send using codeigniter library');
        //Send mail
        if($this->email->send())
            $this->session->set_flashdata("email_sent","Congragulation Email Send Successfully.");
        else
            $this->session->set_flashdata("email_sent","You have encountered an error");
        $this->load->view('contact_email_form');
    }


}