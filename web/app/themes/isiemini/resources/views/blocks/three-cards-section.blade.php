@unless ($block->preview)
<div {{ $attributes }}>
  @endunless

  <form class="group/tiers bg-white py-24 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
      <div class="mx-auto max-w-4xl text-center">
        <p class="mt-2 text-5xl font-semibold tracking-tight text-balance text-gray-900 sm:text-6xl">{{ $title }}</p>
        @if ($description)
        <p class="mx-auto mt-6 max-w-2xl text-center text-lg font-medium text-pretty text-gray-600 sm:text-xl/8">{{ $description }}</p>
        @endif
      </div>
      <p class="mx-auto mt-6 max-w-2xl text-center text-lg font-medium text-pretty text-gray-600 sm:text-xl/8">{{ $description }}</p>
      <div class="mt-16 flex justify-center">
        <div class="isolate mx-auto mt-10 grid max-w-md grid-cols-1 gap-8 lg:mx-0 lg:max-w-none lg:grid-cols-3">
          @foreach ($cards as $card)
          <div class="group/tier rounded-3xl p-8 ring-1 ring-gray-200 data-featured:ring-2 data-featured:ring-indigo-600 xl:p-10">
            <h3 id="tier-freelancer" class="mt-2 text-xl/8 font-semibold tracking-tight text-balance text-gray-900 sm:text-3xl">{{ $card['title'] }}</h3>
            <p class="mt-6 text-lg/6 font-semibold text-gray-900 group-data-featured/tier:text-indigo-600">{{ $card['subtitle'] }}</p>
            <p class="mt-4 text-sm/6 text-gray-600">{{ $card['description'] }}</p>
            @if ($card['items'])
            <ul role="list" class="mt-8 space-y-3 text-sm/6 text-gray-600 xl:mt-10">
              @foreach ($card['items'] as $item)
              <li class="flex gap-x-3">
                <div class="h-6 w-6 ">
                  <svg class="h-6 w-5 max-w-[20px] max-h-[20px] flex-none text-secondary" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                  </svg>
                </div>
                {{ $item['item'] }}
              </li>
              @endforeach
            </ul>
            @endif
            @if ($card['button_text'])
            <div class="mt-6">
              <a href="{{ $card['button_url'] }}" class="btn-primary">{{ $card['button_text'] }}</a>
            </div>
            @endif
          </div>
          @endforeach
        </div>
      </div>
  </form>


  @unless ($block->preview)
</div>
@endunless