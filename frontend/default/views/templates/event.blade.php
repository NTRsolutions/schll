@layout('views/layouts/master')

@section('content')
    @include('views/partials/breadcrumb')
    
    <section class="popular_coureses_area all_courses grid_list section_padding_100">
        <div class="container">
            <div class="row">
            @if(count($events))
                <?php $i = 1; ?>
                @foreach($events as $event)
                    @if($i <= 9)
                    <!-- Single Courses Area Start -->
                    <div class="col-12 col-md-4">
                        <div class="single_courses item">
                            <div class="single_courses_thumb">
                                <img src="{{ base_url('uploads/images/'.$event->photo) }}" alt="">
                                <div class="hover_overlay">
                                    <div class="links">
                                        <a class="magnific-popup" href="{{ base_url('uploads/images/'.$event->photo) }}"><i class="fa fa-search" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Courses Image Area End -->
                            <div class="single_courses_desc">
                                <!-- Single Courses Title Area End -->
                                <div class="title">
                                    <a href="{{ base_url('frontend/event/'.$event->eventID) }}"><h5>{{ $event->title }}</h5></a>
                                    <p>{{ date('H:i', strtotime($event->ftime)).' - '.date('d F', strtotime($event->fdate))  }}</p>
                                    <p>{{ namesorting($event->details, 100)  }}</p>
                                </div>
                                <!-- Single Courses Blog Title Area End -->
                            </div>
                        </div>
                    </div>
                    <!-- Single Courses Area End -->
                    @endif
                    <?php $i++; ?>
                @endforeach
            @endif
            </div>
        </div>
    </section>

@endsection

@section('footerAssetPush')

    <script type="text/javascript">
        $(document).on('click', '.going-event', function(e) {
            e.preventDefault();
            var id = $(this).attr('id');
            if(id) {
                $.ajax({
                    dataType: 'json',
                    type: 'POST',
                    url: "<?=base_url('frontend/eventGoing')?>",
                    data: { 'id':id },
                    dataType: "html",
                    success: function(data) {
                        var response = jQuery.parseJSON(data);
                        if(response.status == true) {
                            toastr["success"](response.message)
                            toastr.options = {
                                "closeButton": true,
                                "debug": false,
                                "newestOnTop": false,
                                "progressBar": false,
                                "positionClass": "toast-top-right",
                                "preventDuplicates": false,
                                "onclick": null,
                                "showDuration": "500",
                                "hideDuration": "500",
                                "timeOut": "5000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            }

                        } else {
                            toastr["error"](response.message)
                            toastr.options = {
                                "closeButton": true,
                                "debug": false,
                                "newestOnTop": false,
                                "progressBar": false,
                                "positionClass": "toast-top-right",
                                "preventDuplicates": false,
                                "onclick": null,
                                "showDuration": "500",
                                "hideDuration": "500",
                                "timeOut": "5000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            }
                        }
                    }
                });
            }
        });

    </script>

@endsection
