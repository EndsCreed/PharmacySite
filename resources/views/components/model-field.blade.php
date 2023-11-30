@props(['label'])

<div class="mx-4 px-2 py-4 border-t border-gray-500 grid grid-cols-3 items-center">
    <dt class="text-md font-medium leading-6 text-white">
        {{ $label }}
    </dt>
    <dd class="mt-1 text-md leading-6 text-gray-400 sm:col-span-2 sm:mt-0 span-2">
        {{ $slot }}
    </dd>
</div>
