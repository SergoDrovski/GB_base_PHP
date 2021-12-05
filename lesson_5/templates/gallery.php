<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Галерея">
    <meta name="author" content="">


    <title>Моя Галерея</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <style>
        :root {
            --input-padding-x: .75rem;
            --input-padding-y: .75rem;
        }

        html,
        body {
            height: 100%;
        }

        body {
            display: -ms-flexbox;
            display: -webkit-box;
            display: flex;
            -ms-flex-align: center;
            -ms-flex-pack: center;
            -webkit-box-align: center;
            align-items: start;
            -webkit-box-pack: center;
            justify-content: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #ffffff;
        }

        body {
            margin: 0;
            font-family: var(--bs-body-font-family);
            font-size: var(--bs-body-font-size);
            font-weight: var(--bs-body-font-weight);
            line-height: var(--bs-body-line-height);
            color: var(--bs-body-color);
            text-align: var(--bs-body-text-align);
            background-color: var(--bs-body-bg);
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: transparent;
        }

        .form-signin {
            width: 100%;
            max-width: 420px;
            padding: 0 15px;
            margin: 0 auto;
        }

        .form-label-group {
            position: relative;
            margin-bottom: 1rem;
        }

        .form-label-group > input,
        .form-label-group > label {
            padding: var(--input-padding-y) var(--input-padding-x);
        }

        .form-label-group > label {
            position: absolute;
            top: 0;
            left: 0;
            display: block;
            width: 100%;
            margin-bottom: 0; /* Override default `<label>` margin */
            line-height: 1.5;
            color: #495057;
            border: 1px solid transparent;
            border-radius: .25rem;
            transition: all .1s ease-in-out;
        }

        .form-label-group input::-webkit-input-placeholder {
            color: transparent;
        }

        .form-label-group input:-ms-input-placeholder {
            color: transparent;
        }

        .form-label-group input::-ms-input-placeholder {
            color: transparent;
        }

        .form-label-group input::-moz-placeholder {
            color: transparent;
        }

        .form-label-group input::placeholder {
            color: transparent;
        }

        .form-label-group input:not(:placeholder-shown) {
            padding-top: calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));
            padding-bottom: calc(var(--input-padding-y) / 3);
        }

        .form-label-group input:not(:placeholder-shown) ~ label {
            padding-top: calc(var(--input-padding-y) / 3);
            padding-bottom: calc(var(--input-padding-y) / 3);
            font-size: 12px;
            color: #777;
        }

        .bd-example {
            padding: 1.3rem;
            margin-right: 0;
            margin-left: 0;
            margin-bottom: .8rem;
            border-radius: .25rem;
        }

        .bd-example {
            position: relative;
            border: 1px solid #dee2e6;
        }

        .main {
            max-width: 750px;
            display: flex;
            flex-direction: column;
        }

        .btn {
            margin-top: 15px;
        }

        .form-text {
            color: #e15151;
        }

    </style>
</head>

<body>
<div class="main">
    <div class="form-signin">
        <div class="text-center mb-4">
            <h1 class="h3 mb-3 font-weight-normal">Моя Галерея</h1>
        </div>
    </div>

    <div class="row">
        <?php if (!empty($collect)): ?>
            <?php foreach ($collect as $photo): ?>
                <div class="col-sm-3">
                    <div class="card" style="width: 100%; margin-top: 15px; min-width: 150px;">
                        <img  src="photo/small/<?php echo $photo['title'] ?>" class="card-img-top" alt="<?php echo $photo['alt'] ?>">
                        <div class="card-body">
                            <p class="card-text">Some example text.</p>
                            <button type="button" class="btn btn-outline-danger img-delete" data-id="<?php echo $photo['id'] ?>">Удалить</button>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        <?php endif ?>
    </div>
    <br>
    <div style="margin-bottom: 25px;" class="row">
        <h2 id="file-input">Выбор файла</h2>
        <div class="bd-example">
            <form enctype="multipart/form-data" method="post" action="/">
                <div class="mb-3">
                    <input class="form-control" accept="image/*" name="photo" type="file" id="formFile">
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </div>
            </form>
        </div>
    </div>

</div>



<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <img alt="" src="#" style="max-width: 100%; height: auto;">
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
        crossorigin="anonymous"></script>
<script>
    var myModal = new bootstrap.Modal(document.getElementById('exampleModalToggle'), {
        keyboard: false
    });
    function basename(path, suffix){
        let p = path.split( /[\/\\]/ ), name = p[p.length-1];
        return ('string'!=typeof suffix) ? name :
        name.replace(new RegExp(suffix.replace('.', '\\.')+'$'),'');
    }

    $('.card-img-top').on('click', function (e) {
        let img = $(this);
        let src = basename(img[0].src);
        $('#exampleModalToggle img').attr('src', `photo/big/${src}`);
        myModal.show();
    });

    $( document ).ready(function(){
        $('.img-delete').click(function(){
            let id = $(this).data('id');

            $.ajax({
                method: "POST",
                url: "index.php",
                data: {
                    idImg: id
                },
                success: function(result){
                    location.reload();
                }
            })
        });
    });

</script>
</body>
</html>