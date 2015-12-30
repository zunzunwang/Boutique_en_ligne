var boutique = angular.module('Boutique',[]);
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