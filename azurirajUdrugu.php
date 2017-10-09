<?php
session_start();
include 'baza.php';

if (!isset($_SESSION['prijava'])){
    header("Location: prijava.php");
} else if ($_SESSION['tip'] != "administrator"){
    header("Location: korisnikAktivnosti.php");
}

if(isset($_POST['dodaj'])){
    $upit = "UPDATE udruga SET moderator_id='{$_POST['moderator_id']}', naziv='{$_POST['naziv']}', opis='{$_POST['opis']}' WHERE udruga_id='{$_POST['udruga_id']}'";
    $rezultat = radiSBazom($upit);
    header("Location: pregledSvihUdruga.php");
}elseif (isset($_GET['udruga_id'])){
    $upit = "SELECT * FROM udruga WHERE udruga_id='{$_GET['udruga_id']}'";
    $rezultat = radiSBazom($upit);
    $udruga = mysqli_fetch_assoc($rezultat);
}else {
    header("Location: pregledSvihUdruga.php");
}
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Ažuriranje udruge</title>
    <link href="lana.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<header>
    <h1>Ažuriranje udruge</h1>
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
        <form method="post" action="azurirajUdrugu.php">
            <label for="naziv">Naziv udruge</label>
            <input type="text" id="naziv" name="naziv" required value="<?php echo $udruga['naziv']; ?>"><br/>
            <label for="opis">Opis udruge</label>
            <input type="text" id="opis" name="opis" required value="<?php echo $udruga['opis']; ?>"><br/>
            <label for="moderator_id">Moderator</label>
            <select id="moderator_id" name="moderator_id">
                <?php
                    $upit = "SELECT * FROM korisnik WHERE tip_id<2";
                    $rezultat = radiSBazom($upit);
                    while ($moderator = mysqli_fetch_assoc($rezultat)){
                        if($moderator['korisnik_id'] == $udruga['moderator_id']){
                            echo "<option selected value='".$moderator['korisnik_id']."'>".$moderator['ime']." ".$moderator['prezime']."</option>";
                        }else {
                            echo "<option value='".$moderator['korisnik_id']."'>".$moderator['ime']." ".$moderator['prezime']."</option>";
                        }
                    }
                ?>
            </select>
            <input type="hidden" id="udruga_id" name="udruga_id" value="<?php echo $udruga['udruga_id']; ?>"><br/>
            <input type="submit" name="dodaj" value="Ažuriraj udrugu">
        </form>
    </div>
</section>
<footer>
    <p><b>Lana Kostanjšek</b></p>
    <p>&copy;Sportske udruge</p>
</footer>
</body>
</html>
