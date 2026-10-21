# Consulta de Signo

Aplicação web simples que identifica o signo do zodíaco a partir da data de nascimento e exibe uma breve descrição. As datas e descrições dos signos ficam em um arquivo XML.

## Contexto acadêmico

Projeto desenvolvido como trabalho do 3º semestre do curso de **Análise e Desenvolvimento de Sistemas** da **Anhanguera**, na disciplina de **Desenvolvimento Web**.

## Funcionalidades

- Formulário para informar a data de nascimento.
- Validação para aceitar apenas datas válidas que já aconteceram.
- Identificação do signo, incluindo períodos que atravessam a virada do ano.
- Exibição do símbolo e de uma descrição do signo.
- Mensagens de erro quando a data ou os dados dos signos não podem ser processados.

## Tecnologias

- PHP
- XML
- HTML e CSS
- Bootstrap 5.2, carregado por CDN
- Google Fonts (Cinzel), carregada por CDN

## Requisitos

- PHP com a extensão **SimpleXML** habilitada.
- Um servidor web com suporte a PHP, como Apache (por exemplo, pelo XAMPP).
- Acesso à internet para carregar o Bootstrap e a fonte do Google Fonts.

## Como executar

### Usando o XAMPP

1. Copie a pasta do projeto para o diretório `htdocs` do XAMPP.
2. Inicie o Apache pelo painel de controle do XAMPP.
3. Abra no navegador `http://localhost/signos/`.

Se a pasta tiver outro nome, substitua `signos` na URL pelo nome usado.

### Usando o servidor embutido do PHP

Com o PHP instalado e disponível no terminal, acesse a pasta do projeto e execute:

```bash
php -S localhost:8000
```

Depois, abra `http://localhost:8000/` no navegador.

## Estrutura do projeto

```text
.
├── index.php                 # Formulário de entrada
├── show_zodiac_sign.php      # Validação da data e exibição do resultado
├── signos.xml                # Períodos e descrições dos signos
├── layouts/
│   └── header.php            # Cabeçalho HTML e referências a CSS/CDNs
└── assets/
    └── css/
        └── style.css         # Estilos da aplicação
```

## Personalização

Para alterar os períodos ou as descrições, edite `signos.xml`. Cada elemento `<signo>` contém as datas de início e fim, o nome e a descrição. Use o formato `DD/MM` para as datas e mantenha os nomes consistentes com os usados pela aplicação.
