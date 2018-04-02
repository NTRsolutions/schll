@layout('views/layouts/master')

@section('page-title', 'HOME')
@section('content')
    @if(count($sliders))
        <section class="welcome_area clearfix" id="home">
            <div class="welcome_slides">
                @foreach($sliders as $slider)
                <div class="single_slide" style="background-image: url(<?=base_url('uploads/gallery/'.$slider->file_name)?>);">
                    <div class="slide_text">
                        <div class="table">
                            <div class="table_cell">
                                <div class="container">
                                    <div class="row">
                                        <div class="col">
                                            <h2>{{ sentenceMap(htmlspecialchars_decode($slider->file_title), 17, '<span>', '</span>') }}</h2>
                                            <h3>{{ htmlspecialchars_decode($slider->file_description) }}</h3>
                                            <div class="welcome_btn">
                                                <a class="btn btn-1 btn-default btn-lg active" href="https://imtahan.correctsteps.az" target="_blank" role="button">Onlayn İmtahan Ver</a>
                                                <a class="btn btn-2 btn-default btn-lg" href="<?=base_url('frontend/page/services')?>" role="button">Xidmətlərimizlə Tanış Ol</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
    @endif

    <!-- ===================== Awesome Feature Area Start ===================== -->
    <section class="awesome_features_area home2 section_padding_100_70">
        <div class="container">
            <div class="row">
                <div class="col">
                    <!-- Section Heading Start -->
                    <div class="section_heading wow fadeInUp">
                        <img src="<?=base_url($frontendThemePath.'assets/img/icon-img/icon.png')?>" alt="">
                        <h4>Üstünlüklərimiz</h4>
                    </div>
                </div>
            </div>
            <!-- end./ row -->

            <div class="row">
                <!-- Single Feature Area Start -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single_feature wow fadeInUp item" data-wow-delay="0.2s">
                        <div class="feature_img">
                            <span class="icon-genius"></span>
                        </div>
                        <!-- Single Feature Image Area End -->
                        <div class="feature_text">
                            <h5>Effektiv Təhsil</h5>

                        </div>
                        <!-- Single Feature Text Area End -->
                    </div>
                </div>
                <!-- Single Feature Area End -->

                <!-- Single Feature Area Start -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single_feature wow fadeInUp item" data-wow-delay="0.4s">
                        <div class="feature_img">
                            <span class="icon-profile-male"></span>
                        </div>
                        <!-- Single Feature Image Area End -->
                        <div class="feature_text">
                            <h5>İxtisaslı Müəllim Heyəti</h5>

                        </div>
                        <!-- Single Feature Text Area End -->
                    </div>
                </div>
                <!-- Single Feature Area End -->

                <!-- Single Feature Area Start -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single_feature wow fadeInUp item" data-wow-delay="0.6s">
                        <div class="feature_img">
                            <span class="icon-compass"></span>
                        </div>
                        <!-- Single Feature Image Area End -->
                        <div class="feature_text">
                            <h5>Düzgün Yönləndirmə</h5>

                        </div>
                        <!-- Single Feature Text Area End -->
                    </div>
                </div>
                <!-- Single Feature Area End -->

                <!-- Single Feature Area Start -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single_feature wow fadeInUp item" data-wow-delay="0.8s">
                        <div class="feature_img">
                            <span class="icon-gift"></span>
                        </div>
                        <!-- Single Feature Image Area End -->
                        <div class="feature_text">
                            <h5>Məqsədyönlü Tədbirlər</h5>

                        </div>
                        <!-- Single Feature Text Area End -->
                    </div>
                </div>
                <!-- Single Feature Area End -->

            </div>
        </div>
    </section>
    <!-- ===================== Awesome Feature Area End ===================== -->

    <!-- ===================== Popular Courses Area Start ===================== -->
    <section class="popular_coureses_area home2 grid_coundown section_padding_100_70">
        <div class="container">
            <div class="row">
                <div class="col">
                    <!-- Section Heading Area Start -->
                    <div class="section_heading wow fadeInUp">
                        <img src="<?=base_url($frontendThemePath.'assets/img/icon-img/coures-icon.png')?>" alt="">
                        <h4>Yaxınlaşan Tədbirlər</h4>
                    </div>
                    <!-- Section Heading Area End -->
                </div>
            </div>

            <div class="row">
                @foreach($last_events as $event)
                <!-- Single Courses Area Start -->
                <div class="col-lg-4 col-12 col-md-6">
                    <div class="single_courses wow fadeInUp" data-wow-delay="0.2s">
                        <div class="single_courses_thumb">
                            <img src="<?=base_url('uploads/images/'.$event->photo)?>" alt="">
                            <div class="hover_overlay">
                                <div class="links">
                                    <a class="magnific-popup" href="img/course-img/event-1.jpg')?>"><i class="fa fa-search" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- Single Courses Image Area End -->
                        <div class="single_courses_desc">
                            <!-- Single Courses Title Area End -->
                            <div class="title">
                                <a href="{{ base_url('frontend/event/'.$event->eventID) }}">
                                    <h5>{{ $event->title }}</h5>
                                </a>
                                <div class="date_time">
                                    <div class="date">
                                        <p><span class="icon-calendar"></span> {{ date('G:i', strtotime($event->ftime)).' '.date('d M Y', strtotime($event->fdate)) }}</p>
                                    </div>
                                    <div class="time">
                                    </div>
                                </div>
                                <p>{{ namesorting($event->details, 120) }}</p>
                            </div>
                            <!-- Single Courses Blog Title Area End -->

                            <div class="price_rating_area">
                            </div>
                            <!-- Event Coundown area End -->
                        </div>
                    </div>
                </div>
                <!-- Single Courses Area End -->
                @endforeach
            </div>
        </div>
    </section>
    <!-- ===================== Popular Courses Area End ===================== -->

    <!-- ===================== Why Chooses Area Start ===================== -->
    <section class="why_choose_us_area home2 section_padding_100_70">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section_heading wow fadeInUp">
                        <img src="<?=base_url($frontendThemePath.'assets/img/icon-img/why-choose-icon.png')?>" alt="">
                        <h4>Niyə Məhz Biz?</h4>
                    </div>
                </div>
            </div>
            <div class="row">

                <!-- Single why choose area start -->

                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="single_service wow fadeInUp item" data-wow-delay="0.1s">
                        <div class="single_service_img_area">
                            <div class="border">
                                <!-- Single why choose image -->
                                <div class="single_service_img">
                                    <span class="fa fa-search"></span>
                                </div>
                                <!-- Single why choose title -->
                                <div class="service_title">
                                    <h5>Axtardığınız Müəllimlər<br>Artıq Bir Ünvanda</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Single why choose area start -->
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="single_service wow fadeInUp item" data-wow-delay="0.2s">
                        <div class="single_service_img_area">
                            <div class="border">
                                <!-- Single why choose image -->
                                <div class="single_service_img">
                                    <span class="fa fa-check"></span>
                                </div>
                                <!-- Single why choose title -->
                                <div class="service_title">
                                    <h5>Daimi Yenilənən Mövzu<br>və Ümumi İmtahanlar</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Single why choose area start -->
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="single_service wow fadeInUp item" data-wow-delay="0.3s">
                        <div class="single_service_img_area">
                            <div class="border">
                                <!-- Single why choose image -->
                                <div class="single_service_img">
                                    <span class="fa fa-tasks"></span>
                                </div>
                                <!-- Single why choose title -->
                                <div class="service_title">
                                    <h5>Fərdi Hazırlaşanlar üçün<br>Təhsilin Planlaşdırılması</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Single why choose area start -->
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="single_service wow fadeInUp item" data-wow-delay="0.4s">
                        <div class="single_service_img_area">
                            <div class="border">
                                <!-- Single why choose image -->
                                <div class="single_service_img">
                                    <span class="fa fa-video-camera"></span>
                                </div>
                                <!-- Single why choose title -->
                                <div class="service_title">
                                    <h5>Bütün Fənnlər üzrə<br>Ödənişsiz Video Dərslər</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Single why choose area start -->
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="single_service wow fadeInUp item" data-wow-delay="0.5s">
                        <div class="single_service_img_area">
                            <div class="border">
                                <!-- Single why choose image -->
                                <div class="single_service_img">
                                    <span class="fa fa-file-pdf-o"></span>
                                </div>
                                <!-- Single why choose title -->
                                <div class="service_title">
                                    <h5>Lazım Olan Bütün Dərslər<br>üçün Geniş PDF Kitabxana</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="single_service wow fadeInUp item" data-wow-delay="0.6s">
                        <div class="single_service_img_area">
                            <div class="border">
                                <!-- Single why choose image -->
                                <div class="single_service_img">
                                    <span class="icon-genius"></span>
                                </div>
                                <!-- Single why choose title -->
                                <div class="service_title">
                                    <h5>Müxtəlif Mövzularda<br>Maarifləndirici Təlimlər</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Single why choose area start -->
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="single_service wow fadeInUp item" data-wow-delay="0.7s">
                        <div class="single_service_img_area">
                            <div class="border">
                                <!-- Single why choose image -->
                                <div class="single_service_img">
                                    <span class="fa fa-bus"></span>
                                </div>
                                <!-- Single why choose title -->
                                <div class="service_title">
                                    <h5>Valideynlərin Rahatlığı üçün<br>Məktəb Servisi Xidməti</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Single why choose area start -->
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="single_service wow fadeInUp item" data-wow-delay="0.8s">
                        <div class="single_service_img_area">
                            <div class="border">
                                <!-- Single why choose image -->
                                <div class="single_service_img">
                                    <span class="fa fa-university"></span>
                                </div>
                                <!-- Single why choose title -->
                                <div class="service_title">
                                    <h5>Sərfəli Qiymətlərlə<br>Yataqxana Axtarışı</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- ===================== Why Chooses Area End ===================== -->

    <!-- ===================== Blog Area Start ===================== -->
    <section class="blog_area section_padding_100_70">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section_heading wow fadeInUp">
                        <img src="<?=base_url($frontendThemePath.'assets/img/news-img/news-icon.png')?>" alt="">
                        <h4>Yenilik və Xəbərlər</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($last_news as $news)
                <!-- single latest news area start -->
                <div class="col-lg-4 col-12 col-md-6">
                    <div class="single_latest_news_area wow fadeInUp" data-wow-delay="0.2s">
                        <!-- single latest news thumb -->
                        <div class="single_latest_news_img_area">
                            <img src="<?=base_url('uploads/images/'.$news->photo)?>" alt="">
                            <!-- single latest news published date -->
                            <div class="published_date">
                                <p class="date">{{ date('d', strtotime($news->create_date)) }}</p>
                                <p class="month">{{ date('M', strtotime($news->create_date)) }}</p>
                            </div>
                        </div>
                        <div class="single_latest_news_text_area">
                            <!-- single latest news title -->
                            <div class="news_title">
                                <a href="{{ base_url('frontend/notice/'.$news->noticeID) }}">
                                    <h4>{{ $news->title }}</h4>
                                </a>
                            </div>
                            <!-- single latest news excerp -->
                            <div class="news_content">
                                <p>{{ namesorting($news->notice, 120) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- ===================== Blog Area End ===================== -->

    <!-- ===================== Contact & FAQ Area Start ===================== -->
    <section class="global_partner_area section_padding_100_70">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section_heading wow fadeInUp">
                        <img src="<?=base_url($frontendThemePath.'assets/img/news-img/news-icon.png')?>" alt="">
                        <h4>Bizimlə Əlaqə</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- basic contact info area start -->
                <div class="col-lg-6 col-12">
                    <div class="basic_contact_area wow fadeInUp" data-wow-delay="0.2s">
                        <!-- basic contact title -->
                        <h5>Sualınız var? Bizə Yazın, Cavablandıraq</h5>
                        <!-- basic contact form -->
                        <div class="basic_contact_form">
                            <form action="#">
                                <div class="form-group">
                                    <input type="text" class="form-control pull-left" id="name" placeholder="Adınız və Soyadınız" required>
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control pull-right" id="phone" placeholder="Telefon Nömrəniz" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" id="email" placeholder="Poçt Adresiniz" required>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" id="question" cols="30" rows="10" placeholder="Sualınızı Yazın" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-default">Cavab Al</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-12">
                    <div class="accordions wow fadeInUp" data-wow-delay="0.4s" id="accordion" role="tablist" aria-multiselectable="true">

                        <!-- single accordian area start -->
                        <div class="panel single-accordion">
                            <h5>
                                <a role="button" aria-expanded="true" aria-controls="collapseOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Sizin Komandanıza Necə Qoşula Bilərəm?
                                    <span class="accor-open">+</span>
                                    <span class="accor-close">-</span>
                                </a>
                            </h5>
                            <div id="collapseOne" class="accordion-content collapse in">
                                <p>Gündən günə müxtəlif sahələrdə olduğu kimi təhsil sahəsində də keyfiyyətli kadrlara tələbat artmaqdadır. Rahat iş şəraiti, gözəl kollektivlə işləmək və ən əsası karyeranızın etibarlı yerdən başlaması üçün <strong>hr@onlayn-tehsil.az</strong> ünvanına CV formanızı göndərin. Vakansiyalarla <a href="vacancies.html">burada</a> tanış ola bilərsiniz.</p>
                            </div>
                        </div>

                        <!-- single accordian area start -->
                        <div class="panel single-accordion">
                            <h5>
                                <a role="button" aria-expanded="true" aria-controls="collapseOne" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Psixoloji Təlimlərə Necə Qatıla Bilərəm?
                                    <span class="accor-open">+</span>
                                    <span class="accor-close">-</span>
                                </a>
                            </h5>
                            <div id="collapseTwo" class="accordion-content collapse in">
                                <p>Saytımızda qeydiyyatdan keçən və rəhbərlik tərəfindən təyin olunan vaxt ərzində saytın mütəmadi iştirakçıları bu təlimlərdən ödənişsiz şəkildə yararlana bilərlər. Qeydiyyatı olmayan digər bütün istifadəçilər isə təlimə əvvəlcədən satışa çıxarılan biletlərdən alaraq qatıla bilərlər.</p>
                            </div>
                        </div>

                        <!-- single accordian area start -->
                        <div class="panel single-accordion">
                            <h5>
                                <a role="button" aria-expanded="true" aria-controls="collapseOne" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Valideyn Kimi Qeydiyyatın Üstünlükləri Nədir?
                                    <span class="accor-open">+</span>
                                    <span class="accor-close">-</span>
                                </a>
                            </h5>
                            <div id="collapseThree" class="accordion-content collapse in">
                                <p>Siz qeydiyyatdan keçərkən <strong>"Valideyn"</strong> kateqoriyasını seçərək artıq saytın istifadəçisi olmağa başlayırsınız. Qeydiyyat sizə bir sıra üstünlüklər verir. Üstünlüklər barədə qısaca deyə bilərik ki, siz birbaşa övladınızın qeydiyyatından tutmuş, ödəniş əməliyyatlarına, dərs davamiyyətindən tutmuş, müəllimlərin övladınız haqqındakı düşüncələrinə qədər, hətta imtahan nəticələrini daimi izləmək şansına da sadəcə qeydiyyatdan keçərək nail ola bilərsiniz.</p>
                            </div>
                        </div>

                        <!-- single accordian area start -->
                        <div class="panel single-accordion">
                            <h5>
                                <a role="button" aria-expanded="true" aria-controls="collapseOne" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">Müəllim Kimi Qeydiyyatın Üstünlükləri Nədir?
                                    <span class="accor-open">+</span>
                                    <span class="accor-close">-</span>
                                </a>
                            </h5>
                            <div id="collapseFour" class="accordion-content collapse in">
                                <p>Hörmətli, Müəllimlərimiz! Saytımızda qeydiyyatdan keçərək siz burada faktiki dərs dediyiniz sinifləri, o cümlədən hazırlaşdırdığınız bütün şagirdləri qeydiyyatdan keçirərək onlara dərsdən əlavə materiallar, tapşırıqlar, hətta sinifdaxili və qrupdaxili test imtahanları keçirə bilərsiniz. Bundan əlavə siz bütün şagirdlərinizin valideynləri ilə saytın köməkliyi ilə müntəzəm əlaqə saxlaya biləcəksiniz.</p>
                            </div>
                        </div>

                        <!-- single accordian area start -->
                        <div class="panel single-accordion">
                            <h5>
                                <a role="button" aria-expanded="true" aria-controls="collapseOne" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">Mən Niyə Məhz Bu Saytdan İstifadə Etməliyəm?
                                    <span class="accor-open">+</span>
                                    <span class="accor-close">-</span>
                                </a>
                            </h5>
                            <div id="collapseFive" class="accordion-content collapse in">
                                <p>Bu sayt sizə təhsilin gizli qapılarını açmağa, həyatdakı müsbət şeylərdən ilham almağa, tək təhsildə yox, bütün həyatınızdakı arzu və planları reallaşdırmağa kömək olacaq. Müxtəlif kateqoriyalardan təşkil olunan çoxlu sayda həftəlik və aylıq yenilənən imtahanlardan istifadə etməklə siz məqsədinizə doğru addımladığınız yolda önəmli mərhələlərdən keçəcəksiniz. Saytdakı təcrübəli müəllim sayı da gündən günə artaraq sizə seçimlərinizdə və axtardığınız müəllimi, axtardığınız təhsili, axtardığınız keyfiyyəti qarşınıza qoyacaq. Sadəcə sayta daxil olun və xidmətlərimizlə tanış olun. Verdiyiniz sualın cavabını o zaman daha yaxşı tapacaqsınız. </p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ===================== Contact & FAQ Area End ===================== -->
@endsection
