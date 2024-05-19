
# Pretems

## Group ltw15g03

- Filipe Correia (up202206776) %
- Gonçalo Nunes (up202205538) %
- Vanessa Queirós (up202207919) %

## Install Instructions

    git clone https://github.com/FEUP-LTW-2024/ltw-project-2024-ltw15g03.git
    git checkout final-delivery-v1
    sudo apt-get install php-gd
    sqlite db/database.db < db/create.sql
    php -S localhost:9000

## External Libraries

We have used the following external libraries:

- normalize.css v8.0.1 | github.com/necolas/normalize.cs
- php-gd

## Screenshots

Several screenshots of our website. Using mobile and PC.

![image](https://github.com/FEUP-LTW-2024/ltw-project-2024-ltw15g03/assets/68955432/b3e5cf02-d2fc-424f-9daf-0f976f3794d0)

![image](https://github.com/FEUP-LTW-2024/ltw-project-2024-ltw15g03/assets/68955432/3dfdb9b6-581a-4941-8d43-97e2bf9267ab)


![image](https://github.com/FEUP-LTW-2024/ltw-project-2024-ltw15g03/assets/68955432/bed3560e-6c53-40da-a4df-5842028c3d73)

![image](https://github.com/FEUP-LTW-2024/ltw-project-2024-ltw15g03/assets/68955432/721b0dd8-ce5c-45ef-9b55-3dbf93b9a0f7)

<video src="https://github.com/FEUP-LTW-2024/ltw-project-2024-ltw15g03/assets/68955432/d51fb7b2-0bce-44b1-9888-962ec816c354" 
 width="320" height="240" controls></video>

<video src="https://github.com/FEUP-LTW-2024/ltw-project-2024-ltw15g03/assets/68955432/534ed423-69eb-4a1e-8021-1bd183e93ad7"  
 width="320" height="240" controls></video>




(Link for the videos: https://github.com/FEUP-LTW-2024/ltw-project-2024-ltw15g03/assets/68955432/d51fb7b2-0bce-44b1-9888-962ec816c354; https://github.com/FEUP-LTW-2024/ltw-project-2024-ltw15g03/assets/68955432/534ed423-69eb-4a1e-8021-1bd183e93ad7)



## Implemented Features

**General**:

- [x] Register a new account.
- [x] Log in and out.
- [x] Edit their profile, including their name, username, password, and email.

**Sellers**  should be able to:

- [x] List new items, providing details such as category, brand, model, size, and condition, along with images.
- [x] Track and manage their listed items.
- [x] Respond to inquiries from buyers regarding their items and add further information if needed.
- [x] Print shipping forms for items that have been sold.

**Buyers**  should be able to:

- [x] Browse items using filters like category, price, and condition.
- [x]  Engage with sellers to ask questions or negotiate prices.
- [x] Add items to a wishlist or shopping cart.
- [x] Proceed to checkout with their shopping cart (simulate payment process).

**Admins**  should be able to:

- [x] Elevate a user to admin status.
- [x] Introduce new item categories, sizes, conditions, and other pertinent entities.
- [x] Oversee and ensure the smooth operation of the entire system.

**Security**:
We have been careful with the following security aspects:

- [x] **SQL injection**
- [x] **Cross-Site Scripting (XSS)**
- [x] **Cross-Site Request Forgery (CSRF)**

**Password Storage Mechanism**: hash_password&verify_password

**Aditional Requirements**:

We also implemented the following additional requirements:

- [ ] **Rating and Review System**
- [x] **Promotional Features**
- [ ] **Analytics Dashboard**
- [x] **Multi-Currency Support**
- [ ] **Item Swapping**
- [x] **API Integration**
- [x] **Dynamic Promotions**
- [ ] **User Preferences**
- [ ] **Shipping Costs**
- [x] **Real-Time Messaging System**

Other additional features developed:

- [x] **PWA**
- [x] ****

