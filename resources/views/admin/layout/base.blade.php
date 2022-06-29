<!DOCTYPE html>
<html lang="en">
@include('includes.head')

<body data-page-id="@yield('data-page-id')">
    @include('includes.header')
    @include('admin.sidebar')
    
    <div class="container" style="margin:90px 250px">
        @yield('content')
    </div>
    
    <script src="/js/script.js"></script>
</body>
</html>