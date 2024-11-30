<div>
    @if($label ?? false)
        <label for="{{ $name }}" class="block text-sm font-medium leading-6 text-gray-900">
            {{ $label }} @if($attributes->has('required'))<span class="text-red-600">*</span>@endif
        </label>
    @endif
    <div class="mt-2">
        <input
            id="{{ $name }}"
            name="{{ $name }}"
            type="{{ $type ?? 'text' }}"
            value="{{ old($name, $value ?? '') }}"
            placeholder="{{ $placeholder ?? '' }}"
            {{ $attributes->merge(['class' => 'block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6']) }}
        />
    </div>
    @error($name)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
