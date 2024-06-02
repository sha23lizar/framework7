document.getElementById('custom-google-button').addEventListener('click', function() {
  gapi.auth2.getAuthInstance().signIn();
});

function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
  $("#name").text(profile.getName());
  $("#email").text(profile.getEmail());
  $("#image").attr('src', profile.getImageUrl());
  $(".data").css("display", "flex");
  $(".container").css("display", "none");
}


function signOut() {
  var auth2 = gapi.auth2.getAuthInstance();
  auth2.signOut().then(function () {
      alert('User signed out.');
      $(".container").css("display", "flex");
  });
}
