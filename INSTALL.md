## Clonar o repositório

```bash
git clone https://github.com/daniloocavalcante/AuthBase
cd AuthBase
```
---

## Instalação (passo-a-passo)

1. **Instalar dependências PHP via Composer**

```bash
composer install
```
2. **Renomear o arquivo de exemplo `.env.example` para `.env`**
> **Importante:** o arquivo `.env` contém suas credenciais e não deve ser comitado para o repositório.

```bash
cp .env.example .env
```
3. **Gerar a chave da aplicação (Laravel)**

```bash
php artisan key:generate
```
4. **Instalar dependências JavaScript**
```bash
npm install 
npm run dev      # para desenvolvimento
npm run build    # para produção
```

5. **Criar o banco de dados**
```sql
CREATE DATABASE authbase CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
```

6. **Editar o `.env` com as credenciais do banco de dados**

Abra `.env` e ajuste as variáveis:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=authbase
DB_USERNAME=root
DB_PASSWORD=
```

7. **Executar migrations (criar tabelas)**
```bash
php artisan migrate --seed            # Criar as tabelas e popular com dados iniciais (primeira vez)
php artisan migrate:refresh --seed    # Apagar e recriar todas as tabelas, depois popular novamente (quando quiser reiniciar o banco) 
```

8. **Executar a aplicação**
- Usando o servidor embutido do Laravel (apenas para desenvolvimento):
```bash
php artisan serve     # por padrão roda em http://127.0.0.1:8000
```
- Em produção, configure um virtual host no Apache / Nginx apontando para a pasta `public/`.

---
