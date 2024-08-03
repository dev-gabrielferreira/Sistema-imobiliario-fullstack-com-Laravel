<?php

namespace Tests\Feature;

use App\Mail\AnunciarMailable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class MailTest extends TestCase
{

    public function test_anunciar(): void
    {
        Mail::fake();

        $response = $this->post(route('anunciar.send'), [
            "nome" => "Nome Teste",
            "endereco" => "Endereço Teste",
            "bairro" => "Bairro Teste",
            "email" => "email@teste.com",
            "tipo" => "Tipo Teste",
            "telefone" => "123456789",
            "finalidade" => "Finalidade Teste"
        ]);

        $response->assertStatus(302);

        Mail::assertSent(AnunciarMailable::class, function ($mail) {
            if (!$mail->hasTo(env('MAIL_FROM_ADDRESS'))) {
                return false;
            }
    
            if ($mail->envelope()->subject !== 'Anunciar Imóvel') {
                return false;
            }
    
            $body = $mail->render();
            
            if (strpos($body, 'Nome Teste') === false) {
                return false;
            }
    
            if (strpos($body, 'Endereço Teste') === false) {
                return false;
            }
    
            if (strpos($body, 'Bairro Teste') === false) {
                return false;
            }
    
            return true;
        });
    }
}
