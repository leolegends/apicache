<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CacheME</title>

        <!-- Fonts -->
    <link rel="stylesheet" href="{{url('css/style.css')}}">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>    </head>
    <body>

        <div id="app">
            <redis-component url="{{url('api/cache')}}"></redis-component>
        </div>

        {{-- <div>
            <form action="" class="search-form">
                    <div class="search-box">
                      <input class="search-input" id="valor" type="text" placeholder="URL, ENTER e PRONTO ..."/>
                      <button class="search-button"><span></span></button>
                    </div>
                    <p class="link-response" id="url">A URL cacheada irá aparecer aqui!</p>

            </form>

        </div> --}}

    </body>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript">
    
    $('.search-button').on('click', function(e) {
  e.preventDefault();

    $.post("{{url('api/cache')}}", {
        "url": $('#valor').val()
    }) 
    .done((data) => {
        $("#url").text(data.url);
    })
    .fail((data) => {
        $("#url").text("Erro!");
    });

  $('body').addClass('animate').toggleClass('focus');


    });

    $("#add_header").on('click', function(e) {
        e.preventDefault();

        $("#headers").append(`
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="">Key and Value</span>
            </div>
            <input type="text" name="key[]" class="form-control">
            <input type="text" name="value[]" class="form-control">
            <div class="input-group-append">
                <td>
                    <button class="btn btn-danger remove_header" type="button">X</button>
                </td>
            </div>
        </div>
        `);

        $('body').addClass('animate').toggleClass('focus');

    });

    $(".remove_header").on('click', (e) => {
        $(this).remove();
    });

    </script>
    
<script src="{{url('js/app.js')}}"></script>

</html>
