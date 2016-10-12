<div class="panel wtg-panel-info">
    <div class="panel-heading text-center">Merken</div>

    <div id="brand-filter" class="list-group search-filter">
        <a data-filter="" href="#" class="list-group-item {{ (!request('brand') ? 'active' : '') }}">Geen merk filter</a>

        @foreach($brands as $brand)
            <a data-filter="{{ $brand }}" href="#" class="list-group-item {{ (request('brand') === $brand ? 'active' : '') }}">{{ $brand }}</a>
        @endforeach
    </div>
</div>

<script type="text/javascript">
    $('#brand-filter a').on('click', function (e) {
        e.preventDefault();
        window.brandFilter = $(this).data('filter');
        filter();
    });
</script>