

const cart = document.querySelector(".cart");
const price = document.querySelector("#cart-total-price");


async function removeFromCart(){
    const productid = this.getAttribute('data-id');

    await fetch(`/api/cart.php?type=remove&product=${encodeURIComponent(productid)}`).then((e) => updateCart());
}

function updateRemoveCarts(){
    document.querySelectorAll("button.remove-cart").forEach(function(btn){
        btn.addEventListener('click', removeFromCart);
    })
}
updateRemoveCarts();

function createProduct(product){
    const div = document.createElement('div');

    for (const key in product) {
        if(key != 0){
            const p = document.createElement('p');
            p.textContent = key + " - " + product[key];
            const button = document.createElement('button');
            button.textContent = "Remove From Cart";
            button.classList = "remove-cart"
            button.setAttribute("data-id", product['product']);
            div.appendChild(p);
            div.appendChild(button);
        }
    }
    cart.appendChild(div);
}

function setPrice(value){
    price.textContent = value;
}

async function updateCart(){
    await fetch('api/cart.php').then(
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
                            price ++;
                        }
                    )
                    updateRemoveCarts();
                    setPrice(price);
                }
            )
        }
    )
}

updateCart(); // on page load


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
