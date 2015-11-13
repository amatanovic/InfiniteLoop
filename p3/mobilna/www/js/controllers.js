angular.module('starter.controllers', [])

.controller ('LogoutCtrl', function($scope) {})

.controller ('LoginCtrl', function($scope) {})

.controller ('UploadslikaCtrl', function($scope) {})

.controller ('TerminiCtrl', function($scope) {})

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

