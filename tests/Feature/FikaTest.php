<?php

namespace Tests\Feature;

use App\Fika;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

test('can see create page')
    ->get('/')
    ->assertOk()
    ->assertViewIs('fika.create')
    ->assertSee('Create');


test('can see edit page', function () {
    $fika = factory(Fika::class)->create();

    session([
        'fikas' => [$fika->getAttribute('slug')]
    ]);

    $response = $this->get(route('fika.edit', $fika));

    $response->assertOk();
    $response->assertViewIs('fika.edit');
    $response->assertSee('Edit fika');
});

test('edit requires auth', function() {
    $fika = factory(Fika::class)->create();

    $response = $this->get(route('fika.edit', $fika));

    $response->assertOk();
});

test('edit auth correct password', function () {
    $fika = factory(Fika::class)->create([
        'password' => Hash::make('test'),
    ]);

    $response = $this->post(route('fika.edit.auth', $fika), [
        'password' => 'test'
    ]);

    $response->assertStatus(302);
    $response->assertRedirect(route('fika.edit', $fika));
});

test('edit auth wrong password', function () {
    $fika = factory(Fika::class)->create([
        'password' => Hash::make('test'),
    ]);

    $response = $this->post(route('fika.edit.auth', $fika), [
        'password' => 'test1'
    ]);

    $response->assertStatus(302);
    $response->assertRedirect(route('fika.create'));
});

test('can update fika', function () {
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
});

test('update requires auth', function () {
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
});

test('can create fika without password', function () {
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
});

test('can create fika with password', function() {
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
});