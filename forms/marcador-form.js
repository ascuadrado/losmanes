$(document).ready(function () {
  $("#marcadorForm").submit(function (event) {

    var new_event = {
      nombre: $("#memberSelect").val(),
      accion: $("#actionSelect").val(),
      password: $("#passwordCheck").val()
    }

    $.ajax({
      type: "POST",
      url: "forms/marcador-form.php",
      data: new_event,
      dataType: "json",
      encode: true,
    }).done(function (data) {
      console.log(data);

      if (!data.success) {
        if (data.errors.data) {
        }
      } else {
        $("#marcadorForm").html(
          '<div class="alert alert-success">' + data.message + "</div>"
        );
      }
    }).fail(function (data) {
        $("#marcadorForm").html(
          '<div class="alert alert-danger">Could not reach server, please try again later.</div>'
        );
      });;

      event.preventDefault();

  });
});
