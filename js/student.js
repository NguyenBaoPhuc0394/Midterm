const sidebar = document.querySelector("#toggle-btn")

sidebar.addEventListener("click", function(){
    document.querySelector("#sidebar").classList.toggle("expand"); 
});  


const sidebarItem = document.querySelectorAll(".sidebar-item")
function active(event){
    sidebarItem.forEach(item => {
        item.classList.remove('active')
    })
    event.currentTarget.classList.add('active');
}
sidebarItem.forEach(item => {
    item.addEventListener('click',active);
})

// const avatar = document.querySelector("#avatar")
function home(event){
    sidebarItem.forEach(item => {
        item.classList.remove('active')
    })
}