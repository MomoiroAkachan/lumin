@props(['name', 'class' => 'w-8 h-8 text-primary'])

@if(\App\Support\AdminIcons::exists($name))
    <x-admin.icon :name="$name" :class="$class" />
@endif
