<script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
<script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>

<!-- Sweet Alerts js -->
<script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

<!-- Sweet alert init js-->
<script src="{{ asset('assets/js/pages/sweet-alerts.init.js') }}"></script>

<script src="{{ asset('assets/js/app.js') }}"></script>

<script src="{{ asset('assets/js/custom/bootstrap-validation.js') }}"></script>
<script src="{{ asset('assets/js/custom/custom.js') }}"></script>


@if (session('error'))
    <script>
        Swal.fire({
            title: "Hata!",
            text: "{{ session('error') }}",
            icon: "error",
            button: "Tamam",
        });
    </script>
@endif

@if (session('success'))
    <script>
        Swal.fire({
            title: "Başarıyla kaydedildi!",
            text: "{{ session('success') }}",
            icon: "success",
            button: "Tamam",
        });
    </script>
@endif
