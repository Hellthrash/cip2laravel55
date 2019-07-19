@include('layout.header')

        <link rel="stylesheet" href="{{asset('pickadate/themes/default.css')}}">
        <link rel="stylesheet" href="{{asset('pickadate/themes/default-date.css')}}">
        <!-- Icons -->
        <link href="{{asset('icons/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
        <link href="{{asset('icons/themify-icons/themify-icons.css')}}" rel="stylesheet">
        <!--animate css-->
        <link rel="stylesheet" href="{{asset('animate.css')}}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset('css/main-style.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/skins/all-skins.css')}}">

        <link rel="stylesheet" href="{{asset('node_modules/filepond/dist/filepond.css')}}">
        <link rel="stylesheet" href="{{asset('node_modules/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css')}}">
        <link href="{{asset('js/sweetalert/sweetalert.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/dropify.css')}}">


        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <!--
      |---------------------------------------------------------|
      |LAYOUT OPTIONS | fixed                                   |
      |               | layout-boxed                            |
      |               | sidebar-collapse                        |
      |               | sidebar-mini                            |
      |---------------------------------------------------------|
    -->
    <body class="skin-yellow sidebar-mini fixed">
        <div class="page-loader-wrapper">
            <div class="spinner"></div>
        </div>
        <div class="wrapper">
            <!-- Main Header -->
            @include('layout.top_menu_header')
            <!-- Left side column. contains the logo and sidebar -->
            @include('layout.sidebar_left')
            <!-- Content Wrapper -->
            <div class="content-wrapper">
                <section class="content">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="nav-tabs-custom">
                                <div class="tab-content">
                                        <div class="box box-form no-shadow">
                                            <div class="box-header">
                                                <h3 class="box-title">Gestionar comprobante</h3>
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body">
                                                <div class="col-md-12">
                                                    <form enctype="multipart/form-data" action="/admin/invoice-update" method="POST">
                                                        <label>Reemplazar comprobante</label>
                                                        <input id="invoice" name="invoice" class="dropify" type="file" required accept="application/pdf">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="hidden" name="id" value="{{ $invoice->id }}">
                                                        <input type="submit" value="Subir" class="btn btn-sm btn-primary">
                                                    </form>
                                                    <br>
                                                    <div class='row'>
                                                        <div class='col-md-12'>
                                                            <div class='form-group'>
                                                                <label>Descuento</label>
                                                                <input class="form-control" id="discount" name="discount" type="text" value="{{$invoice->discount}}" />
                                                            </div>
                                                        </div>
                                                    <div class='row'>
                                                    </div>
                                                        <div class='col-md-12'>
                                                            <div class='form-group'>
                                                                <label>IVA</label>
                                                                 <select id="iva" name="iva" class="form-control select2">
                                                                <option value="yes">Con IVA</option>
                                                                <option value="no">Sin IVA</option>
                                                            </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class='col-md-12'>
                                                            <div class='form-group'>
                                                                <label>Tipo de documento</label>
                                                                 <select id="type" name="type" class="form-control select2">
                                                                <option value="NCI">NCI</option>
                                                                <option value="BCIP">BCIP</option>
                                                                <option value="boleta">Boleta</option>
                                                                <option value="Factura">factura</option>
                                                            </select>
                                                            </div>
                                                        </div>
                                                    <div class='row'>
                                                    </div>
                                                        <div class='col-md-12'>
                                                            <div class="form-group">
                                                                <label>Estado</label>
                                                                <select id="status" name="status" class="form-control select2">
                                                                    @if($invoice->status == "payed")
                                                                    <option selected="selected" value="payed">Pagado</option>
                                                                    <option value="pending">Pendiente</option>
                                                                    @else
                                                                    <option value="payed">Pagado</option>
                                                                    <option selected="selected" value="pending">Pendiente</option>
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class='row'>
                                                        <div class='col-md-12'>
                                                            <div class='form-group'>
                                                                <button id="btn_update" type="button" class="btn btn-primary">Actualizar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                </div>
                                <!-- /.tab-content -->
                            </div>
                        </div>
                        <div class="col-md-8">
                            <embed src="{{ asset($invoice->pdf) }}" style="width:100%; height:800px;" frameborder="0">
                        </div>
                    </div>
                    
                </section>
                <!-- /. main content -->
                <span class="return-up"><i class="fa fa-chevron-up"></i></span>
            </div>
            <!-- /. content-wrapper -->
            <!-- Main Footer -->
            @include('layout.footer')
        </div>


        <!-- /. wrapper content-->
        <!-- JS scripts -->
        <script src="{{asset('jQuery/jquery-2.2.3.min.js')}}"></script>
        <script src="{{asset('node_modules/filepond/dist/filepond.min.js')}}"></script>
        <script src="{{asset('node_modules/jquery-filepond/filepond.jquery.js')}}"></script>
        <script src="{{asset('node_modules/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js')}}"></script>
        <script src="{{asset('node_modules/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.min.js')}}"></script>
        <script src="{{asset('node_modules/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.min.js')}}"></script>
        <script src="{{asset('node_modules/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.min.js')}}"></script>
        <script src="{{asset('node_modules/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.min.js')}}"></script>
        <script src="{{asset('node_modules/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.min.js')}}"></script>
        <script src="{{asset('node_modules/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.min.js')}}"></script>
        <script src="{{asset('js/jquery-fullscreen/jquery.fullscreen-min.js')}}"></script>
        <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/slimScroll/jquery.slimscroll.min.js')}}"></script>
        <script src="{{asset('js/fastclick/fastclick.min.js')}}"></script>
        <script src="{{asset('pickadate/picker.js')}}"></script>
        <script src="{{asset('pickadate/picker-date.js')}}"></script>
        <script src="{{asset('js/pages/jquery-pickadate.js')}}"></script>
        <script src="{{asset('material-buttons/ripple-effects.js')}}"></script>
        <script src="{{asset('js/sweetalert/sweetalert.min.js')}}"></script>

        <script src="{{asset('js/user-profile.js')}}"></script>


        <script src="{{asset('js/app2.js')}}"></script>
        <!-- Slimscroll is required when using the fixed layout. -->
    </body>
