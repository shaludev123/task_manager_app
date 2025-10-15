angular.module("taskApp").service("ApiService", function ($http, API_BASE) {
  this.getAll = function () {
    return $http.get(API_BASE + "read.php");
  };
  this.getOne = function (id) {
    return $http.get(API_BASE + "read_one.php?id=" + id);
  };
  this.create = function (data) {
    return $http.post(API_BASE + "create.php", data);
  };
  this.update = function (data) {
    return $http.post(API_BASE + "update.php", data);
  };
  this.delete = function (id) {
    return $http.post(API_BASE + "delete.php", { id: id });
  };
});
