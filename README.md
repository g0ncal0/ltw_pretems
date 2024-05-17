
# Your Project Name

## Group ltw00g00

- Filipe Correia (up202206776) %
- Gonçalo Nunes (up2022) %
- Vanessa Queirós (up2022) %

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

(2 or 3 screenshots of your website)

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

**Password Storage Mechanism**: md5 / sha1 / sha256 / *hash_password&verify_password*

**Aditional Requirements**:

We also implemented the following additional requirements:

- [ ] **Rating and Review System**
- [x] **Promotional Features**
- [ ] **Analytics Dashboard**
- [ ] **Multi-Currency Support**
- [ ] **Item Swapping**
- [x] **API Integration**
- [x] **Dynamic Promotions**
- [ ] **User Preferences**
- [ ] **Shipping Costs**
- [x] **Real-Time Messaging System**

Other additional features developed:

- [x] **PWA**
- [x] ****

