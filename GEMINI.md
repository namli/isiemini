# Gemini Project Context

This file helps Gemini understand the project's conventions, tools, and architecture.

## Project Overview

- **Type:** WordPress Application
- **Framework:** [Roots.io Bedrock](https://roots.io/bedrock/)
- **Theme:** [Roots.io Sage](https://roots.io/sage/)
- **Main Theme Location:** `web/app/themes/isiemini`
- **Dev envierment** DDEV used to run app localy on developer computer

## Development Conventions

### Custom Gutenberg Blocks

- **Technology:** Blocks are created using **log1x/acf-composer** with PHP and Blade templates (no React).
- **Location:** New blocks should be created in their own directory within `web/app/themes/isiemini/app/Blocks/`.
  - Example: `app/Blocks/PromoBox/`
- **Autoloading:** Blocks are automatically registered by location. No manual registration is needed.
- **Custom Category:** All custom blocks should be assigned to the **"IsiEmini Blocks"** category for easy identification in the editor.
  - The category slug is `iesemini-theme`.
  - Set this in the block's PHP file: `public $category = 'iesemini-theme';`
- **Create custom block** to create new block we **use ddev wp acorn acf:block BlockName**
- **Плагины WordPress** — всегда в корень (Bedrock). **Библиотеки для темы** — в тему (Sage).

### Styling

- **Framework:** [Tailwind CSS](https://tailwindcss.com/) is used for styling.
- **Build Command:** Run `npm run build` from the theme directory (`web/app/themes/isiemini`) to compile assets.

## Deployment

- **Tool:** [Deployer](https://deployer.org/) is used for zero-downtime deployments.
- **Configuration:** The deployment recipe is located at `deploy.php` in the project root.
- **Deployment Command:** To deploy to production, run the following command from your local machine:
  ```bash
  ./vendor/bin/dep deploy production
  ```
- **Manual:** A detailed deployment guide is available at `doc/deploy.md`.
