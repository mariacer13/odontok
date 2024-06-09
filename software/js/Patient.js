class PatientJs {


   //Metodo para insertar paciente
   insertPatient() {
    swal({
      icon: "warning",
      title: "Confirmar agregar paciente",
      text: "Esta segur@ de agregar al paciente?",
      buttons: {
        cancel: true,
        confirm: true,
      },
    }).then((confirm) => {
      if (confirm) {
        //Enviar el formulario si es que se confirmo el envio

        var object = new FormData(document.querySelector("#insert_patient"));

        fetch("PatientController/insertPatient", {
          method: "POST",
          body: object,
        })
          .then((resp) => resp.text())
          .then(function (data) {
            try {
              object = JSON.parse(data);
              toastr.error(object.message);
            } catch (error) {
              document.querySelector("#content").innerHTML = data;
              toastr.success("El registro fue guardado");
            }
          })
          .catch(function (error) {
            console.log(error);
          });
      }
    });
  }

  
    //Metodo para mostrar el formulario para agregar un nuevo usuario
    showFormPatient() {
      var object = new FormData();
  
      $("#my_modal").modal("show"); //Saber en donde vamos a mostrar el contenido
      document.querySelector("#modal_title").innerHTML =
        "Agregar un nuevo paciente";
      fetch("PatientController/showFormPatient", {
        method: "POST",
        body: object,
      })
        .then((resp) => resp.text())
        .then(function (data) {
          document.querySelector("#modal_content").innerHTML = data;
        })
        .catch(function (error) {
          console.log(error);
        });
    }
  
    //Metodo para actualuzar un usuario
    showPatient(cod_patient) {
      //Crear un formulario
      var object = new FormData();

      //Añardir al formulario el codigo del usuario
      object.append("cod_patient", cod_patient);

      $("#my_modal").modal("show");

      document.querySelector("#modal_title").innerHTML = "Actualizar paciente";

      fetch("PatientController/showPatient", {
        method: "POST",
        body: object,
      })
        .then((resp) => resp.text())
        .then(function (data) {
          document.querySelector("#modal_content").innerHTML = data;
        })
        .catch(function (error) {
          console.log(error);
        });
    }
  
    //Metodo para buscar a un usuario por numero de docmento
    searchNumberDocument() {
      var object = new FormData(document.querySelector("#search_patient"));

      fetch("PatientController/searchPatientDocument", {
        method: "POST",
        body: object,
      })
        .then((resp) => resp.text())
        .then(function (data) {
          try {
            object = JSON.parse(data);
  
            toastr.error(object.message);
          } catch (error) {
            document.querySelector("#content").innerHTML = data;
          }
        })
        .catch(function (error) {
          console.log(error);
        });
    }

    //Metodo para actualizar un usuario
  updatePatient(cod_patient) {
    swal({
      icon: "warning",
      title: "Confirmar actualizar paciente",
      text: "Esta segur@ de actualizar al paciente?",
      buttons: {
        cancel: true,
        confirm: true,
      },
    }).then((confirm) => {

      if (confirm) {
       
        
        //Obtener y agregar al formulario el codigo del usuario
        var object = new FormData(document.querySelector("#update_patient"));
        object.append("cod_patient", cod_patient);

        fetch("PatientController/updatePatient", {
          method: "POST",
          body: object,
        })
          .then((resp) => resp.text())
          .then(function (data) {
            try {
              object = JSON.parse(data);

              toastr.error(object.message);
            } catch (error) {
              document.querySelector("#content").innerHTML = data;
              toastr.success("El registro fue guardado");
              const ventanaModal = document.getElementById("#update_user");
              ventanaModal.style.display = "none";
            }
          })
          .catch(function (error) {
            console.log(error);
          });
      }
    });
  }
  
  }
  
  var Patient = new PatientJs(); //Crear un nuevo objeto
  