<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title')</title>

  {{-- vendor styles  --}}
  {{-- Bootstrap CSS --}}
  <link href="{{ asset('assets_frontend/vendors/bootstrap/css/bootstrap.min.css') }}" type="text/css" rel="stylesheet" />
  {{-- Fontawesome CSS --}}
  <link href="{{ asset('assets_frontend/vendors/fontawesome/css/fontawesome.min.css') }}" type="text/css" rel="stylesheet" />
  <link href="{{ asset('assets_frontend/vendors/fontawesome/css/brands.min.css') }}" type="text/css" rel="stylesheet" />
  <link href="{{ asset('assets_frontend/vendors/fontawesome/css/solid.min.css') }}" type="text/css" rel="stylesheet" />

  {{-- global custom styles --}}
  <link href="{{ asset('assets_frontend/css/app.css') }}" type="text/css" rel="stylesheet" />

  {{-- page (child) styles --}}
  @yield('page-styles')
</head>
<body>

  @include('frontend.layouts.partials.header')

  <main>
    @yield('content')
  </main>

  @include('frontend.layouts.partials.footer')
  
  {{-- vendor scripts --}}
  {{-- Popper JS --}}
  <script src="{{ asset('assets_frontend/vendors/popper/popper.min.js') }}"></script>
  {{-- Bootstrap JS --}}
  <script src="{{ asset('assets_frontend/vendors/bootstrap/js/bootstrap.min.js') }}"></script>

  {{-- global custom scripts --}}
  <script src="{{ asset('assets_frontend/js/app.js') }}"></script>

  {{-- page (child) scripts --}}
  @yield('page-scripts')
</body>
</html>