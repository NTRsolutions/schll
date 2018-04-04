@layout('views/layouts/master')


@section('content')

    <section class="latest_blog_news_area blog sidebar section_padding_100">
        <div class="container">
            <div class="row">
                <div class="col-12 pb-5">
                    <div class="form-group">
                        <input class="form-control" name="search_data" id="search_data" type="text" placeholder="Axtarış" onkeyup="search_data()">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="blog_rightsider">
                        <div class="row" id="search_results">

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection

@section('footerAssetPush')
    <script type="text/javascript">
        search_data();

        function search_data()
        {
            var params = new URLSearchParams();
            var input_data = $('#search_data').val();
            params.append('search_data', input_data);

            axios.post('<?php echo base_url(); ?>Frontend/teacher_search', params)
                .then(function (data) {
                    $('#search_results').html(data.data);
                })
                .catch(function (error) {
                    $('#search_results').html(error);
                });

        }
    </script>
@endsection