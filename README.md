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



## AJAXREQUEST.js
É uma interface para requisições XMLHTTPRequest que foi criada para o projeto. Ela espera alguns parâmetros, que são respectivamente:

```js
* urlParam: 'url onde a coleção está localizada'
* methodParam: 'verbo HTTP que representa a operação sobre a coleção'
* dataParam: 'parâmetros que serão enviados na requisição'
* onSuccessCallback: ''
* loaderSelector: 'seletor css do loader que será exibido enquanto a requisição acontece'
* dataTypeParam: 'tipo de retorno que a requisição espera'
* contentTypeParam: 'tipo de dado que será enviado na requisição'

//Exemplo de uso usando GET

AjaxRequest(
  '/pessoas/1',
  'get',
  null,
  function(data) { return data.nome; },
  '#pessoaLoader',
  'json',
  'application/x-www-form-urlencoded'
)

//Exemplo de uso usando POST
AjaxRequest(
  '/pessoas',
  'post',
  {nome: 'Jose', sobrenome: 'da Silva', cidade: 'Cornélio Procópio/PR'},
  function(data) { alert("Pessoa " + data.nome + " cadastrado com sucesso!"); },
  '#pessoaLoader'
)


```
