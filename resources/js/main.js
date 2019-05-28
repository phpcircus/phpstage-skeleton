require('./bootstrap');

// GLobal Scripts
[].map.call(document.querySelectorAll('.accessible-input'), function (input) {
  input.addEventListener('focus', function (event) {
    input.parentNode.classList.remove('accessible-input-container')
    input.parentNode.classList.add('accessible-input-container-active')
  });
  input.addEventListener('blur', function (event) {
    input.parentNode.classList.remove('accessible-input-container-active')
    input.parentNode.classList.add('accessible-input-container')
  });
});
