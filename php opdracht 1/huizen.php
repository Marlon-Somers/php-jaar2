<?php

class Huis {
    private int $aantalVerdiepingen;
    private int $aantalKamers;
    private float $breedte;
    private float $hoogte;
    private float $diepte;
    private float $prijsPerM3 = 1500;

    public function __construct(int $aantalVerdiepingen, int $aantalKamers, float $breedte, float $hoogte, float $diepte) {
        $this->aantalVerdiepingen = $aantalVerdiepingen;
        $this->aantalKamers = $aantalKamers;
        $this->breedte = $breedte;
        $this->hoogte = $hoogte;
        $this->diepte = $diepte;
    }

    public function berekenVolume(): float {
        return $this->breedte * $this->hoogte * $this->diepte;
    }

    public function berekenPrijs(): float {
        return $this->berekenVolume() * $this->prijsPerM3;
    }

    public function toonDetails(): void {
        echo "Huis details:\n";
        echo "Aantal verdiepingen: {$this->aantalVerdiepingen}\n";
        echo "Aantal kamers: {$this->aantalKamers}\n";
        echo "Afmetingen (BxHxD): {$this->breedte}m x {$this->hoogte}m x {$this->diepte}m\n";
        echo "Volume: " . $this->berekenVolume() . " m³\n";
        echo "Prijs: €" . number_format($this->berekenPrijs(), 2, ',', '.') . "\n\n";
    }
}

$huis1 = new Huis(2, 5, 6.5, 4, 10);
$huis2 = new Huis(1, 3, 8, 3.5, 12);
$huis3 = new Huis(3, 7, 10, 5, 15);


$huis1->toonDetails();
echo "<br>";
$huis2->toonDetails();
echo "<br>";
$huis3->toonDetails();

?>

