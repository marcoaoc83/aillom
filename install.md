## Instalação do Projeto

Este guia descreve como configurar e executar o projeto localmente. Certifique-se de que todos os pré-requisitos estejam atendidos antes de prosseguir.


### **Pré-requisitos**

Antes de iniciar, você precisará ter os seguintes softwares instalados no seu ambiente:

- PHP 8.3 (ou superior)
- Composer (https://getcomposer.org/)
- Node.js com NPM (https://nodejs.org/)
- Banco de Dados:
    - MySQL 8.0+ ou PostgreSQL 13+
- Redis para gerenciamento de filas (https://redis.io/)
- Git para clonar o repositório

---

### **Instalação**

Execute os seguintes passos para configurar o ambiente:

1. Clone o repositório do projeto:
   ```
   git clone https://github.com/marcoaoc83/aillom/ aillom
   ```

2. Acesse o diretório do projeto:
   ```
   cd aillom
   ```

3. Instale as dependências do PHP:
   ```
   composer install
   ```

4. Copie o arquivo `.env.example` e configure as variáveis de ambiente no arquivo `.env`:
   ```
   cp .env.example .env
   ```

5. Instale as dependências do Node.js:
   ```
   npm install
   ```

6. Compile os assets:
   ```
   npm run build
   ```

7. Gere a chave da aplicação:
   ```
   php artisan key:generate
   ```

8. Execute as migrações e seeders do banco de dados:
   ```
   php artisan migrate --seed
   ```

---

### **Limpeza e Otimização**

Antes de iniciar o servidor, execute os comandos de limpeza e otimização para garantir o correto funcionamento:

```
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan optimize:clear
php artisan event:clear
php artisan clear-compiled
php artisan cache:clear
php artisan filament:optimize
```

---

### **Execução**

1. Inicie o servidor da aplicação na porta 8085:
   ```
   nohup php artisan serve --port=8085 > serve.log 2>&1 &
   ```

2. Inicie o Horizon para gerenciamento de filas:
   ```
   nohup php artisan horizon > horizon.log 2>&1 &
   ```

---

### **Configuração do Banco de Dados**

Certifique-se de configurar corretamente o banco de dados no arquivo `.env`. Exemplos de configuração:

#### MySQL:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=usuario
DB_PASSWORD=senha
```

#### PostgreSQL:
```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=nome_do_banco
DB_USERNAME=usuario
DB_PASSWORD=senha
```

---

### **Dependências Redis**

No arquivo `.env`, configure o Redis para gerenciar as filas:

```
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

---

Agora o projeto estará rodando localmente. Para verificar se o servidor está ativo, acesse:

http://localhost:8085
