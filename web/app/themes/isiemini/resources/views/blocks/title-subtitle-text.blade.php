@php
  // Определяем классы выравнивания текста
  $textAlignClass = match($alignment) {
    'left' => 'text-left',
    'right' => 'text-right',
    default => 'text-center',
  };
  
  // Определяем классы выравнивания flex контейнера для кнопки
  $flexAlignClass = match($alignment) {
    'left' => 'justify-start',
    'right' => 'justify-end',
    default => 'justify-center',
  };
  
  // Определяем классы для контейнера блока
  $containerAlignClass = match($alignment) {
    'left' => 'lg:text-left',
    'right' => 'lg:text-right',
    default => 'lg:text-center',
  };
@endphp

@unless ($block->preview)
<div {{ $attributes }}>
  @endunless

  <div class="py-24 sm:py-32">
    <div class="container mx-auto px-6 lg:px-8">
      <div class="mx-auto max-w-2xl {{ $containerAlignClass }}">
        @if ($subtitle)
        <p class="text-base/7 font-semibold text-primary {{ $textAlignClass }}">{{ $subtitle }}</p>
        @endif
        @if ($title)
        <h2 class="mt-2 text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl lg:text-balance {{ $textAlignClass }}">{{ $title }}</h2>
        @endif
        @if ($text)
        <p class="mt-6 text-lg/8 text-gray-600 {{ $textAlignClass }}">{!! $text !!}</p>
        @endif
        @if ($button_text)
        <div class="mt-10 flex items-center {{ $flexAlignClass }} gap-x-6">
          <a href="{{ $button_url }}" 
             target="{{ $button_target }}" 
             rel="{{ $button_rel }}"
             class="btn-primary">
            {{ $button_text }}
          </a>
        </div>
        @endif
      </div>
    </div>
  </div>

  @unless ($block->preview)
</div>
@endunless
