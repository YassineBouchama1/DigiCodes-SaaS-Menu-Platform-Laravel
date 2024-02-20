## how to use

// This can use it inside function in controller
# if ($user->can('edit menu')) {
    
}

// Or in views
@can('edit menu')
    <!-- Examples: Show edit menu button -->
@endcan

