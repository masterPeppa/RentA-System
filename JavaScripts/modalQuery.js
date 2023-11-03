// initialization
const showConfirmation = document.getElementById('confirmation_id');
const openConfirmationButton = document.getElementById('approvedConfirmation');
const closeConfirmation = document.getElementsByClassName('btn_No')[0];
const btnYes = document.getElementById('btn_Yes');
const btnLease = document.getElementById('btn_Sendlease');
const btnApprove = document.getElementById('approvedConfirmation');
const btnReject = document.getElementById('btn_reject');
const btnMessage = document.getElementById('btn_Message');

// Function to open the confirmation
function openConfirmationFunction() {
    showConfirmation.style.display = 'block';
}

// Function to close the confirmation
function closeConfirmationFunction() {
    showConfirmation.style.display = 'none';
}
//to hide buttons and show only send lease

function confirmed(){
    showConfirmation.style.display = 'none';
    btnApprove.style.display = 'none';
    btnReject.style.display = 'none';
    btnMessage.style.display = 'none';
    btnLease.style.display = 'block';
}


// Event listeners to open and close the confirmation
btnYes.addEventListener('click', confirmed);
openConfirmationButton.addEventListener('click', openConfirmationFunction);
closeConfirmation.addEventListener('click', closeConfirmationFunction);
window.addEventListener('click', (event) => {
    if (event.target === showConfirmation) {
        closeConfirmationFunction();
    }
});