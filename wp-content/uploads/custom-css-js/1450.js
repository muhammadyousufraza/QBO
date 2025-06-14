<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function () {
  // Error message par click se usay hatao
  document.addEventListener('click', function(e) {
    if (e.target.classList.contains('wpcf7-not-valid-tip')) {
      e.target.style.display = 'none';
      const input = e.target.closest('.wpcf7-form-control-wrap')?.querySelector('input, textarea, select');
      if (input) input.classList.remove('wpcf7-not-valid');
    }
  });

  // Field par focus hone par bhi error hatao
  const fields = document.querySelectorAll('.wpcf7 input, .wpcf7 textarea, .wpcf7 select');
  fields.forEach(function(field) {
    field.addEventListener('focus', function() {
      const error = this.closest('.wpcf7-form-control-wrap')?.querySelector('.wpcf7-not-valid-tip');
      if (error) {
        error.style.display = 'none';
      }
      this.classList.remove('wpcf7-not-valid');
    });
  });
});

</script>
<!-- end Simple Custom CSS and JS -->
