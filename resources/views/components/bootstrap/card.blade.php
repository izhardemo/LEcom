<div {{ $attributes->merge(['class'=> 'card radius-10 w-100', 'style']) }} >
    <div class="card-body">
        <div class="d-flex justify-content-between">
            {{-- Header --}}
            <div class="d-flex flex-column justify-content-center">
                {{-- Card title --}}
                @if (isset($title))
                    {{$title}}
                @endif
                {{-- Card Subtitle --}}
                @if (isset($subTitle))
                    {{$subTitle}}
                @endif
            </div>
            {{-- Controls --}}
            @if (isset($controls))
            <div class="d-flex justify-content-between align-items-start">
                {{$controls}}
            </div>
            @endif
        </div>
        {{-- Content --}}
        @if (isset($content))
            {{$content}}
        @else
            {{$slot}}
        @endif
    </div>
    @if (isset($footer))
        <div class="card-footer">
            {{$footer}}
        </div>
    @endif
</div>