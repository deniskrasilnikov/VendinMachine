<?php

declare(strict_types=1);

class VendingMachine
{
    private const ACCEPTED_COINS = [1, 2, 5, 10, 20, 50];

    private array $products = [
        'A' => 95,
        'B' => 126,
        'C' => 233,
    ];

    public function start(array $input)
    {
        if (count($input) < 2) {
            die("You must pick a product type and put at least one coin.\n");
        }

        $product = array_shift($input);

        if (!isset($this->products[$product])) {
            die("You must pick one of A, B or C products.\n");
        }

        echo sprintf("You have picked $product product for $%0.2f price\n", $this->products[$product] / 100);

        $coins = $input;

        if (!is_array($coins) || !count($coins)) {
            die("Please provide some coins.\n");
        }

        foreach ($coins as $coin) {
            if (!in_array($coin, self::ACCEPTED_COINS)) {
                die("The coin $coin is not accepted. Please put any of " . implode(', ', self::ACCEPTED_COINS) . "\n");
            }
        }

        $coinSum = array_sum($coins);
        $productPrice = $this->products[$product];

        if ($coinSum < $productPrice) {
            die("Not enough coins for this product. Please provide more\n");
        }

        echo sprintf("You provided $%0.2f\n", $coinSum / 100);

        $changeSum = $coinSum - $productPrice;

        echo sprintf("The change is $%0.2f\n", $changeSum / 100);

        $changeCoins = [];

        foreach (array_reverse(self::ACCEPTED_COINS) as $acceptedNominal) {
            $result = $changeSum / $acceptedNominal;

            if ($result < 1) {
                continue;
            }

            $changeCoins = array_merge(
                $changeCoins,
                array_fill(
                    count($changeCoins),
                    $coinAmount = (int)floor($result),
                    $acceptedNominal
                )
            );
            $changeSum -= $coinAmount * $acceptedNominal;
            // var_dump($acceptedNominal . ': ' .$result);
        }

        if (count($changeCoins)) {
            printf("Please take a change: " . implode(" ", $changeCoins) . "\n");
        }

        echo "Please take a product.\n";
    }
}

$machine = new VendingMachine();
$machine->start(array_slice($argv, 1));