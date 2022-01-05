  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0-rc
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- jQuery -->
<script src="{{asset('/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->


@if(App::isLocal('ar'))
<script src="{{asset('/plugins/bootstrap/js/bootstrapAr.min.js')}}"></script>
@endif
<!-- Bootstrap 4 -->
{{-- <script src="{{asset('/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script> --}}
<!-- ChartJS -->

<!-- overlayScrollbars -->
{{-- <script src="{{asset('/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script> --}}
<!-- AdminLTE App -->
<script src="{{asset('/dist/js/adminlte.js')}}"></script>
<script src="{{asset('/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('/vue/vue.js')}}"></script>





@notifyJs

@stack('dataTables')
</body>
</html>
