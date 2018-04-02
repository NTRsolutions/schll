<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="SHORTCUT ICON" href="<?=base_url($frontendThemePath.'assets/img/core-img/favicon.ico')?>">
    <title> @yield('page-title') | CorrectSteps</title>


    @include('views/partials/headerAssets')
</head>
<body>
    <div id="preloader"></div>
    <header id="home">
        @include('views/partials/topbar')
        @include('views/partials/navbar')
    </header>

    @yield('content')
    @include('views/partials/footer')
    @include('views/partials/footerAssets')
    
</body>
</html>