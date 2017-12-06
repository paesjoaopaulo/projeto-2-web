# INSTALAÇÃO

\* execute os comandos no TERMINAL ou PROMPT

```sh
git clone https://github.com/paesjoaopaulo/projeto-2-web
```

```sh
cd projeto-2-web
composer install
```

Crie um banco de dados (PostgreSQL, SQLite ou MySQL), renomeie o arquivo **.env-example** para **.env** e configure os dados de acesso ao banco de dados nesse arquivo, como no exemplo abaixo:
```
DB_CONNECTION=pgsql
DB_HOST=localhost
DB_PORT=5432
DB_DATABASE=aps3-web
DB_USERNAME=utfpr
DB_PASSWORD=utfpr
```

Crie as tabelas no banco de dados usando o comando abaixo no terminal:
```sh
php artisan migrate
```

## EXECUÇÃO

```sh
php artisan serve
```

Pronto! O sistema estará acessível no endereço informado na saída do comando acima. Provavelmente em http://127.0.0.1:8000

O sistema também se encontra na internet por meio do endereço http://web.crpsomeluz.com.br/
