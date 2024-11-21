<script>
  const dropdowns = document.querySelectorAll('.dropdown');

  dropdowns.forEach((dropdown) => {
    dropdown.addEventListener('click', () => {
      dropdown.nextElementSibling.classList.toggle('active');
    });
  });
</script>
