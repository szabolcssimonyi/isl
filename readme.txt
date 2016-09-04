Install:

1. Klónozd vagy töltsd le a repositorit egy tetszőleges könyvtárba
2. Nyisd meg egy szövegszerkesztővel a [saját mappa]/isl/config/main.php állományt és állítsd be a mysql szerver adatait
2. Állítsd a html szerver munkakönyvtárát a [saját mappa]/isl/migrations könyvtárra és command prompt-ból futtasd a migrations.php file-t:
    php migrations.php
    (php környezeti változó a php.exe file-ra mutasson)
    a migráció folymatát láthatod a command ablakban
3. Állítsd a html szerver munkakönyvtárát a [saját mappa]/isl/web könyvtárra
4. Az alkalmazás futtatható böngészőben a localhost címről

Az adatbázis táblák dump file-okból is feltölthetők a Dump20160904-1 könyvtárból

Működés:

Egy egyszerű MVC került megvalódításra. A bejövő kérések adatait feldolgozva az Application objektum létrehozza a specializált
controller osztályt a controllers könyvtárból. Ehhez az url "option" get vagy post adatát használja.
A controller lefuttatja magán a szükséges metodust (action), amit az url "view" adattagjából vesz.
A metodusban létjön a szükséges model objektum a models könyvtárból, amivel futtatni lehet a szükséges adatgyüjtési eljárást.
A üsszegyűjtött adatokat a controller átaja a view-nak ami megjeleníti a layout-ot az adatokkal a views könyvtárból.

A kliens oldalon egy jquery applikáció kezeli a szükséges DOM manipulációkat. A szűrés és rendezés is itt kerül megvalósításra.
Az adatok lekérdezése AJAX/JSON segítségével történik.