<?php
namespace Deployer;

require 'recipe/wordpress.php';

// Config
set('application', 'isiemini.email2.ru');
set('repository', 'git@github.com:namli/isiemini.git');
set('branch', 'main');
set('php_fpm_service', 'php8.2-fpm');
set('deploy_path', '/home/isiemini/web/isiemini.email2.ru/public_html');
set('keep_releases', 5);

// Hosts
host('production')->setHostname('vetratoria.isiemini');

// Shared / Writable (override defaults from wordpress recipe)
set('shared_files', ['.env', 'web/.htaccess']);
set('shared_dirs', [
    'web/app/uploads',
    'web/app/plugins/advanced-custom-fields-pro'
]);
set('writable_dirs', ['web/app/cache', 'web/app/uploads']);
set('writable_mode', 'chmod');
set('writable_chmod_mode', '0775');

// Theme composer install task (must be defined before hooks that reference it)
task('deploy:theme_composer', function () {
    cd('{{release_path}}/web/app/themes/isiemini');
    run('composer install --no-dev --prefer-dist --no-interaction --optimize-autoloader');
});

task('assets:upload', function () {
  upload('web/app/themes/isiemini/public/build', '{{release_path}}/web/app/themes/isiemini/public/');
});

task('assets:build_locally', function () {
    runLocally('cd web/app/themes/isiemini && npm ci && npm run build');
});

// Hooks
after('deploy:shared', 'deploy:vendors');
after('deploy:vendors', 'deploy:theme_composer');
after('deploy:theme_composer', 'assets:build_locally');
after('assets:build_locally', 'assets:upload');
after('deploy:failed', 'deploy:unlock');
