document
  .getElementById("login-form")
  .addEventListener("submit", function (event) {
    event.preventDefault();

    const formData = {
      action: "login",
      username: $("#username").val(),
      password: $("#password").val(),
    };

    $.ajax({
      url: "index.php?action=login",
      method: "POST",
      data: formData,
      success: function (response) {
        console.log(response);
        window.location.href = "index.php";
        return response;
      },
      error: function (xhr, status, error) {
        console.log("Status:", status);
        console.log("Requête renvoyée :", xhr.responseText);
        const errorDiv = document.getElementById("error-message");
        errorDiv.textContent = "Identifiant ou mot de passe incorrect";
      },
    });
  });
