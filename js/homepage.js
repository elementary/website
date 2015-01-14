var overlayBtn = document.getElementById('overlay-download');
overlayBtn.addEventListener('click', openDownload);

window.addEventListener('popstate', function () {
    handler.close();
});

var downloadBtn = document.getElementById('download');
downloadBtn.addEventListener('click', function(event) {
    doStripePayment();
    event.preventDefault();
});

var handler = StripeCheckout.configure({
    key: 'pk_test_aPQFfHx96Qeznh5tFGzW3H6T',
    image: '/logomark.svg',
    token: function (token) {
        console.log(token);
        //TODO: send payment token to server
    },
    closed: toggleOverlay
});

function parseDonation() {
    var amount = document.getElementById('donate').value;
    if (-1 == amount.indexOf('.')) {
        var isDollar = true;
    }
    var cleanAmount = amount.replace(/\D+/g, '');
    if (isDollar) {
        cleanAmount = cleanAmount + '00';
    }
    return cleanAmount;
}

function doStripePayment () {
    var amount = parseDonation();
    if (/^0+$/.test(amount)) {
        //if some type of 0 is specified, do not open handler and direct user to download
        toggleOverlay();
        return;
    }
    handler.open({
        name: 'elementary LLC.',
        description: 'elementary OS download',
        amount: amount
    });
}

function toggleOverlay(){
    console.log("toggleOverlay");
    var overlay = document.getElementById('overlay');
    var content = document.getElementById('overlay-content');
    overlay.style.opacity = 0.7;
    if(overlay.style.display == 'block'){
        overlay.style.display = 'none';
        content.style.display = 'none';
    } else {
        overlay.style.display = 'block';
        content.style.display = 'block';
    }
}

function openDownload() {
    var bitOptions = document.getElementsByName('bit');
    for(var i=0; i<bitOptions.length; i++) {
        var option = bitOptions[i];
        if(option.checked) {
            if('64' == option.value) {
                window.open('http://downloads.sourceforge.net/project/elementaryos/unstable/elementaryos-unstable-amd64.20140810.iso');
            } else {
                //TODO put download for 32 bit here
            }
        }
    }
    toggleOverlay();
}