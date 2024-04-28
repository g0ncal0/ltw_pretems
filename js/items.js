

const list_items = document.querySelector("#products");
const button_filter = document.querySelector('#submit-filter');
const sizeE = document.querySelector("#form-filter #size");
const categoryE = document.querySelector("#form-filter #category");
const brandE = document.querySelector("#form-filter #brand");
const conditionE = document.querySelector("#form-filter #condition");
const minpriceE = document.querySelector("#form-filter .min-input");
const maxpriceE = document.querySelector("#form-filter .max-input");
const button_continue = document.querySelector('#more-items');


// Function
let offset = 0; // the current offset



/*

<div class="box-item">             
    <img src="<?php echo $product['firstImg'] ?>">

    <div class="box-details">
        <a href="/item.php?id=<?php echo $product['id']?>">
        <h3><?php echo $product['name']?></h3></a>
        <p class="info"><span>NEW</span><span><?php echo getBrand($db, $product['brand'])?></span></p>
        <div>
            <p><?php echo $product['price']?></p>
            <button data-id="<?php echo $product['id'] ?>"  class="button add-cart">ADD TO CART</button>
        </div>
    </div>
</div>


*/


function build_item(prod){
    let item = document.createElement('div');

    let img = document.createElement('img');
    img.setAttribute('src', prod['firstImg']);
    item.appendChild(img);

    item.setAttribute('class', 'box-item');
    let linkitem = document.createElement('a');
    linkitem.href = 'item.php?id=' + prod['id'];
    let h3e = document.createElement('h3');
    h3e.textContent = prod['name'];
    linkitem.appendChild(h3e);
    item.appendChild(linkitem);

    let dbuy = document.createElement('div');
    let p = document.createElement('p');
    let bu = document.createElement('button');
    bu.textContent = 'Add to cart';
    bu.setAttribute('class', 'add-cart');
    bu.setAttribute('data-id', prod['id']);
    p.textContent = prod['price'];
    dbuy.appendChild(p);
    dbuy.appendChild(bu);

    item.appendChild(dbuy);

    return item
}


async function get_items(){
    if(offset == 0){
        // we want to clean out everything.
        list_items.innerHTML = "";
    }
    data = {'category': categoryE.value, 'brand': brandE.value, 'size': sizeE.value, 'condition': conditionE.value, 'min': minpriceE.value, 'max': maxpriceE.value, 'offset': offset}; // define the data
    await fetch('/api/products.php', {method: "post", headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      }, body: encodeForAjax(data)}).then((r)=>r.json().then(
        (d) =>{
            let count = d['products'].length;
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

button_filter.addEventListener('click', (e) =>{e.preventDefault(); offset = 0; get_items();});
if(button_continue){
    button_continue.addEventListener('click', (e) =>{e.preventDefault(); offset++; get_items();})
}

button_continue.style.display = 'block';
get_items();



