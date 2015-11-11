angular.module('starter.controllers', [])

.controller('AppCtrl', function($scope, $rootScope, $ionicPush, $ionicUser, $state) {
  document.addEventListener("deviceready", onDeviceReady, false);

function onDeviceReady() {
    $scope.identifyUser();
}
  $rootScope.$on('$cordovaPush:tokenReceived', function(event, data) {
  $rootScope.loginData.device = data.token;
  });
  //Basic registration
  $scope.pushRegister = function() {

    $ionicPush.register({
      canShowAlert: false,
      onNotification: function(notification) {
        // Called for each notification for custom handling
        $scope.lastNotification = JSON.stringify(notification);
      }
    }).then(function(deviceToken) {
      $scope.token = deviceToken;
    });
  }
  $scope.identifyUser = function() {

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
    $scope.pushRegister();
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
$rootScope.loginData = {};

})


.controller('LoginCtrl', function($scope,  $rootScope, $ionicLoading, $http, $state, Camera) {
$scope.error = false;
$scope.alert = false;
$rootScope.uslikaj = false;
$scope.picture = function () {
  Camera.getPicture().then(function(imageURI) {
      console.log(imageURI);
    }, function(err) {
      console.err(err);
    });
}

$scope.submit = function () {
      $ionicLoading.show({
          template: '<ion-spinner></ion-spinner><br />Please wait...'
        });   
        $http({
          url: $rootScope.server + "API/login.php",
          data: $rootScope.loginData,
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          }
        }).success(function(data) {
          $ionicLoading.hide();
          if (data === false) {
            $scope.alert = true;
          }
          else if (data.length != 1 && data !== "prazno") {
            $rootScope.userData = data;
            if ($rootScope.userData.proknjizeno == 0) {
              $rootScope.userData.proknjizeno = "Vaša uplata još uvijek nije proknjižena."
            }
            else if ($rootScope.userData.proknjizeno == 1) {
              $rootScope.userData.proknjizeno = "Vaša uplata je proknjižena."
            }
            $rootScope.uslikaj = true; 
            $state.go("tab.proknjizene_uplate");
          }
          else if (data == "prazno") {
            $rootScope.uslikaj = false; 
            $state.go("tab.proknjizene_uplate");
          }
          

        }).error(function(err) {
          $ionicLoading.hide();
          $scope.upozorenje = true;
        });
    }
})




.controller('ProknjizeneUplateCtrl', function($scope) {

});




