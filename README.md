# PROJETO DOE+

📌 Visão Geral da Solução<br>
Este projeto tem como objetivo oferecer uma solução que facilite e incentive a realização de doações entre pessoas físicas e instituições assistenciais, bem como entre as próprias instituições.

A plataforma permite:

- Que uma pessoa indique os itens que deseja doar;

- A escolha da instituição receptora dos donativos;

- A realização de avaliações mútuas entre doador e instituição;

- A visualização, no perfil das instituições, de um histórico de doações que contribui para maior transparência e credibilidade diante dos doadores.

🚀 Como Executar este Projeto<br>
Este projeto foi desenvolvido com PHP e banco de dados PostgreSQL. Para rodar localmente com XAMPP:

✅ Pré-requisitos<br>
- XAMPP instalado (usado para servir o PHP)

- PostgreSQL instalado

- Navegador web (Google Chrome, Firefox etc.)

📁 Passo a Passo
1. Clone este repositório:

```bash
git clone https://github.com/paulornr89/projetoDoeMais.git
```

2. Copie a pasta do projeto para o diretório htdocs do XAMPP:

```makefile
C:\xampp\htdocs\seu-projeto
```

3. Crie o banco de dados no PostgreSQL:

- Abra o pgAdmin ou use o terminal psql

- Crie um banco com o nome nomedobanco

- Importe o arquivo database.sql (caso fornecido) com os comandos de criação de tabelas e inserts iniciais:

```bash
psql -U seu_usuario -d nomedobanco -f database.sql
```

4. Configure a conexão com o PostgreSQL no seu projeto:

Verifique se o arquivo de conexão (por exemplo connectDB.php) está com os dados corretos:

```php
private $servidor = 'localhost';
private $porta = 5432;
private $dbname = 'projetoDoar';
private $usuario = 'seu_usuario';
private $senha = 'sua_senha';
```
5. Acesse o sistema no navegador:

```
[localhost](http://localhost/seu-projeto/public/login.php)
```

💡 Observações
- O sistema segue o padrão MVC (Model-View-Controller)

- O banco de dados é PostgreSQL (port padrão: 5432)

- Recomendado utilizar o navegador Google Chrome

- Certifique-se de que a extensão pdo_pgsql está habilitada no php.ini:

```ini
extension=pdo_pgsql
extension=pgsql
```

