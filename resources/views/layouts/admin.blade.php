<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title-block')</title>
        <link rel="stylesheet" href="/css/app.css">
        <!-- CSS only -->
        <!-- Bootstrap core CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <!-- Подключается для иконок-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    </head>
    <body>
        <header>
            @include('admin.inc.header')
        </header>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-2 col-xl-2 col-xxl-2">
                    @yield('dashboard-aside')
                </div>
                <div class="col-sm-12 col-md-4 col-lg-7 col-xl-7 col-xxl-8">
                    <div class="text-center mb-5">@yield('dashboard-header')</div>
                    <div class="position-fixed bottom-0 end-0 p-3 mb-5" style="z-index: 5">
                        @include('admin.inc.messages')
                    </div>
                    @yield('dashboard-text')
                </div>
                <div class="col-sm-12 col-md-4 col-lg-3 col-xl-3 col-xxl-2">
                    @yield('dashboard-info')
                </div>
            </div>
        </div>
        <footer>
            @include('admin.inc.footer')
        </footer>

        <!-- Подключается для java script-->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        {{--        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>--}}
        {{--        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>--}}
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
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


