# Heritage Websites

## 🏛️ Aplicação Web de Blog Simples (Yii2 Framework)

O **Heritage Websites** é uma aplicação web desenvolvida utilizando o *framework* **Yii2** (PHP), seguindo o padrão de arquitetura **Model-View-Controller (MVC)**. O projeto tem como objetivo simular um website de blog simples, demonstrando a capacidade de estruturar e desenvolver aplicações web completas com um *framework* robusto.

### ✨ Funcionalidades e Estrutura

O projeto é baseado no **Yii 2 Basic Project Template**, o que indica uma aplicação com funcionalidades básicas de gerenciamento de conteúdo e usuários.

*   **Estrutura MVC:** O uso do Yii2 garante uma separação clara de responsabilidades entre Modelos (dados e regras de negócio), Views (interface do usuário) e Controllers (lógica de aplicação).
*   **Conteúdo Estático:** A presença da pasta `content-pages` sugere que o projeto lida com páginas de conteúdo estático ou páginas de informação do blog.
*   **Gerenciamento de Conteúdo:** O projeto inclui as pastas `controllers`, `models` e `views`, indicando a capacidade de gerenciar o conteúdo do blog (posts, categorias, etc.) através de rotas e lógica de aplicação.

### 🛠️ Tecnologias Utilizadas

| Tecnologia | Uso Principal |
| :--- | :--- |
| **PHP** | Linguagem de programação principal. |
| **Yii2 Framework** | Estrutura MVC para o desenvolvimento da aplicação. |
| **HTML5** | Estrutura e marcação do conteúdo. |
| **CSS3** | Estilização e layout. |

### 📂 Estrutura do Projeto

O projeto segue a estrutura padrão do Yii2 Basic Project Template:

```
Heritage-Websites/
├── assets/             # Definições de Assets (JS, CSS)
├── commands/           # Comandos de Console
├── config/             # Configurações da Aplicação (db.php, web.php, etc.)
├── content-pages/      # Páginas de conteúdo estático
├── controllers/        # Controladores da Aplicação (Lógica de Negócio)
├── mail/layouts/       # Layouts de E-mail
├── models/             # Modelos de Dados (Estrutura e Regras)
├── runtime/            # Arquivos gerados em tempo de execução
├── tests/              # Testes (Codeception)
├── views/              # Arquivos de Visualização (Views)
├── web/                # Ponto de entrada da aplicação (index.php)
├── widgets/            # Componentes de interface reutilizáveis
└── README.md           # Este arquivo
```

### 🚀 Como Executar

O projeto requer um ambiente de servidor web com PHP e um banco de dados.

1.  **Instalação de Dependências:**
    ```bash
    composer install
    ```
2.  **Configuração do Banco de Dados:**
    Edite o arquivo `config/db.php` com as credenciais do seu banco de dados.
3.  **Acesso:**
    A aplicação pode ser acessada através do servidor web configurado (ex: `http://localhost/heritage-websites/web/`).

### 📝 Licença

Este projeto está sob a seguinte [<ins>licença</ins>](LICENSE.md).

---
*Desenvolvido por [BrizidoAndre](https://github.com/BrizidoAndre)*
