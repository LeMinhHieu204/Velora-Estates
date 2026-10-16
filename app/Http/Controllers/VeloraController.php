<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyInquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class VeloraController extends Controller
{
    public function home(): View
    {
        $properties = $this->catalog()->take(8)->values();

        return view('home', [
            'featured' => $properties->take(3)->all(),
            'properties' => $properties->all(),
        ]);
    }

    public function index(Request $request): View
    {
        $filters = $request->validate([
            'location' => ['nullable', 'string', 'max:180'],
            'type' => ['nullable', Rule::in(['villa', 'penthouse', 'residence', 'estate', 'chalet'])],
            'max_price' => ['nullable', 'integer', 'min:1'],
            'bedrooms' => ['nullable', 'integer', 'min:1', 'max:20'],
        ]);

        $query = Property::query()->where('is_published', true);
        $query->when($filters['location'] ?? null, fn ($q, $value) => $q->where('location', 'like', '%'.$value.'%'));
        $query->when($filters['type'] ?? null, fn ($q, $value) => $q->whereRaw('LOWER(type) = ?', [$value]));
        $query->when($filters['max_price'] ?? null, fn ($q, $value) => $q->where('price', '<=', $value));
        $query->when($filters['bedrooms'] ?? null, fn ($q, $value) => $q->where('bedrooms', '>=', $value));

        $properties = $query->orderByDesc('created_at')->paginate(12)->through(
            fn (Property $property) => $property->toPresentationArray()
        );

        return view('properties', ['properties' => $properties, 'activeFilters' => $filters]);
    }

    public function show(string $slug): View
    {
        $propertyRecord = Property::query()
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();
        $property = $propertyRecord->toPresentationArray();
        $related = Property::query()
            ->where('is_published', true)
            ->where('id', '!=', $propertyRecord->id)
            ->latest()
            ->limit(4)
            ->get()
            ->map(fn (Property $item) => $item->toPresentationArray())
            ->values()
            ->all();

        return view('property', compact('property', 'related'));
    }

    public function inquire(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'property_id' => ['nullable', 'integer', 'exists:properties,id'],
            'name' => ['nullable', 'string', 'max:160'],
            'full_name' => ['nullable', 'string', 'max:160'],
            'email' => ['required', 'email:rfc', 'max:190'],
            'phone' => ['nullable', 'string', 'max:40'],
            'inquiry_type' => ['required', 'string', 'max:60'],
            'preferred_location' => ['nullable', 'string', 'max:180'],
            'location' => ['nullable', 'string', 'max:180'],
            'date' => ['nullable', 'date'],
            'preferred_date' => ['nullable', 'date'],
            'time' => ['nullable', 'string', 'max:40'],
            'preferred_time' => ['nullable', 'string', 'max:40'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        $name = trim((string) ($data['name'] ?? $data['full_name'] ?? ''));
        if ($name === '') {
            return back()->withErrors(['name' => 'Please enter your name.'])->withInput();
        }

        PropertyInquiry::create([
            'property_id' => $data['property_id'] ?? null,
            'name' => $name,
            'email' => strtolower($data['email']),
            'phone' => $data['phone'] ?? null,
            'inquiry_type' => $data['inquiry_type'],
            'preferred_location' => $data['preferred_location'] ?? $data['location'] ?? null,
            'preferred_date' => $data['preferred_date'] ?? $data['date'] ?? null,
            'preferred_time' => $data['preferred_time'] ?? $data['time'] ?? null,
            'message' => $data['message'],
            'consented_at' => now(),
        ]);

        return back()->with('inquiry_success', 'Thank you — your enquiry has been received. An advisor will review it shortly.');
    }

    private function catalog()
    {
        return Property::query()->where('is_published', true)->latest()->get()->map(
            fn (Property $property) => $property->toPresentationArray()
        );
    }
}
