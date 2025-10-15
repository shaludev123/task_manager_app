angular
  .module("taskApp")
  .controller(
    "FormCtrl",
    function ($scope, $routeParams, $location, ApiService) {
      $scope.user = {};
      $scope.isEdit = false;

      if ($routeParams.id) {
        $scope.isEdit = true;
        ApiService.getOne($routeParams.id).then(function (res) {
          $scope.user = res.data;
        });
      }

      $scope.save = function () {
        if ($scope.isEdit) {
          ApiService.update($scope.user).then(
            function () {
              alert("Updated");
              $location.path("/list");
            },
            function () {
              alert("Error updating");
            }
          );
        } else {
          ApiService.create($scope.user).then(
            function () {
              alert("Created");
              $location.path("/list");
            },
            function () {
              alert("Error creating");
            }
          );
        }
      };
    }
  )
  .controller("ListCtrl", function ($scope, ApiService, $location) {
    $scope.users = [];

    $scope.load = function () {
      ApiService.getAll().then(function (res) {
        $scope.users = res.data.users;
      });
    };

    $scope.edit = function (id) {
      $location.path("/edit/" + id);
    };

    $scope.del = function (id) {
      if (!confirm("Delete this user?")) return;
      ApiService.delete(id).then(
        function () {
          $scope.load();
        },
        function () {
          alert("Delete failed");
        }
      );
    };

    $scope.search = function () {
      if (!$scope.searchQuery || $scope.searchQuery.trim() === "") {
        $scope.load();
        return;
      }

      ApiService.search($scope.searchQuery).then(
        function (res) {
          $scope.users = res.data.users;
        },
        function () {
          alert("Search failed!");
        }
      );
    };

    $scope.load();
  });
