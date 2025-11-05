@props(['title', 'pretitle' => null, 'breadcrumbs' => []])

<div class="page-header d-print-none" aria-label="Page header">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                @if ($pretitle)
                    <div class="page-pretitle">{{ $pretitle }}</div>
                @endif
                <h2 class="page-title">{{ $title }}</h2>
            </div>
            @if (!empty($breadcrumbs))
                <div class="col-auto ms-auto d-print-none">
                    <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
                        @foreach ($breadcrumbs as $index => $breadcrumb)
                            @php
                                $isLast = $index === count($breadcrumbs) - 1;
                                $isActive = $isLast && !isset($breadcrumb['url']);
                            @endphp
                            <li class="breadcrumb-item {{ $isActive ? 'active' : '' }}"
                                @if ($isActive) aria-current="page" @endif>
                                @if (isset($breadcrumb['url']) && !$isActive)
                                    <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['name'] }}</a>
                                @else
                                    <a href="#">{{ $breadcrumb['name'] }}</a>
                                @endif
                            </li>
                        @endforeach
                    </ol>
                </div>
            @endif
        </div>
    </div>
</div>
