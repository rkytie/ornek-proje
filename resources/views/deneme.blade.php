
@extends('front.app')
@section('content')
<button type="submit" id="yukle"> Yükle </button>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

$('body').on('click', '#yukle', function () {
        $.ajax({
            url: '{{ route('denemePost') }}',//Ajax ile tetiklenecek ilgili adresi belirliyoruz.
            type: 'POST',
            data: {
                        "_token": "{{ csrf_token() }}"
            },
            success: function (data) {
                if (data.success == "true") {
                    swal("Tebrikler!", "Belgeniz Başarıyla Yüklendi!", "success");
                } else {
                    swal("Tebrikler!", "Belgeniz Başarıyla Yüklendi!", "success");


                }
            
            },
        });
    });


</script>

@endsection

