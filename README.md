# 🧁 Marketplace de Confeitarias

Projeto desenvolvido como desafio técnico para uma vaga de estágio.  
Este marketplace permite o cadastro e gerenciamento de confeitarias e seus produtos, com visualização geográfica em mapa.

---

## 🚀 Tecnologias Utilizadas

- **Laravel 10** – Back-End PHP
- **Vue.js 3 + Inertia.js** – Front-End SPA
- **PostgreSQL** – Banco de dados relacional
- **Leaflet.js** – Mapa interativo
- **Docker + Docker Compose** – Ambiente conteinerizado

---

## 🔧 Funcionalidades

- ✅ Cadastro, edição e exclusão de confeitarias
- ✅ Cadastro de produtos vinculados a uma confeitaria
- ✅ Upload e gerenciamento de múltiplas imagens para produtos
- ✅ Visualização de confeitarias em mapa (Leaflet.js)
- ✅ Integração completa com Docker (PHP, Node, PostgreSQL)

---

## 🐳 Como Rodar o Projeto via Docker

### 1. Pré-requisitos

- Ter o [Docker](https://www.docker.com/) e o Docker Compose instalados.

### 2. Passos para Rodar

```bash
# Clone ou extraia o projeto
git clone https://github.com/Thayroni-Lima/confeitaria
cd seu-repo

# Suba o ambiente
docker compose up --build
```

> A primeira execução pode demorar alguns minutos.

### 3. Acesse a Aplicação

- 🌐 http://localhost:8000 → Acesso principal ao sistema (Laravel + Vue)  
- (Opcional) http://localhost:5173 → Servidor Vite (não é necessário acessar diretamente)

---

## ⚙️ Configuração do Banco de Dados

A aplicação utiliza PostgreSQL com os seguintes dados (pré-configurados no Docker):

```ini
DB_CONNECTION=pgsql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=secret
```

---

## 🧪 Testes

(Opcional: Se você implementou testes, adicione as instruções aqui.)

---

## 📂 Estrutura do Projeto

- `app/` – Lógica principal do Laravel  
- `resources/js/Pages/` – Páginas do front-end (Vue via Inertia)  
- `routes/web.php` – Definição das rotas do sistema  
- `docker-compose.yml` – Configuração dos containers  
- `entrypoint.sh` – Script de inicialização automática  
- `.env.example` – Variáveis de ambiente base

---

## 🙋 Sobre

Este projeto foi desenvolvido por **Thayroni Lima**  
Para fins de estudo, portfólio e processos seletivos.  
📧 Entre em contato: [thayronivflima@gmail.com](thayronivflima@gmail.com)
