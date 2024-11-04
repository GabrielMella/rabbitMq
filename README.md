# Projeto de Estudo: RabbitMQ com Laravel

Este projeto foi desenvolvido para aprender e implementar RabbitMQ com Laravel em uma arquitetura orientada a eventos (event-driven architecture). Sempre que um novo usuário é criado no sistema, um evento é disparado, acionando um job que envia o email do usuário para um consumidor específico via RabbitMQ.

## Visão Geral

O sistema funciona com uma integração entre Laravel e RabbitMQ:
- **Event-driven**: Um evento é disparado sempre que um usuário é criado.
- **Job**: O evento dispara um job que envia dados do email do usuário para uma fila do RabbitMQ.
- **RabbitMQ**: As mensagens são enviadas para uma `exchange` que as roteia para a fila configurada.
- **Consumidor**: O consumidor recebe o endereço de e-mail do novo usuário e envia um e-mail de boas vindas utilizando o mailtrap.

## Tecnologias Utilizadas

- **Laravel** - Framework PHP para backend.
- **RabbitMQ** - Sistema de mensageria para comunicação entre serviços.
- **PHP** - Linguagem de programação.
- **Docker** - Para gerenciamento de containers e fácil deploy do RabbitMQ.

## Estrutura do Projeto

- **Eventos**: Disparados na criação de um usuário.
- **Jobs**: Executados ao receber um evento, enviando mensagens para RabbitMQ.
- **Comando Customizado**: Um comando Laravel para configurar a `exchange`, `queue`, e o `bind` entre elas.
- **Consumers**: Serviços que escutam as filas e processam as mensagens.

## Configuração e Instalação

1. Clone o repositório:

    ```bash
    git clone git@github.com:GabrielMella/rabbitMq.git
    cd rabbitMq
    ```

2. Instale as dependências do Laravel:

    ```bash
    composer install
    ```

3. Configuração do `.env` no app Consumer-1

    - Configuração do laravel
    - Configuração do MailTrap
    
      ```env
      MAIL_MAILER=smtp
      MAIL_HOST=sandbox.smtp.mailtrap.io
      MAIL_PORT=2525
      MAIL_USERNAME=
      MAIL_PASSWORD=
      ```

4. Suba o RabbitMQ usando Docker:

    ```bash
    docker run -d --hostname rabbitmq --name rabbitmq -p 5672:5672 -p 15672:15672 rabbitmq:3-management
    ```

5. Dentro do app Producer, execute o comando para configurar a `exchange`, `queue`, e o `bind`:

    ```bash
    php artisan send-new-user
    ```

6. Dentro do app Consumer-1, execute o Laravel para rodar os consumidores:

    ```bash
    php artisan queue:work
    ```

## Funcionamento

1. **Criação do Usuário**: Quando um usuário é criado, um evento é disparado.
2. **Execução do Job**: O evento aciona um job, que envia o email do usuário para o RabbitMQ.
3. **Processamento pelo Consumidor**: O consumidor recebe o endereço de e-mail do novo usuário e envia um e-mail de boas vindas utilizando o mailtrap.

## Estrutura do Código

- **App/Events**: Definições de eventos que o sistema dispara.
- **App/Jobs**: Lógica dos jobs que processam as mensagens e enviam para RabbitMQ.
- **App/Console/Commands**: Comando customizado para configurar `exchange`, `queue` e `bind`.
- **Config/queue.php**: Configurações de fila e RabbitMQ.

## Contribuição

Este projeto é um estudo, mas sugestões e melhorias são bem-vindas! Sinta-se à vontade para abrir uma issue ou fazer um fork do repositório e enviar um pull request.

## Licença

Este projeto é de uso livre e sem restrições.
