<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    
    public $categories = [
        'schermi',
        'schede video',
        'schede madri',
        'processori',
        'alimentatori',
        'ram',
        'accessori',
        'libri',
        'case',
        'periferiche'  
    ];
    public function run(): void
    {
        foreach ($this->categories as $category){
            Category::create([
                'name' => $category
            ]);
        }
        
        
    }
}
