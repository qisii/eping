const grayWrapper = document.querySelector('.hero-wrapper')
const modulePopup = document.querySelector('#feeds-popup')
const createModuleBtn = document.querySelector(".create-btn")
const closeBtn = document.querySelector('#close-btn')

// // filter 
// const filterPopup = document.querySelector('#filter-popup')
// const filterBtn = document.querySelector('.filter-btn')
// const filterCloseBtn = document.querySelector('#filter-close-btn')


createModuleBtn.addEventListener('click', function() {
    modulePopup.classList.add("active")
    grayWrapper.classList.add("active")
})
closeBtn.addEventListener('click', function() {
    modulePopup.classList.remove("active")
    grayWrapper.classList.remove("active")
})


// filterBtn.addEventListener('click', function() {
//     filterPopup.classList.add("active")
//     grayWrapper.classList.add("active")

// })
// filterCloseBtn.addEventListener('click', function() {
//     filterPopup.classList.remove("active")
//     grayWrapper.classList.remove("active")
// })

  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };