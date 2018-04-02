@layout('views/layouts/master')

@section('content')

	<section class="courses_details_area">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-7 col-lg-8">

					<!-- Courses Details Thumb Area Start -->
					<div class="courses_details_thumb">
						<img src="{{ base_url('uploads/images/'.$eventView->photo) }}" alt="">
						<!-- Courses Details Thumb Caption Area Start -->
					</div>
					<!-- Courses Details Thumb Area End -->

					<!-- Courses Overview -->
					<div class="courses_overview">
						<h5>{{ $eventView->title }}</h5>
					</div>

					<!-- Courses Overview Content -->
					<div class="couress_overview_content">
						<p>{{ $eventView->details }}</p>
					</div>


					<!-- Courses Description -->
					<div class="courses_description">
						<h5>Digər Təlimlər</h5>
					</div>

					<!-- Single Courses Area Start -->
					<div class="row">
					@if(count($events))
                        <?php $i = 1; ?>
						@foreach($events as $event)
							@if($i <= 2)
							<!-- Single Courses Area Start -->
							<div class="col-12 col-lg-6">
								<div class="single_courses related">
									<div class="single_courses_thumb">
										<img src="{{ base_url('uploads/images/'.$event->photo) }}" alt="">
										<div class="hover_overlay">
											<div class="links">
												<a class="magnific-popup" href="img/course-img/softwareengineer.jpg"><i class="fa fa-search" aria-hidden="true"></i></a>
											</div>
										</div>
									</div>
									<!-- Single Courses Image Area End -->
									<div class="single_courses_desc">
										<!-- Single Courses Title Area End -->
										<div class="title">
											<a href="{{ base_url('frontend/event/'.$event->eventID) }}"><h5>{{ $event->title }}</h5></a>
											<p><span>{{ date("h:i A", strtotime($event->ftime)) }} - {{ date("h:i A", strtotime($event->ttime)) }}</span></p>
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
					<!-- Single Courses Area End -->
				</div>

				<!-- ==================== Sidebar Area Start ==================== -->
				<div class="col-12 col-md-5 col-lg-4">
					<div class="sidebar_area">

						<!-- Single Sidebar Content Start -->
						<div class="single_sidebar_content">
							<div class="row">
								<!-- Single Option -->
								<div class="col-6 clearfix">
									<div class="single_option clearfix">
										<i class="fa fa-check-square-o" aria-hidden="true"></i>
										<p>Başlayacaq:</p>
										<p>{{ date("H:i", strtotime($eventView->ftime)).' '.date("d M Y", strtotime($eventView->fdate)) }}</p>
									</div>
								</div>

								<!-- Single Option -->
								<div class="col-6 clearfix">
									<div class="single_option clearfix">
										<i class="fa fa-times-circle-o" aria-hidden="true"></i>
										<p>Bitəcək:</p>
										@if($eventView->fdate != $eventView->tdate)
											<p>{{ date("H:i", strtotime($eventView->ttime)).' '.date("d M Y", strtotime($eventView->tdate)) }}</p>
										@else
											<p>{{ date("H:i", strtotime($eventView->ftime)).' '.date("d M Y", strtotime($eventView->fdate)) }}</p>
										@endif
									</div>
								</div>
							</div>
						</div>
						<!-- Single Sidebar Content End -->

						<!-- Single Sidebar Content End -->
					</div>
				</div>
				<!-- Sidebar Area End -->
			</div>
		</div>
	</section>

@endsection