<!-- ===================== Footer Area Start ===================== -->
<footer class="footer_area">
	<div class="container section_padding_100_70">
		<div class="row">
			<!-- Footer About Area Start -->
			<div class="col-12 col-md-6 col-lg-3">
				<div class="footer_about_us footer-single-part item wow fadeInUp">
					<div class="title">
						<h4>Haqqımızda</h4>
						<!-- Useful Links Title -->
						<div class="underline"></div>
					</div>
					<p>Onlayn Təhsil Mərkəzi olaraq bizim mümkün olan ən yaxşı təhsil texnologiyasını yaratmaq və dəstəkləmək mövzusunda istəyimiz var. Uşaqlardan yeniyetmələrə, milyonlarla şagirdin istifadə edəcəyi ən keyfiyyətli işləri inkişaf etdiririk. </p>
				</div>
			</div>
			<!-- Footer About Area End -->

			<!-- Upcoming Area Start -->
			<div class="col-12 col-md-6 col-lg-3">
				<div class="footer_upcoming_event footer-single-part item wow fadeInUp">
					<div class="title">
						<h4>Yeniliklər</h4>
						<!-- Useful Links Title -->
						<div class="underline"></div>
					</div>
					@if(frontendData::get_footer_data())
					@foreach(frontendData::get_footer_data() as $news)
					<div class="event_single_post">
						<a href="<?=base_url('frontend/notice/'.$news->noticeID)?>">
							<p>{{ $news->title }}</p>
						</a>
					</div>
					@endforeach
					@endif
				</div>
			</div>
			<!-- Upcoming Area End -->

			<!-- Contact info Area Start -->
			<div class="col-12 col-md-6 col-lg-3">
				<div class="footer_contact_info footer-single-part item wow fadeInUp">
					<div class="title">
						<h4>Əlaqə</h4>
						<!-- Useful Links Title -->
						<div class="underline"></div>
					</div>
					<!-- single contact info start -->
					<div class="footer_single_contact_info">
						<i class="fa fa-thumb-tack" aria-hidden="true"></i>
						<p>{{ frontendData::get_backend('address') }}</p>
					</div>
					<!-- single contact info start -->
					<div class="footer_single_contact_info">
						<i class="fa fa-phone" aria-hidden="true"></i>
						<a href="tel:{{ frontendData::get_backend('phone') }}">{{ frontendData::get_backend('phone') }}</a>
					</div>
					<!-- single contact info start -->
					<div class="footer_single_contact_info">
						<i class="fa fa-envelope-o" aria-hidden="true"></i>
						<a href="mailto:{{ frontendData::get_backend('email') }}">{{ frontendData::get_backend('email') }}</a>
					</div>
				</div>
			</div>
			<!-- Contact info Area End -->

			<!-- Useful Links Area Start -->
			<div class="col-12 col-md-6 col-lg-3">
				<div class="important_links footer-single-part item wow fadeInUp">
					<div class="title">
						<h4>Faydalı Linklər</h4>
						<!-- Useful Links Title -->
						<div class="underline"></div>
					</div>
					<!-- Links Start -->
					<div class="links">
						<p><i class="fa fa-angle-double-right" aria-hidden="true"></i><a href="result.html">Müəllim Axtarışı</a></p>
						<p><i class="fa fa-angle-double-right" aria-hidden="true"></i><a href="#">Onlayn İmtahan</a></p>
						<p><i class="fa fa-angle-double-right" aria-hidden="true"></i><a href="vacancies.html">İş İmkanları</a></p>
						<p><i class="fa fa-angle-double-right" aria-hidden="true"></i><a href="pdf_books.html">PDF Dərsliklər</a></p>
						<p><i class="fa fa-angle-double-right" aria-hidden="true"></i><a href="#">Hüquq və Qaydalar</a></p>
					</div>
					<!-- Links End -->
				</div>
			</div>
			<!-- Useful Links Area End -->
		</div>
	</div>

	<!-- Bottom Footer Area Start -->
	<div class="col-sm-12 copyright" >
		<div class="col-sm-12 copyright" >
			<div class="copyright-text text-center">
				{{ frontendData::get_backend('footer') }}
			</div>
		</div>
	</div>
	<!-- Bottom Footer Area End -->
</footer>
<!-- ===================== Footer Area End ===================== -->