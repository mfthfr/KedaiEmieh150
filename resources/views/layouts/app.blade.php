<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('admin')}}/img/logo.png">
    <title>Kedai Mieh 150</title>
    <!-- Custom CSS -->
    <link href="{{asset('admin')}}/dist/css/style.min.css" rel="stylesheet">
</head>

<body>
@yield('content')

    <script src="{{asset('admin')}}/assets/libs/jquery/dist/jquery.min.js "></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('admin')}}/assets/libs/popper.js/dist/umd/popper.min.js "></script>
    <script src="{{asset('admin')}}/assets/libs/bootstrap/dist/js/bootstrap.min.js "></script>
    <script>
        $(".preloader ").fadeOut();
    </script>
</body>
</html>
