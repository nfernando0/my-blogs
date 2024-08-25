@props(['title'])
<div x-data ="{ show:false }" x-show = "show" x-on:open-modal.window= "show=true" x-on:close-modal.window= "show=false"
    x-on:keydown.escape.window="show=false" x-transition class="fixed z-50 inset-0">

    <div x-on:click="show=false" class="fixed inset-0 bg-gray-300 opacity-40"></div>
    <div class="bg-white rounded m-auto fixed inset-0 p-5 max-w-2xl max-h-[70vh]">
        <button x-on:click="$dispatch('close-modal')">
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M6 18 17.94 6M18 18 6.06 6" />
        </svg>

    </button>
    <div>
            <h2 class="text-xl font-semibold my-4 text-center">{{ $title }}</h2>
            {{ $body }}
        </div>
    </div>
</div>
