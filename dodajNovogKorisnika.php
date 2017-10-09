<?php
session_start();
include 'baza.php';

if (!isset($_SESSION['prijava'])){
    header("Location: prijava.php");
} else if ($_SESSION['tip'] != "administrator"){
    header("Location: korisnikAktivnosti.php");
}

if (isset($_POST['dodaj'])){
    if ($_FILES['slika']['name'] != ""){
        $lokacija_slike = "korisnici/".$_FILES['slika']['name'];
        move_uploaded_file($_FILES['slika']['tmp_name'], $lokacija_slike);
    }
    else {
        $lokacija_slike = "";
    }

    $upit = "INSERT INTO korisnik(tip_id, korisnicko_ime, lozinka, ime, prezime, email, slika) VALUES ('{$_POST['tip_id']}', '{$_POST['korisnicko_ime']}', '{$_POST['lozinka']}', '{$_POST['ime']}', '{$_POST['prezime']}', '{$_POST['email']}', '{$lokacija_slike}')";
    $rezultat = radiSBazom($upit);
}

?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Dodavanje korisnika</title>
    <link href="lana.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<header>
    <h1>Dodavanje novog korisnika</h1>
</header>
<section>
    <div id="nav">
        <ul>
            <?php
            include 'izbornik.php';
            ?>
        </ul>
    </div>
    <div id=sadrzaj>
        <form method="post" action="dodajNovogKorisnika.php" enctype="multipart/form-data">
            <label for="korisnicko_ime">Korisničko ime</label>
            <input type="text" id="korisnicko_ime" name="korisnicko_ime" required><br/>
            <label for="lozinka">Lozinka</label>
            <input type="text" id="lozinka" name="lozinka" required><br/>
            <label for="tip_id">Tip korisnika</label>
            <select id="tip_id" name="tip_id">
                <option value="0">Administrator</option>
                <option value="1">Moderator</option>
                <option value="2">Korisnik</option>
            </select><br/>
            <label for="email">Email</label>
            <input type="text" id="email" name="email"><br/>
            <label for="ime">Ime</label>
            <input type="text" id="ime" name="ime"><br/>
            <label for="ime">Prezime</label>
            <input type="text" id="prezime" name="prezime"><br/>
            <label for="slika">Slika korisnika</label>
            <input type="file" id="slika" name="slika"><br/>
            <input type="submit" name="dodaj" value="Dodaj korisnika">
        </form>
    </div>
</section>
<footer>
    <p><b>Lana Kostanjšek</b></p>
    <p>&copy;Sportske udruge</p>
</footer>
</body>
</html>
