# 🛒 Marketplace Core - Backend Architecture

Sistema de Marketplace escalável desenvolvido com foco em alta performance e isolamento de ambiente. O projeto utiliza as versões mais recentes do ecossistema PHP para garantir segurança e suporte a novas funcionalidades.

## 🛠️ Stack Técnica & Infraestrutura
* **Linguagem:** PHP 8.5+
* **Framework:** Laravel 13
* **Ambiente de Dev:** Docker (Laravel Sail)
* **IDE Workflow:** VS Code Dev Containers (Isolamento total de dependências)
* **Database:** MySQL

## 🚀 Arquitetura de Ambiente
Para eliminar o problema de "funciona na minha máquina", o projeto foi configurado com **Dev Containers**. Isso permite que todo o ciclo de desenvolvimento ocorra dentro de um container Docker padronizado, garantindo que o PHP, extensões e banco de dados sejam idênticos em qualquer estação de trabalho.

## 📋 Implementações Atuais
- [x] Bootstrapping do ambiente via Laravel Sail.
- [x] Configuração de Workspaces em Dev Containers para PHP 8.5.
- [x] Modelagem e Migration da estrutura de Lojas (`stores`).
- [x] Modelagem e Migration da estrutura de Produtos (`products`).