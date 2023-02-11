<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Dokani</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <link href="{{ asset('assets/main.css') }}" rel="stylesheet">
    
    <link href="{{ asset('assets/css/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap-tokenfield.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.min.css') }}">
    <style type="text/css">
       

        .box {
          display: flex;
          align-items: center;
          justify-content: center;
        }

        .box div {
          width: 100px;
          height: 100px;
        }

        .info {
            font-size: 1.5em;
        }

        .filters {
            display: none;
        }

        .modal .modal-body {    
        overflow-y: auto;
        max-height: 400px;
    }
    </style>
</head>
<body>
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        
        @include('layouts.app-header')

                  
        <div class="app-main">
                @include('layouts.app-sidebar')
                <div class="app-main__outer">

                    <div class="app-main__inner">   
                        
                       @yield('content')
                       
                    </div>


                   @include('layouts.app-wrapper-footer')
                  
            </div>
                

        </div>
    </div>

    <script type="text/javascript" src="{{ asset('assets/scripts/main.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/scripts/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/scripts/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/scripts/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/scripts/bootstrap-tokenfield.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/scripts/select2.full.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/scripts/select2Scripts.js') }}"></script>
    <script type="text/javascript">
            $(document).ready(function(){
 
             $('#selection_value').tokenfield();
            });
    </script>

    <script type="text/javascript" src="{{ asset('assets/scripts/printThis.js') }}"></script>
    <script type="text/javascript">
        $('body').on('click','.print',function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            
            $('#barcode-'+id).printThis({
                importCSS: true
            });
        });

        $('#filter').click(function () {
            var btn = $(this).text();
            $('.filters').slideToggle(100);
            

            if ($.trim($(this).text()) === 'Show Filters') {
               $(this).text('Hide Filters');
            } else {
                $(this).text('Show Filters');        
            }

        });       
    </script>


 
    
</body>
</html>
