<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class PerfilTest extends TestCase
{

    public function test_atualizar_email_e_nome(): void
    {
        Artisan::call('migrate');

        $admin = Admin::create([
            "nome" => "admin",
            "email" => "admin@email.com",
            "password" => bcrypt("123456")
        ]);

        $this->actingAs($admin);

        $response = $this->post(route("perfil.update", [
            "nome" => "root",
            "email" => "root@email.com"
        ]));

        $response->assertStatus(302);

        $this->assertDatabaseHas('admins', [
            "nome" => "root",
            "email" => "root@email.com"
        ]);

    }
}
