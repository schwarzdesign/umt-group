# nxttool-starter
Starter Projekt for nxttol

## Installation

### Requirements

#### Required

- PHP version: ~8.1.0, ~8.2.0, or ~8.3.0
- Kirby CMS: ^4.0
- Composer

#### Required Kirby CMS Plugins

- "schwarzdesign/nxttool-core"
- "schwarzdesign/nxttool-theme-tailwind"

### Install a new project

- git clone git@github.com:schwarzdesign/nxttool-starter.git {PROJECT_NAME}
- cd {PROJECT_NAME}

- Install composer dependencies:
    - `composer install`
- Install node:
    - `npm install`
    - `npm ci`
- Build fonts only manual on change:
    - `npm run fonts`   
- Build tailwind css, alpine js:
    - `npm run build`
    - `npm run watch`

Add the `.env` file and set your OpenAI API key:

```dotenv
OPENAI_API_KEY=sk-xxxxxxx
REPLICATE_API_KEY=xxxx
SMTP_HOST=xxx
SMTP_PORT=xxx
SMTP_USER=xxx
SMTP_PWD=xxx
ENVIRONMENT={development OR production}

```

## Support

For support or further inquiries, please contact [info@schwarzdesign.de](mailto:info@schwarzdesign.de).
