<?php

require_once 'korrikalari.php';

class Txapelketa {
    private array $korrikalariak;

    public function __construct() {
        $this->korrikalariak = [];
    }

    public function getKorrikalariak(): array {
        return $this->korrikalariak;
    }

    public function setKorrikalariak(array $korrikalariak): void {
        $this->korrikalariak = $korrikalariak;
    }

    public function korrikalariagehitu(Korrikalari $korrikalaria): void {
        $kodea = $korrikalaria->getKodea();
        $this->korrikalariak[$kodea] = $korrikalaria;
    }

    public function gehitulasterketakorrikalariari(string $kodea, float $denbora): void {
        if (isset($this->korrikalariak[$kodea])) {
            $this->korrikalariak[$kodea]->lasterketaGehitu($denbora);
        } else {
            throw new Exception("Ez da aurkitu '$kodea' kodea duen korrikalaririk.");
        }
    }

    public function batezBeste1Lasterketa(): float {
        $batuketa = 0;
        $kopurua = 0;

        foreach ($this->korrikalariak as $korrikalaria) {
            $denborak = $korrikalaria->getDenborak();
            if (isset($denborak[0])) {
                $batuketa += $denborak[0];
                $kopurua++;
            }
        }

        if ($kopurua === 0) {
            return 0;
        }

        return $batuketa / $kopurua;
    }

    public function korrikalariBizkorrena(): ?Korrikalari {
        $bizkorrena = null;
        $denboraGutxiena = INF;

        foreach ($this->korrikalariak as $korrikalaria) {
            $denborak = $korrikalaria->getDenborak();
            if (!empty($denborak)) {
                $guztira = array_sum($denborak);
                if ($guztira < $denboraGutxiena) {
                    $denboraGutxiena = $guztira;
                    $bizkorrena = $korrikalaria;
                }
            }
        }

        return $bizkorrena;
    }

    public function biLasterketa15SegundoBainoGehiago(): array {
        $izenak = [];

        foreach ($this->korrikalariak as $korrikalaria) {
            $denborak = $korrikalaria->getDenborak();
            $kontagailua = 0;

            foreach ($denborak as $denbora) {
                if ($denbora > 15) {
                    $kontagailua++;
                }
            }

            if ($kontagailua >= 2) {
                $izenak[] = $korrikalaria->getIzena();
            }
        }

        return $izenak;
    }

    public function izenaEnekinAmaitu(): array {
        $zerrenda = [];

        foreach ($this->korrikalariak as $korrikalaria) {
            $izena = $korrikalaria->getIzena();
            if (str_ends_with(strtolower($izena), 'e')) {
                $zerrenda[] = $korrikalaria;
            }
        }

        return $zerrenda;
    }
}
?>