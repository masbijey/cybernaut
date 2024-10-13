document.addEventListener('DOMContentLoaded', function() {
    // Pilih semua elemen input, select, dan textarea dalam form
    var formElements = document.querySelectorAll('form input, form select, form textarea');
    
    formElements.forEach(function(element) {
        element.addEventListener('input', function() {
            // Hapus class is-invalid
            this.classList.remove('is-invalid');
            
            // Cari elemen feedback terdekat
            var feedbackElement = this.nextElementSibling;
            if (feedbackElement && feedbackElement.classList.contains('invalid-feedback')) {
                feedbackElement.style.display = 'none';
            }
            
            // Jika menggunakan Laravel Collective, mungkin perlu menangani div parent
            var formGroup = this.closest('.form-group');
            if (formGroup) {
                formGroup.classList.remove('has-error');
            }
        });
    });
});