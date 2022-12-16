<?php

namespace Database\Seeders;

use App\Models\Progress;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Progress::insert([
            ['name' => '未着手'],
            ['name' => 'メール作成済み'],
            ['name' => 'メール送信済み'],
            ['name' => '面談決定'],
            ['name' => '案件獲得'],
            ['name' => 'お祈り'],
            ['name' => '保留'],
        ]);
    }
}
