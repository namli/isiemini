@unless ($block->preview)
<div {{ $attributes }}>
@endunless

<div class="relative bg-white">
  <div class="mx-auto max-w-7xl lg:flex lg:justify-between lg:px-8 
       {{ $image_position === 'right' ? 'xl:justify-start' : 'xl:justify-end' }}">
    
    {{-- Image Section --}}
    <div class="lg:flex lg:w-1/2 lg:shrink lg:grow-0 xl:absolute xl:inset-y-0 xl:w-1/2
         {{ $image_position === 'right' ? 'xl:left-1/2' : 'xl:right-1/2' }}">
      <div class="relative h-80 lg:h-auto lg:w-full lg:grow
           {{ $image_position === 'right' ? 'lg:-mr-8 xl:mr-0' : 'lg:-ml-8 xl:ml-0' }}">
        @if ($image)
        <img class="absolute inset-0 size-full bg-gray-50 object-cover" 
             src="{{ $image }}" 
             alt="{{ $image_alt }}" />
        @endif
      </div>
    </div>

    {{-- Content Section --}}
    <div class="px-6 lg:contents">
      <div class="mx-auto max-w-2xl pt-16 pb-24 sm:pt-20 sm:pb-32 lg:w-full lg:max-w-lg lg:flex-none lg:pt-32 xl:w-1/2
           {{ $image_position === 'right' ? 'lg:ml-0 lg:mr-8' : 'lg:mr-0 lg:ml-8' }}">
        @if ($title)
        <h1 class="mt-2 text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl">
          {{ $title }}
        </h1>
        @endif
        
        @if ($description)
        <p class="mt-6 text-xl/8 text-gray-700">
          {{ $description }}
        </p>
        @endif
        
        @if ($content)
        <div class="mt-10 max-w-xl text-base/7 text-gray-600 lg:max-w-none">
          {!! $content !!}
        </div>
        @endif
      </div>
    </div>
  </div>
</div>

@unless ($block->preview)
</div>
@endunless