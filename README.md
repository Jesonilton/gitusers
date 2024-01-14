# Projeto Teste

Este é um projeto teste que utiliza Node.js e PHP.

**O projeto está na branch Master**

## Pré-requisitos

- Node.js v16.20.2
- PHP 7.4.33
- Composer

## Rodando o Projeto front com Node.js (Vue.js)

1. Navegue até a pasta `vueapp`:
   ```bash
   npm install
   
2. inicie o projeto:
   ```bash
   npm run dev

O projeto vue estará disponível em http://localhost:portaX.

Obs.: se os usuários não forem listados após o carregamento, tente buscar no campo de pesquisa. No meu ambiente algumas vezes tive este problema mas creio ser na minha máquina. Ao buscar no campo de pesquisa a tabela é renderizada.

## Rodando a api em PHP
1. Na pasta api, execute o comando
   ```bash
   composer install
   
2. Navegue até a pasta api/public:
   ```bash
   cd api/public

3. Iniciar servidor php:
   ```bash
   php -S localhost:8000

O projeto PHP estará disponível em http://localhost:8000.


No projeto também estão 3 vídeos de apresentação na pasta "videos".

Certifique-se de ter as versões corretas do Node.js e PHP instaladas.

Certifique-se de que a porta 8000 esteja disponível ao rodar o projeto PHP.
