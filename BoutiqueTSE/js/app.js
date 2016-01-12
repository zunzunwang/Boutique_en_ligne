var boutique = angular.module('Boutique', [
  'ui.router','ui.bootstrap'
]);



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


//   $scope.showEtHide = function(){  
//     // $scope.slidesLooping = !$scope.slidesLooping;
//     $scope.hideImg = !$scope.hideImg;
//     $scope.showImg = !$scope.showImg;
// //    $scope.slidesLooping = !$scope.slidesLooping;
//     $("#headImg").toggle(1000);

//   }
  $scope.hide = function(){  
    // $scope.slidesLooping = !$scope.slidesLooping;
    $scope.hideImg = !$scope.hideImg;
    $scope.showImg = !$scope.showImg;
//    $scope.slidesLooping = !$scope.slidesLooping;
    $("#headImg").slideUp(1000);
  }
  $scope.show = function(){  
    // $scope.slidesLooping = !$scope.slidesLooping;
  $scope.hideImg = !$scope.hideImg;
  $scope.showImg = !$scope.showImg;
//    $scope.slidesLooping = !$scope.slidesLooping;
  $("#headImg").slideDown(1000);
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

boutique.controller('content',['$scope', function($scope){
    $scope.allUsersContent = false;
    $scope.quantityContent = false;
    $scope.basketContent = false;
    $scope.publishContent = false;
    $scope.publishBDEContent = false;
    $scope.informationContent = false;

    $scope.allUsers = function(){
      $scope.allUsersContent = true;
      $scope.publishBDEContent = false;
      $scope.quantityContent = false;
    }

    $scope.quantity = function(){
      $scope.allUsersContent = false;
      $scope.publishBDEContent = false;
      $scope.quantityContent = true;
    }    

    $scope.basket = function(){
      $scope.basketContent = true;
      $scope.publishContent = false;
      $scope.informationContent = false;
    }

    $scope.publish = function(){
      $scope.basketContent = false;
      $scope.publishContent = true;
      $scope.informationContent = false;
    }

    $scope.publishBDE = function(){
      $scope.allUsersContent = false;
      $scope.publishBDEContent = true;
      $scope.quantityContent = false;
    }

    $scope.information = function(){
      $scope.basketContent = false;
      $scope.publishContent = false;
      $scope.informationContent = true;
    }
}]);

/*boutique.controller('DropdownCtrl', ['$scope', function ($scope, $log) {
  $scope.items = [
    'The first choice!',
    'And another choice for you.',
    'but wait! A third!'
  ];

  $scope.status = {
    isopen: false
  };

  $scope.toggled = function(open) {
    $log.log('Dropdown is now: ', open);
  };

  $scope.toggleDropdown = function($event) {
    $event.preventDefault();
    $event.stopPropagation();
    $scope.status.isopen = !$scope.status.isopen;
  };
}]);*/


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