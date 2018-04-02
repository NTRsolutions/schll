<!-- Top Header Area Start -->
<div class="top_header_area hidden-xs">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-lg-5">
                <!--  Top Quote Area Start -->
                <div class="top_quote hidden-sm">
                    <p>Onlayn Təhsil Mərkəzinə Xoş Gəlmisiniz</p>
                </div>
            </div>
            <div class="col-md-9 col-lg-7">
                <div class="social_reg_log_area">
                    <!--  Top Social bar start -->
                    <div class="top_social_bar">
                        <a href="{{ frontendData::get_frontend('facebook') }}" target="_blank"><i class="fa fa-facebook"></i></a>
                        <a href="{{ frontendData::get_frontend('twitter') }}" target="_blank"><i class="fa fa-twitter"></i></a>
                        <a href="{{ frontendData::get_frontend('linkedin') }}" target="_blank"><i class="fa fa-linkedin"></i></a>
                        <a href="{{ frontendData::get_frontend('youtube') }}" target="_blank"><i class="fa fa-youtube"></i></a>
                        <a href="{{ frontendData::get_frontend('google') }}" target="_blank"><i class="fa fa-google-plus"></i></a>
                    </div>
                    <!--  Login Register Area -->
                    <div class="login_register">
                        <div class="login">
                            <i class="fa fa-sign-in" aria-hidden="true"></i>
                            <a href="login.html">Şəxsi Kabinet</a>
                        </div>
                        <div class="reg">
                            <i class="fa fa-user-plus" aria-hidden="true"></i>
                            <a href="register.html">Qeydiyyat</a>
                        </div>
                    </div>

                    <div class="language_area">
                        <div class="dropdown">
                            <button aria-expanded="false" aria-haspopup="true" data-toggle="dropdown" id="lag" type="button" class="btn btn-default dropdown-toggle">
                                <i class="fa fa-globe" aria-hidden="true"></i>Dil
                            </button>
                            <ul aria-labelledby="lag" class="dropdown-menu">
                                <li>
                                    <a href="#">&nbsp;&nbsp;<img alt="" src="<?=base_url($frontendThemePath.'assets/img/core-img/az.png')?>""> Azərbaycan</a>
                                </li>
                                <li>
                                    <a href="#">&nbsp;&nbsp;<img alt="" src="<?=base_url($frontendThemePath.'assets/img/core-img/eng.png')?>""> English</a>
                                </li>
                                <li>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Top Header Area  End -->
