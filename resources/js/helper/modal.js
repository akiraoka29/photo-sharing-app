jQuery(function($) {
    // Initialize
    let Modal = {
        element: {
            signinModal: $('#signinModal'),
            signupModal: $('#signupModal'),
            signupLink: '#signupLink'
        }
    }
    // Call Function
    Modal.init = () => {
        Modal.event.showSignupOnClick();
    }

    Modal.active = {
        signupModal: (type='show') => {
            console.log('-- Signup Modal --');
            if(type == 'show') {
                Modal.element.signupModal.modal('show');
            }else {
                Modal.element.signupModal.modal('hide');
            }
        },
        signinModal: (type='show') => {
            console.log('-- Signin Modal --');
            if(type == 'show') {
                Modal.element.signinModal.modal('show');
            }else {
                Modal.element.signinModal.modal('hide');
            }
        }

    }

    Modal.event = {
        showSignupOnClick: () => {
            $(document).on('click', Modal.element.signupLink, () => {
                Modal.active.signinModal('hide')
                Modal.active.signupModal('show')
            })
        }
    }

    // Render
    Modal.init();
})