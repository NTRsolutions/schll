<!-- Breadcumb area start -->
<section class="breadcumb_area" style="background-image: url(<?=base_url($frontendThemePath.'assets/img/bg-pattern/breadcumb.jpg')?>    ">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="breadcumb_section">
                    <!-- Breadcumb page title start -->
                    <div class="page_title">
                        <h3>{{ $page->title }}</h3>
                    </div>
                    <!-- Breadcumb page pagination start -->
                    <div class="page_pagination">
                        <ul>
                            <li><a href="index.html">Ana Səhifə</a></li>
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                            <li>{{ $page->title }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcumb area end -->