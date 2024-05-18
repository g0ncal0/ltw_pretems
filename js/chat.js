'use strict'

function encodeForAjax(data) {
    return Object.keys(data).map(function(k){
      return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
}

const newMessageButton = document.querySelector('#newCommentForm button')
const productId = document.querySelector('#newCommentForm #productId')
const buyerId = document.querySelector('#newCommentForm #buyerId')
const newMessage = document.querySelector('#newCommentForm #newMessage')
const csrfM = document.querySelector('#newCommentForm .csrf')

async function processMessage(message) {
    const newDiv = document.createElement("div");
    const newDivMsg = document.createElement("div");
    
    let user = null;
    let userPfp = null;

    if (message.fromBuyer) {
        user = await getUserName(buyerId.value);
        userPfp = await getUserPfp(buyerId.value);
        newDiv.className = "fromBuyer message";
        newDivMsg.className = "messageFromBuyer";
    }
    else {
        const product = await getProduct(productId.value);
        user = await getUserName(product.user);
        userPfp = await getUserPfp(product.user);
        newDiv.className = "fromSeller message";
        newDivMsg.className = "messageFromSeller";
    }

    newDiv.innerHTML = `            
        <img src="${userPfp}" alt="Profile Image" class="profile-image">        
    `;

    newDivMsg.innerHTML = `
        <p>${message.message}</p>
        <p class='message-from'>
            ${user} <span class="timestamp"> ${message.date} </span>
        </p>
    `;

    const section = document.querySelector('.messages');
    newDiv.appendChild(newDivMsg);
    section.appendChild(newDiv);
}

if (newMessageButton) {
    newMessageButton.addEventListener('click', async function(e) {
        e.preventDefault();

        if(!productId.value || !buyerId.value || !newMessage.value){
            return;
        }

        const data = {"productId": productId.value, "buyerId": buyerId.value, "message": newMessage.value, "csrf": csrfM.value};

        const response = await fetch('/api/chat.php', {
            method: "post",
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: encodeForAjax(data)
        });

        const message = await response.json()

        processMessage(message)

        newMessage.value = ''
    })
}

async function getUserName(userId) {
    const response = await fetch(`/api/user.php?userId=${userId}`);
    const data = await response.json();
    return data.name;
}

async function getProduct(productId) {
    const response = await fetch('/api/products.php', {method: "post", headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: encodeForAjax({'productId': productId})});

    const data = await response.json();
    return data;
}

async function getUserPfp(userId){
    const response = await fetch(`/api/user.php?userId=${userId}`);
    const data = await response.json();
    return data.profileImg;
}

function getLastMessageTimestamp() {
    const lastMessageTime = document.querySelector('.messages .message:last-child .timestamp');
    if (lastMessageTime) {
        const timestamp = lastMessageTime.textContent.trim();
        return timestamp;
    } else {
        return '0';
    }
}

async function fetchNewMessages(productId, buyerId, lastTime) {
    const response = await fetch(`/api/getNewMessages.php?productId=${productId}&buyerId=${buyerId}&lastTime=${lastTime}`);
    const messages = await response.json();
    return messages;
}

async function updateChat() {
    const lastTime = getLastMessageTimestamp();
    const messages = await fetchNewMessages(productId.value, buyerId.value, lastTime);
    const section = document.querySelector('.messages');

    if (messages != null) {
        messages.forEach(message => {
            processMessage(message);
        });
    }
}

setInterval(updateChat, 3000);
