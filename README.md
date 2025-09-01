# UMT Group Website

## Installation

### Requirements

#### Required

- PHP version: ~8.1.0, ~8.2.0, or ~8.3.0
- Node.js version: >=18.0.0 (empfohlen: 20.x LTS)
- npm version: >=8.0.0
- Kirby CMS: ^4.0
- Composer

#### Required Kirby CMS Plugins

- "schwarzdesign/nxttool-core"
- "schwarzdesign/nxttool-theme-tailwind"

### Install a new project

- git clone git@github.com:schwarzdesign/umt-group.git {PROJECT_NAME}
- cd {PROJECT_NAME}


- Install PHP composer dependencies:
  ```bash
  composer install
  ```

- Install Node.js dependencies:
  ```bash
  npm install
  # oder falls ein lockfile vorhanden ist:
  npm ci
  ```

- Add the `.env` file and set your OpenAI API key:

```dotenv
OPENAI_API_KEY=sk-xxxxxxx
REPLICATE_API_KEY=xxxx
SMTP_HOST=xxx
SMTP_PORT=xxx
SMTP_USER=xxx
SMTP_PWD=xxx
ENVIRONMENT={development OR production}

```

- Add repository secrets for sftp / ftp deployment:
```dotenv
`REMOTE_PROTOCOL => Remote file transfer protocol (ftp, sftp)`
`REMOTE_HOST => Remote host`
`REMOTE_USER => FTP/SSH username`
`REMOTE_PASSWORD => FTP/SSH password`
`REMOTE_PATH => Remote path on host`
`REMOTE_PORT => Remote port`

```


### Fonts

- Build fonts (only when fonts are changed):
  ```bash
  npm run fonts
  ```

### Tailwind CSS & Alpine.js

- Build Tailwind + Alpine assets:
  ```bash
  npm run build
  ```

- Start watcher for development:
  ```bash
  npm run watch
  ```

---

## Multisite CSS

Dieses Projekt unterstützt **mehrere CSS-Dateien für verschiedene Domains**.  
Die Idee ist einfach:

- Lege für jede Domain, die ein eigenes Design benötigt, eine CSS-Datei in  
  ```
  /src/css/sites/{domain}.css
  ```
  an.  
  Beispiel: `/src/css/sites/umt-move.css`

- Gleichzeitig existiert für diese Domain ein Ordner in  
  ```
  /content-multisites/{domain}/
  ```
  → Dieser Ordner steht für die Inhalte dieser Domain.

- Wenn **beides** vorhanden ist (CSS-Datei + Content-Ordner), dann wird beim Build automatisch eine eigene Datei erzeugt:
  ```
  /public/assets/css/{domain}.css
  ```

- Wenn keine spezielle Domain-CSS gefunden wird, wird automatisch die Standarddatei genutzt:
  ```
  /public/assets/css/styles.css
  ```

Auf diese Weise kann jede Domain ein eigenes Styling haben, ohne dass die globale Basis überschrieben wird.

---

## Available npm scripts

| Command                | Description                                                                 |
|-------------------------|-----------------------------------------------------------------------------|
| `npm run fonts`         | Kopiert/erstellt Fonts (nur bei Änderungen notwendig).                      |
| `npm run images`        | Kopiert/erstellt Images (nur bei Änderungen notwendig).                     |
| `npm run favicons`      | Kopiert/erstellt Favicons (nur bei Änderungen notwendig).                   |
| `npm run build`         | Baut **Default-CSS (`styles.css`)** und alle gültigen **Domain-CSS**.       |
| `npm run watch`         | Startet Watcher für Default-CSS und alle gültigen Domain-CSS (parallel).    |
| `npm run build:default` | Baut nur das Default-CSS (`src/css/tailwind.css` → `public/assets/css/styles.css`). |
| `npm run build:dynamic` | Baut nur die Domain-CSS (alle gültigen unter `src/css/sites/*`).            |
| `npm run watch:default` | Watch-Modus nur für Default-CSS.                                            |
| `npm run watch:dynamic` | Watch-Modus nur für Domain-CSS.                                             |

---

👉 Damit reicht es für eine neue Domain, einen passenden Content-Ordner und eine gleichnamige CSS-Datei anzulegen – der Rest läuft automatisch beim Build.




## Support

For support or further inquiries, please contact [info@schwarzdesign.de](mailto:info@schwarzdesign.de).
