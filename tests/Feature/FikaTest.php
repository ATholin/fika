<?php

namespace Tests\Feature;

use App\Fika;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class FikaTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Assert that the create (home) view can be loaded.
     *
     * @return void
     */
    public function test_can_see_create_page()
    {
        $response = $this->get(route('fika.create'));

        $response->assertOk();
        $response->assertViewIs('fika.create');
        $response->assertSee('Create');
    }

    /**
     * Assert that the fika page can be loaded.
     *
     * @return void
     */
    public function test_can_see_show_page()
    {
        $fika = factory(Fika::class)->create();

        $response = $this->get(route('fika.show', $fika));

        $response->assertOk();
        $response->assertViewIs('fika.show');
        $response->assertSee($fika->getAttribute('title'));
    }

    /**
     * Assert that the edit page can be loaded.
     *
     * @return void
     */
    public function test_can_see_edit_page()
    {
        $fika = factory(Fika::class)->create();

        session([
            'fikas' => [$fika->getAttribute('slug')]
        ]);

        $response = $this->get(route('fika.edit', $fika));

        $response->assertOk();
        $response->assertViewIs('fika.edit');
        $response->assertSee('Edit fika');
    }

    /**
     * Assert that the edit page requires password.
     *
     * @return void
     */
    public function test_edit_requires_auth()
    {
        $fika = factory(Fika::class)->create();

        $response = $this->get(route('fika.edit', $fika));

        $response->assertOk();
    }

    /**
     * Assert updating.
     *
     * @return void
     */

    /**
     * Assert that the edit page requires password.
     *
     * @return void
     */
    public function test_edit_auth_correct_password()
    {
        $fika = factory(Fika::class)->create([
            'password' => Hash::make('test'),
        ]);

        $response = $this->post(route('fika.edit.auth', $fika), [
            'password' => 'test'
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('fika.edit', $fika));
    }

    /**
     * Assert that the edit page requires password.
     *
     * @return void
     */
    public function test_edit_auth_wrong_password()
    {
        $fika = factory(Fika::class)->create([
            'password' => Hash::make('test'),
        ]);

        $response = $this->post(route('fika.edit.auth', $fika), [
            'password' => 'test1'
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('fika.create'));
    }

    /**
     * Assert updating.
     *
     * @return void
     */

    public function test_can_update_fika()
    {
        $fika = factory(Fika::class)->create();

        session([
            'fikas' => [$fika->getAttribute('slug')]
        ]);

        $response = $this->patch(route('fika.update', $fika), [
            'title' => 'Updated title',
            'slug' => $fika->slug,
            'times' => [
                [
                    'start' => '22:30',
                    'end' => '23:30',
                ]
            ],
            'password' => ''
        ]);

        $fika = Fika::first();

        $response->assertStatus(302);
        $response->assertRedirect(route('fika.show', $fika));

        $this->assertEquals('Updated title', $fika->title);
    }

    /**
     * Assert that updating requires auth.
     *
     * @return void
     */
    public function test_update_requires_auth()
    {
        $fika = factory(Fika::class)->create();

        $response = $this->patch(route('fika.update', $fika), [
            'title' => 'Updated title',
            'slug' => $fika->slug,
            'times' => [
                [
                    'start' => '22:30',
                    'end' => '23:30',
                ]
            ],
            'password' => ''
        ]);

        $fika = Fika::first();

        $response->assertStatus(302);
        $response->assertRedirect(route('fika.edit.auth', $fika));
    }

    /**
     * Assert can create fika without a password.
     *
     * @return void
     */
    public function test_can_create_fika_without_password()
    {
        $slug = 'test-slug';

        $response = $this->post(route('fika.create'), [
            'title' => 'Fika',
            'slug' => $slug,
            'times' => [
                [
                    'start' => '22:30',
                    'end' => '23:30',
                ]
            ],
            'password' => ''
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('fika.show', $slug));

        /** @var Fika $fika */
        $fika = Fika::whereSlug($slug)->first();

        $this->assertNotNull($fika);

        $this->assertNull($fika->getAttribute('password'));
    }

    /**
     * Assert can create fika with a password.
     *
     * @return void
     */
    public function test_can_create_fika_with_password()
    {
        $slug = 'test-slug';

        $response = $this->post('/', [
            'title' => 'Fika',
            'slug' => $slug,
            'times' => [
                [
                    'start' => '22:30',
                    'end' => '23:30',
                ]
            ],
            'password' => 'test'
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('fika.show', $slug));

        /** @var Fika $fika */
        $fika = Fika::whereSlug($slug)->first();

        $this->assertTrue($fika->exists);

        $this->assertNotNull($fika->getAttribute('password'));
    }
}
