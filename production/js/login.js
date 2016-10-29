// JavaScript Document

// DOM ready

    // Test data
    /*
     * To test the script you should discomment the function
     * testLocalStorageData and refresh the page. The function
     * will load some test data and the loadProfile
     * will do the changes in the UI
     */
    // testLocalStorageData();
    // Load profile if it exits
	//setLocalStorageData();

   
 // Trigger form submit
 $('form[name=form-signin]').submit(function(event){
		
		event.preventDefault(); // avoid to execute the actual submit of the form.

		var 	inputUsername =$('#inputUsername').val();
		var 	inputPassword =$('#inputPassword').val();
		var 	inputRemember =  $('#inputRemember').is(':checked') ? $('#inputRemember').val() : '';
		var 	SignDiffAccount =$('#SignDiffAccount').val();
		
		
		// Ajax progressbar loading start
		NProgress.start();
		
		// if checkbox #inputRemember = TRUE is checked -> Store Var to localStorage
		if(inputRemember == 'TRUE'){
			setLocalStorageData();
		}
		
		
		// Define Var for submitform
		 var request = $.ajax({
					type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
					url         : 'checkLogin.php', // the url where we want to POST
					data        : $(this).serialize(), // our data object
					dataType    : 'html' // text, html, xml, json, jsonp, and script.
					});
									
					//Success
					request.done (function(textStatus){
					//console.log(textStatus);   
					
					NProgress.done();  // Stop akax data progress
					
					// Check return from target submit from (TRUE,FALSE)
					if(textStatus == true){ // if true
						//showNotify('success');
						$('#message').show();
						$('#message').removeClass('alert alert-danger');
						$('#message').addClass('alert alert-success');
						$('#message').html('<i class="fa fa-check"></i> Login Success!!');									
						setTimeout("window.location.href = 'index.php' ",1000);	// Redirect to main page
						
					}else{ // If false -> show error message
						//console.log('Invalid username or Password!!'); 									
						$('#message').show();
						$('#message').removeClass('alert alert-success');
						$('#message').addClass('alert alert-danger');
						if(profileReRememberMe == 'TRUE'){
							$('#message').html('<i class="fa fa-warning"></i> Password wrong, Try again!');	
						}else{
							 $('#message').html('<i class="fa fa-warning"></i> Invalid username or password!!');		
						}
					}
		});
 });
		


//#############################################################

//Get Current Datetime from store in localStorage	
var dt = new Date();
var dateTime = moment().format('MMMM Do YYYY, h:mm:ss a'); //= dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
			
// Get Remember Me Status   
var profileReRememberMe = localStorage.getItem("APPS.SITE.PROFILE_REMEMBER_ME");
		//console.log(profileReRememberMe);
		
		
// if remember me not equa TURE -> Show div #rememberme 	
if(profileReRememberMe != 'TRUE'){
		 $("#remember").show();
         $("#profile-name").hide();
		 $("#SignDiffAccount").hide();
}else{
		loadProfile();
		$("#SignDiffAccount").show();
}


//#############################################################

// Reset remember accout to login other user
$('#SignDiffAccount').click(function(text){
		ResetLocalStorageData(); // Reset localStorage
		window.location.reload(true); // Refresh current page
});



/**
 * Function that gets the data of the profile in case
 * thar it has already saved in localstorage. Only the
 * UI will be update in case that all data is available
 *
 * A not existing key in localstorage return null
 *
 */
 
 // Function for get localStorage
function getLocalProfile(callback){
	var profileImgSrc      = localStorage.getItem("APPS.SITE.PROFILE_IMG_SRC");
	var profileName        = localStorage.getItem("APPS.SITE.PROFILE_NAME");
	var profileReAuthUserName = localStorage.getItem("APPS.SITE.PROFILE_REAUTH_USERNAME");
	var profileReRememberMe = localStorage.getItem("APPS.SITE.PROFILE_REMEMBER_ME");
	var profilelastLogin = localStorage.getItem("APPS.SITE.PROFILE_LAST_LOGIN");

    if(profileName !== null
            && profileReAuthUserName !== null
            && profileImgSrc !== null) {
        callback(profileImgSrc, profileName, profileReAuthUserName ,profileReRememberMe, profilelastLogin);
    }
}

/**
 * Main function that load the profile if exists
 * in localstorage
 */
function loadProfile() {
    if(!supportsHTML5Storage()) { return false; }
    // we have to provide to the callback the basic
    // information to set the profile
    getLocalProfile(function(profileImgSrc, profileName, profileReAuthUserName ,profileReRememberMe, profilelastLogin) {
        //changes in the UI
		$("#profile-img").attr("src",profileImgSrc);
		$("#profile-name").html(profileName);
		$("#reauth-username").html(profileReAuthUserName);
		$("#remember").html(profileReRememberMe);
		$("#reauth-last-login").html(profilelastLogin);		 
		$("#inputUsername").val(profileReAuthUserName);
		$("#inputUsername").hide();
		$("#remember").hide();
		$("#reauth-last-login").show();
    });
}

/**
 * function that checks if the browser supports HTML5
 * local storage
 *
 * @returns {boolean}
 */
function supportsHTML5Storage() {
    try {
        return 'localStorage' in window && window['localStorage'] !== null;
    } catch (e) {
        return false;
    }
}

/**
 * Test data. This data will be safe by the web app
 * in the first successful login of a auth user.
 * To Test the scripts, delete the localstorage data
 * and comment this call.
 *
 * @returns {boolean}
 */
function setLocalStorageData() {
    if(!supportsHTML5Storage()) { return false; }		
		localStorage.setItem("APPS.SITE.PROFILE_IMG_SRC", "./images/img.jpg" );
		localStorage.setItem("APPS.SITE.PROFILE_NAME", $("#profile-name").text());
		localStorage.setItem("APPS.SITE.PROFILE_REAUTH_USERNAME", inputUsername.value);
		localStorage.setItem("APPS.SITE.PROFILE_REMEMBER_ME", inputRemember.value);
		localStorage.setItem("APPS.SITE.PROFILE_LAST_LOGIN", 'Last login : '+dateTime);
}

/**
 * Reset LocalStorage
 * @returns {boolean}
 */
function ResetLocalStorageData() {
    if(!supportsHTML5Storage()) { return false; }
    localStorage.setItem("APPS.SITE.PROFILE_IMG_SRC", "./images/user.png");
    localStorage.setItem("APPS.SITE.PROFILE_NAME", "");
    localStorage.setItem("APPS.SITE.PROFILE_REAUTH_USERNAME", "<input type='text' name='inputUsername' id='inputUsername' class='form-control' placeholder='Username' required autofocus>");
	 localStorage.setItem("APPS.SITE.PROFILE_REMEMBER_ME", "<input type='checkbox' name='inputRemember' id='inputRemember' value='TRUE'>");
	 localStorage.setItem("APPS.SITE.PROFILE_LAST_LOGIN", '');
}