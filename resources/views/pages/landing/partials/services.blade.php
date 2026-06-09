<section id="servicos" class="py-16 bg-surface">
    <div class="max-w-[95%] card-accent mx-auto w-full bg-zinc-800 text-white pb-9">
        <h2 class="text-3xl font-bold text-center my-9 mb-2">Serviços</h2>
        <p class="text-center text-gray-500 mb-10">Soluções tecnológicas para sua empresa</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 text-foreground">
            @foreach($services as $service)
                <div class="bg-interface rounded-lg border border-gray-200 p-6 hover:shadow-lg transition">
                    @if($service->icon_path)
                        <img src="{{ media_url($service->icon_path) }}" alt="" class="h-12 w-12 mb-4">
                    @elseif($service->icon)
                        <div class="h-12 w-12 mb-4 rounded bg-primary/10 flex items-center justify-center text-primary">
                            <x-site.icon :name="$service->icon" class="w-7 h-7" />
                        </div>
                    @endif
                    <h3 class="text-xl font-semibold mb-2">{{ $service->title }}</h3>
                    <p class="text-gray-600 text-sm mb-4">{{ $service->short_description }}</p>
                    <a href="#contato" data-service-id="{{ $service->id }}"
                       class="js-service-cta inline-block text-primary text-sm font-medium hover:underline">
                        Solicitar orçamento →
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
