## Subir o ambiente
- Para subir o ambiente, basta rodar o comando `docker-compose up` na raiz do projeto.
- Entrar no container do php com o comando `docker exec -it php_labs_api bash`.
  - Rodar o comando `composer install` para instalar as dependências do projeto.
  - Rodar o comando `php artisan migrate` para criar as tabelas no banco de dados.
  - Copiar o arquivo `.env.example` para `.env` e configurar o banco de dados.
  - Rodar o comando `php artisan key:generate` para gerar a chave da aplicação.
  - O projeto estará disponível em `http://localhost:8080`.
