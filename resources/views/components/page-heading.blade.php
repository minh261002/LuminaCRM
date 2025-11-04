@props([
    'title' => '',
    'breadcrumbs' => [],
])

<div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
    <div class="flex-grow-1">
        <h4 class="fs-18 fw-semibold m-0">
            {{ $title }}
        </h4>
    </div>

    <div class="text-end d-flex align-items-center gap-2">
        @if (!empty($breadcrumbs))
            <ol class="breadcrumb m-0 py-0">
                @foreach ($breadcrumbs as $index => $breadcrumb)
                    @php $isLast = $index === count($breadcrumbs) - 1; @endphp
                    @if ($isLast)
                        <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb['name'] }}</li>
                    @else
                        <li class="breadcrumb-item"><a
                                href="{{ $breadcrumb['url'] ?? '#' }}">{{ $breadcrumb['name'] }}</a></li>
                    @endif
                @endforeach
            </ol>
        @endif
    </div>
</div>
