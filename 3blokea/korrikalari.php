<?php

class Korrikalari {
    private string $izena;
    private string $kodea;
    private array $denborak;

    public function __construct(string $izena, string $kodea) {
        $this->izena = $izena;
        $this->kodea = $kodea;
        $this->denborak = [];
    }

    public function getIzena(): string {
        return $this->izena;
    }

    public function setIzena(string $izena): void {
        $this->izena = $izena;
    }

    public function getKodea(): string {
        return $this->kodea;
    }

    public function setKodea(string $kodea): void {
        $this->kodea = $kodea;
    }

    public function getDenborak(): array {
        return $this->denborak;
    }

    public function setDenborak(array $denborak): void {
        $this->denborak = $denborak;
    }

    public function lasterketaGehitu(float $denbora): void {
      
        if ($denbora < 5) {
            throw new Exception("Lasterketak gutxienez 5 segundo izan behar ditu.");
        }

        if (count($this->denborak) >= 5) {
            throw new Exception("Ezin dira 5 lasterketa baino gehiago gehitu.");
        }

        $this->denborak[] = $denbora;
    }
}
?>
