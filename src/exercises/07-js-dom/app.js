console.log("hello World")


let myButton = document.getElementById("myBtn");
let myInput = document.getElementById("title")


function addParagraph() {
  const p = document.createElement('p');
  p.innerHTML = myInput.value;
  document.body.appendChild(p);
}

myButton.addEventListener('click',addParagraph);
myInput.addEventListener('keyup',function(e){
    if(e.key === 'Enter'){
        addParagraph();
    }
})


