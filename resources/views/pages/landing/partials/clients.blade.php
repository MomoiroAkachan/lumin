<section id="clientes" class="py-16 bg-surface">
    <div class="container">
        <h2 class="text-3xl font-bold text-center mb-10">Clientes &amp; Parceiros</h2>

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8 items-center">
            @foreach($logos as $logo)
                @if($logo->link)
                    <a href="{{ $logo->link }}" target="_blank" rel="noopener" class="grayscale hover:grayscale-0 transition opacity-70 hover:opacity-100">
                        <img src="{{ media_url($logo->logo_path) }}" alt="{{ $logo->name }}" class="h-12 w-full object-contain">
                    </a>
                @else
                    <img src="{{ media_url($logo->logo_path) }}" alt="{{ $logo->name }}"
                         class="h-12 w-full object-contain grayscale hover:grayscale-0 transition opacity-70 hover:opacity-100">
                @endif
            @endforeach
        </div>
    </div>
</section>
