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

window.addEventListener('swal:confirm-registration', event => {
    const word = event.detail[0].word;

    Swal.fire({
        title: 'Konfirmasi Pendaftaran',
        text: `Silahkan ketik "${word}" untuk melanjutkan.`,
        input: 'text',
        borderRadius: '1.5rem',
        inputAttributes: {
            autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'Daftar Sekarang',
        confirmButtonColor: '#3B82F6',
        cancelButtonText: 'Batal',
        preConfirm: (value) => {
            if (value.toUpperCase() !== word) {
                Swal.showValidationMessage('Kata kunci salah!');
            }
            return value;
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // Kirim event balik ke Livewire Component
            Livewire.dispatch('confirmed-registration', { value: result.value });
        }
    });
});
