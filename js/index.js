'use strict'

function encodeForAjax(data) {
    return Object.keys(data).map(function(k){
      return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
  }



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


async function addToCartProductId(id){
    const audio = new Audio("/img/ping.mp3");
    await fetch('/api/cart.php', {method: 'PUT', headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      }, body: encodeForAjax({'product': id})});
    audio.play();

}

async function addToCart(){
    const productid = this.getAttribute('data-id');
    addToCartProductId(productid);
}

document.querySelectorAll("button.add-cart").forEach(function(btn){
    btn.addEventListener('click', addToCart)
})

async function addToFavoritesProductId(id){
    await fetch('/api/favorites.php', {method: 'PUT', headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      }, body: encodeForAjax({'product': id})});
}

async function removeFromFavoritesProductId(id){
    await fetch(`/api/favorites.php`, {method: "DELETE", headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      }, body: encodeForAjax({'product': id})});
}

async function addToFavorites(){
    const productid = this.getAttribute('data-id');

    if (!this.classList.contains("favorited")) {
        await addToFavoritesProductId(productid);
        this.innerHTML = "REMOVE FAVS";
        this.classList.add("favorited");
    }

    else {
        await removeFromFavoritesProductId(productid);
        this.innerHTML = "FAVORITES";
        this.classList.remove("favorited");
    }
}

document.querySelectorAll("button.add-favorites").forEach(function(btn){
    btn.addEventListener('click', addToFavorites)
})








/******* PRICE RANGE ******/
// INSPIRED FROM https://www.geeksforgeeks.org/price-range-slider-with-min-max-input-using-html-css-and-javascript/

const rangevalue = document.querySelector(".slider-container .price-slider"); 
const rangeInputvalue = document.querySelectorAll(".range-input input"); 

const priceGap = 50; 
  
const priceInputvalue = document.querySelectorAll(".price-input span.pr"); 
  

for (let i = 0; i < rangeInputvalue.length; i++) { 
    rangeInputvalue[i].addEventListener("input", e => { 
        let minVal = parseInt(rangeInputvalue[0].value); 
        let maxVal = parseInt(rangeInputvalue[1].value); 

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
            priceInputvalue[0].textContent = minVal; 
            priceInputvalue[1].textContent = maxVal; 
            rangevalue.style.left = 
                `${(minVal / rangeInputvalue[0].max) * 100}%`; 
            rangevalue.style.right = 
                `${100 - (maxVal / rangeInputvalue[1].max) * 100}%`; 
        } 
    }); 
} 






/***** LOGIN ******/

const csrfLogin = document.querySelector("#login-form .csrf");
const loginButton = document.querySelector("#login-submit");
const emailLogin = document.querySelector("#login-form input[name='Lemail']");
const passwordLogin = document.querySelector("#login-form input[name='Lpassword']");
const infoLogin = document.querySelector("#sucess-login");

async function login(){
    
    if(!emailLogin.value.includes("@") || !passwordLogin.value){
        //password not valid
        infoLogin.textContent = "Oopss... We don't think that is valid.";
        return;
    }
    const data = {"email": emailLogin.value, "password": passwordLogin.value, "csrf": csrfLogin.value};

    let cart = [];

    await fetch('/api/cart.php', {method: "POST"}).then((response) =>{
        response.json().then(
            async (data)=>{
                data.forEach(
                    (product)=>{
                        cart.push(product['id']);
                    }
                )
            }
        )
    })

    let favorites = [];

    await fetch('/api/favorites.php', {method: "POST"}).then((response) =>{
        response.json().then(
            async (data)=>{
                data.forEach(
                    (product)=>{
                        favorites.push(product['id']);
                    }
                )
            }
        )
    })
   

    await fetch('/api/login.php', {method: "post", headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      }, body: encodeForAjax(data)}).then((response) =>{
        response.json().then(
            async (data)=>{
                if(data['success']){
                    infoLogin.textContent = "Success.";
                    cart.forEach(
                        (product)=>{addToCartProductId(product);}
                    )
                    favorites.forEach(
                        (product)=>{addToFavoritesProductId(product);}
                    )
                    setTimeout(() => location.reload(), 500)
                    
                }else{
                    infoLogin.textContent = "Wrong password or username";
                    passwordLogin.value ="";
                }
            }
        )
    })
    


}

loginButton.addEventListener('click', (e) =>{e.preventDefault(); login();});



const registerFormPassword = document.querySelector("#register-account input[type='password']");

