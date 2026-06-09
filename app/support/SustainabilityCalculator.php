<?php

namespace App\Support;

use App\Models\Product;

class SustainabilityCalculator
{
    public static function calculate(Product $product): array
    {
        $score = match ($product->category?->name) {

            'Vergadertafels' => 90,
            'Bureaus' => 85,
            'Kasten' => 80,
            'Opbergmeubilair' => 75,
            'Bureaustoelen' => 70,

            default => 60,
        };

        // Gratis weggeven = extra duurzaam
        if ($product->is_free) {

            $score += 15;

        } elseif ($product->price <= 50) {

            $score += 10;

        } elseif ($product->price <= 150) {

            $score += 5;
        }

        $score = min($score, 100);

        // Label
        if ($score >= 90) {

            $label = 'Uitstekende duurzame keuze';

        } elseif ($score >= 80) {

            $label = 'Zeer duurzame keuze';

        } elseif ($score >= 70) {

            $label = 'Goede duurzame keuze';

        } else {

            $label = 'Positieve impact';
        }

        // Geschatte CO₂-besparing
        $co2Savings = match ($product->category?->name) {

            'Vergadertafels' => 45,
            'Bureaus' => 35,
            'Kasten' => 30,
            'Opbergmeubilair' => 25,
            'Bureaustoelen' => 20,

            default => 15,
        };

        return [
            'score' => $score,
            'label' => $label,
            'co2_savings' => $co2Savings,
        ];
    }
}