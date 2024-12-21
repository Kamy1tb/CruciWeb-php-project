document
  .getElementById("login-form")
  .addEventListener("submit", function (event) {
    event.preventDefault();

    const formData = {
      action: 'login', // Ajouter l'action ici
      username: $('#username').val(),
      password: $('#password').val(),
    };


    $.ajax({
      url: '../public/index.php?action=login',
      method: 'POST',
      data: formData, // L'objet FormData contenant les données du formulaire
    
      success: function (response) {
          console.log("response");
          window.location.href = '../public/index.php';
          return response;
      },
      error: function (xhr, status, error) {
          console.error('Erreur AJAX:', error);
          console.log("Status:", status);
        console.log("Requête renvoyée :", xhr.responseText);
      }
  });
    
  });