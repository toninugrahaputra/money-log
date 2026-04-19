<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Account;

class DefaultDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Kategori (Daftar kategori default: Makanan, Transport, dll)
        $categories = [
            // Expense
            ['name' => 'Makanan', 'type' => 'expense'],
            ['name' => 'Transport', 'type' => 'expense'],
            ['name' => 'Belanja', 'type' => 'expense'],
            ['name' => 'Tagihan', 'type' => 'expense'],
            ['name' => 'Hiburan', 'type' => 'expense'],
            ['name' => 'Kesehatan', 'type' => 'expense'],
            // Income
            ['name' => 'Gaji', 'type' => 'income'],
            ['name' => 'Bonus', 'type' => 'income'],
            ['name' => 'Lainnya', 'type' => 'income'],
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(['name' => $cat['name'], 'type' => $cat['type']]);
        }

        // 2. Sumber Dana (Contoh: Cash, Bank (Debit), E-wallet / QRIS)
        $accounts = [
            ['name' => 'Cash', 'type' => 'cash'],
            ['name' => 'Bank (Debit)', 'type' => 'bank'],
            ['name' => 'E-wallet / QRIS', 'type' => 'ewallet'],
        ];

        foreach ($accounts as $acc) {
            Account::firstOrCreate(['name' => $acc['name'], 'type' => $acc['type']]);
        }
    }
}
