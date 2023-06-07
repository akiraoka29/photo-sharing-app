<!-- Hero Section - Home Page -->
<section id="hero" class="hero">

    <img src="{{ asset($image) }}" alt="" data-aos="fade-in">

    <div class="container">
        <div class="row">
            <div class="col-lg-10">
                <h2 data-aos="fade-up" data-aos-delay="100">{{ $title }}</h2>
                <p data-aos="fade-up" data-aos-delay="200">{{ $description }}</p>
            </div>
            <div class="col-lg-5">
                <form action="#" class="sign-up-form d-flex" data-aos="fade-up" data-aos-delay="300">
                    <input type="text" class="form-control" placeholder="Enter email address">
                    <input type="submit" class="btn btn-primary" value="Sign up">
                </form>
            </div>
        </div>
    </div>

</section><!-- End Hero Section -->