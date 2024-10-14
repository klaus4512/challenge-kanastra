# challenge-kanastra

Implementação do desafio tecnico proposto pela Kanastra.

## Como rodar o projeto

Rodar o seguinte comando para iniciar os containers Docker
```console
docker compose build
docker compose up -d
```

E o seguinte comando para rodar as migrations
```console
docker exec -t laravel_php php artisan migrate
```

## Acessar o projeto

Acessar o projeto localmente pelo link: http://localhost:80

