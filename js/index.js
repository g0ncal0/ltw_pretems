

function toggleMenu(){
    
    document.querySelector(".login-signup").classList.remove("visible");
   
    document.querySelector(".menu").classList.toggle("visible");

    if(!document.querySelector('.menu').classList.contains("visible")){
        document.querySelector("html main").classList.remove("stop-behavior");
    }else{
        document.querySelector("html main").classList.add("stop-behavior");
    }
}

document.querySelector("header .menu-header").addEventListener("click", toggleMenu);
document.querySelector(".menu #close-menu").addEventListener("click", toggleMenu);



async function toggleLoginSignup(){
    await fetch('/api/user.php').then(
        (e)=>{e.json().then(
            (user)=>{
                console.log(user);
                if(user.user){
                    window.location.replace("/profile.php");
                }else{
                    document.querySelector(".menu").classList.remove("visible");
                    const loginel = document.querySelector(".login-signup");
                    loginel.classList.toggle("visible");
                
                    if(!loginel.classList.contains("visible")){
                        document.querySelector("html main").classList.remove("stop-behavior");
                    }else{
                        document.querySelector("html main").classList.add("stop-behavior");
                    }
                }
            }
        )}
    )
    
}


document.querySelectorAll(".toggle-login").forEach(function(btn){
    btn.addEventListener('click', toggleLoginSignup);
})



async function logout(){
    await fetch('api/logout.php').then(() => {window.location.replace('/')});
}

document.querySelectorAll(".act-logout").forEach(function(btn){
    btn.addEventListener('click', logout)
})



async function addToCart(){
    const productid = this.getAttribute('data-id');

    await fetch(`/api/cart.php?type=insert&product=${encodeURIComponent(productid)}`);
    
}

document.querySelectorAll("button.add-cart").forEach(function(btn){
    btn.addEventListener('click', addToCart)
})



async function removeFromCart(){
    const productid = this.getAttribute('data-id');

    await fetch(`/api/cart.php?type=remove&product=${encodeURIComponent(productid)}`);
}

document.querySelectorAll("button.remove-cart").forEach(function(btn){
    btn.addEventListener('click', removeFromCart);
})


async function proceedToCheckout(){
    const user = await fetch("api/user.php").then(response => {
        if (!response.ok) {
          console.log("error");
        }
        const user = response.json().then(
            (u) => {
                if(u.user){
                    window.location.replace('checkout.php');
                }else{
                    toggleLoginSignup();
                }
            }
        );
       
      })
}

const checkout = document.querySelector("button.proceed-checkout");
if(checkout){
    checkout.addEventListener('click', proceedToCheckout);
}

