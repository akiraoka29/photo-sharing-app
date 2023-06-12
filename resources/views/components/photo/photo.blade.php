<div class="col-lg-4 col-md-6 portfolio-item isotope-item {{ strtolower($tags->pluck('name')->map(function($tag) {return 'filter-'.$tag;})->implode(' ')) }}" style="cursor: pointer;">
    <img src="{{ asset('storage/'.$path.'/'.$fileName) }}" class="img-fluid" alt="">
    <div class="portfolio-info">
        <h4>{{ $title }}</h4>
        <p>{{ $caption }}</p>
        <a href="{{ asset('storage/'.$path.'/'.$fileName) }}" title="{{ $title }}"
            data-gallery="portfolio-gallery-app" data-tags="{{ strtolower($tags->pluck('name')->implode(' ')) }}" data-description="{{ $caption }}" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
        <a href="javascript:void(0)" title="Like" class="details-link like-button"><i class="bi bi-heart"></i></a>
    </div>
</div><!-- End Portfolio Item -->