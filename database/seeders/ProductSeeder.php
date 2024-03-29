<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = ['white', 'black', 'red', 'green', 'blue'];
        $category = [
            ['mm' => 'တီရှပ်', 'en' => 'T Shirt'],
            ['mm' => 'မိုဖိုင်းဖုန်း', 'en' => 'Mobile'],
            ['mm' => 'ဦးထုတ်', 'en' => 'Hat'],
            ['mm' => 'လျှပ်စစ်ပစ္စည်း', 'en' => 'Electronic'],
            ['mm' => 'အလှကုန်', 'en' => 'Cosmetics']
        ];
        $brand = ['Samsung', 'Huawei', 'Apple', 'Vivo', 'Xiaomi'];
        $size = ['sm', 'lg', 'xs'];

        foreach ($colors as $c) {
            Color::create([
                'slug' => uniqid(),
                'name' => $c
            ]);
        }

        foreach ($category as $c) {
            Category::create([
                'slug' => uniqid(),
                'name' => $c['en'],
                'mm_name' => $c['mm'],
            ]);
        }
        foreach ($brand as $c) {
            Brand::create([
                'slug' => uniqid(),
                'name' => $c
            ]);
        }
        foreach ($size as $c) {
            Size::create([
                'slug' => uniqid(),
                'name' => $c
            ]);
        }
    }
}
