<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>SignUp</title>
	<script  src="../js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="../js/angular.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/Site.css">
</head>
<body>

<div class="container" ng-app="myApp" ng-controller="myCtrl">
	<h2>Register</h2>
<form class="form-horizontal" id="register">
    
    <h4>User Detail</h4>
    <hr />
    <div class="form-group">
        <label class="col-md-2 control-label">First Name</label>
        <div class="col-md-4"> 
            <input type="text" ng-model="fname" class="form-control"/>
        </div>
        <span class="col-md-3" ng-style="{'color' : 'red'}" ng-model="efname">{{efname}}</span>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Last Name</label>
        <div class="col-md-4"> 
            <input type="text" ng-model="lname" class="form-control" />
        </div>
        <span class="col-md-3" ng-style="{'color' : 'red'}" ng-model="elname">{{elname}}</span>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Email</label>
        <div class="col-md-4"> 
            <input type="email" ng-model="email" class="form-control"/>
        </div>
        <span class="col-md-3" ng-style="{'color' : 'red'}" ng-model="eemail">{{eemail}}</span>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Date Of Birth</label>
        <div class="col-md-4"> 
            <input type="date" ng-model="dateofbirth" class="form-control" />
        </div>
        <span class="col-md-3" ng-style="{'color' : 'red'}" ng-model="edob">{{edob}}</span>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Select Country</label>
        <div class="col-md-4"> 
                <select class="form-control col-md-4 dropdown" ng-model="country">
                    <option selected disabled hidden style='display: none' value=''>--Select--</option>
                    <option ng-repeat="y in ctry" value="{{y.id}}">{{y.name}}</option>
                </select>
        </div>
        <span class="col-md-3" ng-style="{'color' : 'red'}" ng-model="ecountry">{{ecountry}}</span>
    </div>
    <div class="form-group">
            <label class="col-md-2 control-label">Address</label>
            <div class="col-md-4"> 
                <textarea style="margin: 0px 666px 0px 0px; width: 277px; height: 87px;" type="text" ng-model="address" placeholder="Enter address here" class="form-control" ></textarea>
            </div>
            <span class="col-md-4" ng-style="{'color' : 'red'}" ng-model="eaddress">{{eaddress}}</span>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Area Code</label>
        <div class="col-md-4"> 
            <input type="text" ng-model="areacode" class="form-control" />
        </div>
        <span class="col-md-3" ng-style="{'color' : 'red'}" ng-model="eareacode">{{eareacode}}</span>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Telephone</label>
        <div class="col-md-4"> 
            <input type="text" ng-model="telephone" class="form-control" />
        </div>
        <span class="col-md-3" ng-style="{'color' : 'red'}" ng-model="etelephone">{{etelephone}}</span>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Mobile</label>
        <div class="col-md-4"> 
            <input type="text" ng-model="mobile" class="form-control" />
        </div>
        <span class="col-md-3" ng-style="{'color' : 'red'}" ng-model="emobile">{{emobile}}</span>
    </div>
    <hr />
    <h4>Account Detail</h4>
    <hr />
    <div class="form-group">
        <label class="col-md-2 control-label">User Name</label>
        <div class="col-md-4"> 
            <input type="text" ng-model="username" class="form-control" />
        </div>
        <span class="col-md-3" ng-style="{'color' : 'red'}" ng-model="eusername">{{eusername}}</span>
    </div>
    <div class="form-group">
    <label class="col-md-2 control-label">Password</label>
        <div class="col-md-4"> 
            <input ng-style="error()" type="password" ng-model="password" class="form-control" />
        </div>
        <span class="col-md-3" ng-style="{'color' : 'red'}" ng-model="epassword">{{epassword}}</span>
    </div>
    <div class="form-group">
    <label class="col-md-2 control-label">Confirm Password</label>
        <div class="col-md-4"> 
            <input ng-style="error()" type="password" ng-model="cpassword" class="form-control" />
        </div>
        <span class="col-md-3" ng-style="{'color' : 'red'}" ng-model="ecpassword">{{ecpassword}}</span>
    </div>
    <div class="form-group">
        <div class="col-md-offset-2 col-md-10">
            <button type="button" class="btn btn-default" ng-click="signUp()">Register</button>
        </div>
    </div>
       
 </form>


 <h3 class="col-md-3" class="alert" ng-style="{'color' : 'red'}" ng-model="status">{{status}}</h3>

</div>





