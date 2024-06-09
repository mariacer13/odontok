class ProcedureJs {

  //Metodo para insertar prcedimientos
  insertProcedure() {

    var object = new FormData(document.querySelector("#insert_procedure"));
    fetch("ProcedureController/insertProcedure", {
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
      }
    );

  }


  //Metodo para mostrar el formulario para agregar un nuevo usuario
  showFormProcedure() {
    var object = new FormData();

    $("#my_modal").modal("show"); //Saber en donde vamos a mostrar el contenido
    document.querySelector("#modal_title").innerHTML =
      "Agregar un nuevo procedimiento";
    fetch("ProcedureController/showFormProcedure", {
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


  showProcedure(cod_procedure){
    //Crear un formulario
    var object = new FormData();

    //Añardir al formulario el codigo del usuario
    object.append("cod_procedure", cod_procedure);

    $("#my_modal").modal("show");

    document.querySelector("#modal_title").innerHTML = "Actualizar procedimiento";

    fetch("ProcedureController/showProcedure", {
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

  //Metodo para consultar por nombre
  //Metodo para buscar a un usuario por numero de docmento
  searchNameProcedure() {

    var object = new FormData(document.querySelector("#search_procedure"));

    fetch("ProcedureController/searchNameProcedure", {
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

  //Metodo para buscar por estado procedimientos
  //Metodo para buscar a un usuario por estado
  searchProcedureState() {
    var object = new FormData(document.querySelector("#search_procedure"));

    fetch("ProcedureController/searchProcedureState", {
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


  //Metodo para actualizar un procedimiento
  updateProcedure(cod_procedure) {
    swal({
      icon: "warning",
      title: "Confirmar actualizar procedimiento",
      text: "Esta segur@ de actualizar al procedimiento?",
      buttons: {
        cancel: true,
        confirm: true,
      },
    }).then((confirm) => {

      if (confirm) {
       
        //Obtener y agregar al formulario el codigo del usuario
        var object = new FormData(document.querySelector("#update_procedure"));
        object.append("cod_procedure", cod_procedure);

        fetch("ProcedureController/updateProcedure", {
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

}

var Procedure = new ProcedureJs(); //Crear un nuevo objeto
