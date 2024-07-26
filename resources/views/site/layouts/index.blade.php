<!DOCTYPE html>
<html>

  @include('site.components.head')

  <body>
    <div id="wrapper" class="container-fluid">
        @include('site.components.header')

        @yield('content')

    </div>

    @include('site.includes.scripts')

  </body>
</html>
