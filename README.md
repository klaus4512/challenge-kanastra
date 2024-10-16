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

### Envio do arquivo para processamento

Para enviar o arquivo para processamento, é necessario enviar via post para a rota /api/billet, através do parâmetro file o arquivo.

Se tudo estiver ok com a requisição é esperado receber a seguinte mensagem em JSON

```json
{
    "message": "Billets successfully upload"
}
```
Após isso o sistema ira começar o processamento do arquivo através de uma fila


### Geração e envio dos boletos

Para gerar e enviar os boletos é necessario rodar o seguinte comando

```console
docker exec laravel_php php artisan app:send-billets
```


## Testes

Para rodar os testes é necessario rodar o seguinte comando

```console
docker exec laravel_php php artisan test
```


## Logs para exemplo de envios

Os logs para exemplo de envios ficam localizados dentro da pasta storage/logs

O arquivo billetPDF representa a geração do boleto em PDF

O arquivo mail repreenta o envio do email
