Install:

1. Klónozd vagy töltsd le a repositorit egy tetszőleges könyvtárba
2. Nyisd meg egy szövegszerkesztővel a [saját mappa]/isl/config/main.php állományt és állítsd be a mysql szerver adatait
2. Állítsd a html szerver munkakönyvtárát a [saját mappa]/isl/migrations könyvtárra és command prompt-ból futtasd a migrations.php file-t:
    php migrations.php
    (php környezeti változó a php.exe file-ra mutasson)
    a migráció folymatát láthatod a command ablakban
3. Állítsd a html szerver munkakönyvtárát a [saját mappa]/isl/web könyvtárra
4. Az alkalmazás futtatható böngészőben a localhost címről