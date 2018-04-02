@layout('views/layouts/master')

@section('content')
	<section class="error_page section_padding_100">
		<div class="container">
			<div class="row">
				<div class="col">
					<!--  Page not found text start -->
					<div class="not-found-text text-center">
						<h2>404</h2>
						<br>
						<h3>BAĞIŞLAYIN!</h3>
						<br>
						<h5>Axtardığınız səhifə tapılmadı</h5>
						<p>Daha sonra yenidən yoxlayın və ya <strong>Bizimlə Əlaqə</strong> bölməsindən iradınızı bildirin.</p>
						<a class="btn btn-default" href="<?=base_url('frontend/page/home')?>" role="button">Ana Səhifəyə Qayıt</a>
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection