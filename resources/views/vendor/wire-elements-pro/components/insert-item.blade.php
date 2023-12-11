@props(['item', 'index'])
<li {{ $attributes->merge([
    'class' => 'wep-insert-item',
    'x-bind:data-id' => $item['id'],
    '@click' => "select({$item['id']})",
    ':class' => "{ 'wep-insert-item-active': selected === {$index} }",
    'wire:key' => $item['id'],
    'role' => 'option',
]) }}>
    {{ $slot }}
</li>
