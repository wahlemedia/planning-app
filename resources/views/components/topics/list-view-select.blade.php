@props(['label', 'value', 'current'])



<label {{ $attributes }}
    class="
    flex items-center justify-center first-of-type:rounded-l-md last-of-type:rounded-r-md py-3 px-3 text-sm font-semibold uppercase sm:flex-1 cursor-pointer focus:outline-none
    ring-inset first-of-type:-mr-px ring-1 {{ $current === $value ? 'bg-indigo-600 text-white hover:bg-indigo-500' : 'bg-white text-gray-900 hover:bg-gray-50' }}">
    <input type="radio" name="list-view-option" value="{{ $value }}" class="sr-only"
        aria-labelledby="list-view-option-{{ $value }}">
    <span id="list-view-option-{{ $value }}">{{ $label }}</span>
</label>
