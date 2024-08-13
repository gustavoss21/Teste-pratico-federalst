## Instalação e configuraçoes inicias
* certifique-se de ter o php7.1
* certifique-se de ter o composer2.2
* Execute composer install
* Renomeie o arquivo .env.example para .env
* Configure o acesso do seu banco de dados postgree no arquivo .env
* Execute php artisan key:generate
* Execute php artisan migrate
* Execute php artisan db:seed

## run dependeicas
* php artisan queue:work
* redis-server(no linux)/windows abra terminal linux e execute


## melhorias
* o user admin pode ver os excluidos

## verificaçoes finais de desenvolvimento
* apagar importaçoes desnecessarias
* apagar codigo comentado
* o no confing\mail tirar o "to" global
* adicionar "Mail::to()" no SendMailUser


