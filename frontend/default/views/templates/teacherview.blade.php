@layout('views/layouts/master')

@section('content')
    <section class="all_our_teacher_area section_padding_100">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-12">
                    <!-- Teacher Full Image Start -->
                    <div class="teacher_full_image">
                        <img src="{{ base_url('uploads/images/'.$teacherView->photo) }}" alt="">
                    </div>
                </div>
                <div class="col-md-9 col-12">
                    <!-- Teacher Details Info Area Start -->
                    <div class="teacher_details_info">
                        <!-- Teacher Name Designation Start -->
                        <div class="name_designation">
                            <h3>{{ $teacherView->name }}</h3>
                        </div>

                        <!-- About Teacher Start -->
                        <div class="about_teacher">
                            <p>{{ $teacherView->about }}</p>
                        </div>
                        <!-- Teacher Contact Info Start -->
                        <div class="teacher_contact_info">
                            <!-- Single Contact Info Start -->
                            <div class="tea_single_contact_info">
                                <div class="contact_icon">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                </div>
                                <div class="contact_data">
                                    <p>{{ $teacherView->address }}</p>
                                </div>
                            </div>
                            <!-- Single Contact Info Start -->
                            <div class="tea_single_contact_info">
                                <div class="contact_icon">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                </div>
                                <div class="contact_data">
                                    <p>{{ frontendData::get_backend('phone') }}</p>
                                </div>
                            </div>
                            <!-- Single Contact Info Start -->
                            <div class="tea_single_contact_info">
                                <div class="contact_icon">
                                    <i class="fa fa-money" aria-hidden="true"></i>
                                </div>
                                <div class="contact_data">
                                    <p>{{ $teacherView->price }} 	&#8380;</p>
                                </div>
                            </div>
                            <!-- Single Contact Info Start -->
                            <div class="tea_single_contact_info">
                                <div class="contact_icon">
                                    <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                                    <div class="contact_data">
                                        <p>{{ $teacherView->designation }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Teacher Contact Info End -->
                    </div>
                    <!-- Teacher Details Info Area End -->
                </div>
            </div>
        </div>
    </section>
@endsection