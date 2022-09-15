<?php

namespace Database\Seeders;

use App\Models\Reward;
use App\Models\RewardCode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RewardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reward = new Reward();
        $reward->name = "คูปองส่วนลด 90% สูงสุด 5 บาท";
        $reward->detail = "เฉพาะสินค้าที่ร่วมรายการ";
        $reward->point = 100;
        $reward->total_amount = 10;
        $reward->balance = 10;
        $reward->is_active = true;
        $reward->save();

        for ($i = 0; $i < $reward->total_amount; $i++) {
            $rewardCode = new RewardCode();
            $rewardCode->code = fake()->lexify("?????");
            $reward->rewardCodes()->save($rewardCode);
        }
    }
}
