<section id="galeria" class="py-16">
    <div class="container">
        <h2 class="text-3xl font-bold text-center mb-10">Galeria</h2>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($gallery as $image)
                <figure class="relative overflow-hidden rounded group">
                    <img src="{{ media_url($image->image_path) }}" alt="{{ $image->caption }}"
                         class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                    @if($image->caption)
                        <figcaption class="absolute bottom-0 left-0 right-0 bg-black/60 text-white text-xs p-2 translate-y-full group-hover:translate-y-0 transition-transform">
                            {{ $image->caption }}
                        </figcaption>
                    @endif
                </figure>
            @endforeach
        </div>
    </div>
</section>
