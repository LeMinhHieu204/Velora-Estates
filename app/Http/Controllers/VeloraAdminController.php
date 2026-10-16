<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyInquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class VeloraAdminController extends Controller
{
    public function index(): View
    {
        return view('admin.velora.index', [
            'properties' => Property::latest()->get(),
            'inquiries' => PropertyInquiry::with('property')->latest()->limit(50)->get(),
            'metrics' => [
                'published' => Property::where('is_published', true)->count(),
                'inquiries' => PropertyInquiry::count(),
                'new' => PropertyInquiry::where('status', 'new')->count(),
            ],
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Property::create($this->validated($request));

        return back()->with('success', 'Property created.');
    }

    public function update(Request $request, Property $property): RedirectResponse
    {
        $property->update($this->validated($request, $property));

        return back()->with('success', 'Property updated.');
    }

    public function archive(Property $property): RedirectResponse
    {
        $property->update(['is_published' => false]);

        return back()->with('success', 'Property archived and removed from the public catalog.');
    }

    public function updateInquiry(Request $request, PropertyInquiry $inquiry): RedirectResponse
    {
        $inquiry->update($request->validate(['status' => [Rule::in(['new', 'contacted', 'closed'])]]));

        return back()->with('success', 'Inquiry status updated.');
    }

    private function validated(Request $request, ?Property $property = null): array
    {
        $data = $request->validate([
            'slug' => ['required', 'alpha_dash', 'max:120', Rule::unique('properties', 'slug')->ignore($property?->id)],
            'title' => ['required', 'string', 'max:180'],
            'location' => ['required', 'string', 'max:180'],
            'price' => ['required', 'integer', 'min:0'],
            'type' => ['required', 'string', 'max:40'],
            'bedrooms' => ['required', 'integer', 'min:1', 'max:50'],
            'bathrooms' => ['required', 'integer', 'min:1', 'max:50'],
            'area_sq_ft' => ['required', 'integer', 'min:1'],
            'land_sq_ft' => ['nullable', 'integer', 'min:0'],
            'status' => ['nullable', 'string', 'max:40'],
            'hero_image' => ['required', 'url:http,https', 'max:1000'],
            'gallery' => ['nullable', 'array', 'max:20'],
            'gallery.*' => ['url:http,https', 'max:1000'],
            'description' => ['required', 'string', 'max:10000'],
            'features' => ['nullable', 'array', 'max:30'],
            'features.*' => ['string', 'max:180'],
            'agent' => ['required', 'string', 'max:160'],
            'is_published' => ['sometimes', 'boolean'],
        ]);
        $data['is_published'] = (bool) ($data['is_published'] ?? false);

        return $data;
    }
}
