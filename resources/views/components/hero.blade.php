<!-- Hero Section - Home Page -->
<section id="hero" class="hero">

    <img src="{{ asset($image) }}" alt="" data-aos="fade-in">

    <div class="container">
        <div class="row mx-auto">
            <div class="col-lg-7">
                <h2 data-aos="fade-up" data-aos-delay="100" style="font-size:48px;">{{ $title }}</h2>
                <p data-aos="fade-up" data-aos-delay="200">{{ $description }}</p>
            </div>
            <div class="col-lg-5">
                <x-form.search />
            </div>
        </div>
    </div>

</section><!-- End Hero Section -->