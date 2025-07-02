<?php
namespace Deployer;

require 'recipe/bedrock.php';

// Config
set('application', 'isiemini.com');
set('repository', 'git@github.com:your-user/your-repo.git'); // <-- EDIT THIS
set('php_fpm_service', 'php8.1-fpm'); // <-- EDIT THIS if needed

// Hosts
host('production') // <-- EDIT THIS (e.g., your-server.com)
    ->set('remote_user', 'user') // <-- EDIT THIS
    ->set('deploy_path', '~/sites/{{application}}'); // <-- EDIT THIS

// Shared files/dirs
add('shared_files', ['.env']);
add('shared_dirs', ['web/app/uploads']);

// Writable dirs
add('writable_dirs', ['web/app/cache']);

// Tasks
task('deploy:build_assets', function () {
    cd('{{release_path}}/web/app/themes/isiemini');
    run('npm install');
    run('npm run build');
});

// Hooks
after('deploy:vendors', 'deploy:build_assets');
after('deploy:failed', 'deploy:unlock');

// Main task
task('deploy', [
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:vendors',
    'deploy:publish',
])->desc('Deploy your project');
