angular
  .module("taskApp", ["ngRoute"])
  .config(function ($routeProvider) {
    $routeProvider
      .when("/add", {
        templateUrl: "templates/form.html",
        controller: "FormCtrl",
      })
      .when("/edit/:id", {
        templateUrl: "templates/form.html",
        controller: "FormCtrl",
      })
      .when("/list", {
        templateUrl: "templates/list.html",
        controller: "ListCtrl",
      })
      .otherwise({ redirectTo: "/list" });
  })
  .constant("API_BASE", "/taskmanager/api/");
