<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ticket_settings')->insert([
            'greeting_1' => 'Gracias por tu compra.',
            'greeting_2' => 'Esperamos verte pronto.',
            'greeting_3' => 'Atte. La Gerencia',
            'signature_line' => false,
            'created_at' => NOW(),
        ]);
    }
}
