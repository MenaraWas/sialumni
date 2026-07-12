<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FormSchema;

class FormSchemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        FormSchema::create([
            'name' => 'Tracer Study 2025',
            'description' => 'Form penelusuran alumni MAN 2 Bantul tahun 2025',
            'is_active' => true,
            'fields' => [
                [
                    'key' => 'motivasi',
                    'label' => 'Motivasi memilih MAN 2 Bantul',
                    'type' => 'textarea',
                    'required' => false,
                ],
                [
                    'key' => 'kesan',
                    'label' => 'Kesan selama belajar di MAN 2 Bantul',
                    'type' => 'textarea',
                    'required' => false,
                ],
                [
                    'key' => 'saran',
                    'label' => 'Saran untuk MAN 2 Bantul',
                    'type' => 'textarea',
                    'required' => false,
                ],
            ],
        ]);
    }
}
