# Teste SoftwareSul

**Observação: Os comandos instruídos devem ser executados a partir de um terminal.**


# Conteúdos

1. [Requisitos](#Requisitos)<br>
2. [Execução Padrão do projeto](#Execução-Padrão-do-projeto)<br>
   2.1 [Instalando Dependências e configurando variáveis de ambiente](##Instalando-Dependências-e-configurando-variáveis-de-ambiente)<br>
   2.2 [Iniciando o projeto](##Iniciando-o-projeto)<br>
3. [Testando a aplicação](#Testando a aplicação)<br>
   3.1 [Tela de Login](##Tela de Login)<br>
   3.2 [Dashboard](##Dashboard)<br>
   3.3 [Listagem de Livros](##Listagem de Livros)<br>
   3.4 [Cadastro de Livros](##Cadastro de Livros)<br>
   3.5 [Listagem de Reservas](##Listagem de Reservas)<br>

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


# 3. Testando a aplicação

## 3.1 Tela de Login

A tela de login terá os campos de autenticação padrões, além de um botão de login e uma **url** para registrar um usuário novo.

Por padrão, as migrations irão criar um usuário ADMIN com as seguintes credenciais para teste:

- Email: test@example.com
- Senha: password

## 3.2 Dashboard

A tela de dashboard, possui dois botões, um dá acesso à listagem de livros e outro acesso às reservas do usuário autenticado.

## 3.3 Listagem de Livros

A tela de listagem de livros, primeiramente lista os livros cadastrados no banco de dados. Adicionalmente tem três funcionalidades extras:

- Para ADMINs, possui um botão de cadastrar um novo Livro, e cada livro na listagem aparece uma ação para editar o cadastro do livro específico

- Para todos os usuários, exibe uma ação para reservar o livro em questão

- Para todos os usuários, tem um campo de barra de pesquisa que filtra pelos campos de Título, autor e ISBN, é necessário interagir com o botão de pesquisa para aplicar o filtro

## 3.4 Cadastro de Livros

A tela é apenas disponível para ADMINs, permite o cadastro ou alteração de um livro

## 3.5 Listagem de Reservas

A tela de listagem de reservar, primeiramente lista as reservar que o usuário autenticado realizou. Adicionalmente tem duas funcionalidades extras:

- Exibe uma ação para cancelar a reserva especificada

- Tem um campo de barra de pesquisa que filtra as reservas de acordo com o livro reservado, os campos de filtro sãos os mesmos da listagem de livros