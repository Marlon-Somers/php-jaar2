<?php
class Kamer {
    private float $lengte;
    private float $breedte;
    private float $hoogte;

    public function __construct(float $lengte, float $breedte, float $hoogte) {
        $this->lengte = $lengte;
        $this->breedte = $breedte;
        $this->hoogte = $hoogte;
    }

    public function getLengte(): float {
        return $this->lengte;
    }

    public function getBreedte(): float {
        return $this->breedte;
    }

    public function getHoogte(): float {
        return $this->hoogte;
    }

    public function berekenVolume(): int {
        return (int)($this->lengte * $this->breedte * $this->hoogte);
    }
}

class Huis {
    private array $kamers = [];
    private float $prijsPerM3 = 3000;

    public function voegKamerToe(Kamer $kamer): void {
        $this->kamers[] = $kamer;
    }

    public function getKamers(): array {
        return $this->kamers;
    }

    public function berekenTotaleGrootte(): int {
        $totaalVolume = 0;
        foreach ($this->kamers as $kamer) {
            $totaalVolume += $kamer->berekenVolume();
        }
        return $totaalVolume;
    }

    public function berekenPrijs(): float {
        return $this->berekenTotaleGrootte() * $this->prijsPerM3;
    }

    public function toonDetails(): void {
        echo "<h3>Inhoud Kamers:</h3><ul>";
        foreach ($this->kamers as $kamer) {
            echo "<li>Lengte: {$kamer->getLengte()}m Breedte: {$kamer->getBreedte()}m Hoogte: {$kamer->getHoogte()}m</li>";
        }
        echo "</ul>";

        echo "<p><strong>Volume Totaal = " . $this->berekenTotaleGrootte() . "m³</strong></p>";
        echo "<p><strong>Prijs van het huis is= " . number_format($this->berekenPrijs(), 0, ',', '') . " Euro</strong></p>";
    }
}

// Huis aanmaken en kamers toevoegen
$huis = new Huis();
$huis->voegKamerToe(new Kamer(5.2, 5.1, 5.5));
$huis->voegKamerToe(new Kamer(4.8, 4.6, 4.9));
$huis->voegKamerToe(new Kamer(5.9, 2.5, 3.1));

$huis->toonDetails();
?>
