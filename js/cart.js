'use strict'

const cartInterface = document.querySelector(".cart_interface");
const cart = document.querySelector(".cart");
const price = document.querySelector("#cart-total-price");
const checkoutDIV = document.querySelector("#checkout");
const discountInput = document.querySelector("input#discount");
let INITIALprice = 0;

async function removeFromCart(){
    const productid = this.getAttribute('data-id');

    await fetch(`/api/cart.php`, {method: "DELETE", headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      }, body: encodeForAjax({'product': productid})}).then((e) => updateCart());
}

function updateRemoveCarts(){
    document.querySelectorAll("button.remove-cart").forEach(function(btn){
        btn.addEventListener('click', removeFromCart);
    })
}
updateRemoveCarts();

function createProduct(product){
    const div = document.createElement('div');
    div.setAttribute('class', 'box-item');

    const boxDetails = document.createElement('div');
    boxDetails.setAttribute('class', 'box-details');

    const productImg = document.createElement('img');
    productImg.setAttribute('src', product['firstImg']);
    div.appendChild(productImg);

    const nameLink = document.createElement('a');
    const productId = product['id'];
    nameLink.setAttribute('href', `item.php?id=${productId}`);
    boxDetails.appendChild(nameLink);
    
    const productName = document.createElement('h3');
    productName.textContent = product['name'];
    nameLink.appendChild(productName);

    const divPriceButton = document.createElement('div');
    boxDetails.appendChild(divPriceButton);

    const productPrice = document.createElement('p');
    productPrice.textContent = product['price'] + '€';
    divPriceButton.appendChild(productPrice);

    const button = document.createElement('button');
    button.textContent = "Remove From Cart";
    button.classList = "remove-cart button";
    button.setAttribute("data-id", product['id']);
    divPriceButton.appendChild(button);

    div.appendChild(boxDetails);
    cart.appendChild(div);
}

function setPrice(value){
    value = parseFloat(value);
    price.textContent = value.toFixed(2);
}

async function updateCart(){
    await fetch('api/cart.php', {method: "POST"}).then(
        (re) =>{
            re.json().then(
                (products) =>{
                    let price = 0;
                    cart.innerHTML = "";
                    if(products === undefined || products.length == 0){
                        setPrice(0);
                        cart.innerHTML = "<p>There are currently no items in your shopping cart</p>";
                    }
                    products.forEach(
                        (product) =>{
                            const prodDiv = document.createElement("div");
                            createProduct(product);
                            price += product['price'];
                        }
                    )
                    updateRemoveCarts();
                    setPrice(price);
                    INITIALprice = price;
                    return price;
                }
            )
        }
    )
}

updateCart(); // on page load


async function proceedToCheckout(){
    await fetch("api/user.php").then(response => {
        if (!response.ok) {
          console.log("error");
        }
        const user = response.json().then(
            async (u) => {
                if(u.user){
                    await fetch("api/cart.php", {method:"POST"}).then((r) =>r.json().then(
                        (products)=>{
                            if(!(products == undefined || products.length == 0)){
                                cartInterface.classList.add("unclickable");
                                checkoutDIV.style.display = "block";
                            }
                        }
                    ))
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




const discountcode = document.querySelector("input#discount-code");
const discountSubmit = document.querySelector("button#discount-submit");
const messageDiscount = document.querySelector("#info-discount")

async function addDiscount(){
    const code = discountcode.value;
    await fetch(`/api/discount.php`, {method: "POST", headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      }, body: encodeForAjax({'value': INITIALprice, 'discount': code})}).then((e) => e.json().then((content) =>{
        
        if(content['result']){
            setPrice(content['result']);
            discountInput.value = code;
        }else{
            setPrice(INITIALprice);
        }
        messageDiscount.innerHTML = content['error'];
      }));
}

discountSubmit.addEventListener('click', addDiscount);