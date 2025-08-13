# Application Deployment Guide

This guide describes zero-downtime deployments with [Deployer](https://deployer.org/) for the Bedrock/WordPress project. It reflects the current production setup and tasks.

## Prerequisites

- **SSH access**: Key-based access to production as the user configured in `deploy.php`.
- **Local tools**: Git and Composer installed locally.
- **Server tools**: PHP 8.2+, Composer, Git. Node/npm on server are NOT required (we build assets locally).

## Paths and Structure

- Deploy path: `/home/isiemini/web/isiemini.email2.ru/public_html` (configured in `deploy.php`).
- Active release symlink: `/home/isiemini/web/isiemini.email2.ru/public_html/current`.
- Web server should serve from: `/home/isiemini/web/isiemini.email2.ru/public_html/current/web`.
- Shared directory: `/home/isiemini/web/isiemini.email2.ru/public_html/shared`.

## First-Time Server Setup (one-time)

1. SSH to the server.
2. Create shared directories:
   ```bash
   mkdir -p /home/isiemini/web/isiemini.email2.ru/public_html/shared/web/app/uploads
   ```
3. Create production `.env` in `shared`:
   ```bash
   nano /home/isiemini/web/isiemini.email2.ru/public_html/shared/.env
   ```
   Fill it with production credentials, URLs, and salts.
4. Ensure the deploy user has read access to the Git repo via SSH keys.
5. If the web server docroot cannot be changed, create a symlink once so `public_html/web` points to `current/web`:
   ```bash
   ln -sfn /home/isiemini/web/isiemini.email2.ru/public_html/current/web \
          /home/isiemini/web/isiemini.email2.ru/public_html/web
   ```

## Deploy Process

From your local project root, deploy the `main` branch:

```bash
./vendor/bin/dep deploy production
```

### What Happens During Deployment

1. A new `releases/<id>` directory is created on the server.
2. The repository is cloned into the new release.
3. Shared files/dirs are symlinked (`.env`, `web/app/uploads`).
4. Composer installs root PHP dependencies (`vendor/`).
5. Composer installs theme PHP dependencies in `web/app/themes/isiemini`.
6. Frontend assets are built LOCALLY and uploaded to the server (`web/app/themes/isiemini/public/build`).
7. The `current` symlink atomically switches to the new release.
8. Old releases are cleaned up, keeping a limited number for rollbacks.

Notes:
- We use the `wordpress` recipe and hooks. Asset build happens locally; the server doesn’t require Node/npm.

## Rollback

To switch back to the previous release instantly:

```bash
./vendor/bin/dep rollback production
```

## Asset Build Strategies

- **Current (recommended for this project)**: Build locally and upload `web/app/themes/isiemini/public/build` during deploy. No Node/npm on server.
- **Alternative**: Build on the server (requires Node 20+ and npm). If you switch to this, enable the `deploy:build_assets` task and ensure Node/npm are installed on the server.

## Release Retention

- The system keeps up to 10 recent releases by default. You can change this by setting `set('keep_releases', N);` in `deploy.php`.
- Manual cleanup:
  ```bash
  ./vendor/bin/dep deploy:cleanup production
  ```

## Best Practices

- **Do not edit files on the server**: Any change in `current` will be overwritten on the next deploy.
- **Uploads persistence**: `web/app/uploads` is shared and survives deployments.
- **Environment variables**: Keep production `.env` only on the server under `shared/.env` and never commit it.
- **WP-CLI**: Run from the `current` directory:
  ```bash
  cd /home/isiemini/web/isiemini.email2.ru/public_html/current && wp <command>
  ```
