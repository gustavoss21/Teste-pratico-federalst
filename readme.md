## Instalação e configuraçoes inicias
* certifique-se de ter o php7.1
* certifique-se de ter o composer2.2
* Execute composer install
* Renomeie o arquivo .env.example para .env
* Configure o acesso do seu banco de dados postgree no arquivo .env
* Configure o acesso do seu banco de dados redis no arquivo .env
* Configure o acesso do servidor smtp ou mail no arquivo .env
* Execute php artisan key:generate
* Execute php artisan migrate
* Execute php artisan db:seed


## run dependêcias
* Execute php artisan queue:work
* Execute "redis-server"(no linux)/windows abra terminal linux e execute


## melhorias
* o user admin pode ver os veiculos excluidos pelo softdelete

## verificaçoes finais de desenvolvimento
* apagar importaçoes desnecessarias
* apagar codigo comentado
* no confing\mail tirar o "to" global
* descomentar method delete do AdminController


