<?php
namespace Deployer;

require 'recipe/wordpress.php';

// Config
set('application', 'isiemini.email2.ru');
set('repository', 'git@github.namli:namli/isiemini.git');
set('branch', 'main');
set('php_fpm_service', 'php8.2-fpm');
set('identity_file', '~/.ssh/vetratoria_contabo/isiemini/isiemini_key_ed25519');
set('deploy_path', '/home/isiemini/web/isiemini.email2.ru/public_html');

// Hosts
host('production')
    ->setHostname('31.220.82.125')
    ->set('remote_user', 'isiemini')
    ->set('port', '19219')
    ->set('identity_file', '~/.ssh/vetratoria_contabo/isiemini/isiemini_key_ed25519');

// Shared / Writable
add('shared_files', ['.env']);
add('shared_dirs', ['web/app/uploads']);
add('writable_dirs', ['web/app/cache', 'web/app/uploads']);

// Build assets
task('deploy:build_assets', function () {
    cd('{{release_path}}/web/app/themes/isiemini');
    run('npm ci');
    run('npm run build');
});

// Optional: reload php-fpm (нужны права sudo без пароля на reload)
// task('php-fpm:reload', function () {
//     run('sudo systemctl reload {{php_fpm_service}}');
// });

// Hooks
after('deploy:failed', 'deploy:unlock');

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
