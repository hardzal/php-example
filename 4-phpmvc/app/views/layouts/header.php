<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$data['title'];?></title>
    <link href="<?= BASE_URL;?> /css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<!-- #6 -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="<?= BASE_URL;?>">PHP MVC</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link active" href="<?= BASE_URL;?>/home">Home <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link" href="<?= BASE_URL;?>/about">About</a>
                <a class="nav-item nav-link" href="<?= BASE_URL;?>/mahasiswa">Mahasiswa</a>                
                <a class="nav-item nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </div>
        </div>
    </div>
</nav>