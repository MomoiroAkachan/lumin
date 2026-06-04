<section id="portfolio" class="py-16">
    <div class="container">
        <h2 class="text-3xl font-bold text-center mb-2">Portfólio</h2>
        <p class="text-center text-gray-500 mb-10">Projetos que entregamos</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($portfolios as $project)
                <article class="bg-interface rounded-lg overflow-hidden border border-gray-200 hover:shadow-lg transition">
                    @if($project->cover_image_path)
                        <img src="{{ media_url($project->cover_image_path) }}" alt="{{ $project->title }}"
                             class="w-full h-48 object-cover">
                    @endif
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">{{ $project->title }}</h3>
                        @if($project->description)
                            <p class="text-gray-600 text-sm mb-3 line-clamp-3">{{ \Illuminate\Support\Str::limit(strip_tags($project->description), 140) }}</p>
                        @endif
                        @if($project->link)
                            <a href="{{ $project->link }}" target="_blank" rel="noopener" class="text-primary text-sm hover:underline">Ver projeto →</a>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
