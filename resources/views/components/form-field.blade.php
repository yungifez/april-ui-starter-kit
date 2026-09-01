@props([
    'name',
    'label',
    'type' => 'text',
    'value' => null,
    'placeholder' => null,
    'autocomplete' => null,
])

<div class="space-y-2">
    <april:label for="{{ $name }}">{{ $label }}</april:label>
    <april:input
        id="{{ $name }}"
        name="{{ $name }}"
        type="{{ $type }}"
        :value="$value ?? old($name)"
        @if ($placeholder) placeholder="{{ $placeholder }}" @endif
        @if ($autocomplete) autocomplete="{{ $autocomplete }}" @endif
        {{ $attributes }}
    />
    @error($name)
        <p class="text-sm text-destructive">{{ $message }}</p>
    @enderror
</div>
