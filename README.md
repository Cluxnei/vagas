# vagas
Desenvolvimento de um site para  cadastro de vagas de emprego para FATEC SOROCABA
## Instalação
- `git clone https://github.com/Cluxnei/vagas.git`
- `cd vagas`
- `composer update`
- `npm install`
- Crie um banco da dados com o nome **vagas**
- Crie o arquivo **.env** na raiz do projeto e cole o conteúdo do arquivo **.env.example**
- Configure o banco de dados no **.env**
- `composer dump-autoload`
- `php artisan migrate --seed`
- `php artisan serve`
- Acesse http://localhost:8000
