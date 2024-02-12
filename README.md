# LibX

## Sobre o projeto
LibX é uma aplicação full stack web contruída para um processo seletivo da Codificar Sistemas Tecnologicos para uma vaga de Desenvolvedor.

A aplicação consiste em compartilhar pequenas mensagens, atualizações pessoais, projetos, ideias e curiosidades sobre liberalismo econômico!

## Layout Web
![Tela Inicial](https://github.com/marwamprog-js/desafioTecnico_Codificar_Sistemas_Tecnologicos/blob/main/front-end/src/assets/appWeb.png)

# Tecnologias utilizadas

## * Back end
- PHP
- Laravel 8
- JWT

## * Front end
- Javascript
- SCSS (SASS)
- Bootstrap
- Vue js 3 (CLI)
- Axios
- Vuex
- Vue-Router
- Vue-sweetalert2

# Como executar o projeto
Pré requisitos:
- docker
- clonar repositorio
git clone https://github.com/marwamprog-js/desafioTecnico_Codificar_Sistemas_Tecnologicos.git

## Back end
```bash
# Dentro da pasta do projeto tem um arquivo do docker-compose.yml, na mesma pasta abra o terminal e digite:
docker-compose up -d

# Através do docker ps, pegar o id do container que foi criado na porta 8000 e executar o comando:
docker exec <id/nomecontainer> bash -c "composer update ; php artisan migrate ; php artisan db:seed"

# Testando o projeto
Abra o link http://localhost:8080
tem que aparecer a página do Laravel
```

## Front end
```bash
# Abrir o terminal na pasta front-end e executar o comando:
npm install

# Testando o projeto: Ainda na pasta front-end, digitar o seguinte comento:
yarn serve ou npm run serve
```

# Autor
Marwam Malta Araujo

Linkedin: https://www.linkedin.com/in/marwam-malta-80916030/


  
