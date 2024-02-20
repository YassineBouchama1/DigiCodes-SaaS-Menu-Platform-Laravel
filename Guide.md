## how to use

//1- ./vendor/bin/sail up -d
//2- ./vendor/bin/sail artisan migrate
//3- ./vendor/bin/sail artisan db:seed --class=RolesSeeder

permissions
database/seeders/RolesSeeder.php

// This can use it inside function in controller
# if ($user->can('edit menu')) {
    
}

// Or in views
@can('edit menu')
    <!-- Examples: Show edit menu button -->
@endcan

