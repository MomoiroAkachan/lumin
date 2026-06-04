<footer class="bg-gray-900 text-gray-300 py-12">
    <div class="container grid grid-cols-1 md:grid-cols-4 gap-8">
        <div>
            <h3 class="text-white text-lg font-semibold mb-3">{{ $settings['company_name'] ?? config('app.name') }}</h3>
            <p class="text-sm">{{ $settings['footer_about'] ?? ($settings['company_tagline'] ?? '') }}</p>
        </div>

        <div>
            <h4 class="text-white font-semibold mb-3">Contato</h4>
            <ul class="space-y-2 text-sm">
                @if($settings['contact_email'] ?? false)
                    <li>📧 <a href="mailto:{{ $settings['contact_email'] }}" class="hover:text-white">{{ $settings['contact_email'] }}</a></li>
                @endif
                @if($settings['contact_phone'] ?? false)
                    <li>📞 {{ $settings['contact_phone'] }}</li>
                @endif
                @if($settings['contact_whatsapp'] ?? false)
                    <li>💬 <a href="https://wa.me/{{ preg_replace('/\D+/', '', $settings['contact_whatsapp']) }}" target="_blank" rel="noopener" class="hover:text-white">WhatsApp</a></li>
                @endif
                @if($settings['contact_address'] ?? false)
                    <li>📍 {{ $settings['contact_address'] }}</li>
                @endif
            </ul>
        </div>

        <div>
            <h4 class="text-white font-semibold mb-3">Navegação</h4>
            <ul class="space-y-2 text-sm">
                <li><a href="#servicos" class="hover:text-white">Serviços</a></li>
                <li><a href="#portfolio" class="hover:text-white">Portfólio</a></li>
                <li><a href="#qualidades" class="hover:text-white">A empresa</a></li>
                <li><a href="#contato" class="hover:text-white">Contato</a></li>
            </ul>
        </div>

        <div>
            <h4 class="text-white font-semibold mb-3">Redes Sociais</h4>
            <ul class="space-y-2 text-sm">
                @foreach(['instagram' => 'Instagram', 'facebook' => 'Facebook', 'linkedin' => 'LinkedIn', 'youtube' => 'YouTube'] as $key => $label)
                    @php $url = $settings['social_'.$key] ?? null; @endphp
                    @if($url)
                        <li><a href="{{ $url }}" target="_blank" rel="noopener" class="hover:text-white">{{ $label }}</a></li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>

    <div class="container mt-8 pt-6 border-t border-gray-700 text-center text-xs text-gray-500">
        © {{ now()->year }} {{ $settings['company_name'] ?? config('app.name') }}. Todos os direitos reservados.
    </div>
</footer>
