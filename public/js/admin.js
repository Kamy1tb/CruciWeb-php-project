// Add your JavaScript functions here
document.addEventListener("DOMContentLoaded", function () {
  const deleteLinks = document.querySelectorAll(
    'a[href^="/admin/deleteUser"], a[href^="/admin/deleteGrid"]'
  );

  deleteLinks.forEach(function (link) {
    link.addEventListener("click", function (e) {
      const confirmation = confirm("Are you sure you want to delete this?");
      if (!confirmation) {
        e.preventDefault();
      }
    });
  });
});
