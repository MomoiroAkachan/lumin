import { initSortableLists } from "./sortablesList";

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-image-upload]').forEach((group) => {
        const input = group.querySelector('input[type="file"]');
        const dropzone = group.querySelector('.image-upload-dropzone');
        const filenameEl = group.querySelector('.image-upload-filename');
        const previewEl = group.querySelector('.image-upload-preview');

        if (! input || ! dropzone) {
            return;
        }

        const showPreviews = (files) => {
            if (! previewEl) {
                return;
            }

            previewEl.innerHTML = '';
            previewEl.classList.add('hidden');

            if (! files?.length) {
                return;
            }

            previewEl.classList.remove('hidden');

            Array.from(files).forEach((file) => {
                if (! file.type.startsWith('image/')) {
                    return;
                }

                const img = document.createElement('img');
                img.className = 'h-24 w-full rounded-lg border border-gray-200 object-cover shadow-sm';
                img.alt = file.name;
                img.src = URL.createObjectURL(file);
                previewEl.appendChild(img);
            });
        };

        const updateFilename = (files) => {
            if (! filenameEl) {
                return;
            }

            if (! files?.length) {
                filenameEl.textContent = '';
                filenameEl.classList.add('hidden');

                return;
            }

            filenameEl.textContent = files.length === 1
                ? files[0].name
                : `${files.length} arquivos selecionados`;

            filenameEl.classList.remove('hidden');
        };

        input.addEventListener('change', () => {
            updateFilename(input.files);
            showPreviews(input.files);
        });

        ['dragenter', 'dragover'].forEach((eventName) => {
            dropzone.addEventListener(eventName, (event) => {
                event.preventDefault();
                dropzone.classList.add('border-primary', 'bg-primary/15', 'ring-2', 'ring-primary/30');
            });
        });

        ['dragleave', 'drop'].forEach((eventName) => {
            dropzone.addEventListener(eventName, (event) => {
                event.preventDefault();
                dropzone.classList.remove('border-primary', 'bg-primary/15', 'ring-2', 'ring-primary/30');
            });
        });

        dropzone.addEventListener('drop', (event) => {
            const files = event.dataTransfer?.files;

            if (! files?.length) {
                return;
            }

            const dataTransfer = new DataTransfer();
            Array.from(files).forEach((file) => dataTransfer.items.add(file));
            input.files = dataTransfer.files;

            updateFilename(input.files);
            showPreviews(input.files);
        });
    });

    initIconPickers();
    initSortableLists();
});

function initIconPickers() {
    document.querySelectorAll('[data-icon-picker]').forEach((picker) => {
        const input = picker.querySelector('[data-icon-input]');
        const labelEl = picker.querySelector('[data-icon-selected-label]');
        const clearBtn = picker.querySelector('[data-icon-clear]');

        const setSelected = (slug, labelText) => {
            input.value = slug ?? '';
            if (labelEl) {
                labelEl.textContent = labelText ?? 'Nenhum';
            }
            if (clearBtn) {
                clearBtn.classList.toggle('hidden', ! slug);
            }
            picker.querySelectorAll('[data-icon-option]').forEach((btn) => {
                const active = btn.dataset.iconOption === slug;
                btn.classList.toggle('border-primary', active);
                btn.classList.toggle('bg-primary/10', active);
                btn.classList.toggle('text-primary', active);
                btn.classList.toggle('border-transparent', ! active);
            });
        };

        picker.querySelectorAll('[data-icon-option]').forEach((btn) => {
            btn.addEventListener('click', () => {
                const slug = btn.dataset.iconOption;
                const labelText = btn.querySelector('span')?.textContent?.trim() ?? slug;
                setSelected(slug, labelText);
            });
        });

        clearBtn?.addEventListener('click', () => setSelected('', 'Nenhum'));
    });
}