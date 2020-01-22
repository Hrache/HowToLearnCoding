<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
 <head>

 @include('layouts.inc.head')

 </head>
 <body class="dradient-anim">

  <div class="container-fluid p-0" style="min-height: 70vh;" data-with-bgimage="yes">

   @stack('body')
   @include('layouts.inc.footer')

  </div>

  <script src="{{ asset('js/popper.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/aos.js') }}"></script>
  <script>
   AOS.init({
   'useClassNames': true,
   'mirror': false
   });
   AOS.refresh();
  </script>

  @stack('bottom-scripts')

 </body>
</html>