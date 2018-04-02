
@layout('views/layouts/master')


@section('content')
    @include('views/partials/breadcrumb')

    <section class="message_now_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Message Title -->
                    <div class="message_title">
                        <h3>Şikayət və ya Təklifinizi Bizə Göndərin</h3>
                    </div>
                </div>
            </div>
            <!-- .end row -->
            <div class="row">
                <div class="col-12">
                    <form id="contact-form" action="mail.php" method="post">
                        <!-- Message Input Area Start -->
                        <div class="contact_input_area">
                            <div id="success_fail_info"></div>
                            <div class="row">
                                <!-- Single Input Area Start -->
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control" id="send-email-name" placeholder="Adınız və Soyadınız *" required>
                                    </div>
                                </div>
                                <!-- Single Input Area Start -->
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" id="send-email-email" placeholder="Poçt Adresiniz *" required>
                                    </div>
                                </div>
                                <!-- Single Input Area Start -->
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="title" class="form-control" id="send-email-subject" placeholder="Mövzu Başlığı *" required>
                                    </div>
                                </div>
                                <!-- Single Input Area Start -->
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <input type="number" name="phone" class="form-control" id="send-email-phone" placeholder="Telefon Nömrəniz *" required>
                                    </div>
                                </div>

                                <!-- Single Input Area Start -->
                                <div class="col-12">
                                    <div class="form-group">
                                        <textarea name="message" id="send-email-message" class="form-control" rows="" placeholder="Müraciətiniz *" maxlength="550" required></textarea>
                                        <h6>
                                            <span id="counter__length"></span>
                                        </h6>
                                    </div>
                                </div>
                                <!-- Single Input Area Start -->
                                <div class="col-12">
                                    <button type="button" class="btn btn-default" id="send-email" name="ok">Göndər</button>
                                </div>
                            </div>
                        </div>
                        <!-- Message Input Area End -->
                    </form>
                </div>
            </div>
        </div>
    </section>


    <!-- Start About Content -->
    <section id="about" class="">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-about">
                        <p> {{ htmlspecialchars_decode($page->content) }} </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Close About Content -->

@endsection

@section('footerAssetPush')
    <script>
        var counterLength = document.querySelector('#send-email-message');
        document.getElementById('counter__length').innerHTML = 'Qalan simvol sayı: '+counterLength.getAttribute('maxlength');
        function val(e) {
            var attrLength = counterLength.getAttribute('maxlength');
            var currentLength = counterLength.value.length;
            var totalLength = attrLength - currentLength;
            document.querySelector('#counter__length').innerHTML = 'Qalan simvol sayı: '+totalLength;
            if (e.keyCode === 8) {
                document.querySelector('#counter__length').innerHTML = 'Qalan simvol sayı: '+totalLength++;
            }
        }
        counterLength.addEventListener("keyup", val, false);

        function check_email(email) {
            var status = false;
            var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
            if (email.search(emailRegEx) == -1) {
                $("#to_error").html('');
                $("#to_error").html("<?=$this->lang->line('mail_valid')?>").css("text-align", "left").css("color", 'red');
            } else {
                status = true;
            }
            return status;
        }
        $(document).on('click', '#send-email', function() {
            var error       = 0;
            var name        = $('#send-email-name').val();
            var email       = $('#send-email-email').val();
            var subject     = $('#send-email-subject').val();
            var message     = $('#send-email-message').val();
            var phone       = $('#send-email-phone').val();

            if(name == '') {
                error++;
                $('#send-email-name').css("border-color", 'red');
            } else {
                $('#send-email-name').css("border-color", '');
            }   

            if(email == '') {
                error++;
                $('#send-email-email').css("border-color", 'red');
            } else {
                $('#send-email-email').css("border-color", '');
            }

            if(subject == '') {
                error++;
                $('#send-email-subject').css("border-color", 'red');
            } else {
                $('#send-email-subject').css("border-color", '');
            }

            if(message == '') {
                error++;
                $('#send-email-message').css("border-color", 'red');
            } else {
                $('#send-email-message').css("border-color", '');
            }

            if(phone == '') {
                error++;
                $('#send-email-phone').css("border-color", 'red');
            } else {
                $('#send-email-phone').css("border-color", '');
            }

            if(check_email(email) == false) {
                error++;
                $('#send-email-email').css("border-color", 'red');
            } else {
                $('#send-email-email').css("border-color", '');
            }

            if(error <= 0) {
                $.ajax({
                    type: 'POST',
                    url: "<?=base_url('frontend/contactMailSend')?>",
                    data: {'name' : name, 'email' : email, 'phone' : phone, 'subject' : subject, 'message' : message},
                    dataType: "html",
                    success: function(data) {
                        if(data = 'success') {
                            location.reload();
                        }
                    }
                });

            }
        });

    </script>


    @if($this->session->flashdata('success'))
        <script type="text/javascript">
            toastr["success"]("<?=$this->session->flashdata('success');?>")
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
        </script>
    @endif

    @if($this->session->flashdata('error'))
       <script type="text/javascript">
            toastr["error"]("<?=$this->session->flashdata('error');?>")
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
        </script>
    @endif
@endsection