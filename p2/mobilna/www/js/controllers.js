angular.module('starter.controllers', [])

.controller('AppCtrl', function($scope, $rootScope, $ionicPush, $ionicUser, $state) {
  $rootScope.$on('$cordovaPush:tokenReceived', function(event, data) {
    alert('Got token' + data.token, data.platform);
  });
  //Basic registration
  $scope.pushRegister = function() {
    alert('Registering...');

    $ionicPush.register({
      canShowAlert: false,
      onNotification: function(notification) {
        // Called for each notification for custom handling
        $scope.lastNotification = JSON.stringify(notification);
      }
    }).then(function(deviceToken) {
      $scope.token = deviceToken;
      alert($scope.token);
    });
  }
  $scope.identifyUser = function() {
    alert('Identifying');
    console.log('Identifying user');

    var user = $ionicUser.get();
    if(!user.user_id) {
      // Set your user_id here, or generate a random one
      user.user_id = $ionicUser.generateGUID()
    };

    angular.extend(user, {
      name: 'Test User',
      message: 'I come from planet Ion'
    });

    $ionicUser.identify(user);
  }

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

})


.controller('LoginCtrl', function($scope,  $rootScope, $ionicLoading, $http, $state) {
$scope.error = false;
$scope.alert = false;
$scope.loginData = {};

$scope.submit = function () {
      $ionicLoading.show({
          template: '<ion-spinner></ion-spinner><br />Please wait...'
        });   
        $http({
          url: $rootScope.server + "API/login.php",
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
          else if (data !== false) {
            $rootScope.userData = data;
            $state.go("tab.proknjizene_uplate");
          }

        }).error(function(err) {
          $ionicLoading.hide();
          $scope.upozorenje = true;
        });
    }
})




.controller('ProknjizeneUplateCtrl', function($scope) {

})

.controller('NeproknjizeneUplateCtrl', function($scope) {

});




