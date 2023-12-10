        <!-- jQuery -->
        <script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap 4 -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('assets/js/modernizr.js') }}"></script>
        <script src="{{ asset('assets/js/moment.js') }}"></script>
        <script src="{{ asset('assets/vendor/swal/sweetalert2.all.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>
        <script src="{{ asset('assets/js/main.js') }}"></script>
        <script>
                $(document).ready(function() {
                        $('.btn-hapus').click(function(e) {
                                e.preventDefault();
                                Swal.fire({
                                title: 'Kamu Yakin?',
                                text: "data yg di hapus tidak dapat kembali!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Ya, hapus!',
                                cancelButtonText: 'Tidak'
                        }).then((result) => {
                                if (result.isConfirmed) {
                                        $(this).parent('form').submit();
                                }
                        })
                })
        });
        </script>
