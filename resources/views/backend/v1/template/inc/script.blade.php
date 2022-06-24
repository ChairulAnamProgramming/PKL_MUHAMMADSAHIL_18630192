@stack('before-js')
<!--   Core JS Files   -->
<script src="{{ url('template/backend') }}/js/core/jquery.3.2.1.min.js"></script>
<script src="{{ url('template/backend') }}/js/core/popper.min.js"></script>
<script src="{{ url('template/backend') }}/js/core/bootstrap.min.js"></script>

<!-- jQuery UI -->
<script src="{{ url('template/backend') }}/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="{{ url('template/backend') }}/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

<!-- jQuery Scrollbar -->
<script src="{{ url('template/backend') }}/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<!-- Datatables -->
<script src="{{ url('template/backend') }}/js/plugin/datatables/datatables.min.js"></script>
<!-- Atlantis JS -->
<script src="{{ url('template/backend') }}/js/atlantis.min.js"></script>

<!-- Atlantis DEMO methods, don't include it in your project! -->
<script src="{{ url('template/backend') }}/js/setting-demo.js"></script>
<script src="{{ url('template/backend') }}/js/demo.js"></script>
<script>
    $('.datatables').DataTable({});
</script>

@stack('after-js')
