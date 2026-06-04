<section id="depoimentos" class="py-16">
    <div class="container">
        <h2 class="text-3xl font-bold text-center mb-10">O que dizem nossos clientes</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($testimonials as $t)
                <blockquote class="bg-interface rounded-lg border border-gray-200 p-6">
                    @if($t->rating)
                        <div class="text-amber-500 text-lg mb-2">{{ str_repeat('★', $t->rating) }}{{ str_repeat('☆', 5 - $t->rating) }}</div>
                    @endif
                    <p class="text-gray-700 italic mb-4">“{{ $t->content }}”</p>
                    <footer class="flex items-center gap-3">
                        @if($t->photo_path)
                            <img src="{{ media_url($t->photo_path) }}" alt="" class="h-12 w-12 rounded-full object-cover">
                        @endif
                        <div>
                            <p class="font-semibold">{{ $t->name }}</p>
                            @if($t->role_company)
                                <p class="text-sm text-gray-500">{{ $t->role_company }}</p>
                            @endif
                        </div>
                    </footer>
                </blockquote>
            @endforeach
        </div>
    </div>
</section>
