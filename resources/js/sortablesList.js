import Sortable from "sortablejs";

export function initSortableLists() {
    const csrf = document.querySelector('meta[name="csrf-token"]')?.content;
    const reorderUrl = document.querySelector('meta[name="admin-reorder-url"]')?.content;

    if (!csrf || !reorderUrl) {
        return;
    }

    document.querySelectorAll('[data-sortable-list]').forEach((list) => {
        const resource = list.dataset.resource;

        const items = () => [...list.querySelectorAll('[data-sortable-item]')];

        const updatePositions = () => {
            items().forEach((item, index) => {
                const badge = item.querySelector('[data-sortable-position]');
                if (badge) {
                    badge.textContent = String(index);
                }
            });
        };

        const persistOrder = async () => {
            const order = items().map((item) => Number(item.dataset.id));

            const response = await fetch(reorderUrl, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": csrf,
                },
                body: JSON.stringify({ resource, order }),
            });

            if (!response.ok) {
                window.location.reload();
            }
        };

        Sortable.create(list, {
            animation: 150,
            handle: "[data-sortable-handle]",
            draggable: "[data-sortable-item]",
            ghostClass: "drag-ghost",
            chosenClass: "drag-chosen",
            dragClass: "drag-class",
            delay: 200,

            onEnd() {
                updatePositions();
                persistOrder();
            },
        });
    });
}