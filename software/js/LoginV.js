const form = document.querySelector('#formLogin');
form.addEventListener('submit', function(event) {

  event.preventDefault(); // prevenir el envío del formulario

  const code = document.querySelector('#usser').value;
  const password = document.querySelector('#password_user').value;

  if (code === '' || password === '') {
    swal({
      title: "DATOS VACIOS!",
      text: "Por favor ingrese todos los datos",
      icon: "warning",
      button: "Entendido!"

    });
  //} else if (code.length !== 6) {
  //  alert('El código debe tener 6 caracteres.');
 // } else if (password.length < 8) {
  //  alert('La contraseña debe tener al menos 8 caracteres.');
  } else {
    // formulario válido, puedes enviar los datos
    form.submit();
  }
});