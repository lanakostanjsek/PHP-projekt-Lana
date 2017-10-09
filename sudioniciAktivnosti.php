<?php
session_start();
include 'baza.php';

if (!isset($_SESSION['prijava'])){
    header("Location: prijava.php");
} else if (isset($_GET['aktivnost_id'])){
    $upit = "SELECT korisnik.* FROM korisnik, sudionik WHERE sudionik.aktivnost_id={$_GET['aktivnost_id']} AND sudionik.korisnik_id=korisnik.korisnik_id";
    $rezultat = radiSBazom($upit);
} else {
    header("Location: korisnikAktivnosti.php");
}

?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Sudionici aktivnosti</title>
    <link href="lana.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<header>
    <h1>Sudionici odabrane aktivnosti</h1>
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
        <table>
            <thead>
                <th>Slika</th>
                <th>Ime i prezime</th>
                <th>Email</th>
            </thead>
            <tbody>
                <?php
                    while ($sudionik = mysqli_fetch_assoc($rezultat)){
                        echo "<tr>";
                        echo "<td><img src='".$sudionik['slika']."' width='50' height='50' /></td>";
                        echo "<td>".$sudionik['ime']." ".$sudionik['prezime']."</td>";
                        echo "<td>".$sudionik['email']."</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</section>
<footer>
    <p><b>Lana Kostanjšek</b></p>
    <p>&copy;Sportske udruge</p>
</footer>
</body>
</html>
