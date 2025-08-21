import './bootstrap';
import * as bootstrap from 'bootstrap';
import Swal from 'sweetalert2';
window.Swal = Swal;

document.getElementById('sortSelect').addEventListener('change', function () {
    const sortValue = this.value;
    const url = new URL(window.location.href);

    if (sortValue) {
        url.searchParams.set('sort', sortValue);
    } else {
        url.searchParams.delete('sort');
    }

    window.location.href = url.toString();
});