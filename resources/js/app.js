import './bootstrap';

import Alpine from 'alpinejs';
import Swal from 'sweetalert2';

window.Alpine = Alpine;
window.Swal = Swal;

/** Confirm before submitting a form (e.g. delete). Use in onsubmit="return window.confirmDelete(this, 'Title', 'Text');" */
window.confirmDelete = function(form, title, text) {
  if (!form || !window.Swal) return true;
  const t = title || 'Are you sure?';
  const txt = text || 'This action cannot be undone.';
  Swal.fire({
    title: t,
    text: txt,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#dc2626',
    cancelButtonColor: '#6b7280',
    confirmButtonText: 'Yes, delete it',
  }).then(function(r) {
    if (r.isConfirmed && form && form.submit) form.submit();
  });
  return false;
};

Alpine.start();
