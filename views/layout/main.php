<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Teszt oldal</title>
        <script src="<?=baseUrl;?>web/js/jquery.js" type="text/javascript"></script>
        <link href="<?=baseUrl;?>web/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <script src="<?=baseUrl;?>web/js/bootstrap.js" type="text/javascript"></script>
        <link href="<?=baseUrl;?>web/css/dashboard.css" rel="stylesheet" type="text/css"/>
        <script src="<?=baseUrl;?>web/js/app.js" type="text/javascript"></script>
        <link href="<?=baseUrl;?>web/css/css.css" rel="stylesheet" type="text/css"/>
        <link href="<?=baseUrl;?>web/css/font-awesome.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">ISL teszt alkalmazás</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right" data-target="menu">
                        <li class="active">
                            <a href="#" data-tag="users" onclick="loadData('index.php?option=users');" >Felhasználók</a>
                        </li>
                        <li>
                            <a href="#" data-tag="downloads"  onclick="loadData('index.php?option=users&view=downloads');">Letöltések</a>
                        </li>
                        <li>
                            <a href="#" data-tag="favorites" onclick="loadData('index.php?option=users&view=favorites');">Kedvenc feladatlapok</a>
                        </li>
                        <li>
                            <a href="#" data-tag="error" onclick="loadData('index.php?option=users&view=error');">Hibás link</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar">
                    <ul class="nav nav-sidebar" data-target="menu">
                        <li class="menu-header">
                            Menü
                        </li>
                        <li class="active">
                            <a href="#" data-tag="users" onclick="loadData('index.php?option=users');" >Felhasználók</a>
                        </li>
                        <li>
                            <a href="#" data-tag="downloads"  onclick="loadData('index.php?option=users&view=downloads');">Letöltések</a>
                        </li>
                        <li>
                            <a href="#" data-tag="favorites" onclick="loadData('index.php?option=users&view=favorites');">Kedvenc feladatlapok</a>
                        </li>
                        <li>
                            <a href="#" data-tag="error" onclick="loadData('index.php?option=users&view=error');">Hibás link</a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <h2 class="page-header">Tartalom</h2>
                    <div class="row loader-container">
                        <div class="col-sm-2 col-sm-offset-5 loader">
                            <i class="fa fa-cog fa-spin fa-5x fa-fw" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="row content-container">
                        <div class="col-md-12">
                            <?php print_r($content);?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
