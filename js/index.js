
function toggleMenu(){
    document.querySelector(".menu").classList.toggle("visible");
    document.querySelector("html main").classList.toggle("stop-behavior");

}

document.querySelector("header .menu-header").addEventListener("click", toggleMenu);
document.querySelector(".menu #close-menu").addEventListener("click", toggleMenu);



function toggleLoginSignup(){
    const loginel = document.querySelector(".login-signup");
    loginel.classList.toggle("visible");
    document.querySelector("html main").classList.toggle("stop-behavior");
}


document.querySelector("#open-profile").addEventListener("click", toggleLoginSignup);
document.querySelector("#close-login").addEventListener("click", toggleLoginSignup);




async function addToCart(){
    const productid = this.getAttribute('data-id');

    await fetch(`/api/cart.php?type=insert&product=${encodeURIComponent(productid)}`).then((r)=>console.log(r))
    
}

document.querySelectorAll("button.add-cart").forEach(function(btn){
    btn.addEventListener('click', addToCart)
})