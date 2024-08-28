<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>@yield('title')</title>
    <!-- CSS files -->
    <link href="{{asset('/dist/css/tabler.min.css?1692870487')}}" rel="stylesheet"/>
    <link href="{{asset('/dist/css/tabler-flags.min.css?1692870487')}}" rel="stylesheet"/>
    <link href="{{asset('/dist/css/tabler-payments.min.css?1692870487')}}" rel="stylesheet"/>
    <link href="{{asset('/dist/css/tabler-vendors.min.css?1692870487')}}" rel="stylesheet"/>
    <link href="{{asset('/dist/css/demo.min.css?1692870487')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('/assets/images/logo/logo_sekolah.png')}}">
    <link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
   />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
      	--tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
      	font-feature-settings: "cv03", "cv04", "cv11";
      }
    </style>
  </head>
  <body>
    {{-- Alert Modal --}}
    @if(session()->has('title'))
    <div class="modal modal-blur fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="alertModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-status bg-{{session('alert')}}"></div>
                <div class="modal-body text-center py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-{{session('alert')}} icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">{!!session('icon')!!}</svg>
                    <h3>{{session('title')}}</h3>
                    <div class="text-secondary">{{session('message')}}</div>
                </div>
            </div>
        </div>
    </div>
    @endif
    {{-- End Alert Modal --}}
    <!-- JS files -->
    <script src="{{asset('/dist/js/demo-theme.min.js?1692870487')}}"></script>
    
    @yield('content')

    
    <!-- Tabler Core -->
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        tinyMCE.init({
          selector: '#tinymce-mytextarea',
          height: 200,
          menubar: false,
          statusbar: false,
          plugins: 'lists',
          toolbar: 'undo redo | formatselect | ' +
                  'bold italic backcolor | alignleft aligncenter ' +
                  'alignright alignjustify | bullist numlist outdent indent | ' +
                  'removeformat',
          content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; -webkit-font-smoothing: antialiased; }'
        });
      });
    </script>
    
    

    
    <!-- Libs JS -->
    <script src="{{asset('/dist/libs/apexcharts/dist/apexcharts.min.js?1692870487')}}" defer></script>
    <script src="{{asset('/dist/libs/jsvectormap/dist/js/jsvectormap.min.js?1692870487')}}" defer></script>
    <script src="{{asset('/dist/libs/jsvectormap/dist/maps/world.js?1692870487')}}" defer></script>
    <script src="{{asset('/dist/libs/jsvectormap/dist/maps/world-merc.js?1692870487')}}" defer></script>
    <script src="{{asset('/dist/libs/tinymce/tinymce.min.js?1692870487')}}" defer></script>
    
    <!-- Tabler Core -->
    <script src="{{asset('/dist/js/tabler.min.js?1692870487')}}" defer></script>
    <script src="{{asset('/dist/js/demo.min.js?1692870487')}}" defer></script>
    
    <!-- Data Table -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script>
    new DataTable('#dataTableUsers');
    new DataTable('#dataTableAdmins');
    new DataTable('#dataTableStreams-1');
    new DataTable('#dataTableStreams-2');
    new DataTable('#dataTableStudents');
    new DataTable('#dataTableDonationBoxs');
    new DataTable('#dataTableDonations');
    new DataTable('#dataTableFees');
    </script>

    <!-- Custom JS to show the modal -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if(session()->has('title'))
                var alertModal = new bootstrap.Modal(document.getElementById('alertModal'));
                alertModal.show();
            @endif
        });
    </script>
    
  </body>
</html>
