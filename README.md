# TRIA-Home

Protótipo de um sistema de triagem hospitalar à distância, desenvolvido para a unidade curricular de Engenharia de Sistemas e Serviços (IPLeiria, 2026). O utente responde a um questionário de triagem em casa, recebe uma prioridade e entra na fila de espera do hospital; o médico vê a fila ordenada num painel web.

## Componentes

- `Desktop/minisite/bd_teste/`: esquema e base de dados **SQLite** de teste.
- `Desktop/minisite/tria-web/`: aplicação web em **Laravel 13** com login e painel médico.

## Base de dados

O esquema (`tria_home_schema.sql`) inclui:

- **Tabelas**: `hospitais`, `utilizadores` (perfis `utente`, `secretaria` e `medico`), `triagens`, `respostas_questionario`, `fila_espera`, `checkins`, `consultas` e `logs_auditoria`.
- **Triggers** que atualizam o estado da triagem no check-in e na consulta e libertam a vaga do hospital.
- **Vistas**: `v_painel_medico`, `v_lotacao_hospitais` e `v_triagem_completa`.

Criar a base de dados:

```bash
sqlite3 tria_home.db < tria_home_schema.sql
```

## Aplicação web

- Login por email e palavra-passe, com dados de sessão (nome e perfil).
- Painel médico com a fila de espera: posição, prioridade, utente e resumo clínico.

### Requisitos

PHP 8.3+, Composer, Node.js e npm.

### Executar

```bash
cd Desktop/minisite/tria-web
composer install
npm install
cp .env.example .env
php artisan key:generate
```

No `.env`, apontar `DB_DATABASE` para o caminho absoluto do ficheiro `tria_home.db`. Depois:

```bash
npm run build
php artisan serve
```

A aplicação fica em `http://localhost:8000`.

## Limitações do protótipo

- O login aceita a palavra-passe `password` para qualquer utilizador ativo, porque os hashes da base de teste são exemplos. Não usar em produção.
- O nome do médico e do hospital no cabeçalho do painel estão fixos no código.
