document
  .getElementById("signup-form")
  .addEventListener("submit", function (event) {
    event.preventDefault();
    const errorDiv = document.getElementById('error-message');
    errorDiv.textContent = '';
    const formData = {
      action: 'signup', // Ajouter l'action ici
      username: $('#username').val(),
      fullname: 'test test',
      password: $('#password').val(),
      email: $('#email').val(),
    };

    console.log(formData);
    $.ajax({
      url: '../public/index.php?action=signup',
      method: 'POST',
      data: formData, // L'objet FormData contenant les données du formulaire
    
      success: function (response) {
          console.log(response);
          window.location.href = '../public/index.php';
          return response;
      },
      error: function (xhr, status, error) {
        console.log("Status:", status);
        console.log("Requête renvoyée :", xhr.responseText);
        const errorDiv = document.getElementById('error-message');
        errorDiv.textContent = 'Cet utilisateur existe déjà';
      }
  });
    
  });