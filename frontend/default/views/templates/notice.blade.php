@layout('views/layouts/master')


@section('content')
    @include('views/partials/breadcrumb')

    <section class="popular_coureses_area home2 event-grid grid_coundown section_padding_100">
        <div class="container">
            <div class="row">
                <div class="col-12 pb-5">
                    <div class="form-group">
                        <input class="form-control" name="search_data" id="search_data" type="text" placeholder="search" onkeyup="search_data()">
                    </div>
                </div>
            </div>
            <div id="search_results" class="row">

            </div>
        </div>
    </section>
@endsection@section('footerAssetPush')
    <script type="text/javascript">
        search_data();

        function search_data()
        {
            var params = new URLSearchParams();
            var input_data = $('#search_data').val();
            params.append('search_data', input_data);

            axios.post('<?php echo base_url(); ?>Frontend/autocomplete', params)
                .then(function (data) {
                    console.log(data);
                    $('#search_results').html(data.data);
                })
                .catch(function (error) {
                    console.log(error);
                });

        }
    </script>
@endsection

