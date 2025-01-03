# Passo a Passo com a SDK da D4Sign para PHP

Esta documentação foi criada para auxiliar desenvolvedores a integrarem a SDK da D4Sign utilizando **PHP**. Aqui estão
os tópicos essenciais para realizar a instalação, configuração e uso desse recurso.

## Índice

- [1. Autoloading & Namespaces](#1-autoloading--namespaces)
- [2. Requisitos do sistema](#2-requisitos-do-sistema)
- [3. Instalando a SDK da D4Sign para PHP](#3-instalando-a-sdk-da-d4sign-para-php)
- [4. Configuração e Inicialização](#4-configuração-e-inicialização)
- [5. Autenticação e Autorização](#5-autenticação-e-autorização)
- [6. Fazendo Requisições – Exemplo](#6-fazendo-requisições--exemplo)
- [7. Próximos Passos](#7-próximos-passos)
- [8. Suporte](#8-suporte)

## 1. Autoloading & Namespaces

O D4Sign SDK para PHP é codificado conforme **PSR-4**. Isso significa que ele depende muito de namespaces
para que os arquivos de classe possam ser carregados automaticamente.
Os namespaces disponíveis estão no formato `D4Sign\[SubNamespace]` e são usados para acesso às funcionalidades dos
serviços da API (exemplo: documentos, signatários, cofres, etc.).
Exemplo básico de utilização de namespaces:

```php
use D4Sign\Document\DocumentService;
```

É fundamental que o autoload do **Composer** seja utilizado, pois ele lida automaticamente com o carregamento das
classes necessárias durante a execução da aplicação.
Se você ainda não está familiarizado com os conceitos de _namespace_ e _autoloading_, seria interessante se aprofundar
no tema para tirar o máximo proveito dessa funcionalidade. Esses conceitos permitem a organização e carregamento
eficiente de arquivos na sua aplicação PHP, tornando o processo muito mais ágil e profissional.

## 2. Requisitos do sistema

Os seguintes requisitos são necessários para o funcionamento da SDK:

- **PHP 7.4 ou superior**: garantimos compatibilidade com as versões mais recentes do PHP para aproveitar os recursos
  modernos da linguagem.
- **Extensões PHP**:
    - `curl` - Para realizar as requisições HTTP.
    - `mbstring` - Para manipulação de strings.
- **Ambiente de servidor**: Web ou CLI.

## 3. Instalando a SDK da D4Sign para PHP

### 3.1 Instalando com Composer (recomendado)

O Composer é o gerenciador de dependências mais utilizado no ecossistema PHP. Para instalar a SDK da D4Sign com
Composer, utilize o comando:

```bash
composer require carloshaam/d4sign-php-sdk
```

Isso irá baixar a SDK e suas dependências automaticamente para o diretório `vendor/`.
Caso ainda não tenha o Composer instalado, siga as instruções de instalação
no [site oficial do Composer](https://getcomposer.org/).

## 4. Configuração e Inicialização

Antes de fazer qualquer requisição à API da D4Sign, é necessário configurar as credenciais de autenticação.

### 4.1 Criando uma instância da SDK

Utilize o token da API (`tokenAPI`) e a chave de criptografia (`cryptKey`) fornecidos pela D4Sign.

```php
use D4Sign\D4Sign;

// Configurando a D4Sign
$d4sign = new D4Sign(
    '{tokenAPI}',     // Substitua pelo Token API da sua conta
    '{cryptKey}'      // Substitua pela sua chave de criptografia
);
```

#### 4.1.1 Instanciar a SDK Manualmente com HttpClient

```php
use D4Sign\Client\HttpClient;
use D4Sign\Document\DocumentService;

// Configurando o cliente HTTP manualmente
$httpClient = new HttpClient();
$httpClient->baseUrl('https://sandbox.d4sign.com.br/api/v1'); // URL base
$httpClient->withHeaders([
    'tokenAPI' => '{tokenAPI}',   // Substitua pela sua chave Token API
    'cryptKey' => '{cryptKey}'    // Substitua pela sua chave de criptografia
]);

// Criando a instância do serviço de documentos
$documentService = new DocumentService($httpClient);

// Listando os documentos
$documents = $documentService->listDocuments();

// Exibindo o resultado
echo print_r($documents->getJson(), true);
```

### Alternando entre os Ambientes de Produção e Sandbox

A API possui dois ambientes disponíveis:

- **Produção**: Utilizado para operações reais. URL: `https://secure.d4sign.com.br/api/v1`
- **Sandbox (Homologação)**: Utilizado para testes. URL: `https://sandbox.d4sign.com.br/api/v1`

O ambiente pode ser alternado configurando dinamicamente o URL base durante a inicialização:

```php
$production = true; // Ajuste para 'false' caso queira usar o ambiente Sandbox

$baseUrl = $production 
    ? 'https://secure.d4sign.com.br/api/v1'
    : 'https://sandbox.d4sign.com.br/api/v1';

$d4sign = new D4Sign(
    '{tokenAPI}',
    '{cryptKey}',
    $baseUrl
);
```

## 5. Autenticação e Autorização

As credenciais de autenticação são enviadas no cabeçalho da requisição HTTP. A SDK D4Sign faz isso automaticamente ao
configurar os valores de `tokenAPI` e `cryptKey`.
Exemplo de cabeçalhos que serão enviados:

```http
tokenAPI: SEU_TOKEN_API
cryptKey: SUA_CRYPT_KEY
```

A biblioteca `D4SignClient` lida com todas as requisições HTTP, garantindo que os cabeçalhos corretos sejam enviados em
cada requisição. No caso de falhas, lançará exceções que podem ser tratadas.

#### Tratando Exceções

A SDK utiliza exceções para indicar falhas em operações. Aqui está um exemplo de tratamento de erro:

```php
try {
    $documentos = $d4sign->documents()->listDocuments();

    echo print_r($documentos->getJson());
} catch (\Exception $e) {
    echo $e->getMessage();
}
```

Principais erros:

- **401 Unauthorized**: Credenciais inválidas. Verifique `tokenAPI` ou `cryptKey`.
- **413 Payload Too Large**: Limite de tamanho do documento foi excedido.
- **500 Server Error**: Problema interno no servidor D4Sign.

## 6. Fazendo Requisições – Exemplo

Todos os métodos da SDK utilizam classes de serviço (Service Classes) responsáveis por operações específicas. Abaixo
seguem exemplos de uso:

### 6.1 Listar Documentos

Vamos listar os documentos armazenados na API utilizando o serviço de documentos:

```php
$documentos = $d4sign->documents()->listDocuments();

echo print_r($documentos->getJson());
```

### 6.2 Enviar Documento para um Cofre

Suba documentos para o cofre usando os campos obrigatórios:

```php
use D4Sign\Document\UploadDocumentFields;

// Criando os dados para o upload
$fields = new UploadDocumentFields('/caminho/para/documento.pdf');
$fields->setUuidFolder('uuid-folder'); // Para associar a um diretório

// Enviando o documento
$documento = $d4sign->documents()->uploadDocumentToSafe('uuid-safe', $fields);

echo "Documento enviado com sucesso!" . PHP_EOL;
echo print_r($documento->getJson());
```

### 6.3 Gerenciar Signatários

Adicionar um signatário a um documento existente:

```php
use D4Sign\Signatory\CreateSignatoryInformationFields;

// Informações do novo signatário
$fields = new CreateSignatoryInformationFields('{key_signer}', 'email@email.com');

// Adicionando o signatário
$signatario = $d4sign->signatories()->addSignatoryInformation('uuid-document', $fields);

echo "Signatário adicionado ao documento!" . PHP_EOL;
echo print_r($signatario->getJson());
```

Remover um signatário de um documento:

```php
use D4Sign\Signatory\RemoveSignatoryFields;

$fields = new RemoveSignatoryFields('email@email.com', '{key_signer}');

$d4sign->signatories()->removeSignatory('uuid-document', $fields);

echo "Signatário removido.";
```

### 6.4 Webhooks

A API D4Sign permite gerenciar webhooks para notificação sobre eventos de documentos. Você pode listar e criar.

#### Listar Webhooks Existentes

```php
$webhooks = $d4sign->webhooks()->listWebhookToDocument();

foreach ($webhooks as $webhook) {
    echo $webhook['uuid'] . " - " . $webhook['webhook_url'] . PHP_EOL;
}
```

#### Criar um Novo Webhook

```php
$fields = ['url' => 'https://meuwebhook.com/callback']);

$webhook = $d4sign->webhooks()->createWebhookToDocument('uuid-document', $fields);

echo "Webhook criado com sucesso! UUID: " . $webhook['uuid'];
```

## 7. Próximos Passos

Explore os serviços disponíveis na SDK:

- **Cofres**: `$d4sign->safes()` - Gerencie cofres, incluindo criação e visualização de cofres.
- **Documentos**: `$d4sign->documents()` - Faça o upload de documentos, adicione arquivos e gerencie o status de
  documentos.
- **Signatários**: `$d4sign->signatories()` - Adicione, remova e gerencie signatários de documentos.
- **Usuários**: `$d4sign->users()` - Gerencie usuários na sua conta D4Sign.
- **Tags**: `$d4sign->tags()` - Utilize e gerencie tags para personalizar seus documentos.
- **Certificados**: `$d4sign->certificates()` - Acesse e gerencie certificados de assinatura.
- **Observadores**: `$d4sign->watchers()` - Adicione observadores para acompanhar a assinatura de documentos.
- **Webhooks**: `$d4sign->webhooks()` - Cadastre webhook para acompanhar seus documentos.

Para mais exemplos detalhados e serviços, consulte a [documentação oficial](https://docapi.d4sign.com.br).

## 8. Suporte

Caso encontre algum problema ou tenha dúvidas, entre em contato com o suporte oficial do D4Sign.
E com isso, você está pronto para começar a utilizar a SDK D4Sign com PHP.
