<section id="topo" class="relative">
    <div class="absolute top-0 left-0 right-0 z-10 bg-linear-180 from-zinc-900/50 to-transparent h-1/5"></div>
    @forelse($banners as $banner)
        <div class="relative h-[85vh] min-h-100 flex items-center justify-center text-white overflow-hidden {{ ! $loop->first ? 'hidden' : '' }}">
            @if($banner->image_path)
                <img src="{{ media_url($banner->image_path) }}" alt="{{ $banner->title }}"
                     class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-black/50"></div>
            @else
                <div class="absolute inset-0 bg-linear-to-r from-zinc-800 to-zinc-700"></div>
            @endif

            <div class="relative container text-center">
                <h1 class="text-3xl md:text-5xl font-bold mb-4">{{ $banner->title }}</h1>
                @if($banner->subtitle)
                    <p class="text-lg md:text-xl mb-6 max-w-2xl mx-auto">{{ $banner->subtitle }}</p>
                @endif
                @if($banner->cta_label && $banner->cta_url)
                    <a href="{{ $banner->cta_url }}" class="inline-block px-6 py-3 bg-accent text-accent-fg rounded font-medium">
                        {{ $banner->cta_label }}
                    </a>
                @endif
            </div>
        </div>
    @empty
        <div class="h-[85vh] flex items-center justify-center bg-linear-to-r from-zinc-800 to-zinc-700 text-white">
            <div class="text-center container">
                <h1 class="text-3xl md:text-5xl font-bold">{{ config('app.name') }}</h1>
                <p class="text-lg mt-3">{{ $settings['company_tagline'] ?? 'Tecnologia que transforma' }}</p>
            </div>
        </div>
    @endforelse
    <div class="absolute bottom-0 left-0 right-0 z-10 bg-linear-360 from-zinc-900/40 to-transparent h-1/5"></div>
    <div class="bg-primary absolute z-20 left-2 -bottom-5 flex flex-row *:px-7 *:py-4 *:text-sm *:text-primary-fg">
        <a href="#">Pronus</a>
        <a href="#">Pronus</a>
        <a href="#">Pronus</a>
        <a href="#">Pronus</a>
        <a href="#">Pronus</a>
        <a href="#">Pronus</a>
    </div>
</section>
