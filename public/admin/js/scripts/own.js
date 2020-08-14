// Vars
var reloadButton  = document.querySelector( '.reload' );
var reloadSvg     = document.querySelector( 'svg' );
var reloadEnabled = true;
var rotation      = 0;

// Events
reloadButton.addEventListener('click', function() { reloadClick() });

// Functions
function reloadClick() {

  reloadEnabled = false;
  rotation -= 180;

  // Eh, this works.
  reloadSvg.style.webkitTransform = 'translateZ(0px) rotateZ( ' + rotation + 'deg )';
  reloadSvg.style.MozTransform  = 'translateZ(0px) rotateZ( ' + rotation + 'deg )';
  reloadSvg.style.transform  = 'translateZ(0px) rotateZ( ' + rotation + 'deg )';

  // currentPalette = currentPalette + 1;
  // currentPalette = currentPalette % palettes.length;
  // document.body.style.background = palettes[currentPalette];
}

// Show button.
setTimeout(function() {
  reloadButton.classList.add('active');
}, 1);
