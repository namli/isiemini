@unless ($block->preview)
<div {{ $attributes }}>
  @endunless

  <div class="relative container mx-auto bg-white">
    <div class="mx-auto max-w-7xl lg:grid lg:grid-cols-12 lg:gap-x-8 lg:px-8">
      <div class="px-6 pt-10 pb-24 sm:pb-32 lg:col-span-7 lg:px-0 lg:pt-40 lg:pb-48 xl:col-span-6">
        <div class="mx-auto max-w-lg lg:mx-0">
          @if ($title)
          <h1 class="mt-24 text-5xl font-semibold tracking-tight text-pretty text-gray-900 sm:mt-10 sm:text-7xl">{{ $title }}</h1>
          @endif
          @if ($description)
          <p class="mt-8 text-lg font-medium text-pretty text-gray-500 sm:text-xl/8">{{ $description }}</p>
          @endif
          <div class="mt-10 flex items-center gap-x-6">
            @if ($button_text)
            <a href="{{ $button_url }}" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">{{ $button_text }}</a>
            @endif
            @if ($link_text)
            <a href="{{ $link_url }}" class="text-sm/6 font-semibold text-gray-900">{{ $link_text }} <span aria-hidden="true">→</span></a>
            @endif
          </div>
        </div>
      </div>
      <div class="relative lg:col-span-5 lg:-mr-8 xl:absolute xl:inset-0 xl:left-1/2 xl:mr-0">
        <img class="aspect-3/2 w-full bg-gray-50 object-cover lg:absolute lg:inset-0 lg:aspect-auto lg:h-full" src="{{ $image }}" alt="{{ $image_alt }}" />
      </div>
    </div>
  </div>


  @unless ($block->preview)
</div>
@endunless