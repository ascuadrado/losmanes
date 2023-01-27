$(document).ready(function () {
  $("#instaForm").submit(function (event) {

    var insta_handle = {
      id: $("#instaID").val(),
    }

    $.ajax({
      type: "POST",
      url: "forms/instagram-form.php",
      data: insta_handle,
      dataType: "json",
      encode: true,
    }).done(function (data) {
      console.log(data);

      if (!data.success) {
        if (data.errors.data) {
        }
      } else {
        $("#instaForm").html(
          '<div class="alert alert-success">' + data.message + "</div>"
        );
      }
    }).fail(function (data) {
        $("#instaForm").html(
          '<div class="alert alert-danger">Could not reach server, please try again later.</div>'
        );
      });;

      event.preventDefault();

  });
});
