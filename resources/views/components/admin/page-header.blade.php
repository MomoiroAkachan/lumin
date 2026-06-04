@props(['title', 'subtitle' => null, 'action' => null])

<div class="flex items-start justify-between gap-4 mb-6">
    <div>
        <h2 class="text-2xl font-semibold text-foreground">{{ $title }}</h2>
        @isset($subtitle)
            <p class="text-sm text-gray-500 mt-1">{{ $subtitle }}</p>
        @endisset
    </div>
    @isset($action)
        <div>{{ $action }}</div>
    @endisset
</div>
