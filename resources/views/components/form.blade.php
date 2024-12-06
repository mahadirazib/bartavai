
<form action="{{ $action }}" method="{{ $method ?? 'POST' }}" {{ $attributes->merge(['class' => 'space-y-6']) }} enctype="multipart/form-data">
  @csrf
  @if(strtoupper($method ?? 'POST') !== 'GET' && strtoupper($method ?? 'POST') !== 'POST')
      @method($method)
  @endif

  {{ $slot }}

  @if (isset($buttonText))
    <div class="col-span-full">
        <button
            type="submit"
            class="flex w-full justify-center rounded-md bg-black px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-black focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black">
            {{ $buttonText ?? 'Submit' }}
        </button>
    </div>
  @endif
</form>
