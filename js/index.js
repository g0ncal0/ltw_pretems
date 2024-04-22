
const main = document.querySelector("html main");

function toggleMenu(){
    
    document.querySelector(".login-signup").classList.remove("visible");
   
    document.querySelector(".menu").classList.toggle("visible");

    if(!document.querySelector('.menu').classList.contains("visible")){
        main.classList.remove("stop-behavior");
        main.classList.remove("unclickable");
    }else{
        main.classList.add("stop-behavior");
        main.classList.add("unclickable");
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
                        main.classList.remove("stop-behavior");
                        main.classList.remove("unclickable");
                    }else{
                        main.classList.add("stop-behavior");
                        main.classList.add("unclickable");
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









/******* PRICE RANGE ******/
// INSPIRED FROM https://www.geeksforgeeks.org/price-range-slider-with-min-max-input-using-html-css-and-javascript/

const rangevalue =  
    document.querySelector(".slider-container .price-slider"); 
const rangeInputvalue =  
    document.querySelectorAll(".range-input input"); 
  
// Set the price gap 
let priceGap = 50; 
  
// Adding event listners to price input elements 
const priceInputvalue =  
    document.querySelectorAll(".price-input input"); 
for (let i = 0; i < priceInputvalue.length; i++) { 
    priceInputvalue[i].addEventListener("input", e => { 
  
        // Parse min and max values of the range input 
        let minp = parseInt(priceInputvalue[0].value); 
        let maxp = parseInt(priceInputvalue[1].value); 
        let diff = maxp - minp 
  
        if (minp < 0) { 
            alert("minimum price cannot be less than 0"); 
            priceInputvalue[0].value = 0; 
            minp = 0; 
        } 
  
        // Validate the input values 
        if (maxp > 10000) { 
            alert("maximum price cannot be greater than 10000"); 
            priceInputvalue[1].value = 10000; 
            maxp = 10000; 
        } 
  
        if (minp > maxp - priceGap) { 
            priceInputvalue[0].value = maxp - priceGap; 
            minp = maxp - priceGap; 
  
            if (minp < 0) { 
                priceInputvalue[0].value = 0; 
                minp = 0; 
            } 
        } 
  
        // Check if the price gap is met  
        // and max price is within the range 
        if (diff >= priceGap && maxp <= rangeInputvalue[1].max) { 
            if (e.target.className === "min-input") { 
                rangeInputvalue[0].value = minp; 
                let value1 = rangeInputvalue[0].max; 
                rangevalue.style.left = `${(minp / value1) * 100}%`; 
            } 
            else { 
                rangeInputvalue[1].value = maxp; 
                let value2 = rangeInputvalue[1].max; 
                rangevalue.style.right =  
                    `${100 - (maxp / value2) * 100}%`; 
            } 
        } 
    }); 
  
    // Add event listeners to range input elements 
    for (let i = 0; i < rangeInputvalue.length; i++) { 
        rangeInputvalue[i].addEventListener("input", e => { 
            let minVal =  
                parseInt(rangeInputvalue[0].value); 
            let maxVal =  
                parseInt(rangeInputvalue[1].value); 
  
            let diff = maxVal - minVal 
              
            // Check if the price gap is exceeded 
            if (diff < priceGap) { 
              
                // Check if the input is the min range input 
                if (e.target.className === "min-range") { 
                    rangeInputvalue[0].value = maxVal - priceGap; 
                } 
                else { 
                    rangeInputvalue[1].value = minVal + priceGap; 
                } 
            } 
            else { 
              
                // Update price inputs and range progress 
                priceInputvalue[0].value = minVal; 
                priceInputvalue[1].value = maxVal; 
                rangevalue.style.left = 
                    `${(minVal / rangeInputvalue[0].max) * 100}%`; 
                rangevalue.style.right = 
                    `${100 - (maxVal / rangeInputvalue[1].max) * 100}%`; 
            } 
        }); 
    } 
}


