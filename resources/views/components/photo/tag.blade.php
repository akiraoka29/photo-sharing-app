<ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
    <li data-filter="*" class="filter-active">All</li>
    @foreach($tag as $tg) 
    <li data-filter=".filter-{{ strtolower($tg->name) }}">{{ $tg->name }}</li>
    @endforeach
</ul><!-- End Portfolio Filters -->