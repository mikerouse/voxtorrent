@props(['item', 'index', 'parent'])
<li {{ $attributes->merge([
    'class' => 'wep-spotlight-item',
    '@click' => "select",
    '@mouseover' => "selectedItem = {$index}; selectedGroup = {$parent};",
    ':class' => "{ 'wep-spotlight-item-active': (selectedItem === {$index} && selectedGroup == {$parent}) }",
    'wire:key' => $item->fingerprint(),
    'role' => 'option',
]) }}
    x-data="{ typeahead: @js($item->typeahead()), action: @js($item->action()->toArray()), tokens: @js($item->tokens()->toArray()) }">
    {{ $slot }}
</li>
