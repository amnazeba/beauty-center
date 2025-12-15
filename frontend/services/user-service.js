var UserService = {
  init: function () {
    $("#login-form").on("submit", function (e) {
      e.preventDefault();

      const entity = {
        username: $("input[name='username']").val(),
        password: $("input[name='password']").val()
      };

      UserService.login(entity);
    });
  },

  login: function (entity) {
    $.ajax({
      url: Constants.PROJECT_BASE_URL + "admins/login",
      type: "POST",
      data: JSON.stringify(entity),
      contentType: "application/json",
      success: function (result) {
        localStorage.setItem("user_token", result.token);
        alert("Login successful");
        window.location.href = "index.html";
      },
      error: function (xhr) {
        console.error(xhr.responseText);
        alert("Login failed");
      }
    });
  },

  logout: function () {
    localStorage.clear();
    window.location.href = "login.html";
  }
};
