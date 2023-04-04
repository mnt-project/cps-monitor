<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title-block')</title>
        <link rel="stylesheet" href="/css/app.css">
        <!-- CSS only -->
        <!-- Bootstrap core CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <!-- CSS only -->
        {{--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">--}}
        <!-- Подключается для иконок-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    </head>
    <body>
        <header>
            @include('admin.inc.header')
        </header>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-4 col-lg-2 col-xl-2 col-xxl-2">
                    @yield('dashboard-aside')
                </div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-7 col-xl-7 col-xxl-8">
                    <div class="text-center mb-5">@yield('dashboard-header')</div>
                    <div class="position-fixed bottom-0 end-0 p-3 mb-5" style="z-index: 5">
                        @include('admin.inc.messages')
                    </div>
                    @yield('dashboard-text')
                </div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-3 col-xl-3 col-xxl-2">
                    @yield('dashboard-info')
                </div>
            </div>
        </div>
        <footer>
            @include('admin.inc.footer')
        </footer>

        <!-- Подключается для java script-->
        <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
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


