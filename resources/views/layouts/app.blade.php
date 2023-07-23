<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title-block')</title>
        <link rel="stylesheet" href="/css/app.css">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('bootstrap-icons/font/bootstrap-icons.css') }}">
    </head>
    <body>
        <header>
            @include('inc.header')
        </header>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-4 col-lg-2 col-xl-3 col-xxl-2">
                    @yield('content-aside')
                </div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-7 col-xl-6 col-xxl-8">
                    <div class="text-center mb-5">@yield('content-header')</div>
                    <div class="position-fixed bottom-0 end-0 p-3 mb-5" style="z-index: 5">
                        @include('inc.messages')
                    </div>
                    @yield('content-text')
                </div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-3 col-xl-3 col-xxl-2">
                    @yield('content-info')
                </div>
            </div>
        </div>
        <footer>
            @include('inc.footer')
        </footer>
        <script src="{{ asset('js/jquery-3.6.3.js') }}"></script>
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
        <script>
            //Всплывающие окна инфо-сообщений
            $(document).ready(function() {
                $('.toast').toast({
                    'delay': 5000
                });

                $('.toast').toast('show');
            });
            $('#postbtn').hide();

            $('#post').on('keyup', function() {
                if (this.value.length) {
                    $('#postbtn').show();
                }else{
                    $('#postbtn').hide();
                }
            });
            //Кликабельность таблиц
            jQuery(document).ready(function($) {
                $(".clickable-row-table").click(function() {
                    window.location = $(this).data("href");
                });
            });
            $(function () {
                $('#myTab a:last').tab('show');
            });
        </script>
    </body>
</html>


