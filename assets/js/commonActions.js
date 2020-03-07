//Dom Queries
const navButton = document.querySelector(".navShowHide");
const mainSection = document.getElementById('mainSectionContainer');
const sideNav = document.getElementById('sideNavContainer');


//DOM events
navButton.addEventListener('click', function() {
    mainSection.classList.toggle('leftPadding');
});

function notSignedIn() {
    alert("You must be signed in to perform this action.");
}