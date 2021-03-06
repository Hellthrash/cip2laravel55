@include('layout.header')

        <!-- Icons -->
        <link href="{{asset('icons/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
        <link href="{{asset('icons/themify-icons/themify-icons.css')}}" rel="stylesheet">
        <!--animate css-->
        <link rel="stylesheet" href="{{asset('animate.css')}}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset('css/main-style.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/skins/all-skins.css')}}">
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
        <div class="page-loader-wrapper" >
            <div class="spinner"></div>
        </div>
        <div class="wrapper">
            <!-- Main Header -->
            @include('layout.top_menu_header')
            <!-- Left side column. contains the logo and sidebar -->
            @include('layout.sidebar_left')
            <!-- Content Wrapper -->
            <div class="content-wrapper">
                <section class="content-title">
                    <h1>
                        Boleta
                        <small>#XXXX</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="/admin"><i class="fa fa-home"></i>Inicio</a></li>
                        <li class="active">Pagos</li>
                        <li class="active">Boleta</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="invoice-box">
                        <table cellpadding="0" cellspacing="0">
                            <tr class="top">
                                <td colspan="2">
                                    <table>
                                        <tr>
                                            <td class="title">
                                                <h2><img style="width: 300px" src="/img/Mecesup_AUS.png"></h2>
                                            </td>
                                            <td>
                                                Emitida: {{date('d-m-Y')}}<br>
                                                Vencimiento: {{date('d-m-Y', strtotime(date('d-m-Y'). ' + 7 days'))}}
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr class="information">
                                <td colspan="2">
                                    <table>
                                        <tr>
                                            <td>
                                                Admin<br>
                                                12345 Street<br>
                                                New York<br>
                                                info@example.com
                                            </td>
                                            <td>
                                                Adrien Doe<br>
                                                12345 Street<br>
                                                New York<br>
                                                adrien.doe@example.com
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr class="heading">
                                <td>
                                    Forma de pago
                                </td>
                                <td>
                                    Boleta #
                                </td>
                            </tr>
                            <tr class="details">
                                <td>
                                    Efectivo
                                </td>
                                <td>
                                    XXXX
                                </td>
                            </tr>
                            <tr class="heading">
                                <td>
                                    Detalle
                                </td>
                                <td>
                                    Valor
                                </td>
                            </tr>
                            <tr class="item">
                                <td>
                                    Cobro base
                                </td>
                                <td>
                                    $300.00
                                </td>
                            </tr>
                            <tr class="item">
                                <td>
                                    IVA
                                </td>
                                <td>
                                    $75.00
                                </td>
                            </tr>
                            <tr class="item last">
                                <td>
                                    Descuento
                                </td>
                                <td>
                                   - $10.00
                                </td>
                            </tr>
                            <tr class="total">
                                <td></td>
                                <td>
                                    Total: $365.00
                                </td>
                            </tr>
                        </table>
                        <!-- accepted payments column -->
                        <div class="">
                            <p class="lead">Métodos de pago:</p>
                            <img style="height: 50px; width: 50px" src="/img/credit/cash.png" alt="Efectivo">
                            <img style="height: 50px; width: 50px" src="/img/credit/bank_trasfer-512.png" alt="Mastercard">
                            <img style="height: 50px; width: 50px" src="/img/credit/p_code.png" alt="American Express">
                            <br>
                        </div>
                        <div class="row">
                            <hr>
                            <div class="col-xs-12">
                                <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Enviar</button>
                                <button class="btn btn-default pull-right" onclick="window.print();" style="margin-right: 5px;"><i class="fa fa-print"></i> Imprimir</button>
                            </div>
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
        <script src="{{asset('js/jquery-fullscreen/jquery.fullscreen-min.js')}}"></script>
        <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/slimScroll/jquery.slimscroll.min.js')}}"></script>
        <script src="{{asset('js/fastclick/fastclick.min.js')}}"></script>
        <script src="{{asset('js/app2.js')}}"></script>
        <!-- Slimscroll is required when using the fixed layout. -->
    </body>
</html>