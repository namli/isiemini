@unless ($block->preview)
<div {{ $attributes }}>
  @endunless

  @if ($items)
  <div class="container mx-auto">
    <ul>
      @foreach ($items as $item)
      <li>{{ $item['item'] }}</li>
      @endforeach
    </ul>
  </div>
  @else
  <p>{{ $block->preview ? 'Add an item...' : 'No items found!' }}</p>
  @endif

  <div>
    <InnerBlocks template="{{ $block->template }}" />
  </div>

  @unless ($block->preview)
</div>
@endunless