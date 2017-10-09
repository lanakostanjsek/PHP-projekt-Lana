<?php
    session_start();
    include 'baza.php';

    if (!isset($_SESSION['prijava'])){
        header("Location: prijava.php");
    } else if ($_SESSION['tip'] != "administrator"){
        header("Location: korisnikAktivnosti.php");
    }

?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Pregled svih korisnika</title>
    <link href="lana.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<header>
    <h1>Pegled svih korisnika</h1>
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
                <th>Korisnik</th>
                <th>Email</th>
                <th></th>
            </thead>
            <tbody>
                <?php
                    $upit = "SELECT * FROM korisnik";
                    $rezultat = radiSBazom($upit);
                    while ($korisnik = mysqli_fetch_assoc($rezultat)){
                        echo "<tr>";
                        echo "<td><img src='".$korisnik['slika']."' width='50' height='75'/></td>";
                        echo "<td>".$korisnik['ime']." ".$korisnik['prezime']."</td>";
                        echo "<td>".$korisnik['email']."</td>";
                        echo "<td><a href='azurirajKorisnika.php?korisnik_id=".$korisnik['korisnik_id']."'><button>Ažuriraj</button></a></td>";
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
