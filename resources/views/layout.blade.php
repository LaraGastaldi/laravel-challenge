<html>
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @yield('extra_header')
</head>
<body>
<!-- header -->
<div class="d-flex p-2 bg-success justify-content-center">
    <div class="container-flex">
        <h1 class="display-3 text-light">@yield('title')</h1>
    </div>
</div>
<!-- content -->
<div class="container">
    @yield('content')
</div>
</body>
</html>
