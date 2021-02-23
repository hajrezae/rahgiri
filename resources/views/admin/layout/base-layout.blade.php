<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ isset($page_title) ? $page_title : '' }}</title>
    {{--    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.rtl.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/persian-datepicker@1.2.0/dist/css/persian-datepicker.min.css">
    @yield('custom_styles')

</head>
<body>
@include('admin.layout.partials.header')

<div class="container-fluid mt-3" style="height: 100vh">
    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger shadow-sm" role="alert">
                {{ $error }}
            </div>
        @endforeach
    @endif

    @if(session('success'))
        <div class="alert alert-success shadow-sm" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if(session('failed'))
        <div class="alert alert-danger shadow-sm" role="alert">
            {{ session('failed') }}
        </div>
    @endif

    <div class="row justify-content-center mb-4">
        @yield('content')
    </div>


</div>
<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/persian-date@1.1.0/dist/persian-date.min.js"></script>
<script src="https://unpkg.com/persian-datepicker@1.2.0/dist/js/persian-datepicker.min.js"></script>
@yield('scripts')
</body>
</html>
