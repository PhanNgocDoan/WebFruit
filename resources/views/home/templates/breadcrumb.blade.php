<div class="breadcrumb-homne">
    <div class="wrap-content">
        @foreach ($breadcrumbs as $breadcrumb)
        <a href="{{ $breadcrumb['link'] }}">{{ $breadcrumb['name'] }}</a>
        @if (!$loop->last)
        /
        @endif
        @endforeach
    </div>
</div>