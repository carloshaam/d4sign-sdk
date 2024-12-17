# D4Sign SDK PHP (Em desenvolvimento)

[![Latest Stable Version](https://poser.pugx.org/vendor/d4sign-sdk/version)](https://packagist.org/packages/vendor/d4sign-sdk)
[![License](https://poser.pugx.org/vendor/d4sign-sdk/license)](https://packagist.org/packages/vendor/d4sign-sdk)

## Visão Geral
Este SDK fornece uma integração completa com a API da D4Sign, facilitando o uso das funcionalidades da plataforma em aplicações PHP. Com este pacote, você pode gerenciar Cofres, Documentos, Signatários, Usuários, Tags, Certificados e Observadores de maneira intuitiva e eficiente.

> [!WARNING]
> Projeto em desenvolvimento, alterações estão sendo feitas e mudanças rigorosas podem acontecer a qualquer momento.

## Índice
- [Instalação](#instalação)
- [Configuração](#configuração)
- [Uso](#uso)
    - [Cofres](#cofres) - Gerencie cofres, incluindo criação e visualização de cofres.
    - [Documentos](#documentos) - Faça o upload de documentos, adicione arquivos e gerencie o status de documentos.
    - [Signatários](#signatários) - Adicione, remova e gerencie signatários de documentos.
    - [Usuários](#usuários) - Gerencie usuários na sua conta D4Sign.
    - [Tags](#tags) - Utilize e gerencie tags para personalizar seus documentos.
    - [Certificado](#certificado) - Acesse e gerencie certificados de assinatura.
    - [Observadores](#observadores) - Adicione observadores para acompanhar a assinatura de documentos.
    - [Webhook](#webhook) - Cadastre webhook para acompanhar seus documentos.
- [Requisitos](#requisitos)
- [Contribuição](#contribuição)
- [Licença](#licença)
- [Links](#links)

## Instalação

Este SDK está disponível no [Packagist](https://packagist.org/packages/vendor/d4sign-sdk) e pode ser instalado via Composer:

```bash
composer require carloshaam/d4sign-sdk
```

## Configuração

Para utilizar o SDK, você precisa configurar suas credenciais da API D4Sign. Defina as variáveis de ambiente abaixo ou configure diretamente no código:

```dotenv
D4SIGN_API_URL=your_api_url
D4SIGN_API_KEY=your_api_key
D4SIGN_SECRET_KEY=your_secret_key
```

Ou, ao inicializar o SDK:

```php
use D4Sign\D4Sign;

$d4sign = new D4Sign('your_api_key', 'your_secret_key', 'your_api_url');
```

## Cofres

Gerencie cofres, incluindo criação e visualização de cofres.

```php
$safes = $d4sign->safes()->listSafes();
```

[Documentação completa sobre Cofres em nossa Wiki](https://github.com/carloshaam/d4sign-sdk/wiki/Safe)

## Documentos

Faça o upload de documentos, adicione arquivos e gerencie o status de documentos.

```php
use D4Sign\Data\UploadFields;

$fields = new UploadFields($filePath);
$fields->setUuidFolder('uuid-folder'); // optional

$document = $d4sign->documents()->uploadDocumentToSafe('uuid-safe', $fields);

echo print_r($document->json(), true);
````

[Documentação completa sobre Documentos em nossa Wiki](https://github.com/carloshaam/d4sign-sdk/wiki/Document)

## Signatários

Adicione, remova e gerencie signatários de documentos.

```php
$signatories = $d4sign->signatories()->listGroupsBySafe('uuid-safe');
````

[Documentação completa sobre Signatários em nossa Wiki](https://github.com/carloshaam/d4sign-sdk/wiki/Signatory)

## Usuários

Gerencie usuários na sua conta D4Sign.

```php
$users = $d4sign->users();
````

[Documentação completa sobre Usuários em nossa Wiki](https://github.com/carloshaam/d4sign-sdk/wiki/User)

## Tags

Utilize e gerencie tags para personalizar seus documentos.

```php
$tags = $d4sign->tags();
````

[Documentação completa sobre Tags em nossa Wiki](https://github.com/carloshaam/d4sign-sdk/wiki/Tag)

## Certificado

Acesse e gerencie certificados de assinatura.

```php
$certificates = $d4sign->certificates();
````

[Documentação completa sobre Certificados em nossa Wiki](https://github.com/carloshaam/d4sign-sdk/wiki/Certificate)

## Observadores

Adicione observadores para acompanhar a assinatura de documentos.

```php
$watchers = $d4sign->watchers();
````

[Documentação completa sobre Observadores em nossa Wiki](https://github.com/carloshaam/d4sign-sdk/wiki/Watcher)

## Webhook

Cadastre webhook para acompanhar seus documentos.

```php
$webhooks = $d4sign->webhooks();
````

[Documentação completa sobre Webhooks em nossa Wiki](https://github.com/carloshaam/d4sign-sdk/wiki/Webhook)

Para uma visão completa de todas as funções e parâmetros, consulte a [documentação oficial](https://docapi.d4sign.com.br/docs) para exemplos detalhados, funções avançadas e casos de uso.

## Requisitos

- **PHP 7.4 ou superior:** Garantimos compatibilidade com as versões mais recentes do PHP para aproveitar os recursos modernos da linguagem.
- **Extensões PHP:** Dependências comuns como `curl` para realizar requisições HTTP.

## Links

- [Documentação Oficial](https://docapi.d4sign.com.br)

## Contribuição

Contribuições são bem-vindas! Siga estas etapas para contribuir:

1. Fork o repositório.
2. Crie um branch para sua feature (`git checkout -b feature/nova-feature`).
3. Faça um commit das suas alterações (`git commit -am 'Adiciona nova feature'`).
4. Envie o push do branch (`git push origin feature/nova-feature`).
5. Abra um Pull Request.

## Licença

Este projeto está licenciado sob a [MIT License](#).
