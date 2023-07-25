<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Helpdesk J&T Express</title>
</head>
<body>
<p style="width: 100%; text-align: justify">Halo, {{ $data->user->username }} Ticket ({{ $data->no_ticket }}) dengan No.
    Resi ({{ $data->no_resi }}) dengan deskripsi tentang {{ $data->deskripsi }} telah kami tanggapi dan kami tutup
    ticket nya, Terima kasih.</p>
<br>
<p style="width: 100%; text-align: right; font-weight: bold">Admin Helpdesk J&T Express</p>
</body>
</html>
