<!DOCTYPE html>
<html lang="en">
@include('includes.head')

<body>
    @include('includes.header')
    @include('includes.sidebar') 
        
    <div class="container" style="margin:90px 250px">
        @yield('content')
    </div>
    
    <script src = "/js/script.js"></script>
</body>
</html>