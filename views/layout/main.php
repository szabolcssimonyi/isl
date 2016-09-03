<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Teszt oldal</title>
        <script src="<?=baseUrl;?>js/jquery.js" type="text/javascript"></script>
        <link href="<?=baseUrl;?>css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <script src="<?=baseUrl;?>js/bootstrap.js" type="text/javascript"></script>
        <link href="<?=baseUrl;?>css/dashboard.css" rel="stylesheet" type="text/css"/>
        <script src="<?=baseUrl;?>js/app.js" type="text/javascript"></script>
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
                    <ul class="nav navbar-nav navbar-right">
                      <li><a href="#">Dashboard</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar">
                    <ul class="nav nav-sidebar">
                        <li class="active">
                            <a href="#">
                                Overview
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" onclick="loadData('index.php?option=users');">Felhasználók</a>
                        </li>
                        <li>
                            <a href="#" onclick="loadData('index.php?option=users&view=downloads');">Letöltések</a>
                        </li>
                        <li>
                            <a href="#" onclick="loadData('index.php?option=users&view=favorites');">Kedvenc feladatlapok</a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <h2 class="page-header">Dashboard</h2>
                    <?php print_r($content);?>
                </div>
            </div>
        </div>
    </body>
</html>
