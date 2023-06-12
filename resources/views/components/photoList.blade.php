<!-- Photo Section - Home Page -->
<section id="photos" class="portfolio">

    <!-- Portfolio Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Free Photos</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
    </div><!-- End Section Title -->

    <div class="container">

        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

            <x-photo.tag 
                :tag="$tags" />

            <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
                @foreach($photos as $ph)
                    <x-photo.photo 
                        :path="$ph->file_path" 
                        :fileName="$ph->file_name" 
                        :title="$ph->title" 
                        :tags="$ph->tags" 
                        :caption="$ph->caption" />
                @endforeach
            </div><!-- End Portfolio Container -->

        </div>

    </div>

</section><!-- End Photo Section -->