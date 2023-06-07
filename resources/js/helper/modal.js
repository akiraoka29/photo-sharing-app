jQuery(function($) {
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
            $(document).on('click', Props.element.signupLink, () => {
                Modal.active.signinModal('hide')
                Modal.active.signupModal('show')
            })
        }
    }

    // Render
    Modal.init();
})