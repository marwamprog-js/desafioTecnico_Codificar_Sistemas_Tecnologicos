# LibX

## Sobre o projeto
LibX é uma aplicação full stack web contruída para um processo seletivo da Codificar Sistemas Tecnologicos para uma vaga de Desenvolvedor.

A aplicação consiste em compartilhar pequenas mensagens, atualizações pessoais, projetos, ideias e curiosidades sobre liberalismo econômico!

## Layout Web
![Tela Inicial](https://github.com/marwamprog-js/desafioTecnico_Codificar_Sistemas_Tecnologicos/blob/main/front-end/src/assets/appWeb.png)

# Tecnologia utilizadas

## *Back end
- PHP
- Laravel 8
- JWT

## *Front end
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

##back end
```bash
# clonar repositorio
git clone https://github.com/marwamprog-js/desafioTecnico_Codificar_Sistemas_Tecnologicos.git

# Através do docker ps, pegar o id do container e executar o comando:
docker exec <id/nomecontainer> bash -c "composer update ; php artisan migrate ; php artisan seeder"

# Testando o projeto
Abra o link http://localhost:8080
tem que aparecer a página do Laravel
```


  
