<p align="center"><img src="http://site.federalst.com.br/fsmail.jpg"></p>


# Teste prático - Federal Soluções Técnicas


## Instalação 
* certifique-se de ter o php7.1
* certifique-se de ter o composer2.2
* Execute composer install
* Renomeie o arquivo .env.example para .env
* Configure o acesso do seu banco de dados postgree no arquivo .env
* Execute php artisan key:generate
* Execute php artisan migrate
* Execute php artisan db:seed
 
## Validações
Os campos abaixo só podem ser aceitos no formato:
- Placa: Formato com três letras e quatro números (AAA1111).
- Ano: Formato apenas com números com, no máximo, 4 dígitos.

### Como participar?
- Fazer o fork desse repositório.
- Nos enviar o link do projeto do Github.

#### Dicas após baixar o projeto:
- Rode as migrations.
- Rode as seeders.
- Esteja atento aos usuários e veiculos padrões contidos no Seeder.
- A senha dos usuários é 'secret'.



