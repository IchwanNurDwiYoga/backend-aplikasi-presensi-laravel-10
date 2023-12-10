<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="/presensi/edit/{{$presensi_detail->kode_presensi}}/{{$presensi_detail->nip}}" method="post">
    @csrf
    @method('PUT')
    {{$presensi_detail}}
    <input type="text" name="lat_masuk" value="{{$presensi_detail->lat_masuk}}">
    <input type="text" name="long_masuk" value="{{$presensi_detail->long_masuk}}">
    <button type="submit">simpan</button>
    </form>
</body>
</html>