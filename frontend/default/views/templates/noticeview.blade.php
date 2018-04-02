
@layout('views/layouts/master')


@section('content')

	<section class="event_details_area section_padding_100">
		<div class="container">
			<div class="row">
				<div class="col-12 col-lg-9">
					<div class="event_details">
						<div class="event_thumbnails">
							<img class="img-thumbnail img-responsive" src="<?=base_url('uploads/images/'.$noticeView->photo)?>" alt="">
						</div>
						<div class="event_title">
							<h1>{{ $noticeView->title }}</h1>
							<div class="date_time">
								<div class="date">
									<p><span class="icon-calendar"></span> {{ date('d M Y', strtotime($noticeView->date)) }}</p>
								</div>
							</div>
						</div>
						<div class="event_content">
							<p>{{ htmlspecialchars_decode($noticeView->notice) }}</p>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</section>


@endsection