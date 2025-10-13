<header class="container mx-auto" x-data="{ mobileMenuOpen: false }">
  <nav class="mx-auto flex w-full items-center justify-between p-6 lg:px-8" aria-label="Global">
    <a href="/" class="-m-1.5 p-1.5">
      <span class="text-2xl font-bold">{{ $siteName }}</span>
    </a>
    <div class="flex lg:hidden">
      <button type="button" @click="mobileMenuOpen = true" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
        <span class="sr-only">Open main menu</span>
        <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
      </button>
    </div>
    <div class="hidden lg:flex lg:gap-x-12 justify-end">
      <div class="flex gap-x-12">
        @if ($primaryMenu)
        @foreach ($primaryMenu as $item)
        <a
          href="{{ $item->url }}"
          class="text-sm/6 font-semibold text-gray-900 no-underline flex items-center"

          aria-current="{{ $item->is_current ? 'page' : 'false' }}">
          {{ $item->title }}
        </a>
        @endforeach
        @endif
      </div>
      <div class="shrink-0">
        <a class="btn-secondary" href="#">
          Записаться на консультацию
        </a>
      </div>
    </div>


  </nav>
  <!-- Mobile menu, show/hide based on menu open state. -->
  <div x-show="mobileMenuOpen" x-cloak class="lg:hidden" role="dialog" aria-modal="true">
    <!-- Background backdrop, show/hide based on slide-over state. -->
    <div class="fixed inset-0 z-50" @click="mobileMenuOpen = false"></div>
    <div class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white p-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
      <div class="flex items-center justify-between">
        <a href="/" class="-m-1.5 p-1.5">
          <span class="sr-only">{{ $siteName }}</span>
          <img class="h-8 w-auto" src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600" alt="" />
        </a>
        <button type="button" @click="mobileMenuOpen = false" class="-m-2.5 rounded-md p-2.5 text-gray-700">
          <span class="sr-only">Close menu</span>
          <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      <div class="mt-6 flow-root">
        <div class="-my-6 divide-y divide-gray-500/10">
          <div class="space-y-2 py-6">
            @if ($primaryMenu)
            @foreach ($primaryMenu as $item)
            <a href="{{ $item->url }}" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">{{ $item->title }}</a>
            @endforeach
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</header>