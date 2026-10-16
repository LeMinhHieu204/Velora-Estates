<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Property;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $properties = [
            ['slug' => 'aegean-horizon-villa', 'title' => 'Aegean Horizon Villa', 'location' => 'Santorini, Greece', 'price' => 12500000, 'type' => 'Villa', 'bedrooms' => 6, 'bathrooms' => 6, 'area_sq_ft' => 8200, 'land_sq_ft' => 12400, 'status' => 'Featured', 'hero_image' => 'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=1600&q=85', 'gallery' => ['https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=2200&q=88', 'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?auto=format&fit=crop&w=1200&q=85'], 'description' => 'Perched above the Aegean, this contemporary cliffside residence frames every room with the changing blue of the caldera.', 'features' => ['Infinity pool with caldera views', 'Private cliffside position', 'Indoor-outdoor living'], 'agent' => 'Alexander Grant'],
            ['slug' => 'skyline-penthouse', 'title' => 'Skyline Penthouse', 'location' => 'Dubai, UAE', 'price' => 18900000, 'type' => 'Penthouse', 'bedrooms' => 5, 'bathrooms' => 6, 'area_sq_ft' => 10500, 'land_sq_ft' => null, 'status' => 'New', 'hero_image' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=1600&q=85', 'gallery' => ['https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=2200&q=88'], 'description' => 'A light-filled penthouse above the city, composed as an elevated retreat with uninterrupted skyline views.', 'features' => ['Private lift lobby', 'Skyline terrace', 'Cinema room'], 'agent' => 'Sophie Laurent'],
            ['slug' => 'pacific-view-residence', 'title' => 'Pacific View Residence', 'location' => 'Los Cabos, Mexico', 'price' => 9750000, 'type' => 'Residence', 'bedrooms' => 4, 'bathrooms' => 4, 'area_sq_ft' => 7300, 'land_sq_ft' => 10200, 'status' => null, 'hero_image' => 'https://images.unsplash.com/photo-1613490493576-7fde63acd811?auto=format&fit=crop&w=1600&q=85', 'gallery' => ['https://images.unsplash.com/photo-1613490493576-7fde63acd811?auto=format&fit=crop&w=2200&q=88'], 'description' => 'A sculptural coastal residence where broad terraces, shaded courtyards and the Pacific horizon bring the outdoors into every moment.', 'features' => ['Ocean-facing pool', 'Chef’s kitchen', 'Shaded courtyards'], 'agent' => 'Marco Vitale'],
            ['slug' => 'riviera-estate', 'title' => 'Riviera Estate', 'location' => 'Côte d’Azur, France', 'price' => 14800000, 'type' => 'Estate', 'bedrooms' => 5, 'bathrooms' => 5, 'area_sq_ft' => 9300, 'land_sq_ft' => 28000, 'status' => null, 'hero_image' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1600&q=85', 'gallery' => ['https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=2200&q=88'], 'description' => 'A sun-washed Riviera estate surrounded by mature gardens, with the ease of a private resort.', 'features' => ['Mature Mediterranean gardens', 'Pool house', 'Sea-view terraces'], 'agent' => 'Alexander Grant'],
        ];

        foreach ($properties as $property) {
            Property::updateOrCreate(['slug' => $property['slug']], $property);
        }
    }
}
