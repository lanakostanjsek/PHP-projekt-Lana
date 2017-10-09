<?php
    session_start();
    include 'baza.php';
    $greskaPrijava = "";

    if (isset($_SESSION['korisnik_id'])){
        header("Location: index.php");
    }

    if (isset($_POST['prijava'])){
        if (empty($_POST['korime']) || empty($_POST['lozinka'])){
            $greskaPrijava .= "Niste unijeli sve podatke za prijavu!";
        } else {
            $upit = "SELECT * FROM korisnik WHERE korisnicko_ime='{$_POST['korime']}' AND lozinka='{$_POST['lozinka']}'";
            $rezultat = radiSBazom($upit);
            if ($rezultat->num_rows ==0){
                $greskaPrijava .= "Unijeli ste pogrešne korisničke podatke!";
            } else {
                $korisnik = mysqli_fetch_assoc($rezultat);
                $_SESSION['prijava'] = "da";
                $_SESSION['korisnik_id'] = $korisnik['korisnik_id'];
                switch ((int)$korisnik['tip_id']){
                    case 2: $_SESSION['tip'] = "korisnik";
                        break;
                    case 1: $_SESSION['tip'] = "moderator";
                        break;
                    default: $_SESSION['tip'] = "administrator";
                }
                header("Location: index.php");
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Prijava korisnika</title>
    <link href="lana.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<header>
    <h1>Prijava korisnika</h1>
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
        <form method="post" action="prijava.php">
            <p>
                <?php
                    echo $greskaPrijava;
                ?>
            </p>
            <label for="korime">Korisničko ime</label>
            <input type="text" id="korime" name="korime" /><br/>
            <label for="lozinka">Lozinka</label>
            <input type="password" id="lozinka" name="lozinka" /><br/>
            <input type="submit" name="prijava" value="Prijava" />
        </form>
    </div>
</section>
<footer>
    <p><b>Lana Kostanjšek</b></p>
    <p>&copy;Sportske udruge</p>
</footer>
</body>
</html>
