<div class="card">
    @if (!empty($title))
    <header class="card-header">
        <p class="card-header-title">
            {!! $title !!}
        </p>
    </header>
    @endif

    {!! @$upperToolbar !!}

    <div class="card-content">
        {!! $slot !!}
    </div>

    @if(!empty($footer))
    <footer class="card-footer">
        {!! $footer !!}
    </footer>
    @endif
</div>