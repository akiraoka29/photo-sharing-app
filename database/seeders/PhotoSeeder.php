<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Photo;

class PhotoSeeder extends Seeder
{
    private $data = [
        [
            'user_id' => 1,
            'title' => 'Secangkir Kopi Kenangan',
            'caption' => 'Kopi nikmat nyaman dilambung',
            'file_name' => 'example-1.jpg',
            'file_path' => 'user-1',
        ],
        [
            'user_id' => 1,
            'title' => 'Kacamata Hitam',
            'caption' => 'Bisa lihat mahluk astral',
            'file_name' => 'example-3.jpg',
            'file_path' => 'user-1',
        ],
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('photos')->insert($this->data);
    }
}
