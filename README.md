# Documentação da API

Este repositório contém as rotas e controladores da API para a aplicação. A API é construída usando o Laravel e fornece endpoints para várias funcionalidades da aplicação.

## Usuário na Web

Endpoints relacionados à gestão de usuários na plataforma web.

- `POST /v1/web/login`: Login do usuário.
- `POST /v1/web/register`: Registro do usuário.
- `GET /v1/web/me`: Obter informações do usuário autenticado.
- ...

## ATMs

Endpoints relacionados à gestão de ATMs.

- `GET /v1/atms`: Obter todos os ATMs.
- `GET /v1/atms/{id}`: Obter ATM por ID.
- `POST /v1/atms`: Criar um novo ATM.
- ...

## Carteira

Endpoints relacionados à gestão de carteiras.

- `GET /v1/wallets/{id}`: Obter informações da carteira por ID.
- `PATCH /v1/wallets/{id}`: Atualizar informações da carteira.

## Subscrição

Endpoints relacionados aos planos de assinatura.

- `GET /v1/subscription_plans`: Obter todos os planos de assinatura.
- `GET /v1/subscription_plans/{id}`: Obter plano de assinatura por ID.
- ...

## Admin

Endpoints relacionados à funcionalidade de administrador.

- `GET /v1/admin/users`: Obter todos os usuários (acesso de administrador necessário).
- `DELETE /v1/admin/users/{id}`: Excluir usuário por ID (acesso de administrador necessário).

## Rua

Endpoints relacionados a informações de rua.

- `GET /v1/street`: Obter informações da rua.
- `GET /v1/streetById/{id}`: Obter informações da rua por ID.
- ...

## Município

Endpoints relacionados a informações de município.

- `GET /v1/municipe/`: Obter informações do município.
- `GET /v1/municipeById/{id}`: Obter informações do município por ID.

## Província

Endpoints relacionados a informações de província.

- `GET /v1/municipeByProvince/{id_province}`: Obter município por ID de província.
- `GET /v1/province`: Obter informações de província.
- ...

## Históricos

Endpoints relacionados a dados históricos.

- `POST /v1/newHistory`: Adicionar novos dados históricos.
- `GET /v1/getHistoriesAll`: Obter todos os dados históricos.
- ...

## Usuário

Endpoints relacionados à gestão de usuários.

- `POST /v1/logout`: Logout do usuário (autenticação necessária).
- `POST /v1/user/send-otp`: Enviar OTP para verificação.
- `POST /v1/user/verify-otp`: Verificar OTP.
- ...

## Login por Redes Sociais

Endpoints para login baseado em redes sociais.

- Login pelo Facebook:
  - `GET /v1/login/facebook`: Redirecionar para o provedor de login do Facebook.
  - `GET /v1/login/facebook/callback`: Lidar com o retorno do login do Facebook.

- Login pelo Google:
  - `GET /v1/login/google`: Redirecionar para o provedor de login do Google.
  - `GET /v1/login/google/callback`: Lidar com o retorno do login do Google.
  - `GET /v1/social/login`: Login social.

## Notificações

Endpoints relacionados a notificações push e mensagens.

- `POST /v1/notifications/send`: Enviar notificação push.
- `POST /v1/message/send`: Enviar uma mensagem.
- `POST /v1/notifications/send`: Enviar notificação push (endpoint duplicado).

# Documentação de Endpoints para Administradores

Este documento fornece uma visão geral dos endpoints disponíveis para administradores na aplicação. Esses endpoints são destinados a fins administrativos e permitem a gestão de vários recursos. Abaixo está um resumo de cada endpoint e suas funcionalidades.

### Painel

- **Endpoint**: `/admin`
- **Método**: GET
- **Descrição**: Fornece uma visão geral do status atual e estatísticas da aplicação.

### Carteiras

- **Endpoint**: `/admin/wallets`
- **Métodos**: GET, POST, PUT, DELETE
- **Descrição**: Gerenciar carteiras de usuários, incluindo visualização, criação, atualização e exclusão de informações de carteira.

### Assinaturas de Usuários

- **Endpoint**: `/admin/user-subscriptions`
- **Métodos**: GET, POST, PUT, DELETE
- **Descrição**: Gerenciar assinaturas de usuários, permitindo ações como visualização, criação, atualização e exclusão de detalhes de assinatura.

### Planos de Assinatura

- **Endpoint**: `/admin/subscription-plans`
- **Métodos**: GET, POST, PUT, DELETE
- **Descrição**: Administrar planos de assinatura, incluindo visualização, criação, atualização e exclusão de dados de plano de assinatura.

### Usuários

- **Endpoint**: `/admin/users`
- **Métodos**: GET, POST, PUT, DELETE
- **Descrição**: Gerenciar tarefas de gerenciamento de usuários, como visualização, criação, atualização e exclusão de contas de usuário.

### ATMs

- **Endpoint**: `/admin/atms`
- **Métodos**: GET, POST, PUT, DELETE
- **Descrição**: Gerenciar ATMs no sistema, incluindo ações como visualização, criação, atualização e exclusão de informações de ATM.

### Categorias de ATM

- **Endpoint**: `/admin/atm-categories`
- **Métodos**: GET, POST, PUT, DELETE
- **Descrição**: Administrar categorias de ATM, permitindo tarefas como visualização, criação, atualização e exclusão de dados de categoria de ATM.

### Agentes

- **Endpoint**: `/admin/agents`
- **Métodos**: GET, POST, PUT, DELETE
- **Descrição**: Gerenciar agentes, incluindo ações como visualização, criação, atualização e exclusão de detalhes de agente.

### Detalhes de Rua

- **Endpoint**: `/admin/street`
- **Métodos**: GET, POST, PUT, DELETE
- **Descrição**: Gerenciar detalhes de rua, permitindo tarefas como visualização, criação, atualização e exclusão de informações de rua.

### Detalhes de Província

- **Endpoint**: `/admin/province`
- **Métodos**: GET, POST, PUT, DELETE
- **Descrição**: Administrar detalhes de província, incluindo ações como visualização, criação, atualização e exclusão de dados de província.

### Municípios

- **Endpoint**: `/admin/municipe`
- **Métodos**: GET, POST, PUT, DELETE
- **Descrição**: Gerenciar municípios, incluindo tarefas como visualização, criação, atualização e exclusão de informações de município.

### Atribuir ATMs a Agentes

- **Endpoint**: `/admin/atribuir-atm-agente`
- **Métodos**: GET, POST, PUT, DELETE
- **Descrição**: Gerenciar a atribuição de ATMs a agentes, permitindo tarefas como visualização, criação, atualização e exclusão dessas atribuições.
