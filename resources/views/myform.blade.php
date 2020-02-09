<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Check Ongkir</title>    

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="/js/drop-ajax.js"></script>


</head>
<body>

    <div class="container col-md-6" style="padding-top: 50px;">
        <div class="card">
            <div class="card-header bg-primary text-white"><strong>Cek Ongkir</strong></div>
            <div class="card-body">
                <form method="POST" action="/">
                    @csrf

                    <div class="form-group">
                        <label for="title">Dikirim dari Provinsi:</label>
                        <select name="state_origin" class="form-control">
                            <option value="">--- Pilih Provinsi ---</option>
                            @foreach ($states as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">Kabupaten/Kota:</label>
                        <select name="city_origin" class="form-control">
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="title">Dikirim ke Provinsi:</label>
                        <select name="state_destination" class="form-control">
                            <option value="">--- Pilih Provinsi ---</option>
                            @foreach ($states as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">Kabupaten/Kota:</label>
                        <select name="city_destination" class="form-control">
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="kurir">Kurir</label>
                        <select name="courier" class="form-control">
                            <option value="">--- Pilih Kurir ---</option>
                            @foreach ($couriers as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="kurir">Berat (g)</label>
                        <input type="number" name="weight" class="form-control" value="1000">
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="state_origin"]').on('change', function() {
                var stateID = $(this).val();
                if(stateID) {
                    $.ajax({
                        url: '/index/ajax/'+stateID,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            $('select[name="city_origin"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="city_origin"]').append('<option value="'+ key +'">'+ value +'</option>');
                            });
                        }
                    });
                }else{
                    $('select[name="city_origin"]').empty();
                }
            });

            $('select[name="state_destination"]').on('change', function() {
                var stateID = $(this).val();
                if(stateID) {
                    $.ajax({
                        url: '/index/ajax/'+stateID,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            $('select[name="city_destination"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="city_destination"]').append('<option value="'+ key +'">'+ value +'</option>');
                            });
                        }
                    });
                }else{
                    $('select[name="city_destination"]').empty();
                }
            });
        });
    </script>

</body>
</html>
