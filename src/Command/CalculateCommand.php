<?php

declare(strict_types=1);

namespace App\Command;

use App\Seeders\ProductCatalogueSeederExperiment;
use App\Services\CartService;
use App\Seeders\ProductCatalogueSeederRegular;
use App\Services\ShippingCalculator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CalculateCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->setName('app:calculate')
            ->setDescription('does some sample cart value calculations');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln("This is just a command to play with the cart during development.");
        $output->writeln("----------------------------");

        $cart = new CartService(new ProductCatalogueSeederExperiment(), new ShippingCalculator());
        $cart->addProduct('B01', 1);
        $cart->addProduct('R01', 2);

        $output->write($cart->getCartSummary());

        $output->writeln("----------------------------");

        return Command::SUCCESS;
    }
}
