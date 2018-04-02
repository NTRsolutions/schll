@layout('views/layouts/master')

@section('content')
@include('views/partials/breadcrumb')
<section class="latest_blog_news_area blog section_padding_100">
    <div class="container">
        <div class="row">

            <div class="col-12 col-md-6">
                <!-- Single Blog Post Area Start -->
                <div class="single_latest_news_area clearfix wow fadeInUp" data-wow-delay="0.2s">
                    <div class="single_latest_news_img_area">
                        <!-- Single Blog Post Image Start -->
                        <img src="<?=base_url($frontendThemePath.'assets/img/news-img/blog-1.jpg')?>" alt="">
                        <!-- Single Blog Post Published Date -->

                    </div>
                    <div class="single_latest_news_text_area">
                        <!-- Single Blog Post Title -->
                        <div class="news_title">
                            <a href="<?=base_url('frontend/page/teachers')?>"><h4>Müəllim Axtarışı</h4></a>
                        </div>
                        <!-- Single Blog Post excerpt -->
                        <div class="news_content">
                            <p>Axtardığınız tədris və ya təhsil üzrə ən mükəmməl tədris proqramlarına malik müəllimləri görə bilərsiniz. Sadəcə daxil olub kateqoriyanızı müəyyənləşdirmək kifayətdir. </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Single Blog Post Area End -->

            <div class="col-12 col-md-6">
                <!-- Single Blog Post Area Start -->
                <div class="single_latest_news_area clearfix wow fadeInUp" data-wow-delay="0.4s">
                    <div class="single_latest_news_img_area">
                        <!-- Single Blog Post Image Start -->
                        <img src="<?=base_url($frontendThemePath.'assets/img/news-img/blog-2.jpg')?>" alt="">
                        <!-- Single Blog Post Published Date -->

                    </div>
                    <div class="single_latest_news_text_area">
                        <!-- Single Blog Post Title -->
                        <div class="news_title">
                            <a href="https://imtahan.correctsteps.az" target="_blank"><h4>Onlayn İmtahan</h4></a>
                        </div>
                        <!-- Single Blog Post excerpt -->
                        <div class="news_content">
                            <p>Hər bir fənn və digər kateqoriyalar üzrə hər həftə yenilənən Mövzu və Ümumi imtahan ilə özünüzü imtahana maksimum hazırlayın. Unutmayın ki, uğur bircə addımlığınıdadır. </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Single Blog Post Area End -->

            <div class="col-12 col-md-6">
                <!-- Single Blog Post Area Start -->
                <div class="single_latest_news_area clearfix wow fadeInUp" data-wow-delay="0.4s">
                    <div class="single_latest_news_img_area">
                        <!-- Single Blog Post Image Start -->
                        <img src="<?=base_url($frontendThemePath.'assets/img/news-img/blog-5.jpg')?>" alt="">
                        <!-- Single Blog Post Published Date -->

                    </div>
                    <div class="single_latest_news_text_area">
                        <!-- Single Blog Post Title -->
                        <div class="news_title">
                            <a href="<?=base_url('frontend/page/books')?>"><h4>Ödənişsiz PDF Dərsliklər</h4></a>
                        </div>
                        <!-- Single Blog Post excerpt -->
                        <div class="news_content">
                            <p>Biliyinizi artırmaq üçün əlavə vəsaitlər axtarırsınız? Digər mənbələrdən axtarmağınıza ehtiyyac yoxdur. Çünki bütün kateqoriyalar üzrə PDF dərslikləri ödənişsiz əldə edə bilərsiniz.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Single Blog Post Area End -->

            <div class="col-12 col-md-6">
                <!-- Single Blog Post Area Start -->
                <div class="single_latest_news_area clearfix wow fadeInUp" data-wow-delay="0.6s">
                    <div class="single_latest_news_img_area">
                        <!-- Single Blog Post Image Start -->
                        <img src="<?=base_url($frontendThemePath.'assets/img/news-img/blog-6.jpg')?>" alt="">
                        <!-- Single Blog Post Published Date -->

                    </div>
                    <div class="single_latest_news_text_area">
                        <!-- Single Blog Post Title -->
                        <div class="news_title">
                            <a href="<?=base_url('frontend/page/trainings')?>"><h4>Maarifləndirici Təlimlər</h4></a>
                        </div>
                        <!-- Single Blog Post excerpt -->
                        <div class="news_content">
                            <p>Peşəkarlardan ibarət komandamızın sizə tədris etdiyi xüsusi maarifləndirici təlimlər əsasənda siz beyninizdəki mənfi fikirlərdən, həyəcanlardan, və qərarsızlıqlardan azad olunacaqsınız.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Single Blog Post Area End -->
        </div>
    </div>
</section>
@endsection
