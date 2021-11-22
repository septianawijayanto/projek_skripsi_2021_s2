<!-- END WRAPPER -->
<!-- Javascript -->
<script src="{{asset('klorofil')}}/assets/vendor/jquery/jquery.min.js"></script>
<script src="{{asset('klorofil')}}/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="{{asset('klorofil')}}/assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="{{asset('klorofil')}}/assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
<script src="{{asset('klorofil')}}/assets/vendor/chartist/js/chartist.min.js"></script>
<script src="{{asset('klorofil')}}/assets/scripts/klorofil-common.js"></script>
<script src="{{asset('klorofil')}}/assets/vendor/toastr/toastr.min.js"></script>

<script type="text/javascript" src="{{asset('DataTables/datatables.min.js')}}"></script>

<!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script> -->


<script>
  $(document).ready(function() {

    $(function() {
      var flash = "{{ Session::has('sukses') }}";
      if (flash) {
        var pesan = "{{ Session::get('sukses') }}"
        toastr.success("{{ Session::get('sukses') }}")
      }
      var gagal = "{{ Session::has('gagal') }}";
      if (gagal) {
        var pesan = "{{ Session::get('gagal') }}"
        toastr.error("{{ Session::get('gagal') }}")
      }
      var info = "{{ Session::has('info') }}";
      if (info) {
        var pesan = "{{ Session::get('info') }}"
        toastr.info("{{ Session::get('info') }}")
      }
      var peringatan = "{{ Session::has('peringatan') }}";
      if (peringatan) {
        var pesan = "{{ Session::get('peringatan') }}"
        toastr.warning("{{ Session::get('peringatan') }}")
      }

    })
  });
</script>