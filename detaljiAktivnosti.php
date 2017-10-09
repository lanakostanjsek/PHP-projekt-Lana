<?php
    session_start();
    include 'baza.php';

    if (!isset($_SESSION['prijava'])){
        header("Location: prijava.php");
    } else if (isset($_GET['aktivnost_id'])){
        $upit = "SELECT * FROM aktivnost WHERE aktivnost_id={$_GET['aktivnost_id']}";
        $rezultat = radiSBazom($upit);
        $aktivnost = mysqli_fetch_assoc($rezultat);
    } else {
        header("Location: korisnikAktivnosti.php");
    }

?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Detalji o aktivnosti</title>
    <link href="lana.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<header>
    <h1>Detalji o odabranoj aktivnosti</h1>
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
            <tbody>
                <tr>
                    <td>Naziv</td>
                    <td><?php echo $aktivnost['naziv']; ?></td>
                </tr>
                <tr>
                    <td>Opis</td>
                    <td><?php echo $aktivnost['opis']; ?></td>
                </tr>
                <tr>
                    <td>Datum i vrijeme održavanja</td>
                    <td><?php echo date("d.m.Y", strtotime($aktivnost['datum_odrzavanja']))." ".date("H:i:s", strtotime($aktivnost['vrijeme_odrzavanja'])); ?></td>
                </tr>
                <tr>
                    <td>Datum i vrijeme kreiranja</td>
                    <td><?php echo date("d.m.Y", strtotime($aktivnost['datum_kreiranja']))." ".date("H:i:s", strtotime($aktivnost['vrijeme_kreiranja'])); ?></td>
                </tr>
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