function handlePasswordSecurity(){
    if(registerFormPassword){
        let security = 0;
        const pw = registerFormPassword.value;
        if (pw.match(/[a-z]+/)) {
            security += 1;
        }
        if (pw.match(/[A-Z]+/)) {
            security += 1;
        }
        if (pw.match(/[0-9]+/)) {
            security += 1;
        }
        if (pw.match(/[$@#&!]+/)) {
            security += 1;
        }
        if(pw.length > 5){
            security += 2;
        }
        if(pw.length > 12){
            security += 4;
        }
        if(pw.length > 15){
            security = 10;
        }

        const progress = document.querySelector("#info-password");
        progress.value = security * 10;
        if(security < 5){
            document.querySelector("#register-account button[type='submit']").disabled = true;
            document.querySelector("#password-message").innerText = "Please choose a better password.";
        }else{
            document.querySelector("#register-account button[type='submit']").disabled = false;
            document.querySelector("#password-message").innerText = "";
        }
    }
}


if(registerFormPassword){
    registerFormPassword.addEventListener("input", handlePasswordSecurity)
}



/**** ITEMS *****/

const csrf = document.querySelector("#form-filter .csrf");
const list_items = document.querySelector("#products");
const button_filter = document.querySelector('#submit-filter');
const sizeE = document.querySelector("#form-filter #size");
const categoryE = document.querySelector("#form-filter #category");
const brandE = document.querySelector("#form-filter #brand");
const conditionE = document.querySelector("#form-filter #condition");
const minpriceE = document.querySelector("#form-filter .min-range");
const maxpriceE = document.querySelector("#form-filter .max-range");
const button_continue = document.querySelector('#more-items');
const searchI = document.querySelector("#form-filter input[name='q']")

// Function
let offset = 0; // the current offset


function build_item(prod){
    let item = document.createElement('div');

    let img = document.createElement('img');
    img.setAttribute('src', prod['firstImg']);
    item.appendChild(img);

    item.setAttribute('class', 'box-item');
    let item_info = document.createElement('div');
    item_info.setAttribute('class', 'box-details');
    let linkitem = document.createElement('a');
    linkitem.href = 'item.php?id=' + prod['id'];
    let h3e = document.createElement('h3');
    h3e.textContent = prod['name'];
    linkitem.appendChild(h3e);
    item.appendChild(item_info);
    item_info.appendChild(linkitem);

    let dbuy = document.createElement('div');
    let p = document.createElement('p');
    p.setAttribute('class', 'price');
    let bu = document.createElement('button');
    bu.textContent = 'Add to cart';
    bu.setAttribute('class', 'add-cart button');
    bu.setAttribute('data-id', prod['id']);
    p.textContent = prod['price'] + '€';
    dbuy.appendChild(p);
    dbuy.appendChild(bu);
    item_info.appendChild(dbuy);


    //item.appendChild(dbuy);

    return item
}


async function get_items(){
    if(offset == 0){
        // we want to clean out everything.
        list_items.innerHTML = "";
    }
    const data = {'category': categoryE.value, 'brand': brandE.value, 'size': sizeE.value, 'condition': conditionE.value, 'min': minpriceE.value, 'max': maxpriceE.value, 'offset': offset, 'q': searchI.value, 'csrf': csrf.value}; // define the data
    await fetch('/api/products.php', {method: "post", headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      }, body: encodeForAjax(data)}).then((r)=>r.json().then(
        (d) =>{
            const count = d['products'].length;
            if(count == 0){
                const errorNotMore = document.createElement('p');
                errorNotMore.textContent = "You wanted it.. But, we have no more products";
                list_items.append(errorNotMore);
            }
           
            d['products'].forEach((element) => {
                const t = build_item(element);
                list_items.appendChild(t);
            });
            document.querySelectorAll("button.add-cart").forEach(function(btn){
                btn.addEventListener('click', addToCart)
            })
            if(count != 20){
                button_continue.style.display= "none";
            }else{
                button_continue.style.display = 'block';
            }
        }
      ))
}
if(button_filter){
    button_filter.addEventListener('click', (e) =>{e.preventDefault(); offset = 0; get_items();});
    get_items();
}
if(button_continue){
    button_continue.addEventListener('click', (e) =>{e.preventDefault(); offset++; get_items();})
    button_continue.style.display = 'block';
}





/**** SEARCH *****/


const searchE = document.querySelector("#search-form input");
const searchB = document.querySelector("#search-form button");
const searchlist = document.querySelector("#search-results");


async function search(){
    await fetch('/api/search.php',{method: "post", headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      }, body: encodeForAjax({'q': searchE.value})}).then((response) =>{
        response.json().then(
            async (data)=>{
                searchlist.innerHTML = "";
                data['products'].forEach((element) => {
                    const t = build_item(element);
                    searchlist.appendChild(t);
                });
            }
        )})

    }

if(searchB != null){
    searchB.addEventListener('click', (e)=>{e.preventDefault(); search();})
}






/** OPENING PRODUCT IMAGES LARGE ***/


function closeBigImg(){
    const bimg = document.querySelector('.photo-display-large');
    if(bimg){
        bimg.remove();
    }
}

function stop(e){
    e.stopPropagation();
}

function buildBigImg(src){
    const b = document.querySelector('.photo-display-large');
    if(b){
        closeBigImg();
    }
    const bimg = document.createElement('div');
    bimg.setAttribute('onclick', "closeBigImg()");
    const img = document.createElement('img');
    img.setAttribute('src', src);
    img.setAttribute('onclick', 'event.stopPropagation()')

    bimg.append(img);
    bimg.classList.add('photo-display-large');
    document.querySelector('main').append(bimg);
}


function openLarge(){
    const imgsrc = this.src;
    buildBigImg(imgsrc);
}

document.querySelectorAll(".product-imgs").forEach(function(img){
    img.addEventListener('click', openLarge);
})