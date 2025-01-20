document.addEventListener("DOMContentLoaded", function () {
  const deleteLinks = document.querySelectorAll(
    'a[href^="/admin/deleteUser"], a[href^="/admin/deleteGrid"]'
  );

  deleteLinks.forEach(function (link) {
    link.addEventListener("click", function (e) {
      const confirmation = confirm("Are you sure you want to delete this?");
      if (!confirmation) {
        e.preventDefault();
      } else {
        $.ajax({
          url: this.href,
          method: "GET",
          success: function (response) {
            if (response.success) {
              window.location.href("index.php");
            } else {
              alert("An error occurred. Please try again.");
            }
          },
          error: function () {
            alert("An error occurred. Please try again.");
          },
        });
      }
    });
  });
});
