<<<<<<< HEAD
# alibin-test
technical test
=======
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Alibin test by Pedro Vargas


Breve descrição do seu projeto.

## Instruções para Iniciar com Docker Compose

Siga esses passos para configurar e executar seu projeto localmente utilizando o Docker Compose:

1. Clone o repositório:
    
``` bash
$  git clone <URL do repositório>
```
 
  
2. Navegue até o diretório do projeto:
``` bash
$  cd nome-do-projeto
```
3. Copie o arquivo de configuração .env.example e crie um arquivo .env:

``` bash
$  cp .env.example .env
```


5. Execute o Docker Compose para construir e iniciar os contêineres:

``` bash
$  docker-compose up --build
``` 


## Documentação da API
## Rotas da API

 ### URL_BASE: http://localhost:8000
### 1. Obter Links de Pagamento

- **Método:** GET
- **URL:** `/api/link`
- **Parâmetros de consulta:**
  - `nuLink` (opcional): Número do link de pagamento.
  - `page` (opcional): Página de resultados.
  - `perPage` (opcional): Resultados por página.
- **Descrição:** Essa rota permite obter uma lista de links de pagamento de acordo com os parâmetros fornecidos.

### 2. Criar Novo Link de Pagamento

- **Método:** POST
- **URL:** `/api/link`
- **Corpo da solicitação:** Consulte o código fornecido para ver os parâmetros necessários.
- **Descrição:** Permite criar um novo link de pagamento com os dados fornecidos.

### 3. Excluir Link de Pagamento

- **Método:** DELETE
- **URL:** `/api/link/{linkId}`
- **Parâmetros de rota:**
  - `linkId`: ID do link de pagamento a ser excluído.
- **Descrição:** Essa rota permite excluir um link de pagamento específico usando o seu ID.

## Lógica de Negócio e Serviço

<<<<<<< HEAD
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
>>>>>>> c75c94a (Set up a fresh Laravel app)
=======
O arquivo `LinkPagamentoService.php` contém a lógica de negócio relacionada à gestão de links de pagamento. Ele fornece funções para obter links, criar novos links e excluir links existentes.
>>>>>>> 28a7f55 (INIT REPO)
