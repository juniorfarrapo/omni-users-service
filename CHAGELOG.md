# Omni-Users-Service API Changelog

## Releases
## [1.0.0] - 2021-04-24
## Fixed
* 

## Added
* Backend: CRUD para Tickets
* Backend: Métodos para Users de login, cadastro, atualização, alteração de senha, logout e perfil
* Frontend: Interação com os endpoints de Users

## To Do
* Adicionar validação de formatação das informações de CEP, telefone e CPF, no frontend e no backend
* Implementar testes unitários no backend para validar a criação de usuários e tokens
* Implementar testes de integração no backend para validar as rotas da API e a segurança via JWT
* Adicionar no endpoint de criação de usuário um campo para captcha e validar
* Criar documentação da api usando OpenAPI (Swagger)
* Adicionar no frontend a criação de Tickets (Solicitações de atendimento)
* Testar a utilização de Redis para cache e o uso de LoadBalance para mais de uma instância rodando a mesma aplicação