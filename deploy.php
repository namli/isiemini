<?php
namespace Deployer;

require 'recipe/wordpress.php';
// Либо: require 'recipe/common.php'; и тогда свои шаги bedrock (shared/writable и т.д.)

// Config
set('application', 'isiemini.com');
set('repository', 'git@github.com:ORG/REPO.git'); // ваш реальный репозиторий
set('branch', 'main'); // если нужен фиксированный бранч
set('php_fpm_service', 'php8.2-fpm'); // под вашу версию PHP

// Hosts
host('production')
    ->setHostname('your-server.com')   // реальный адрес/хост
    ->set('remote_user', 'deploy')     // реальный пользователь
    ->set('deploy_path', '~/sites/{{application}}');

// Shared / Writable
add('shared_files', ['.env']);
add('shared_dirs', ['web/app/uploads']);
add('writable_dirs', ['web/app/cache', 'web/app/uploads']);

// Build assets
task('deploy:build_assets', function () {
    cd('{{release_path}}/web/app/themes/isiemini');
    run('npm ci');        // быстрее/детерминированнее, если есть lock
    run('npm run build');
});

// Optional: reload php-fpm (нужны права sudo без пароля на reload)
task('php-fpm:reload', function () {
    run('sudo systemctl reload {{php_fpm_service}}');
});

// Hooks
after('deploy:vendors', 'deploy:theme_composer');
after('deploy:theme_composer', 'deploy:build_assets');
after('deploy:failed', 'deploy:unlock');
// Выполнить права на запись и перезагрузку PHP-FPM
before('deploy:publish', 'deploy:writable');
// after('deploy:publish', 'php-fpm:reload');

// Main task (можно оставить дефолтный из рецепта, но ваш явный порядок тоже ок)
task('deploy:theme_composer', function () {
    cd('{{release_path}}/web/app/themes/isiemini');
    run('composer install --no-dev --prefer-dist --no-interaction --optimize-autoloader');
});

task('deploy', [
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:vendors',
    'deploy:theme_composer',
    'deploy:build_assets',
    'deploy:writable',
    'deploy:publish',
])->desc('Deploy your project');
