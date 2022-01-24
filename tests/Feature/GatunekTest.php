<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Gatunek;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Faker\Factory;

class GatunekTest extends TestCase
{
    use  DatabaseTransactions;

    public function test_wyswietlenie_formularza_dodawania_gatunku()
    {
        $user = User::factory()->create();
        $user->givePermissionTo('gatunki-index');
        $user->givePermissionTo('gatunki-store');

        $response = $this->actingAs($user)->get('/gatunki/create');
        $response->assertStatus(200);
        $response->assertSeeText('Dodanie nowej gatunek');
        
    }

    public function test_dodawanie_gatunku()
    {


        $user = User::factory()->create();
        $user->givePermissionTo('gatunki-index');
        $user->givePermissionTo('gatunki-store');

        $response = $this->actingAs($user)->post('/gatunki', [
            'nazwa_gatunku' => 'testowanieUnikalnaNazwaGatunkuXd'
        ]);

        $response->assertRedirect(route('gatunki.index'));
    }
}
