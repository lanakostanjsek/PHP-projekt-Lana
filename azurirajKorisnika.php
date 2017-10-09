<?php
session_start();
include 'baza.php';

if (!isset($_SESSION['prijava'])){
    header("Location: prijava.php");
} else if ($_SESSION['tip'] != "administrator"){
    header("Location: korisnikAktivnosti.php");
}

if (isset($_POST['dodaj'])){
    $upit = "UPDATE korisnik SET tip_id='{$_POST['tip_id']}', korisnicko_ime='{$_POST['korisnicko_ime']}', lozinka='{$_POST['lozinka']}', ime='{$_POST['ime']}', prezime='{$_POST['prezime']}', email='{$_POST['email']}' WHERE korisnik_id='{$_POST['korisnik_id']}'";
    $rezultat = radiSBazom($upit);
}elseif (isset($_GET['korisnik_id'])){
    $upit = "SELECT * FROM korisnik WHERE korisnik_id='{$_GET['korisnik_id']}'";
    $rezultat = radiSBazom($upit);
    $korisnik = mysqli_fetch_assoc($rezultat);
}else {
    header("Location: pregledSvihKorisnika.php");
}

?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Ažuriranje korisnika</title>
    <link href="lana.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<header>
    <h1>Ažuriranje korisnika</h1>
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
        <form method="post" action="dodajNovogKorisnika.php">
            <label for="korisnicko_ime">Korisničko ime</label>
            <input type="text" id="korisnicko_ime" name="korisnicko_ime" required value="<?php echo $korisnik['korisnicko_ime']; ?>"><br/>
            <label for="lozinka">Lozinka</label>
            <input type="text" id="lozinka" name="lozinka" required value="<?php echo $korisnik['lozinka']; ?>"><br/>
            <label for="tip_id">Tip korisnika</label>
            <select id="tip_id" name="tip_id">
                <?php
                    if ($korisnik['tip_id'] == 0){
                        echo "<option selected value='0'>Administrator</option>";
                        echo "<option value='1'>Moderator</option>";
                        echo "<option value='2'>Korisnik</option>";
                    }elseif ($korisnik['tip_id'] == 1){
                        echo "<option value='0'>Administrator</option>";
                        echo "<option selected value='1'>Moderator</option>";
                        echo "<option value='2'>Korisnik</option>";
                    }else {
                    echo "<option value='0'>Administrator</option>";
                    echo "<option value='1'>Moderator</option>";
                    echo "<option selected value='2'>Korisnik</option>";
                }
                ?>
            </select><br/>
            <label for="email">Email</label>
            <input type="text" id="email" name="email" value="<?php echo $korisnik['email']; ?>"><br/>
            <label for="ime">Ime</label>
            <input type="text" id="ime" name="ime" value="<?php echo $korisnik['ime']; ?>"><br/>
            <label for="ime">Prezime</label>
            <input type="text" id="prezime" name="prezime" value="<?php echo $korisnik['prezime']; ?>"><br/>
            <input type="hidden" id="korisnik_id" name="korisnik_id" value="<?php echo $korisnik['korisnik_id']; ?>"><br/>
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
