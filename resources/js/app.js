import './bootstrap';

import Swal from 'sweetalert2';
window.Swal = Swal;

// Listener Global untuk SweetAlert
window.addEventListener('swal:modal', event => {
    Swal.fire({
        title: event.detail[0].title,
        text: event.detail[0].text,
        icon: event.detail[0].icon,
        confirmButtonColor: '#3B82F6',
        borderRadius: '1.5rem'
    });
});
