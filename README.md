## Framework utilizado
- [Laravel] - The PHP Framework for Web Artisans

## Instalação
Execute o comando abaixo para replicar o conteúdo do arquivo **.env.development** para o arquivo **.env**:
```sh
cp .env.development .env
```
\
Insira sua pública e sua chave privada nos campos indicados no arquivo **.env**:
```sh
MERCADO_PAGO_PUBLIC_KEY={{ YOUR_PUBLIC_KEY }}
MERCADO_PAGO_ACCESS_TOKEN={{ YOUR_ACCESS_TOKEN }}
```
\
Execute o comando abaixo para instalar as dependências do projeto:
```sh
composer install
```
\
Execute o comando abaixo para servir a aplicação:
```sh
php artisan serve
```
\
A aplicação estará disponível no endereço http://localhost:8000.


[Laravel]: <https://laravel.com/>