<script type="text/javascript">

	var app = angular.module("myApp",[]);

	app.controller("myCtrl",function($scope,$http, $timeout) {

		$scope.efname = "";
		$scope.elname = "";
		$scope.eemail = "";
		$scope.eaddress = "";
		$scope.ecountry = "";
		$scope.eareacode = "";
		$scope.etelephone = "";
		$scope.emobile = "";
		$scope.edob = "";
		$scope.eusername = "";
		$scope.epassword = "";
		$scope.ecpassword = "";

		$http({

			url : "/Signup/country",
			method : "GET"
		}).then(function(response){

			var array = new Array();

			var jsObj = angular.fromJson(response);

			array = jsObj["data"]["result"];

			$scope.ctry = array;
		});

		function emptyField()
		{
				$scope.fname = "";
				$scope.lname = "";
				$scope.email = "";
				$scope.address = "";
				$scope.country = "";
				$scope.areacode = "";
				$scope.telephone = "";
				$scope.mobile = "";
				$scope.dateofbirth = "";
				$scope.username = "";
				$scope.password = "";
				$scope.cpassword = "";
		}


		$scope.signUp = function(){

		$scope.efname = "";
		$scope.elname = "";
		$scope.eemail = "";
		$scope.eaddress = "";
		$scope.ecountry = "";
		$scope.eareacode = "";
		$scope.etelephone = "";
		$scope.emobile = "";
		$scope.edob = "";
		$scope.eusername = "";
		$scope.epassword = "";
		$scope.ecpassword = "";


			var obj = {
				fname : $scope.fname,
				lname : $scope.lname,
				email : $scope.email,
				address : $scope.address,
				country : $scope.country,
				areacode : $scope.areacode,
				telephone : $scope.telephone,
				mobile : $scope.mobile,
				dateofbirth : $scope.dateofbirth,
				username : $scope.username,
				password : $scope.password,
				cpassword : $scope.cpassword

			}


	    var errorCount = 0;
		

		for (var key in obj) {
		    if (obj.hasOwnProperty(key)) {
		        console.log(key + " -> " + obj[key]);
		        if (key == "fname" && obj[key] == null) {
		        errorCount++;
		        	$scope.efname = "First name can not be empty";
		        }
		  		if (key == "lname" && obj[key] == null) {
		  			errorCount++;
		        	$scope.elname = "Last name can not be empty";
		        }
		        if (key == "email" && obj[key] == null) {
		    		errorCount++;
		        	$scope.eemail = "Email not vaild";
		        }
		        if (key == "country" && obj[key] == null) {
		   			errorCount++;
		        	$scope.ecountry = "Country must be selected";
		        }
		        if (key == "dateofbirth" && obj[key] == null) {
					errorCount++;
		        	$scope.edob = "Date of birth can not be empty";
		        }
		        if (key == "address" && obj[key] == null) {
		        	errorCount++;

		        	$scope.eaddress = "Address can not be empty";
		        }
		        if (key == "areacode" && obj[key] == null) {
		        	errorCount++;
	
		        	$scope.eareacode = "Area code can not be empty";
		        }
		        if (key == "telephone" && obj[key] == null) {
		   			errorCount++;
		        	$scope.etelephone = "Telephone can not be empty";
		        }
		        if (key == "mobile" && obj[key] == null) {
		        	errorCount++;
		   
		        	$scope.emobile = "Mobile can not be empty";
		        }
		        if (key == "username" && obj[key] == null) {

		        	errorCount++;
		
		        	$scope.eusername = "Username can not be empty";
		        }
		        if (key == "password" && obj[key] == null) {

		        	errorCount++;
		 
		        	$scope.epassword = "Password can not be empty";
		        }
		        if (key == "cpassword" && obj[key] == null) {

		        	errorCount++;
		
		        	$scope.ecpassword = "Confirm password can not be empty";
		        }
		    }
		}

		if ($scope.password != null && $scope.cpassword != null) {
			if ($scope.password != $scope.cpassword) {
				errorCount++;
				    $scope.error = function(){
					    return{
					        "border":"1px solid red"
					    }
					}
			}else
			{
				$scope.error = function(){
					   
				};
			}
		}
		if (errorCount == 0) {

			emptyField();


		    $http({

		    	url : "/Signup/signup_action",
		    	method : "POST",
		    	data : obj
		    }).then(function(response){


		    	console.log(response);

		    	var jsObj = angular.fromJson(response);

		    	if (jsObj["data"]["status"] == "success") {

                    $timeout(function () {
                        $scope.status = "Your are successfully signUp";
                    }, 4000);

                    window.location.href = "/";
		    	}else
		    	{
		    		$scope.status = jsObj["data"]["result"];
		    	}

		    });



		}


		};




	});


</script>

</body>
</html>