# 1. feladat- Reszponziv weboldal elkészítése
1. mappa létrehozása, pl.: ```c:\vue-gyak\html```
2. Ide kell bemásolni a további mappáat, mint a ```css, img, js``` mappákat
3. Hozz létre egy ebba a mappába ```c:\vue-gyak\html``` egy index.html fájlt!
# 2. feladat - head, bootstrap, style.css
4. !+TAB, vagy html:5, HU, ITALOK, bootstrap be, style.css be, 
5. A teljes ```index.html```
```
<!doctype html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Italok</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/bootstrap.bundle.min.js"></script>
</head>
<body>

</body>
</html>
```
# 3.feladat: A weboldal tartalma legyen egy ```Container-fluid``` elemben
6. Vagy ```<main></main>``` , vagy ```<div> </div>```, de jobb a szemantikus elem, vagyis a <main>
7. A ```<body>``` -ba kerüljön egy ```<main class="container-fluid"></main>```
# 4.feladat: rács nézet, desktop 4, tablet 2, telefon 1, 2 egység felső margó
8. ```https://getbootstrap.com/```, rákeres arra, hogy grid, ott egy táblázat.
9. ```div.col-xl-3.col-md-6.col-sm-12.mt-2```+TAB+ENTER
10. Ebből lesz a: ```<div class="col-xl-3 col-md-6 col-sm-12 mt-2"></div>```
# 5.feladat: Alakítosn ki kártyákat a mintának megfelelően!
11. ```https://getbootstrap.com/```, rákeres arra, hogy card, az első találatot kimásoljuk!
12. Levesszük rőla a formázást ```style="width: 18rem;"```, mert úgy is css-ből fogjuk formázni!
13. nem kell a link
14. beletesszük a ```div.col-xl-3.col-md-6.col-sm-12.mt-2```-ba!
```
  <div class="col-xl-3 col-md-6 col-sm-12 mt-2">
    <div class="card">
        <img src="..." class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    </div>
  </div>
```
15. CTRL+D vel csiálunk ebbő 4db-ot
16. Belinkeljük a képet, alt, title, ``` <img src="img/dr_pepper.png" class="card-img-top" alt="dr_peper" title="dr_peper">```
17. betesszük a szöveget is, így ezt kapjuk  és, hogy a kártya egyforma legyen ```div class="card h-100"```,  majd megcsináljuk 4x!
```
    <div class="col-xl-3 col-md-6 col-sm-12 mt-2">
        <div class="card h-100">
            <img src="img/dr_pepper.png" class="card-img-top" alt="dr_peper" title="dr_peper">
            <div class="card-body">
                <h5 class="card-title">Dr. Pepper</h5>
                <p class="card-text">Leírás: Egy különleges gyümölcsös és fűszeres ízvilágú üdítő, melyet sokan imádnak a karakteres íze miatt.
                    Hozzávalók: Szénsavas víz, cukor, karamell színezék, foszforsav, természetes és mesterséges ízesítők, koffein.</p>
            </div>
        </div>
    </div>
```
# 6. feladat: style.css megcsinálása, a leírtak szerint!
18. A háttérszíne az oldalnak legyen #E0FFFF kódolású halvány kék.
```
body{
    background-color: #E0FFFF;
}
```
19. A kártyák háttérszíne legyen Lime zöld (#32CD32) és betű mérete 20px.
```
.card{
    background-color: #32CD32;
    font-size: 20px;
}
```
20. JÖN A MEDIA QUERY, mindíg a CSS-legalja - Ha a weboldal szélesége 768px és 1200px között van, akkor módosítsa a beállításokat a következő képen:
       i.	 A háttérszíne az oldalnak legyen #A4CCCC.
       ii.	A kártyák hátérszíne legyen #279327 és betű mérete az eredetihez képeset 20%-al nagyobb.
       iii.	A kártya címének a betűmérete is legyen 20%-al nagyobb.
```
@media screen and(min-width: 768px) and (max-width: 1200px) {
    body{
        background-color: #A4CCCC;
    }
    .card{
        background-color: #279327;
        font-size: 1.2em;
    }
    .card-title{
        font-size: 1.2em;
    }
}
@media screen and (max-width: 767px){
    body{
        background-color: #689999;
    }
    .card{
        background-color: #1A661A;
        font-size: 1.5em;
    }
    .card-title{
        font-size: 1.5em;
    }
```
21.Ennyi!!!