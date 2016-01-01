var boutique = angular.module('Boutique', [
	'ui.router','ui.bootstrap'
  // ,'ui.uploader'
]);

boutique.config(function($stateProvider, $urlRouterProvider){
	$urlRouterProvider.otherwise('/index_1.html');
	$stateProvider
		.state('index_1',{
			url:'/index_1',
/*			views:{
				'':{
					templateUrl:'html/index_1.html'
				},
			}*/
			templateUrl: 'html/index_1.html',
		})
		.state('bde',{
			url:'/bde',
			templateUrl: 'html/bde.html',
		})
		.state('tse',{
			url:'/tse',
			templateUrl: 'html/tse.html',
		})
});

//controller of index_1.html
boutique.controller('machoice',['$scope',function($scope,Data){

	$scope.bdelogoSmall = true;
	$scope.tselogoSmall = true;
	$scope.bdelogoLarge = false;
	$scope.tselogoLarge = false;

	$scope.showEtHideBDE = function(){  
		$scope.bdelogoSmall = !$scope.bdelogoSmall;
		$scope.bdelogoLarge = !$scope.bdelogoLarge;
	};

	$scope.showEtHideTSE = function(){
		$scope.tselogoSmall = !$scope.tselogoSmall;
		$scope.tselogoLarge = !$scope.tselogoLarge;
	};

	$scope.refreshBDE = function(){
		// window.open("bde.html");
		window.location = "bde.html"; 
	}

	$scope.refreshTSE = function(){
		// window.open("tse.html");  
		window.location = "tse.html";
	}

}]);

//controller of bde.html and tse.html
boutique.controller('showHide', ['$scope', function ($scope,Data) {
		// Realiser les fonctions.
    $scope.slidesLooping = true;
    $scope.hideImg = true;
    $scope.showImg = false;

	$scope.returnToday = function(){
		$scope.dt = new Date();
	};
	$scope.returnToday();


  $scope.showEtHide = function(){  
    // $scope.slidesLooping = !$scope.slidesLooping;
    $scope.hideImg = !$scope.hideImg;
    $scope.showImg = !$scope.showImg;
    $scope.slidesLooping = !$scope.slidesLooping;
  }

  // var timesDoubleClick = 0;
  $scope.important = function() {
    var dayImpo = $scope.dt;
    $scope.events =
      [
        {
          date: dayImpo,
          status: 'important'
        }
      ];

    $scope.getDayClass = function(date, mode) {
      if (mode === 'day') {
        var dayToCheck = new Date(date).setHours(0,0,0,0);
        for (var i=0;i<$scope.events.length;i++){
          var currentDay = new Date($scope.events[i].date).setHours(0,0,0,0);

          if (dayToCheck === currentDay) {
            return $scope.events[i].status;
          }
        }
      }
      return '';
    };

  }

}]);

// The third controller about changing-over images.
boutique.controller('imageChanged', ['$scope', function ($scope) {  
    $scope.myInterval = 2000;
	$scope.noWrapSlides = false;
  	var slides = $scope.slides = [];
  		
  	slides.push({
  		image:'../img/1.jpg'
  	});
  	slides.push({
  		image:'../img/2.jpg'
  	});
  	slides.push({
  		image:'../img/3.jpg'
  	});
  	slides.push({
  		image:'../img/4.jpg'
  	});

}]);

/*//controller of upload.html
boutique.controller('uploaderCtrl', ['$scope', function($scope, $log, uiUploader) {
  $scope.btn_remove = function(file) {
    $log.info('deleting=' + file);
    uiUploader.removeFile(file);
  };
  $scope.btn_clean = function() {
    uiUploader.removeAll();
  };
  $scope.btn_upload = function() {
    $log.info('uploading...');
    uiUploader.startUpload({
      url: 'http://realtica.org/ng-uploader/demo.html',
      concurrency: 2,
      onProgress: function(file) {
        $log.info(file.name + '=' + file.humanSize);
        $scope.$apply();
      },
      onCompleted: function(file, response) {
        $log.info(file + 'response' + response);
      }
    });
  };
  $scope.files = [];
  var element = document.getElementById('file1');
  element.addEventListener('change', function(e) {
    var files = e.target.files;
    uiUploader.addFiles(files);
    $scope.files = uiUploader.getFiles();
    $scope.$apply();
  });
}]);*/