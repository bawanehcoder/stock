@can('view-any', App\Models\Supplier::class)
<x-responsive-nav-link
    href="{{ route('dashboard.suppliers.index') }}"
    :active="request()->routeIs('dashboard.suppliers.index')"
>
    {{ __('navigation.suppliers') }}
</x-responsive-nav-link>
@endcan
