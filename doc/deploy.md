# Application Deployment Guide

This guide outlines the process for deploying the application to a live server using [Deployer](https://deployer.org/). This method ensures zero-downtime, atomic deployments, and provides a simple way to roll back to a previous version if needed.

## Prerequisites

1.  **SSH Access:** You must have SSH key-based access to the production server for the user specified in `deploy.php`.
2.  **Composer:** Composer must be installed on your local machine.
3.  **Git:** Your local machine must have Git installed and be able to pull/push to the project repository.

## First-Time Server Setup

Before the first deployment, you need to prepare the server. This only needs to be done once.

1.  **SSH into the server:**
    ```bash
    ssh user@your-server.com
    ```

2.  **Create Directory Structure:** Create the necessary shared directories that will persist between deployments. The `deploy_path` must match the one set in `deploy.php`.
    ```bash
    # Example:
    mkdir -p ~/sites/isiemini.com/shared/web/app/uploads
    ```

3.  **Create Production `.env` File:**
    Create the production environment file (`.env`) and place it in the `shared` directory. This file is symlinked into each new release and is never stored in Git.
    ```bash
    nano ~/sites/isiemini.com/shared/.env
    ```
    Populate it with your production database credentials, application keys, and other environment-specific settings.

4.  **SSH Key for Git:** Ensure the server has an SSH key that is authorized to pull from the project's Git repository.

## The Deployment Process

To deploy the latest version of the `main` branch, run the following command from your **local machine's** project root:

```bash
./vendor/bin/dep deploy production
```

### What Happens During Deployment?

1.  Deployer SSHes into the server.
2.  It creates a new `release` directory.
3.  It clones your Git repository into this new directory.
4.  It creates symlinks for the shared files and directories (`.env`, `web/app/uploads`).
5.  It runs `composer install` to install PHP dependencies.
6.  It runs `npm install` and `npm run build` inside the theme directory to build frontend assets.
7.  If all steps succeed, it atomically switches the `current` symlink to point to the new `release` directory, making the new version live instantly.
8.  It cleans up old releases, keeping a few recent ones for rollbacks.

## Rolling Back a Deployment

If you discover a bug or issue with a new deployment, you can immediately roll back to the previously working version with a single command:

```bash
./vendor/bin/dep rollback production
```

This command simply switches the `current` symlink back to the previous release directory. It is extremely fast and effective.

## Important Cases & Best Practices

*   **Never Edit Core/Plugin/Theme Files Directly on the Server:** All changes must be committed to Git and deployed. Any direct edits in the `current` release directory will be wiped out on the next deployment.
*   **Managing User-Uploaded Content:** The `web/app/uploads` directory is a shared, persistent directory. It is not affected by deployments, ensuring that user-uploaded media is safe.
*   **Environment Variables:** All environment-specific configuration (database credentials, API keys, etc.) must be stored in the `.env` file on the server. Never commit this file to Git. Use `.env.example` as a template.
*   **Database Migrations:** This deployment recipe does not automatically handle database migrations (e.g., for major plugin updates). If a deployment requires a database change, you must handle that manually by logging into the WordPress admin or using WP-CLI on the server.
*   **WP-CLI:** You can run WP-CLI commands on the server by navigating to the `current` directory:
    ```bash
    cd ~/sites/isiemini.com/current && wp-cli <command>
    ```
