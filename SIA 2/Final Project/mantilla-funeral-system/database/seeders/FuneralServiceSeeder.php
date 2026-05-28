<?php

namespace Database\Seeders;

use App\Models\FuneralService;
use App\Models\User;
use Illuminate\Database\Seeder;

class FuneralServiceSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();

        $services = [
            [
                'name' => 'Basic Funeral Service Package',
                'description' => 'A simple and respectful funeral service package for families who need essential funeral arrangements.',
                'price' => 25000,
                'inclusions' => "Basic casket\nFuneral assistance\nViewing arrangement\nDocumentation support",
                'availability_status' => 'available',
            ],
            [
                'name' => 'Standard Funeral Service Package',
                'description' => 'A complete funeral service package with improved casket option, viewing setup, and coordination support.',
                'price' => 45000,
                'inclusions' => "Standard casket\nViewing setup\nFlower arrangement\nFuneral coordination\nDocumentation support",
                'availability_status' => 'available',
            ],
            [
                'name' => 'Premium Funeral Service Package',
                'description' => 'A premium service package for families who prefer a more complete and comfortable funeral arrangement.',
                'price' => 75000,
                'inclusions' => "Premium casket\nEnhanced viewing setup\nFlower arrangement\nMemorial service assistance\nFuneral coordination\nDocumentation support",
                'availability_status' => 'available',
            ],
        ];

        foreach ($services as $service) {
            FuneralService::updateOrCreate(
                ['name' => $service['name']],
                array_merge($service, ['created_by' => $admin?->id])
            );
        }
    }
}
