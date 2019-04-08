@extends('layouts.app')

@section('content')

@include('layouts._nav')

    <div id="wrapper">

        @include('layouts._sidemenu')

        <div id="content-wrapper">

            <div class="container-fluid">

            </div>
            <!-- /.container-fluid -->

            <!-- Sticky Footer -->
            @include('layouts._footer')

        </div>
        <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

@endsection