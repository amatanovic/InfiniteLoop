// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
angular.module('starter', ['ionic', 'starter.controllers', 'ionic.service.core', 'ionic.service.push'])

.config(['$ionicAppProvider', function($ionicAppProvider) {
  // Identify app
  $ionicAppProvider.identify({
    // Your App ID
    app_id: '8d496e29',
    // The public API key services will use for this app
    api_key: '034d4447e156a5fc57b2174858b618d03f0704d70a53b4ae',
    // Your GCM sender ID/project number (Uncomment if supporting Android)
    gcm_id: '272779918008'
  });

}])
.factory('Camera', ['$q', function($q) {

  return {
    getPicture: function(options) {
      var q = $q.defer();

      navigator.camera.getPicture(function(result) {
        // Do any magic you need
        q.resolve(result);
      }, function(err) {
        q.reject(err);
      }, options);

      return q.promise;
    }
  }
}])

.run(function($ionicPlatform, $rootScope, $ionicPush, $cordovaPush) {
  $ionicPlatform.ready(function() {
    // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
    // for form inputs)
    if(window.cordova && window.cordova.plugins.Keyboard) {
      cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
    }
    if(window.StatusBar) {
      StatusBar.styleDefault();
    }
  });
  $rootScope.server = "http://project.comuv.com/p2/";
 
})

.config(function($stateProvider, $urlRouterProvider) {

  // Ionic uses AngularUI Router which uses the concept of states
  // Learn more here: https://github.com/angular-ui/ui-router
  // Set up the various states which the app can be in.
  // Each state's controller can be found in controllers.js
  $stateProvider

.state('tab', {
    url: '/tab',
    abstract: true,
    templateUrl: 'templates/tabs.html',
    controller: 'AppCtrl'
  })

 .state('tab.login', {
    url: '/login',
    views: {
      'tab-login': {
        templateUrl: 'templates/tab-login.html',
        controller: 'LoginCtrl'
      }
    }
  })

   .state('tab.proknjizene_uplate', {
    url: '/proknjizene_uplate',
    views: {
      'tab-proknjizene_uplate': {
        templateUrl: 'templates/tab-proknjizene_uplate.html',
        controller: 'ProknjizeneUplateCtrl'
      }
    }
  });


  // if none of the above states are matched, use this as the fallback
 $urlRouterProvider.otherwise('/tab/login');

});

