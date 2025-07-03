# Dog API - Sistema de Gerenciamento de Cães

## 1. Visão Geral
Este é um sistema de gerenciamento de cães que consiste em uma API RESTful desenvolvida em Laravel e um frontend em React. O sistema utiliza autenticação JWT para proteger as rotas.

## 2. Backend (Laravel)

### 2.1 Requisitos
- PHP 8.1 ou superior
- Composer
- MySQL
- Laravel 10.x

### 2.2 Instalação
Para instalar o projeto, siga os seguintes passos:

1. Clone o repositório
2. Execute `composer install` para instalar as dependências
3. Copie o arquivo `.env.example` para `.env`
4. Gere a chave da aplicação com `php artisan key:generate`
5. Gere a chave JWT com `php artisan jwt:secret`
6. Execute as migrações com `php artisan migrate`
7. Inicie o servidor com `php artisan serve`

### 2.3 Estrutura do Banco de Dados

O sistema possui duas tabelas principais:

1. **users**: Armazena informações dos usuários
   - id (chave primária)
   - name (nome do usuário)
   - email (email único)
   - password (senha criptografada)
   - timestamps (created_at, updated_at)

2. **dog**: Armazena informações dos cães
   - id (chave primária)
   - nome (nome do cão)
   - raca (raça do cão)
   - idade (idade do cão)
   - timestamps (created_at, updated_at)

### 2.4 Rotas da API

O sistema possui rotas públicas e protegidas:

**Rotas Públicas:**
- POST /api/login: Autenticação de usuários
  - Requer email e senha
  - Retorna token JWT e dados do usuário

**Rotas Protegidas (requerem token JWT):**
- GET /api/me: Retorna dados do usuário autenticado
- POST /api/logout: Realiza logout do usuário
- GET /api/dogs: Lista todos os cães
- GET /api/dogs/{id}: Retorna um cão específico
- POST /api/dogs: Cria um novo cão
- PUT /api/dogs/{id}: Atualiza um cão existente
- DELETE /api/dogs/{id}: Remove um cão

## 3. Frontend (React)

### 3.1 Requisitos
- Node.js 14.x ou superior
- npm ou yarn

### 3.2 Instalação
1. Instale as dependências com `npm install`
2. Inicie o servidor de desenvolvimento com `npm start`

### 3.3 Estrutura de Arquivos
O frontend está organizado da seguinte forma:

- **api.js**: Configuração do Axios e interceptors
- **services/Auth.js**: Serviços de autenticação
- **components/DogList.js**: Componente de listagem de cães
- **components/Login.js**: Componente de autenticação
- **components/PrivateRoute.js**: Componente de rota protegida

### 3.4 Componentes Principais

**Login.js**
- Gerencia o formulário de login
- Valida credenciais
- Armazena token JWT
- Redireciona após autenticação

**DogList.js**
- Exibe lista de cães
- Permite exclusão
- Gerencia estados de loading e erro
- Fornece feedback visual

**PrivateRoute.js**
- Protege rotas que requerem autenticação
- Verifica token JWT
- Redireciona para login quando necessário

## 4. Autenticação

### 4.1 Fluxo de Autenticação
1. Usuário insere credenciais
2. Backend valida e retorna token JWT
3. Frontend armazena token
4. Token é enviado em requisições subsequentes
5. Backend valida token em cada requisição

### 4.2 Segurança
- Tokens JWT com expiração
- Proteção contra CSRF
- Validação de dados
- Sanitização de inputs

## 5. Tratamento de Erros

### 5.1 Backend
- Validação de dados
- Respostas de erro padronizadas
- Logs para debugging

### 5.2 Frontend
- Tratamento de erros de rede
- Feedback visual
- Redirecionamento automático

## 6. CORS
Configurado para permitir requisições do frontend:
- Origem permitida: http://localhost:3000
- Métodos permitidos: Todos
- Headers permitidos: Todos
- Suporte a credenciais: Sim

## 7. Documentação da API
A documentação está disponível via Swagger UI em:
http://localhost:8000/api/documentation

## 8. Desenvolvimento

### 8.1 Comandos Úteis
Backend:
- `php artisan migrate`: Executa migrações
- `php artisan serve`: Inicia servidor
- `php artisan jwt:secret`: Gera nova chave JWT

Frontend:
- `npm start`: Inicia servidor de desenvolvimento
- `npm run build`: Cria build de produção

### 8.2 Variáveis de Ambiente
Backend (.env):
- Configurações do banco de dados
- Chave JWT
- Outras configurações do Laravel

Frontend (.env):
- URL da API

## 9. Contribuição
1. Faça um fork do projeto
2. Crie uma branch para sua feature
3. Faça commit das mudanças
4. Push para a branch
5. Abra um Pull Request

## 10. Licença
Este projeto está sob a licença MIT.
