=== Frameworks e Versões ===
Laravel 10.10
Tenancy for Laravel 3.9
Vue 3.4
InertiaJs/vue 1.0
InertiaJs/laravel 0.6.8

=== Instalação ===
Execute o comando a seguir para instalar o projeto:

composer install

Agora, para executar as Migrations:

php artisan migrate

Finalmente, execute os Seeders:

php artisan db:seed

Serão criados:

- Banco de Dados central: gym

- Banco de Dados para 2 tenants: academia1 e academia2

- Dados de acesso para administrador do sistema:
	Email: admin@admin.com.br
	Senha: 123456

- Dados de acesso padrão para usuário de cada tenant:
	Email: admin@[dominio].com (ex: admin@academia1.com)
	Senha: 123456

- Dados aleatórios de alunos para cada tenant.

Rota para login área admin: /admin/login
