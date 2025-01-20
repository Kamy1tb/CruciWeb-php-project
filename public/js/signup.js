document
  .getElementById("signup-form")
  .addEventListener("submit", function (event) {
    event.preventDefault();
    const errorDiv = document.getElementById("error-message");
    errorDiv.textContent = "";
    const formData = {
      action: "signup",
      username: $("#username").val(),
      fullname: $("#fullname").val(),
      password: $("#password").val(),
      email: $("#email").val(),
    };

    $.ajax({
      url: "index.php?action=signup",
      method: "POST",
      data: formData,

      success: function (response) {
        console.log(response);
        window.location.href = "index.php";
        return response;
      },
      error: function (xhr, status, error) {
        const errorDiv = document.getElementById("error-message");
        errorDiv.textContent = "Cet utilisateur existe déjà";
      },
    });
  });
