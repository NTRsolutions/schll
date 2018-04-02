<!-- Main Header Area Start -->
<div class="main_header_area home2">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-12">
                <!-- Logo Area -->
                <div class="logo_area">
                    <a href="<?=base_url('frontend/page/home')?>"><img src="<?=base_url($frontendThemePath.'assets/img/core-img/logo.png')?>" alt=""></a>
                </div>
            </div>

            <div class="col-md-9 col-12">
                <!-- Menu Area -->
                <div class="main_menu_area">
                    <div class="mainmenu">
                        <nav>
                            <ul id="nav">
                                {{ frontendData::get_frontent_topbar_menu() }}
                            </ul>
                        </nav>
                    </div>
                    <!-- mainmenu end -->
                    <!-- Search Button Area -->
                    <div class="search_button hidden-xs">
                        <a href="#"><i class="fa fa-search" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Header Area End -->

<!-- Search Box Area Start -->
<div id="search">
    <div class="search_box_area">
        <form action="#" method="post">
            <input type="text" name="s" id="search_box" placeholder="Axtarış Sözünü Daxil Edin">
            <input type="submit" value="Submit" id="sub">
            <div id="close_button">
                <i class="fa fa-times-circle" aria-hidden="true"></i>
            </div>
        </form>
    </div>
</div>
<!-- Search Box Area End -->