<?php
    session_start();
    include 'baza.php';

    if (!isset($_SESSION['prijava'])){
        header("Location: prijava.php");
    } else if ($_SESSION['tip'] == "korisnik"){
        header("Location: korisnikAktivnosti.php");
    }

if(isset($_POST['dodaj'])){
    $datumOdrzavanja = date("Y-m-d", strtotime($_POST['datum']));
    $vrijemeOdrzavanja = date("H:i:s", strtotime($_POST['vrijeme']));
    $upit = "UPDATE aktivnost SET udruga_id='{$_POST['udruga_id']}', datum_odrzavanja='{$datumOdrzavanja}', vrijeme_odrzavanja='{$vrijemeOdrzavanja}', naziv='{$_POST['naziv']}', opis='{$_POST['opis']}' WHERE aktivnost_id='{$_POST['aktivnost_id']}'";
    $rezultat = radiSBazom($upit);
    header("Location: pregledSvihAktivnosti.php");
}elseif (isset($_GET['aktivnost_id'])){
    $upit = "SELECT * FROM aktivnost WHERE aktivnost_id='{$_GET['aktivnost_id']}'";
    $rezultat = radiSBazom($upit);
    $aktivnost = mysqli_fetch_assoc($rezultat);
}else {
    header("Location: pregledSvihAktivnosti.php");
}

?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Ažuriranje aktivnosti</title>
    <link href="lana.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<header>
    <h1>Ažuriranje aktivnosti</h1>
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
        <form method="post" action="azurirajAktivnost.php">
            <label for="naziv">Naziv aktivnosti</label>
            <input type="text" id="naziv" name="naziv" required value="<?php echo $aktivnost['naziv']; ?>"><br/>
            <label for="udruga_id">Odaberite udrugu</label>
            <select name="udruga_id" id="udruga_id">
                <?php
                $upit = "SELECT udruga_id, udruga.naziv FROM udruga WHERE moderator_id={$_SESSION['korisnik_id']}";
                $rezultat = radiSBazom($upit);
                while ($udruga = mysqli_fetch_assoc($rezultat)){
                    if ($udruga['udruga_id'] == $aktivnost['udruga_id']){
                        echo "<option selected value='".$udruga['udruga_id']."'>".$udruga['naziv']."</option>";
                    }else {
                        echo "<option value='".$udruga['udruga_id']."'>".$udruga['naziv']."</option>";
                    }
                }
                ?>
            </select><br/>
            <label for="datum">Datum i vrijeme održavanja</label>
            <input type="text" name="datum" id="datum" required placeholder="dd.mm.yyyy" value="<?php echo date("d.m.Y", strtotime($aktivnost['datum_odrzavanja'])); ?>">
            <input type="text" name="vrijeme" required placeholder="hh:mm:ss" value="<?php echo date("H:i:s", strtotime($aktivnost['vrijeme_odrzavanja'])); ?>"><br/>
            <label for="opis">Opis aktivnosti</label>
            <textarea name="opis" id="opis" cols="40" rows="3"><?php echo $aktivnost['opis']; ?></textarea><br/>
            <input type="hidden" id="aktivnost_id" name="aktivnost_id" value="<?php echo $aktivnost['aktivnost_id']; ?>"><br/>
            <input type="submit" name="dodaj" value="Ažuriraj aktivnost">
        </form>
    </div>
</section>
<footer>
    <p><b>Lana Kostanjšek</b></p>
    <p>&copy;Sportske udruge</p>
</footer>
</body>
</html>
