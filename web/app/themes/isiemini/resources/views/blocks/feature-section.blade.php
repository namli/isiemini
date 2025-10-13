@unless ($block->preview)
<div {{ $attributes }}>
  @endunless

  <div class="py-24 sm:py-32">
    <div class="mx-auto container px-6 lg:px-8">
      <div class="mx-auto max-w-2xl lg:mx-0">
        @if ($title)
        <h2 class="text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl">{{ $title }}</h2>
        @endif
        @if ($description)
        <p class="mt-6 text-lg/8 text-gray-600">{{ $description }}</p>
        @endif
      </div>

      @if ($features && count($features) > 0)
      <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
        <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-3">
          @foreach ($features as $feature)
          <div class="flex flex-col">
            <dt class="text-base/7 font-semibold text-gray-900">
              @if ($feature['icon'] && $feature['icon'] !== 'IMAGE')
              <div class="mb-6 flex size-10 items-center justify-center rounded-lg bg-primary-light">
                <div class="size-6">
                  {!! $feature['icon'] !!}
                </div>
              </div>
              @endif
              {{ $feature['title'] }}
            </dt>
            <dd class="mt-1 flex flex-auto flex-col text-base/7 text-gray-600">
              @if ($feature['description'])
              <p class="flex-auto">{{ $feature['description'] }}</p>
              @endif
              @if ($feature['link_text'])
              <p class="mt-6">
                <a href="{{ $feature['link_url'] }}" class="text-sm/6 font-semibold text-primary hover:text-primary-dark">{{ $feature['link_text'] }} <span aria-hidden="true">→</span></a>
              </p>
              @endif
            </dd>
          </div>
          @endforeach
        </dl>
      </div>

      @else
      <p>{{ $block->preview ? 'Add an feature...' : 'No features found!' }}</p>
      @endif

    </div>
  </div>


  @unless ($block->preview)
</div>
@endunless