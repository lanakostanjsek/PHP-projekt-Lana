<?php
session_start();
include 'baza.php';

if (!isset($_SESSION['prijava'])){
    header("Location: prijava.php");
} else if ($_SESSION['tip'] != "administrator"){
    header("Location: korisnikAktivnosti.php");
}

if (isset($_POST['dodaj'])){
    $upit = "INSERT INTO udruga(moderator_id, naziv, opis) VALUES ('{$_POST['moderator_id']}', '{$_POST['naziv']}', '{$_POST['opis']}')";
    $rezultat = radiSBazom($upit);
}

?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Dodavanje udruge</title>
    <link href="lana.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<header>
    <h1>Dodavanje nove udruge</h1>
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
        <form method="post" action="dodajNovuUdrugu.php">
            <label for="naziv">Naziv udruge</label>
            <input type="text" id="naziv" name="naziv" required><br/>
            <label for="opis">Opis udruge</label>
            <input type="text" id="opis" name="opis" required><br/>
            <label for="moderator_id">Moderator</label>
            <select id="moderator_id" name="moderator_id">
                <?php
                $upit = "SELECT * FROM korisnik WHERE tip_id<2";
                $rezultat = radiSBazom($upit);
                while ($moderator = mysqli_fetch_assoc($rezultat)){
                    echo "<option value='".$moderator['korisnik_id']."'>".$moderator['ime']." ".$moderator['prezime']."</option>";
                }
                ?>
            </select>
            <input type="submit" name="dodaj" value="Dodaj udrugu">
        </form>
    </div>
</section>
<footer>
    <p><b>Lana Kostanjšek</b></p>
    <p>&copy;Sportske udruge</p>
</footer>
</body>
</html>
