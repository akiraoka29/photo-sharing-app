define('photo', ['jquery','./modal'], ($, modal) => {
    // Initialize
    let Props = {
        element: {
        },
        class: {
            photoContainer: '.isotope-container',
            filterApp: '.filter-app',
            previewLink: '.preview-link',
            likeButton: '.like-button'
        }
    }
    let Photo = {}
    
    // Call Function
    Photo.init = () => {
        Photo.event.photoOnClick();
        Photo.event.likeOnClick();
    }
    
    Photo.active = {
        showPhoto: () => {
    
        },
        likePhoto: (isAuth) => {
            if(isAuth == 0) {
                modal.active.signinModal();
            }
        }
    }
    
    Photo.event = {
        photoOnClick: () => {
            // $('.isotope-container').on('click', '.filter-app', (element) => {
            //     console.log('-- Photo Item --');
            //     let previewLink = $(element).find('.portfolio-info').find('.preview-link');
            //     console.log($(this))
            //     $(element).remove()
            //     $(element).find('.portfolio-info').remove()
            //     $(element).find('.portfolio-info').find('.preview-link').remove()
            //     return;
            //     var lightbox = GLightbox({
            //         href: previewLink.attr('href'),
            //         title: previewLink.attr('title'),
            //         gallery: previewLink.attr('data-gallery'),
            //     });
            //     lightbox.open();
            // })
        },
        likeOnClick: () => {
            $(Props.class.photoContainer).on('click', Props.class.likeButton, (event) => {
                const $button = $(event.currentTarget);
                if (!$button.prop('disabled')) {
                    $button.prop('disabled', true);
                    // Call Like Photo Feature
                    Photo.active.likePhoto(isAuth)
                    // Set a timeout to activate the back button after a certain delay
                    setTimeout(() => {
                        $button.prop('disabled', false);
                    }, 1000); // Delay time in milliseconds (set here is 1 second)
                }
            });
        }
    }
    
    // Render
    Photo.init();
})