const inputs = document.querySelectorAll('input');
const button = document.querySelector('button');

inputs.forEach((input, index) => {
  input.addEventListener('keyup', function (e){

    const current = input;
    const next = input.nextElementSibling;
    const previous = input.previousElementSibling;

    if(current.value.length > 1){
      current.value = "";
    }

    if(next && next.hasAttribute('disabled') && current.value !== ""){
      next.removeAttribute('disabled');
      next.focus();
    }

    if(e.key === "Backspace"){
      if(current.value !== ""){
        current.value = "";
        current.focus();
      }
      else if(previous){
        current.setAttribute('disabled', true);
        previous.focus();
      }
    }

    if (!input.disabled && index === 3 && input.value !== ""){
      button.classList.add("active");
    }
    else {
      button.classList.remove("active");
    }

  })
})

window.addEventListener("load", () => inputs[0].focus());
