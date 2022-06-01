<?php


namespace Packages\pay\src\database\factories;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Packages\pay\src\Models\Transaction;

class TransactionFactory extends Factory
{

    protected $model = Transaction::class;

    public function definition()
    {
        $startDate = now()->startOfWeek();
        $endDate = now()->endOfWeek();
        return [
            'amount' => round($this->faker->numberBetween($min = 1500000, $max = 6000000) / 10000) * 10000,
            'resnumber' => Str::random(10),
            'enter_port_at' => now(),
            'exit_port_at' => now()->addMinutes(2),
            'details' => [
                'referenceId' => Str::random(8)
            ],
            'status_id' => config('pay.enums.status.successful'),
            'transactiontable_type' => 'Packages\order\src\Models\Order',
            'transactiontable_id' => 3,
            'created_at' => Carbon::createFromTimestamp(rand($endDate->timestamp, $startDate->timestamp))->format('Y-m-d H:i')
        ];
    }
}
