// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
// 'starter.services' is found in services.js
// 'starter.controllers' is found in controllers.js
angular.module('starter', ['ionic', 'starter.controllers', 'starter.services', 'ngCordova', 'ionic.service.core','ionic.service.push'])
.config(['$ionicAppProvider', function($ionicAppProvider) {
  // Identify app
  $ionicAppProvider.identify({
    // Your App ID
    app_id: 'dd0dffc6',
    // The public API key services will use for this app
    api_key: '3b9b859bcd62b9f0719bc04c3ce6331e9cd40ece2d137cb8',
    // Your GCM sender ID/project number (Uncomment if supporting Android)
    gcm_id: '272779918008'
  });

}])
.run(function($ionicPlatform, $rootScope) {
  $ionicPlatform.ready(function() {
    // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
    // for form inputs)
    if (window.cordova && window.cordova.plugins && window.cordova.plugins.Keyboard) {
      cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
      cordova.plugins.Keyboard.disableScroll(true);

    }
    if (window.StatusBar) {
      // org.apache.cordova.statusbar required
      StatusBar.styleDefault();
    }
  });

   $rootScope.server = "http://localhost/InfiniteLoop/p3";
})

.config(function($stateProvider, $urlRouterProvider) {

  // Ionic uses AngularUI Router which uses the concept of states
  // Learn more here: https://github.com/angular-ui/ui-router
  // Set up the various states which the app can be in.
  // Each state's controller can be found in controllers.js
  $stateProvider

  // setup an abstract state for the tabs directive
    .state('tab', {
    url: '/tab',
    abstract: true,
    templateUrl: 'templates/tabs.html',
    controller: 'LogoutCtrl'
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

.state('tab.upload_slika', {
    url: '/upload_slika',
    views: {
      'tab-upload_slika': {
        templateUrl: 'templates/tab-upload_slika.html',
        controller: 'UploadslikaCtrl'
      }
    }
  })

.state('tab.termini', {
    url: '/termini',
    views: {
      'tab-termini': {
        templateUrl: 'templates/tab-termini.html',
        controller: 'TerminiCtrl'
      }
    }
  })

.state('tab.moje_frizure', {
    url: '/moje_frizure',
    views: {
      'tab-moje_frizure': {
        templateUrl: 'templates/tab-moje_frizure.html',
        controller: 'MojefrizureCtrl'
      }
    }
  })

.state('tab.trivije', {
    url: '/trivije',
    views: {
      'tab-trivije': {
        templateUrl: 'templates/tab-trivije.html',
        controller: 'TrivijeCtrl'
      }
    }
  });
  

  // if none of the above states are matched, use this as the fallback
  $urlRouterProvider.otherwise('/tab/login');

});
