<section id="contato" class="py-16 bg-surface">
    <div class="container max-w-3xl">
        <h2 class="text-3xl font-bold text-center mb-2">Entre em contato</h2>
        <p class="text-center text-gray-500 mb-8">Conte-nos sobre seu projeto. Respondemos em até 1 dia útil.</p>

        @if(session('contact-sent'))
            <div class="mb-6 rounded border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                Mensagem enviada com sucesso! Em breve entraremos em contato.
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 rounded border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('contact.store') }}" method="POST"
              class="bg-interface rounded-lg border border-gray-200 p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
            @csrf

            <input type="text" name="website" value="" tabindex="-1" autocomplete="off"
                   class="absolute -left-[9999px] opacity-0" aria-hidden="true">

            <div>
                <label class="block text-sm font-medium mb-1">Nome *</label>
                <input type="text" name="name" required maxlength="120" value="{{ old('name') }}"
                       class="w-full rounded border border-gray-300 px-3 py-2 focus:border-primary focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">E-mail *</label>
                <input type="email" name="email" required maxlength="160" value="{{ old('email') }}"
                       class="w-full rounded border border-gray-300 px-3 py-2 focus:border-primary focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Telefone / WhatsApp</label>
                <input type="text" name="phone" maxlength="40" value="{{ old('phone') }}"
                       class="w-full rounded border border-gray-300 px-3 py-2 focus:border-primary focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Serviço de interesse</label>
                <select name="service_id" class="w-full rounded border border-gray-300 px-3 py-2 focus:border-primary focus:outline-none">
                    <option value="">— Selecione (opcional)</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                            {{ $service->title }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium mb-1">Assunto</label>
                <input type="text" name="subject" maxlength="160" value="{{ old('subject') }}"
                       class="w-full rounded border border-gray-300 px-3 py-2 focus:border-primary focus:outline-none">
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium mb-1">Mensagem *</label>
                <textarea name="message" required rows="5" maxlength="5000"
                          class="w-full rounded border border-gray-300 px-3 py-2 focus:border-primary focus:outline-none">{{ old('message') }}</textarea>
            </div>
            <div class="md:col-span-2 flex justify-end">
                <button type="submit" class="px-6 py-3 bg-primary text-primary-fg rounded font-medium hover:opacity-90">
                    Enviar mensagem
                </button>
            </div>
        </form>
    </div>

    <script>
        document.querySelectorAll('.js-service-cta').forEach((link) => {
            link.addEventListener('click', () => {
                const select = document.querySelector('select[name="service_id"]');
                if (select) {
                    select.value = link.dataset.serviceId;
                }
            });
        });
    </script>
</section>
