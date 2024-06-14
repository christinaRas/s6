<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('client/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/elegant-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/elegant-font-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/slider.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/odometer.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/venobox/venobox.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/responsive.css') }}">

</head>
<body>
    <header class="header">
        <div class="primary-header">
            <div class="container">
                <div class="primary-header-inner">
                    <div class="header-logo">
                        <a href="#"><img src="{{ asset('admin/images/logo.png') }}" width="100px" alt="Indico"></a>
                    </div>
                    <div class="header-menu-wrap">
                        <ul class="dl-menu">
                            <li><a href="{{ route('listeEtape') }}">Home</a></li>
                            <li><a href="">Classement</a>
                        <ul>
                            <li><a href="{{ route('equipeClassementEtape') }}">Classement par etape</a></li>
                            <li><a href="{{ route('equipeClassementTotal') }}">Classement total</a></li>
                            <li><a href="{{ route('ClassementCategorie') }}">Classement par categorie</a></li>
                        </ul>
                    </div>
                    <div class="header-right">
                        <a class="menu-btn" href="{{ route('logout')}}">Deconnexion</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
</body>
</html>