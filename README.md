# Teste SoftwareSul

**Observação: Os comandos instruídos devem ser executados a partir de um terminal.**


# Conteúdos

1. [Requisitos](#Requisitos)<br>
2. [Execução Padrão do projeto](#Execução-Padrão-do-projeto)<br>
   2.1 [Instalando Dependências e configurando variáveis de ambiente](##Instalando-Dependências-e-configurando-variáveis-de-ambiente)<br>
   2.2 [Iniciando o projeto](##Iniciando-o-projeto)<br>
3. [Estrutura do projeto](#Estrutura-do-projeto)<br>
4. [Testando a aplicação](#Testando-a-aplicação)<br>
   4.1 [Tela de Login](##Tela-de-Login)<br>
   4.2 [Dashboard](##Dashboard)<br>
   4.3 [Listagem de Livros](##Listagem-de-Livros)<br>
   4.4 [Cadastro de Livros](##Cadastro-de-Livros)<br>
   4.5 [Listagem de Reservas](##Listagem-de-Reservas)<br>
5. [Testes](#Testes)<br>
6. [Decisões Técnicas](#Decisões-Técnicas)<br>

## 1 Requisitos

- PHP 8
- Composer  2.7.7
- NodeJs  v20.18.1
- MariaDB  v10.11

# 2. Execução Padrão do projeto

## 2.1 Instalando Dependências e configurando variáveis de ambiente

Inicialmente, instalar as dependências do Laravel com o **composer**:

```console
composer i
```

O projeto utiliza o **Laravel Breeze** com **TailwindCSS** por padrão, então é preciso instalar as dependências do npm com o comando:

```console
npm i
```

Em seguida, é necessário configurar as variáveis de ambiente copiando o arquivo **ENV** de exemplo:

```console
cp .env.example .env
```

Configurando as variáveis de acesso ao banco de dados conforme a seguir:

- DB_CONNECTION=mariadb
- DB_HOST=127.0.0.1
- DB_PORT=3306
- DB_DATABASE=teste-software-sul
- DB_USERNAME=Usuario
- DB_PASSWORD=Senha

As variáveis aqui definidas foram utilizadas como exemplo, então ao configurar o ambiente local deve-se alterar de acordo com as configurações locais.

Por último, é necessário criar as *migrations* padrões do projeto executando:

```console
php artisan migrate:fresh --seed
```

## 2.2 Iniciando o projeto

Para iniciar o projeto localmente, basta executar os seguintes comandos em terminais diferentes:

```console
php artisan serve
```

```console
npm run dev
```

O app agora deve ser acessível pela **url**:
 - http://localhost:8000 

# 3. Estrutura do projeto
- **app/Models:** Contém os modelos Eloquent.
- **app/Http/Controllers:** Controladores que gerenciam as requisições.
- **resources/views:** Arquivos Blade para as views.
- **routes/web.php:** Rotas do sistema.
- **database/:** Migrations para geração das tabelas, definição das factories e seeders para geração de models fake.

# 4. Testando a aplicação

## 4.1 Tela de Login

A tela de login terá os campos de autenticação padrões, além de um botão de login e uma **url** para registrar um usuário novo.

Por padrão, as migrations irão criar um usuário ADMIN e um usuário com permissões padrão com as seguintes credenciais para teste:

Admin:

- Email: test@example.com
- Senha: password

Padrão:

- Email: user@example.com
- Senha: password

## 4.2 Dashboard

A tela de dashboard, possui dois botões, um dá acesso à listagem de livros e outro acesso às reservas do usuário autenticado.

## 4.3 Listagem de Livros

A tela de listagem de livros, primeiramente lista os livros cadastrados no banco de dados. Adicionalmente tem três funcionalidades extras:

- Para ADMINs, possui um botão de cadastrar um novo Livro, e cada livro na listagem aparece uma ação para editar e excluir o livro específico

- Para todos os usuários, exibe uma ação para reservar o livro em questão

- Para todos os usuários, tem um campo de barra de pesquisa que filtra pelos campos de Título, autor e ISBN, é necessário interagir com o botão de pesquisa para aplicar o filtro

## 4.4 Cadastro de Livros

A tela é apenas disponível para ADMINs, permite o cadastro ou alteração de um livro

## 4.5 Listagem de Reservas

A tela de listagem de reservar, primeiramente lista as reservar que o usuário autenticado realizou. Adicionalmente tem duas funcionalidades extras:

- Exibe uma ação para cancelar a reserva especificada

- Tem um campo de barra de pesquisa que filtra as reservas de acordo com o livro reservado, os campos de filtro sãos os mesmos da listagem de livros

# 5. Testes

Os testes unitários podem ser encontrados no diretório à seguir:

- **app/tests:** Contém os arquivos de testes unitários

**OBS: É necessário configurar o arquivo *ENV* de testes, como a configuração do banco é local, optei por manter as mesmas configurações de banco de dados que já havia configurado.**

Para executar os testes, basta executar o comando à seguir:

```console
php artisan test
```

# 6. Decisões Técnicas

A princípio as deciões de versionamento do php, mariadb, node e composer, se baseiam mais na configuração da minha máquina local, que já possui configurado os requisitos.

Para autenticação do app, para facilitar e diminuir o tempo de desenvolvimento, optei por configurar o **Laravel Breeze**, que já inclui seus próprios testes também.