@props([
    'items' => [],
])

@php
    $items = \Pnscripts\FilamentFaqAccordion\Forms\Components\FaqList::normalize(is_array($items) ? $items : []);
@endphp

@if ($items !== [])
<div
    class="pnscripts-faq"
    data-pnscripts-faq
    x-data="{ open: 0 }"
>
    @foreach ($items as $index => $item)
        @php
            $buttonId = 'pnscripts-faq-button-'.$index;
            $panelId = 'pnscripts-faq-panel-'.$index;
            $open = $index === 0;
        @endphp
        <div class="pnscripts-faq__item">
            <h3 class="pnscripts-faq__heading">
                <button
                    type="button"
                    class="pnscripts-faq__button"
                    id="{{ $buttonId }}"
                    aria-expanded="{{ $open ? 'true' : 'false' }}"
                    aria-controls="{{ $panelId }}"
                    @click="open = {{ $index }}"
                    :aria-expanded="(open === {{ $index }}).toString()"
                >
                    {{ $item['question'] }}
                </button>
            </h3>
            <div
                class="pnscripts-faq__panel"
                id="{{ $panelId }}"
                role="region"
                aria-labelledby="{{ $buttonId }}"
                @if (! $open) hidden @endif
                x-show="open === {{ $index }}"
                x-cloak
            >
                <div class="pnscripts-faq__answer">{!! $item['answer'] !!}</div>
            </div>
        </div>
    @endforeach
</div>

<style>
    .pnscripts-faq { display: flex; flex-direction: column; gap: 0.5rem; max-width: 42rem; }
    .pnscripts-faq__item { border: 1px solid #d4d4d4; border-radius: 0.35rem; background: #fff; }
    .pnscripts-faq__heading { margin: 0; font-size: 1rem; }
    .pnscripts-faq__button { display: flex; width: 100%; align-items: center; justify-content: space-between; gap: 0.75rem; margin: 0; padding: 0.85rem 1rem; border: 0; background: transparent; font: inherit; font-weight: 600; text-align: left; cursor: pointer; }
    .pnscripts-faq__button::after { content: "+"; font-weight: 400; }
    .pnscripts-faq__button[aria-expanded="true"]::after { content: "−"; }
    .pnscripts-faq__button:focus-visible { outline: 2px solid #1d4ed8; outline-offset: 2px; }
    .pnscripts-faq__panel { padding: 0 1rem 1rem; }
    [x-cloak] { display: none !important; }
</style>

<script>
(function () {
    if (window.Alpine) {
        return;
    }

    function rootOf(node) {
        return node.closest("[data-pnscripts-faq]");
    }

    function buttonsIn(root) {
        return Array.prototype.slice.call(root.querySelectorAll(".pnscripts-faq__button"));
    }

    function setOpen(button, open) {
        var panelId = button.getAttribute("aria-controls");
        var panel = panelId ? document.getElementById(panelId) : null;
        button.setAttribute("aria-expanded", open ? "true" : "false");
        if (panel) {
            if (open) {
                panel.removeAttribute("hidden");
                panel.style.display = "";
            } else {
                panel.setAttribute("hidden", "");
                panel.style.display = "none";
            }
        }
    }

    document.addEventListener("click", function (event) {
        var button = event.target.closest(".pnscripts-faq__button");
        if (!button) {
            return;
        }
        var root = rootOf(button);
        if (!root) {
            return;
        }
        var expanded = button.getAttribute("aria-expanded") === "true";
        buttonsIn(root).forEach(function (item) {
            setOpen(item, item === button ? !expanded : false);
        });
    });

    document.addEventListener("keydown", function (event) {
        var button = event.target.closest(".pnscripts-faq__button");
        if (!button) {
            return;
        }
        var root = rootOf(button);
        if (!root) {
            return;
        }
        var buttons = buttonsIn(root);
        var index = buttons.indexOf(button);
        if (index < 0) {
            return;
        }
        var next = index;
        if (event.key === "ArrowDown") {
            next = (index + 1) % buttons.length;
        } else if (event.key === "ArrowUp") {
            next = (index - 1 + buttons.length) % buttons.length;
        } else if (event.key === "Home") {
            next = 0;
        } else if (event.key === "End") {
            next = buttons.length - 1;
        } else {
            return;
        }
        event.preventDefault();
        buttons[next].focus();
    });
})();
</script>
@endif
