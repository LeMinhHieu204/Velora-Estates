<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VeloraController extends Controller
{
    public function home()
    {
        $properties = $this->properties();

        return view('home', [
            'featured' => array_slice($properties, 0, 3),
            'properties' => $properties,
        ]);
    }

    public function index(Request $request)
    {
        return view('properties', [
            'properties' => $this->properties(),
            'activeFilters' => $request->query(),
        ]);
    }

    public function show(string $slug)
    {
        $properties = $this->properties();
        $property = collect($properties)->firstWhere('slug', $slug) ?? $properties[0];
        $related = collect($properties)
            ->where('slug', '!=', $property['slug'])
            ->take(4)
            ->values()
            ->all();

        return view('property', compact('property', 'related'));
    }

    private function properties(): array
    {
        return [
            [
                'slug' => 'aegean-horizon-villa',
                'title' => 'Aegean Horizon Villa',
                'location' => 'Santorini, Greece',
                'price' => '$12,500,000',
                'type' => 'Villa',
                'beds' => 6,
                'baths' => 6,
                'area' => '8,200',
                'land' => '12,400',
                'status' => 'Featured',
                'image' => 'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=1600&q=85',
                'gallery' => [
                    'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=2200&q=88',
                    'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?auto=format&fit=crop&w=1200&q=85',
                    'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?auto=format&fit=crop&w=1200&q=85',
                    'https://images.unsplash.com/photo-1600607688969-a5bfcd646154?auto=format&fit=crop&w=1200&q=85',
                    'https://images.unsplash.com/photo-1613490493576-7fde63acd811?auto=format&fit=crop&w=1200&q=85',
                ],
                'description' => 'Perched above the Aegean, this contemporary cliffside residence frames every room with the changing blue of the caldera. Honest materials, warm light and a private infinity pool create a home that feels both quietly rooted and entirely extraordinary.',
                'features' => ['Infinity pool with caldera views', 'Private cliffside position', 'Indoor-outdoor living', 'Wine cellar & tasting room', 'Smart home technology', 'Guest villa & staff quarters'],
                'agent' => 'Alexander Grant',
            ],
            [
                'slug' => 'skyline-penthouse',
                'title' => 'Skyline Penthouse',
                'location' => 'Dubai, UAE',
                'price' => '$18,900,000',
                'type' => 'Penthouse',
                'beds' => 5,
                'baths' => 6,
                'area' => '10,500',
                'land' => '—',
                'status' => 'New',
                'image' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=1600&q=85',
                'gallery' => ['https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=2200&q=88', 'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?auto=format&fit=crop&w=1200&q=85'],
                'description' => 'A light-filled penthouse above the city, composed as an elevated retreat with uninterrupted skyline views and a calm, gallery-like interior.',
                'features' => ['Private lift lobby', 'Skyline terrace', 'Cinema room', 'Private gym', 'Concierge service', 'Four-car garage'],
                'agent' => 'Sophie Laurent',
            ],
            [
                'slug' => 'pacific-view-residence',
                'title' => 'Pacific View Residence',
                'location' => 'Los Cabos, Mexico',
                'price' => '$9,750,000',
                'type' => 'Residence',
                'beds' => 4,
                'baths' => 4,
                'area' => '7,300',
                'land' => '10,200',
                'status' => null,
                'image' => 'https://images.unsplash.com/photo-1613490493576-7fde63acd811?auto=format&fit=crop&w=1600&q=85',
                'gallery' => ['https://images.unsplash.com/photo-1613490493576-7fde63acd811?auto=format&fit=crop&w=2200&q=88', 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1200&q=85'],
                'description' => 'A sculptural coastal residence where broad terraces, shaded courtyards and the Pacific horizon bring the outdoors into every moment.',
                'features' => ['Ocean-facing pool', 'Chef’s kitchen', 'Shaded courtyards', 'Private beach access', 'Guest suite', 'Solar power system'],
                'agent' => 'Marco Vitale',
            ],
            [
                'slug' => 'riviera-estate',
                'title' => 'Riviera Estate',
                'location' => 'Côte d’Azur, France',
                'price' => '$14,800,000',
                'type' => 'Estate',
                'beds' => 5,
                'baths' => 5,
                'area' => '9,300',
                'land' => '28,000',
                'status' => null,
                'image' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1600&q=85',
                'gallery' => ['https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=2200&q=88'],
                'description' => 'A sun-washed Riviera estate surrounded by mature gardens, with the ease of a private resort and the intimacy of a family home.',
                'features' => ['Mature Mediterranean gardens', 'Pool house', 'Sea-view terraces', 'Library', 'Wine cellar', 'Guest cottage'],
                'agent' => 'Alexander Grant',
            ],
            [
                'slug' => 'cliffside-estate',
                'title' => 'The Cliffside Estate',
                'location' => 'Bali, Indonesia',
                'price' => '$11,200,000',
                'type' => 'Estate',
                'beds' => 5,
                'baths' => 5,
                'area' => '6,800',
                'land' => '18,500',
                'status' => null,
                'image' => 'https://images.unsplash.com/photo-1600566753051-f0b89df2dd90?auto=format&fit=crop&w=1600&q=85',
                'gallery' => ['https://images.unsplash.com/photo-1600566753051-f0b89df2dd90?auto=format&fit=crop&w=2200&q=88'],
                'description' => 'A private tropical retreat carved into the landscape, balancing quiet pavilion living with generous entertaining spaces.',
                'features' => ['Jungle outlook', 'Infinity pool', 'Spa pavilion', 'Chef’s kitchen', 'Yoga studio', 'Staff residence'],
                'agent' => 'Sophie Laurent',
            ],
            [
                'slug' => 'villa-belvedere',
                'title' => 'Villa Belvedere',
                'location' => 'Tuscany, Italy',
                'price' => '$8,950,000',
                'type' => 'Villa',
                'beds' => 6,
                'baths' => 6,
                'area' => '7,500',
                'land' => '42,000',
                'status' => null,
                'image' => 'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=1500&q=82',
                'gallery' => ['https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=2200&q=88'],
                'description' => 'An Italian country house with a modern point of view, where old stone, cypress gardens and open skies set the rhythm of everyday life.',
                'features' => ['Olive grove', 'Restored stone detail', 'Pool & pool house', 'Formal gardens', 'Orangerie', 'Wine cellar'],
                'agent' => 'Marco Vitale',
            ],
            [
                'slug' => 'oceanfront-residences',
                'title' => 'Oceanfront Residences',
                'location' => 'Miami, USA',
                'price' => '$22,500,000',
                'type' => 'Residence',
                'beds' => 5,
                'baths' => 7,
                'area' => '11,200',
                'land' => '15,400',
                'status' => 'Exclusive',
                'image' => 'https://images.unsplash.com/photo-1600585154526-990dced4db0d?auto=format&fit=crop&w=1600&q=85',
                'gallery' => ['https://images.unsplash.com/photo-1600585154526-990dced4db0d?auto=format&fit=crop&w=2200&q=88'],
                'description' => 'A private oceanfront address with resort-scale amenities and the polished simplicity of a true modern classic.',
                'features' => ['Private ocean access', 'Infinity pool', 'Wellness suite', 'Summer kitchen', 'Smart security', 'Boat dock'],
                'agent' => 'Alexander Grant',
            ],
            [
                'slug' => 'alpine-retreat',
                'title' => 'Alpine Retreat',
                'location' => 'St. Moritz, Switzerland',
                'price' => '$16,900,000',
                'type' => 'Chalet',
                'beds' => 5,
                'baths' => 6,
                'area' => '9,400',
                'land' => '—',
                'status' => null,
                'image' => 'https://images.unsplash.com/photo-1544986581-efac024faf62?auto=format&fit=crop&w=1600&q=85',
                'gallery' => ['https://images.unsplash.com/photo-1544986581-efac024faf62?auto=format&fit=crop&w=2200&q=88'],
                'description' => 'A serene alpine retreat pairing crisp mountain views with warm timber, private wellness and effortless ski access.',
                'features' => ['Ski-in access', 'Fireplace lounge', 'Wellness suite', 'Heated garage', 'Cinema room', 'Mountain terrace'],
                'agent' => 'Sophie Laurent',
            ],
        ];
    }
}
