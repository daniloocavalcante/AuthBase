# AuthBase

Projeto base para **controle de acesso e gerenciamento de usuários** usando Laravel. Este repositório contém a estrutura mínima para iniciar um sistema com autenticação, migrations e configuração básica.

---
## Requisitos

- PHP 8.0+ (verifique a versão compatível com sua versão do Laravel)
- Composer
- MySQL / MariaDB (ou outro banco suportado pelo Laravel)
- Node.js + npm (se for compilar assets/front)
- Git
---

## Clonar o repositório

```bash
# clone o repositório (cole a URL do seu repo)
git clone <URL_DO_SEU_REPOSITORIO>
cd nome-do-repositorio
```

---

## Instalação (passo-a-passo)

1. **Instalar dependências PHP via Composer**

```bash
composer install
```

2. **Renomear o arquivo de exemplo `.env.example` para `.env`**

- No Linux / macOS:

```bash
cp .env.example .env
```

- No Windows (PowerShell):

```powershell
Copy-Item .env.example .env
```

> **Importante:** o arquivo `.env` contém suas credenciais e não deve ser comitado para o repositório.

3. **Gerar a chave da aplicação (Laravel)**

```bash
php artisan key:generate
```

Esse comando preenche `APP_KEY` no `.env` — a aplicação precisa dessa chave para criptografia e sessões.

4. **Criar o banco de dados**

Crie um banco de dados no seu SGBD (por exemplo MySQL). Exemplo usando MySQL:

```sql
CREATE DATABASE authbase CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
```

5. **Editar o `.env` com as credenciais do banco de dados**

Abra `.env` e ajuste as variáveis:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=usuario
DB_PASSWORD=senha
```

6. **Executar migrations (criar tabelas)**

```bash
php artisan migrate --seed
```

Para atualizar:
```bash
php artisan migrate:refresh --seed
```

7. **Instalar dependências JavaScript (opcional, se houver assets)**

```bash
npm install 
npm run dev      # para desenvolvimento
npm run build    # para produção
```

8. **Ajustar permissões (Linux)**

```bash
sudo chown -R $USER:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```
Isso evita problemas de escrita em uploads e cache.

10. **Executar a aplicação**
- Usando o servidor embutido do Laravel (apenas para desenvolvimento):

```bash
php artisan serve     # por padrão roda em http://127.0.0.1:8000
```
- Em produção, configure um virtual host no Apache / Nginx apontando para a pasta `public/`.

---

## Boas práticas e observações

- **Não** comite o arquivo `.env` nem chaves/senhas.
- Se houver um arquivo `.env.example`, mantenha-o atualizado com as variáveis necessárias (sem valores sensíveis).
- Se o repositório remoto já tiver um `README.md`, este arquivo pode complementar ou substituir o existente.
- Caso o repositório remoto já contenha commits/README/README inicial criado no GitHub, antes de enviar suas alterações localmente rode:

```bash
git pull origin main --rebase
```

para evitar conflitos.

---

## Comandos Git úteis (para publicar mudanças)

```bash
git status                                   # ver status

git add .                                    # adicionar alterações

git commit -m "Descrição das alterações"     # commit com mensagem

git push origin main                         # enviar para o branch principal (main)
```

Se ainda não configurou o remoto:

```bash
git remote add origin <URL_DO_SEU_REPOSITORIO>
git push -u origin main
```
---

## Para desenvolver funcionalidades de acesso/usuários

- Verifique se o projeto já inclui migrations para `users`, `roles`, `permissions` e seeders.
- Caso queira um scaffolding de autenticação rápido, use (dependendo da versão do Laravel):

```bash
# Laravel Breeze (simples, minimal)
composer require laravel/breeze --dev
php artisan breeze:install
npm install && npm run dev
php artisan migrate
```

ou usar Laravel Jetstream se precisar de features mais completas (teams, sessions, etc.).

---


