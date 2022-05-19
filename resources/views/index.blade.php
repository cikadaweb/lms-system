<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

  <link href="/colorbox/colorbox.css" rel="stylesheet">
  <!-- /.подключеие стилей colorbox -->

  <link href="{{ mix('/css/app.css') }}" rel="stylesheet">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>

  <script type="text/javascript" src="/colorbox/jquery.colorbox-min.js" defer></script>
  <!-- /.подключеие скрипта colorbox -->

  <script type="text/javascript" src="/packages/barryvdh/elfinder/js/standalonepopup.js" defer></script>
  <!-- /.подключеие готового скрипта elfinder -->

  <title>Формула Стекла</title>
</head>

<body>
  <div id="app">
    <router-view></router-view>
  </div>

  <script src="https://cdn.tiny.cloud/1/2kz20e81idnkyjv90c12g8rxqkn3lormugg4qth35654bzmj/tinymce/5/tinymce.min.js"
    referrerpolicy="origin"></script>
  <!-- /.подключеие tinyMCE -->


  <script>
  tinymce.init({
    selector: '#mytextarea',
    height: 500,
    plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
    toolbar_mode: 'floating',
    relative_urls: false,
    file_picker_callback: elFinderBrowser
  });

  function elFinderBrowser(callback, value, meta) {
    tinymce.activeEditor.windowManager.openUrl({
      title: 'File Manager',
      url: "/elfinder/tinymce5",
      /**
       * On message will be triggered by the child window
       * 
       * @param dialogApi
       * @param details
       * @see https://www.tiny.cloud/docs/ui-components/urldialog/#configurationoptions
       */
      onMessage: function(dialogApi, details) {
        if (details.mceAction === 'fileSelected') {
          const file = details.data.file;

          // Make file info
          const info = file.name;

          // Provide file and text for the link dialog
          if (meta.filetype === 'file') {
            callback(file.url, {
              text: info,
              title: info
            });
          }

          // Provide image and alt text for the image dialog
          if (meta.filetype === 'image') {
            callback(file.url, {
              alt: info
            });
          }

          // Provide alternative source and posted for the media dialog
          if (meta.filetype === 'media') {
            callback(file.url);
          }

          dialogApi.close();
        }
      }
    });
  }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
  </script>

  <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>