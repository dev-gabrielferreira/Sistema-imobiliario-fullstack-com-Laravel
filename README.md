# Projeto fullstack de sistema imobiliário

Projeto de sistema de imóveis incluido com painel admin, recuperação de senha, envio de email e crud completo

## Instalação

1. **Clone o repositório:**

    ```bash
   git clone https://github.com/dev-gabrielferreira/Sistema-imobiliario-fullstack-com-laravel.git

2. **Navegue para o diretótio:**
    ```.env
    cd Sistema-imobiliario-fullstack-com-laravel
    
3. **Instale as dependências:**
    ```bash
   composer install

4. **Crie o arquivo `.env` a partir do exemplo:**

   ```bash
   touch .env
   cp .env.example .env
   php artisan key:generate
   ```
    preencha as sessões de DB e MAIL com suas informações

6. **Realize as migrations e os seeders**
    ```bash
    php artisan migrate
    php artisan db:seed

7. **Crie link para as imagens**

   ```bash
   php artisan storage:link

8. **Inicialize o projeto**
    ```bash
    php artisan serve

   
