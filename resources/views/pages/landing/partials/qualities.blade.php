<section id="qualidades" class="py-16 bg-surface">
    <div class="container">
        <h2 class="text-3xl font-bold text-center mb-10">Por que escolher a {{ $settings['company_name'] ?? 'Abs' }}?</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($qualities as $quality)
                <div class="text-center">
                    @if($quality->icon_path)
                        <img src="{{ media_url($quality->icon_path) }}" alt="" class="h-16 w-16 mx-auto mb-3">
                    @elseif($quality->icon)
                        <div class="h-16 w-16 mx-auto mb-3 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                            <x-site.icon :name="$quality->icon" class="w-8 h-8" />
                        </div>
                    @else
                        <div class="h-16 w-16 mx-auto mb-3 rounded-full bg-primary/10 flex items-center justify-center text-primary text-2xl">✓</div>
                    @endif
                    <h3 class="font-semibold text-lg mb-1">{{ $quality->title }}</h3>
                    <p class="text-sm text-gray-600">{{ $quality->description }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
