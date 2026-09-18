@props(['is' => 'a'])

{{-- this specify what the tag is, by default is an anchor tag --}}

<{{ $is }} {{ $attributes(['class' => 'border border-border rounded-lg bg-card p-4 md:text-sm block']) }}>
    {{ $slot }}
</{{ $is }}>
