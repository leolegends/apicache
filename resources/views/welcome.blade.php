<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CacheME</title>

        <!-- Fonts -->
    <link rel="stylesheet" href="{{url('css/style.css')}}">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>    </head>
    <body>
        <div>
            <form action="" class="search-form">
                    <div class="search-box">
                      <input class="search-input" type="text" placeholder="URL, ENTER e PRONTO ..."/>
                      <button class="search-button"><span></span></button>
                    </div>
                    <p class="link-response">A URL cacheada irá aparecer aqui!</p>

            </form>

        </div>

    </body>

    <script type="text/javascript">
    
    $('.search-button').on('click', function(e) {
  e.preventDefault();

  $('body').addClass('animate').toggleClass('focus');


});

    </script>

</html>
