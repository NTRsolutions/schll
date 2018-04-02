@layout('views/layouts/master')

@section('content')
@include('views/partials/breadcrumb')

<section class="our_teachers_area our_teacher section_padding_100_70">
    <div class="container">
        <div class="row our_team">
            @foreach($team as $member)
            <div class="col-12 col-sm-6 col-md-3">
                <div class="single_teacher_profile item">
                    <!-- Single Teacher Thumb -->
                    <div class="teacher_thumb">
                        <img src="<?=base_url('uploads/images/'.$member->photo)?>" alt="">
                    </div>
                    <!-- Single Teacher Details Info -->
                    <div class="single_teacher_details_info">
                        <h5>{{ $member->name }}</h5>
                        <p>{{ $member->usertype }}</p>
                        <!-- Single Teacher Socila Links -->
                        <div class="teacher_social_info">
                            <div class="social_icon">
                                <a href="mailto:{{ $member->email }}" target="_top"><i class="fa fa-envelope"></i></a>
                                @if($member->phone)
                                <a href="tel:{{ $member->phone }}"><i class="fa fa-phone"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection