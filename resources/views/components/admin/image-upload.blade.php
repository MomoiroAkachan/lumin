@props([
    'name',
    'label',
    'required' => false,
    'optional' => false,
    'previewUrl' => null,
    'multiple' => false,
    'accept' => 'image/*',
    'hint' => 'JPG, PNG ou WebP. Máx. 4 MB.',
    'colSpan' => 'md:col-span-2',
])

<div {{ $attributes->merge(['class' => "image-upload-group {$colSpan}"]) }} data-image-upload>
    <p class="block text-sm font-semibold text-foreground mb-2">
        {{ $label }}
        @if($required && ! $optional)
            <span class="text-red-600" aria-hidden="true">*</span>
        @elseif($optional)
            <span class="text-xs font-normal text-gray-500">(opcional — mantém a atual se vazio)</span>
        @endif
    </p>

    @if($previewUrl)
        <div class="mb-3 rounded-lg border border-gray-200 bg-surface p-3">
            <p class="text-xs font-medium text-gray-500 mb-2">Imagem atual</p>
            <img src="{{ $previewUrl }}" alt="" class="max-h-36 rounded-md border border-gray-200 object-cover shadow-sm">
        </div>
    @endif

    <label
        class="image-upload-dropzone relative flex flex-col items-center justify-center w-full min-h-44 px-6 py-8 rounded-xl border-2 border-dashed border-primary/50 bg-primary/5 hover:bg-primary/10 hover:border-primary cursor-pointer transition-colors group"
        tabindex="0"
    >
        <div class="flex h-14 w-14 items-center justify-center rounded-full bg-primary/15 text-primary group-hover:bg-primary/25 transition-colors">
            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
        </div>

        <span class="mt-4 text-base font-semibold text-primary">
            Clique para {{ $multiple ? 'escolher imagens' : 'escolher imagem' }}
        </span>
        <span class="mt-1 text-sm text-gray-500">ou arraste e solte aqui</span>

        <span class="image-upload-filename mt-3 hidden max-w-full truncate rounded-full bg-primary/15 px-4 py-1 text-sm font-medium text-primary"></span>

        <input
            type="file"
            name="{{ $name }}"
            accept="{{ $accept }}"
            @if($multiple) multiple @endif
            @if($required && ! $optional && ! $previewUrl) required @endif
            class="absolute inset-0 h-full w-full cursor-pointer opacity-0"
        >
    </label>

    <p class="mt-2 text-xs text-gray-500">{{ $hint }}</p>

    <div class="image-upload-preview mt-3 hidden grid grid-cols-2 sm:grid-cols-4 gap-3"></div>
</div>
