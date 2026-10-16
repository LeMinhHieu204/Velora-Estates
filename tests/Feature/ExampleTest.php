<?php

namespace Tests\Feature;

use App\Models\Property;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_property_detail_requires_a_known_slug(): void
    {
        $this->get('/properties/aegean-horizon-villa')->assertOk();
        $this->get('/properties/not-a-real-property')->assertNotFound();
    }

    public function test_catalog_is_database_backed_and_filters_server_side(): void
    {
        $this->get('/properties?type=penthouse')->assertOk()->assertSee('Skyline Penthouse')->assertDontSee('Aegean Horizon Villa');
        $this->get('/properties?max_price=10000000')->assertOk()->assertSee('Pacific View Residence')->assertDontSee('Skyline Penthouse');
        $this->assertSame(4, Property::count());
    }

    public function test_inquiry_is_validated_and_persisted(): void
    {
        $response = $this->post('/inquiries', [
            'name' => 'Alex Morgan',
            'email' => 'alex@example.test',
            'inquiry_type' => 'Private tour',
            'message' => 'I would like to arrange a private viewing.',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('property_inquiries', ['email' => 'alex@example.test', 'status' => 'new']);
    }

    public function test_admin_dashboard_requires_admin_and_can_archive_a_property(): void
    {
        $this->get('/admin/velora')->assertRedirect();
        $admin = User::factory()->create(['is_admin' => true]);
        $this->actingAs($admin)->get('/admin/velora')->assertOk()->assertSee('Velora content dashboard');

        $property = Property::firstOrFail();
        $this->actingAs($admin)->post(route('admin.velora.properties.archive', $property))->assertRedirect();
        $this->assertDatabaseHas('properties', ['id' => $property->id, 'is_published' => false]);
    }
}
