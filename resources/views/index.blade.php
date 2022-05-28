<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">



  <link href="/colorbox/colorbox.css" rel="stylesheet">
  <!-- /.подключеие стилей colorbox -->

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

  <link href="{{ mix('/css/app.css') }}" rel="stylesheet">

  <title>FSK - system</title>

  <link rel="icon" type="image/png" sizes="16x16" href="/images/logo.png" />

</head>

<body>
  <div id="app">
    <router-view></router-view>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script type="text/javascript" src="/colorbox/jquery.colorbox-min.js"></script>
  <!-- /.подключеие скрипта colorbox -->

  <script type="text/javascript" src="/packages/barryvdh/elfinder/js/standalonepopup.js"></script>
  <!-- /.подключеие готового скрипта elfinder -->

  <script src="https://cdn.tiny.cloud/1/2kz20e81idnkyjv90c12g8rxqkn3lormugg4qth35654bzmj/tinymce/5/tinymce.min.js"
    referrerpolicy="origin"></script>
  <!-- /.подключеие tinyMCE -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
  </script>

  <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>