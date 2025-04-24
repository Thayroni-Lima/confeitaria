#!/bin/sh

# Espera o banco de dados ficar pronto
echo "Aguardando o banco de dados iniciar..."
until nc -z db 5432; do
  sleep 1
done
echo "Banco de dados pronto!"

# Instala dependências do PHP
composer install

# Executa migrations
php artisan migrate --force

# Gera chave da aplicação
php artisan key:generate

# Garante que storage está linkado
php artisan storage:link || true

# Sobe o servidor
php artisan serve --host=0.0.0.0 --port=8000
    