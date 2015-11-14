angular.module('starter.controllers', [])

.controller('LogoutCtrl', function($scope, $rootScope, $state) {
 $rootScope.$on('$ionicView.beforeEnter', function () {
var stateName = $state.current.name;
if (stateName === 'tab.login') {
$rootScope.hideTabs = true;
} else {
$rootScope.hideTabs = false;
}
});
$scope.odjava = function(){
$state.go("tab.login");
}
$rootScope.loginData = {};


})

.controller ('LoginCtrl', function($scope, $rootScope, $ionicLoading, $http, $state) {
$scope.error = false;
$scope.alert = false;
$rootScope.userData = {};
$scope.loginData = {};

$scope.submit = function () {
      $ionicLoading.show({
          template: '<ion-spinner></ion-spinner><br />Please wait...'
        });   
        $http({
          url: $rootScope.server + "/API/login.php",
          data: $scope.loginData,
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          }
        }).success(function(data) {
          $ionicLoading.hide();
          if (data === false) {
            $scope.alert = true;
          }
          else if(data !== false) {
            $rootScope.userData = data;
            $state.go("tab.upload_slika");
            console.log($rootScope.userData);
          }
          

        }).error(function(err) {
          $ionicLoading.hide();
          $scope.upozorenje = true;
        });
    }
})



.controller ('UploadslikaCtrl', function($scope) {
 

})

.controller ('TerminiCtrl', function($scope) {


})

.controller ('MojefrizureCtrl', function($scope) {})

.controller ('TrivijeCtrl', function($scope, $rootScope, Trivije, $interval) {
 $scope.$on('$ionicView.beforeEnter', function() {
     $rootScope.trivije = Trivije.all();
  });

 $scope.$on('$ionicView.afterEnter', function() {
 	var i = 0;
    $scope.trivija = $rootScope.trivije[i];

    $scope.interval = $interval(function() {
      if (i == $rootScope.trivije.length -1) {
        $interval.cancel($scope.interval);
   
      } else
       $scope.trivija = $rootScope.trivije[i];
        i++;
    }, 5000);
 
  });
	

});

