<!DOCTYPE html>

<html
  lang="ar"
  class="light-style layout-menu-fixed"
  dir="rtl"
  data-theme="theme-default"
  data-assets-path="sneat/assets/"
  data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>

    <title>لوحة التحكم</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('sneat/assets/img/favicon/favicon.ico') }}" />

   

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('sneat/assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('sneat/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('sneat/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('sneat/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('sneat/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('sneat/assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('sneat/assets/vendor/js/helpers.js') }}"></script>
  

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    
    <script src="{{ asset('sneat/assets/js/config.js') }}"></script>
    <link href="{{ asset('sneat/assets/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('sneat/assets/css/toastr.css') }}" rel="stylesheet" />
    
    
    <style>
      .input-error{
         outline: 1px solid red;
      }
      .select2-container--default .select2-selection--single .select2-selection__arrow b {
          margin-top: 10px;
      }
  
      .select2-container--default .select2-selection--single{
          border-radius: 0.5rem;
          font-size: 1rem;
          min-height: calc(1.53em + 1.5rem + 2px);
          padding: 0.75rem 1.25rem;
      }

      .select2-container--default .select2-selection--multiple {
        border-radius: 0.5rem;
          font-size: 1rem;
          min-height: calc(1.53em + 1.5rem + 2px);
          padding: 0.75rem 1.25rem;
      }
  </style>
  </head>
  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">

        @include('layouts.aside')
        <div class="layout-page">
            @include('layouts.nav')
           
            <!-- Content wrapper -->
          <div class="content-wrapper">
           
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              @if($errors->any())
              <section class="col-lg-12">
              
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger d-flex justify-content-between align-items-center">
                        {{$error}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endforeach
             
              </section>
              @endif
                <div class="row">
                    @yield('content')
                </div>
            </div>

            <div class="content-backdrop fade"></div>
          </div>
        </div>
      </div>

       <!-- Overlay -->
       <div class="layout-overlay layout-menu-toggle"></div>
    </div>


     <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('sneat/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('sneat/assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('sneat/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('sneat/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('sneat/assets/js/filter.js') }}"></script>
    <script src="{{ asset('sneat/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('sneat/assets/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('sneat/assets/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('sneat/assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Main JS -->
    <script src="{{ asset('sneat/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('sneat/assets/js/dashboards-analytics.js') }}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="{{ asset('sneat/assets/js/buttons.js') }}"></script>
    <script src="{{ asset('sneat/assets/js/parsley.min.js') }}"></script>
    <script src="{{ asset('sneat/assets/js/next.js') }}"></script>
    <script src="{{ asset('sneat/assets/js/toastr.js') }}"></script>

        <script>
            $(document).ready(function() {
                toastr.options.timeOut = 10000;
                @if (Session::has('error'))
                    toastr.error('{{ Session::get('error') }}');
                @elseif(Session::has('success'))
                    toastr.success('{{ Session::get('success') }}');
                @elseif(Session::has('warning'))
                    toastr.warning('{{ Session::get('warning') }}');
                @endif

                var price = 0.0;
                $('.item-area .subtotal').each(function(index){
                  
                  price += parseFloat($(this).val());
                  
                });
                
                $('#total').val(price);
                $('#displayTotal').html(price);
                console.log(price);
                if (price > 0) {
                  $('#order-btn').attr('disabled',false);
                }else {
                  $('#order-btn').attr('disabled','disabled');
                }
            });
    
        </script>
        @stack('js')
  </body>
</html>