</html>

<style type="text/css">
    
</style>

<script type="text/javascript">
    
    $(function(){
     


    $('.dropify').dropify();

});

    $('#btn_update').on('click',function(e){

        e.preventDefault();

        var name = $('#name').val();
        var lName = $('#lName').val();
        var rut = $('#rut').val();
        var confirmed = $('#confirmed').val();
        var phone = $('#phone').val();
        var email = $('#email').val();
        var department = $('#department').val();
        var type = $('#type').val();

        $.ajax({
            // En data puedes utilizar un objeto JSON, un array o un query string
           data:{name:name, lName:lName, rut:rut, confirmed:confirmed, phone:phone, email:email, department:department, type:type, "_token": "{{ csrf_token() }}"},
            //Cambiar a type: POST si necesario
            type: 'PUT',
            // Formato de datos que se espera en la respuesta
            dataType: "json",
            // URL a la que se enviará la solicitud Ajax
            url: '/admin/user/update' , //this is different because it can change user type
            success:function(data){
                    if(data.errors != ""){
                        html = '<p>Por favor corregir los siguientes errores</p><br><div class="alert alert-danger fade in">';
                        jQuery.each(data.errors, function(key, value){
                            html += '<li>' + value + '</li>';
                        });
                        swal({
                            title:"Ups!!",
                            text: html,
                            type: "warning",
                            html: true
                        });
                    }
                if(data.message != ""){
                    swal({
                        title:"Actualizado!!",
                        text: "<strong>"+data.message+"</strong>",
                        type: "success",
                        html: true,
                    },function () {
                        window.location.reload(true);
                    });
                }
            }
        }); 
    });

    $('#btn_destroy').on('click',function(e){

        var id = {{$invoice->id}};
        e.preventDefault();

            swal({
            title: "Esta seguro(a)?",
            text: name+" se borrará permanentemente del sistema!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si, borrar!",
            cancelButtonText: "Cancelar",
            closeOnConfirm: false
        }, function () {
            $.ajax({
                data:{
                id:id, "_token": "{{ csrf_token() }}",
                },
                //Cambiar type si necesario
                type: 'POST',
                // Formato de datos que se espera en la respuesta
                dataType: "json",
                // URL a la que se enviará la solicitud Ajax
                url: '/admin/user-destroy' , 
                success: function(json){
                    if(json.error == ""){
                        swal({
                            title:"Usuario eliminado!!",
                            text: json.message,
                            type: "success",
                            html: true,
                        }, function () {
                            window.location.href = "/admin";
                        });
                    }
                    if(json.message == "")
                    {
                        swal({
                            title:"Lo sentimos...",
                            text: json.error,
                            type: "warning",
                            html: true
                        });
                    }                    
                } 
            });
        });
    });

</script>