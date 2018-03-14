<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

# Projeto Prático de Laravel + JWT + Vue JS + Axios + Vuex + VueRouter + Boas Práticas

> Exemplo básico Laravel com Vue JS

## Baixar o projeto
Primeiro passo, clonar o projeto:
``` bash
# Clonar
git clone https://github.com/carlosfgti/laravel-com-vue-exemplo.git

# Acessar
cd laravel-com-vue-exemplo
```

## Configuração - Backend

``` bash
# Instalar dependências do projeto
composer install

# Configurar variáveis de ambiente
cp .env.example .env
php artisan key:generate

# Configuração do JWT
php artisan jwt:secret

# Criar migrations (tabelas e Seeders)
php artisan migrate --seed
```

## Login
O usuário de teste é:
```
email:    carlos@especializati.com.br
password: 123456
```

## Configuração - Frontend
``` bash
# Atualizar dependências
npm install

# Rodar em ambiente local localhost:8080
npm run dev

# Rodar em ambiente de produção
npm run build
```

## Deseja Aprender Laravel com Vue JS?
Recomendo que se matricule no meu treinamento de Laravel com Vue JS ([Saiba Mais](https://www.especializati.com.br/curso-laravel-vue-js)). 