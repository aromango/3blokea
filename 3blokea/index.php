<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Txapelketa Proba</title>
</head>
<body>
<?php

require_once 'Txapelketa.php';

try {
    $txapelketa = new Txapelketa();

    $k1 = new Korrikalari("Ainhoa", "K001");
    $k2 = new Korrikalari("Mikel", "K002");
    $k3 = new Korrikalari("Ane", "K003");

    $txapelketa->korrikalariagehitu($k1);
    $txapelketa->korrikalariagehitu($k2);
    $txapelketa->korrikalariagehitu($k3);

    foreach ($txapelketa->getKorrikalariak() as $kodea => $korrikalaria) {
        $lasterketaKopurua = rand(1, 4);
        for ($i = 0; $i < $lasterketaKopurua; $i++) {
            $txapelketa->gehitulasterketakorrikalariari($kodea, rand(6, 25));
        }
    }

    echo "<h3>1. Batez besteko denbora 1. lasterketan:</h3>";
    echo $txapelketa->batezBeste1Lasterketa() . " segundo.<br>";

    echo "<h3>2. Korrikalari bizkorrena:</h3>";
    $bizkorrena = $txapelketa->korrikalariBizkorrena();
    if ($bizkorrena) {
        echo $bizkorrena->getIzena() . " (" . $bizkorrena->getKodea() . ")<br>";
    }

    echo "<h3>3. 2 lasterketetan >15s egin dutenen izenak:</h3>";
    $izenak = $txapelketa->biLasterketa15SegundoBainoGehiago();

    if (!empty($izenak)) {
    echo implode(", ", $izenak) . "<br>";
    } else {
    echo "Inork ez du baldintza hori bete oraingoan.<br>";
    }

    echo "<h3>4. 'e' letrarekin amaitzen direnak:</h3>";
    foreach ($txapelketa->izenaEnekinAmaitu() as $k) {
        echo $k->getIzena() . "<br>";
    }

} catch (Exception $e) {
    echo "Errorea: " . $e->getMessage();
}
?>
</body>
</html>