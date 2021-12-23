@stack('before-js')
<!-- Chart library -->
<script src="{{url('template')}}/plugins/chart.min.js"></script>
<!-- Icons library -->
<script src="{{url('template')}}/plugins/feather.min.js"></script>
<!-- bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.js">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
    integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
</script>
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js">
</script>
<script src="https://cdn.datatables.net/1.11.2/js/dataTables.bootstrap4.min.js">
</script>

<!-- Custom scripts -->
<script src="{{url('template')}}/js/script.js"></script>

<script>
    $('.datatables').DataTable();
</script>

@stack('after-js')