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
                echo "<li> <em> Not found ... </em> </li>";
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
                echo "<li> <em> Not found ... </em> </li>";
            }
        }
    }

}