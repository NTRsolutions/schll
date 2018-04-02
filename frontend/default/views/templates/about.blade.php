@layout('views/layouts/master')


@section('content')
    @include('views/partials/breadcrumb')

    <!-- About us area start -->
    <section class="about_us_area section_padding_100_70">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <!-- About us text start -->
                    <div class="about_us_text">
                        <h3><span>Onlayn Təhsil Mərkəzi</span> Haqqında</h3>
                        <p> {{ htmlspecialchars_decode($page->content) }} </p>
                    </div>
                    <!-- About us special quote start -->
                    <div class="special_service">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- About us single quote start -->
                                <div class="single_special_service">
                                    <h5><i class="fa fa-check-circle" aria-hidden="true"></i> Effektiv Təhsil</h5>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- About us single quote start -->
                                <div class="single_special_service">
                                    <h5><i class="fa fa-check-circle" aria-hidden="true"></i> Müəllim Heyəti</h5>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- About us single quote start -->
                                <div class="single_special_service">
                                    <h5><i class="fa fa-check-circle" aria-hidden="true"></i> Düzgün Yönləndirmə</h5>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- About us single quote start -->
                                <div class="single_special_service">
                                    <h5><i class="fa fa-check-circle" aria-hidden="true"></i> Tədbirlər</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-12 col-lg-6">
                    <!-- About us thumb start -->
                    <div class="">
                        <img src="{{ base_url('uploads/gallery/'.$featured_image->file_name) }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About us area end -->
@endsection