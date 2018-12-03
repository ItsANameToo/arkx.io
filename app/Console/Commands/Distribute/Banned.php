<?php

namespace App\Console\Commands\Distribute;

use App\Models\Wallet;
use App\Services\Calculator;
use Illuminate\Console\Command;

class Banned extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ark:distribute:banned';

    /**
     * Execute the console command.
     */
    public function handle(Calculator $calculator): void
    {
        $wallets = Wallet::eligible();

        Wallet::banned()->each(function ($offender) use ($calculator, $wallets) {
            $this->line("Processing Offender: <info>{$offender->address}</info>");

            $wallets->each(function ($wallet) use ($calculator, $offender) {
                $this->line("Processing Wallet: <info>{$wallet->address}</info>");

                $calculator->setReward($offender->earnings);

                $wallet->increment('earnings', $calculator->forWallet($wallet));
            });

            $offender->update(['earnings' => 0]);
        });
    }
}
