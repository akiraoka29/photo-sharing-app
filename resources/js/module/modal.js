define('modal', ['jquery','bootstrap'], ($) => {
    // Initialize
    let Props = {
        element: {
            signinModal: $('#signinModal'),
            signupModal: $('#signupModal'),
            signupLink: '#signupLink'
        }
    }
    let Modal = {}
    
    // Call Function
    Modal.init = () => {
        Modal.event.showSignupOnClick();
    }
    
    Modal.active = {
        signupModal: (type='show') => {
            console.log('-- Signup Modal --');
            if(type == 'show') {
                Props.element.signupModal.modal('show');
            }else {
                Props.element.signupModal.modal('hide');
            }
        },
        signinModal: (type='show') => {
            console.log('-- Signin Modal --');
            if(type == 'show') {
                Props.element.signinModal.modal('show');
            }else {
                Props.element.signinModal.modal('hide');
            }
        }
    
    }
    
    Modal.event = {
        showSignupOnClick: () => {
            $(document).on('click', Props.element.signupLink, (event) => {
                const $button = $(event.currentTarget);
                if (!$button.prop('disabled')) {
                    $button.prop('disabled', true);
                    $('.modal').modal('hide');
                    Modal.active.signinModal('hide')
                    Modal.active.signupModal('show')
                    // When Signup Modal Closed
                    Props.element.signupModal.on('hidden.bs.modal', () => {
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                    })
                    // Set a timeout to activate the back button after a certain delay
                    setTimeout(() => {
                        $button.prop('disabled', false);
                    }, 1000); // Delay time in milliseconds (set here is 1 second)
                }
            })
        }
    }
    
    // Render
    Modal.init();

    return Modal;
})