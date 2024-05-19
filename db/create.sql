
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS brands;
DROP TABLE IF EXISTS conditions;
DROP TABLE IF EXISTS productImgs;
DROP TABLE IF EXISTS profileImgs;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS imgs;
DROP TABLE IF EXISTS cart;
DROP TABLE IF EXISTS favorites;
DROP TABLE IF EXISTS sizes;
DROP TABLE IF EXISTS messages;
DROP TABLE IF EXISTS purchases;
DROP TABLE IF EXISTS discounts;
DROP TABLE IF EXISTS purchaseItems;
DROP TABLE IF EXISTS blockedUsers;
DROP TABLE IF EXISTS featured;

CREATE TABLE users (
    name TEXT NOT NULL,
    id INTEGER NOT NULL PRIMARY KEY,
    email TEXT  NOT NULL,
    username TEXT NOT NULL,
    password TEXT NOT NULL,
    admin BOOLEAN,
    profileImg TEXT
);

CREATE TABLE categories(
    id INTEGER NOT NULL PRIMARY KEY,
    name TEXT NOT NULL
);

CREATE TABLE brands(
    id INTEGER PRIMARY KEY NOT NULL,
    name TEXT NOT NULL
);

CREATE TABLE conditions(
    id INTEGER PRIMARY KEY NOT NULL,
    name TEXT NOT NULL
);

CREATE TABLE sizes(
    id INTEGER PRIMARY KEY NOT NULL,
    name TEXT NOT NULL
);

CREATE TABLE products (
    name TEXT NOT NULL,
    id INTEGER PRIMARY KEY,
    date DATETIME NOT NULL,
    category INTEGER NOT NULL REFERENCES categories,
    brand INTEGER REFERENCES brands,
    model TEXT NOT NULL,
    size INTEGER NOT NULL REFERENCES sizes,
    condition INTEGER REFERENCES conditions,
    price REAL NOT NULL,
    user INTEGER NOT NULL REFERENCES users, 
    available BOOLEAN DEFAULT 0,
    description TEXT,
    firstImg TEXT
);

CREATE TABLE profileImgs (
    id INTEGER PRIMARY KEY,
    userId INTEGER REFERENCES users,
    path TEXT
);

CREATE TABLE cart (
    product INTEGER NOT NULL REFERENCES products,
    user INTEGER NOT NULL REFERENCES users
);

CREATE TABLE favorites (
    product INTEGER NOT NULL REFERENCES products,
    user INTEGER NOT NULL REFERENCES users
);

CREATE TABLE productImgs (
    id INTEGER PRIMARY KEY,
    product INTEGER NOT NULL REFERENCES products,
    path TEXT
);

CREATE TABLE messages (
    id INTEGER PRIMARY KEY,
    productId INTEGER NOT NULL REFERENCES products,
    buyerId INTEGER NOT NULL REFERENCES users,
    fromBuyer INTEGER NOT NULL,
    message TEXT NOT NULL,
    date DATETIME
);

CREATE TABLE purchaseItems(
    purchaseid TEXT NOT NULL REFERENCES purchases,
    productid INTEGER NOT NULL
);

CREATE TABLE purchases(
    id TEXT NOT NULL,
    date DATETIME NOT NULL, /* this will be the date it passed to pending (on checkout)*/
    status INTEGER NOT NULL, /* 0: pending ; 1: sucess (paid) */
    address TEXT NOT NULL,
    zipcode TEXT NOT NULL,
    buyerid INTEGER NOT NULL REFERENCES users,
    cost INTEGER NOT NULL
);


CREATE TABLE discounts(
    code TEXT NOT NULL,
    minamount INTEGER NOT NULL,
    percentage INTEGER NOT NULL,
    maxdiscount INTEGER NOT NULL
);


CREATE TABLE featured(
    product INTEGER NOT NULL REFERENCES products,
    enddate DATETIME NOT NULL
);

CREATE TABLE blockedUsers (
    user INTEGER NOT NULL
);

INSERT INTO users VALUES ('Zé', 1, 'ze@gmail.com', 'zeze', '$2y$12$2a.K49CYeaBhTKMWVCHDi.3mJEL/vMKzFRsmYa78GbApmGhiNLn9u', 1, 'img/profile/profile.png');
INSERT INTO users VALUES ('Maria', 2, 'maria@gmail.com', 'maria', '$2y$12$2a.K49CYeaBhTKMWVCHDi.3mJEL/vMKzFRsmYa78GbApmGhiNLn9u', 0, 'img/profile/profile.png');
INSERT INTO users VALUES ('João', 3, 'joao@gmail.com', 'joao', '$2y$12$2a.K49CYeaBhTKMWVCHDi.3mJEL/vMKzFRsmYa78GbApmGhiNLn9u', 0, 'img/profile/profile.png');




INSERT INTO categories VALUES (1, 'Dress');
INSERT INTO categories VALUES (2, 'Trousers');
INSERT INTO categories VALUES (3, 'Shoes');
INSERT INTO categories VALUES (4, 'T-shirts');


INSERT INTO sizes VALUES (1, 'XS');
INSERT INTO sizes VALUES (2, 'S');
INSERT INTO sizes VALUES (3, 'M');
INSERT INTO sizes VALUES (4, 'L');
INSERT INTO sizes VALUES (5, 'XL');

INSERT INTO brands VALUES (1, 'Other');
INSERT INTO brands VALUES (2, 'Adidas');
INSERT INTO brands VALUES (3, 'Pull n Bear');
INSERT INTO brands VALueS (4, 'Salsa');

INSERT INTO conditions VALUES (1, 'New');
INSERT INTO conditions VALUES (2, 'Barely used');
INSERT INTO conditions VALUES (3, 'Used');
INSERT INTO conditions VALUES (4, 'Very used');

INSERT INTO products VALUES ('Wonderful Dress', 1, '2023-11-12', 1, 1, 'Model A', 1, 1, 80.9, 1, 1, 'A beautiful dress only used once. With a beautiful color and all intact.', 'img/products/dress.jpeg'),
('Green T-shirt', 2, '2024-1-12', 4, 2, 'Model B', 2, 2, 20.1, 1, 1, "You know... it's a t-shirt. nothing very special.", 'img/products/p2_1.jpeg'),
('Colourful Shoes', 3, '2024-1-12', 3, 1, 'Model C', 3, 3, 50.3, 2, 1, 'You know... shoes. nothing very special.', 'img/products/p3_1.jpeg'),
('Orange Polo', 4, '2024-3-12', 4, 1, 'Model A', 1, 2, 16.3, 2, 1, 'This orange polo adds a burst of color to your wardrobe, offering a classic yet bold look for casual occasions.', 'img/products/p4_1.jpeg'),
('Jeans Trousers', 5, '2024-3-12', 2, 1, 'Model A', 1, 2, 16.3, 2, 1, 'These jeans are a wardrobe staple, offering timeless style and comfort for everyday wear.', 'img/products/trousers1-trousers-f1.jpg'),
('Pink Woman Trouser', 6, '2023-3-12', 2, 1, 'Model D', 4, 1, 40.3, 2, 1, 'These trousers add a pop of color to your wardrobe, with a flattering fit and versatile style that is perfect for any occasion.', 'img/products/p6_1.jpeg'),
('Super Dress', 7, '2024-6-12', 1, 2, 'Model J', 2, 3, 60.3, 2, 1, 'This super dress is a showstopper, with its eye-catching design and flattering fit, perfect for making a statement at any event.', 'img/products/p7_1.gif'), 
('Trouser Trend', 8, '2024-05-15 12:00:00', 2, 2, 'Model 2', 3, 2, 75.00, 2, 1, 'These trousers offer a sleek and stylish option for any occasion, combining comfort with sophistication.', 'img/products/trousers2-trousers-f1.jpg'),
('Shoe Sensation', 9, '2024-05-15 12:00:00', 3, 3, 'Model 3', 4, 3, 35.00, 3, 1, 'These shoes blend fashion and comfort seamlessly, making them a perfect choice for any occasion.', 'img/products/shoe1-shoe-f1.jpg'),
('T-Shirt Triumph', 10, '2024-05-15 12:00:00', 4, 1, 'Model 4', 1, 2, 10.00, 1, 1, 'This t-shirt offers relaxed style and all-day comfort, perfect for everyday wear and easy pairing with your favorite bottoms.', 'img/products/black1-tshirt-f1.jpg'),
('Elegant Evening Dress', 11, '2024-05-15 12:00:00', 1, 1, 'Model 1', 2, 1, 50.00, 2, 1, 'Glamorous evening dress for nighttime events, with luxurious fabrics and flattering cuts.', 'img/products/dress1-dress-f1.jpg'),
('Tailored Trouser Ensemble', 12, '2024-05-15 12:00:00', 2, 2, 'Model 2', 3, 2, 30.00, 1, 1, 'These tailored trousers offer a sleek, polished look, perfect for both professional settings and upscale events.', 'img/products/trousers3-trouser-f1.jpg'),
('Sneaker Style Statement', 13, '2024-05-15 12:00:00', 3, 3, 'Model 3', 4, 3, 25, 2, 1, 'Step up your style with these versatile sneakers, combining comfort and fashion for any occasion.', 'img/products/shoe2-shoe-f1.jpg'),
('Graphic Tee Treasure', 14, '2024-05-15 12:00:00', 4, 1, 'Model 4', 1, 2, 14.00, 2, 1, 'This graphic tee speaks volumes with its bold design, adding a splash of personality to any casual outfit.', 'img/products/nyc-tshirt-f1.jpg'),
('Casual Day Dress', 15, '2024-05-15 12:00:00', 1, 1, 'Model 1', 2, 1, 25.00, 1, 1, 'Comfy casual dress made from soft, breathable fabrics with simple designs.', 'img/products/dress2-dress-f1.jpg'),
('Cargo Pant Classic', 16, '2024-05-15 12:00:00', 2, 2, 'Model 2', 3, 2, 25.00, 1, 1, 'Cargo pants with pockets aplenty, ready for any adventure.', 'img/products/trousers4-trousers-f1.jpg'),
('Athletic Shoe Adventure', 17, '2024-05-15 12:00:00', 3, 3, 'Model 3', 4, 2, 30.00, 2, 1, 'These athletic shoes offer top-notch support and style, perfect for conquering workouts or simply staying active with comfort and flair.', 'img/products/shoe3-shoe-f1.jpg'),
('Vintage Tee Vibe', 18, '2024-05-15 12:00:00', 4, 1, 'Model 4', 1, 2, 19.00, 2, 1, 'Embrace vintage vibes with this faded print t-shirt, effortlessly blending nostalgia with contemporary style.', 'img/products/vintage1-tshirt.jpg'),
('Formal Occasion Dress', 19, '2024-05-15 12:00:00', 1, 1, 'Model 1', 2, 1, 65.00, 3, 1, 'Formal occasion dress designed for special events.', 'img/products/dress3-dress-f1.jpg'),
('Denim Dream Trousers', 20, '2024-05-15 12:00:00', 2, 2, 'Model 2', 3, 2, 15.00, 1, 1, 'These trousers combine the timeless appeal of denim with a tailored fit, offering both comfort and style for a versatile addition to your wardrobe.', 'img/products/trousers5-trousers-f1.jpg'),
('Boot Beauty', 21, '2024-05-15 12:00:00', 3, 3, 'Model 3', 4, 3, 50.00, 3, 1, 'Step out in style with these classic boots, crafted for durability and fashion-forward flair, making them perfect for any season and any outfit.', 'img/products/shoe4-shoe-f1.jpg'),
('Polo Perfection T-Shirt', 22, '2024-05-15 12:00:00', 4, 1, 'Model 4', 1, 2, 35.50, 2, 1, 'Classic polo tee with a vintage vibe. Soft, breathable fabric for all-day comfort. Slim fit with traditional collar and button placket.', 'img/products/polo1-tshirt-f1.jpg'),
('Summer Sun Dress', 23, '2024-05-15 12:00:00', 1, 1, 'Model 1', 2, 1, 50.00, 1, 1, 'Lightweight summer dress, designed to keep you cool and comfortable in warm weather.', 'img/products/dress4-dress-f1.jpg'),
('Slim Fit Slacks', 24, '2024-05-15 12:00:00', 2, 2, 'Model 2', 3, 2, 23.50, 2, 1, 'These slim fit slacks boast a tailored silhouette and premium fabric, offering both style and comfort for any professional or formal occasion.', 'img/products/trousers6-trousers-f1.jpg'),
('Heel Haven', 25, '2024-05-15 12:00:00', 3, 3, 'Model 3', 4, 3, 20.00, 3, 1, 'Elevate your look with these chic heels featuring a classic design and comfortable fit.', 'img/products/shoe5-shoe-f1.jpg'),
('V-neck Versatility T-Shirt', 26, '2024-05-15 12:00:00', 4, 1, 'Model 4', 1, 2, 12.00, 2, 1, 'This V-neck tee offers a relaxed fit and soft fabric for everyday comfort and style, a versatile essential for any wardrobe.', 'img/products/vneck1-tshirt-f3.jpeg'),
('Flowy Floral Dress', 27, '2024-05-15 12:00:00', 1, 1, 'Model 1', 2, 1, 50.00, 1, 1, 'Light and breezy flower dress adorned with floral prints, perfect for a fresh, summery look.', 'img/products/dress5-dress-f1.jpg'),
('Jogger Jean Jamboree', 28, '2024-05-15 12:00:00', 2, 2, 'Model 2', 3, 2, 15.00, 2, 1, 'These jogger jeans blend comfort and style seamlessly, featuring a relaxed fit.', 'img/products/trousers7-trousers-f1.jpg'),
('Sandal Splendor', 29, '2024-05-15 12:00:00', 3, 3, 'Model 3', 4, 3, 30.00, 3, 1, 'Slip into these stylish sandals for effortless comfort and a touch of laid-back charm, perfect for sunny days and beach outings.', 'img/products/shoe6-shoe-f1.jpg'),
('Retro Logo T-Shirt', 30, '2024-05-15 12:00:00', 4, 1, 'Model 4', 1, 2, 19.50, 2, 1, 'Vintage-style tee with a retro vibe. Soft, worn-in feel and bold graphics for a nostalgic look. Perfect for adding a touch of old-school cool to any outfit!', 'img/products/redstripe-tshirt-f1.jpg'),
('Skeleton T-Shirt', 31, '2024-05-16 12:00:00', 4, 1, 'Model 4', 1, 2, 16.3, 2, 1, 'Really cool T-shirt with a skeleton hand', 'img/products/skeleton-tshirt-f1.jpg');


INSERT INTO productImgs (product, path) VALUES 
(1, 'img/products/dress.jpeg'), (1, 'img/products/dress-beach.jpeg'), ( 2, 'img/products/p2_1.jpeg'), (2, 'img/products/p2_2.jpeg'),
(2, 'img/products/p2_3.jpeg'), (3, 'img/products/p3_1.jpeg'), (3, 'img/products/p3_2.jpeg'),
(4, 'img/products/p4_1.jpeg'), (4, 'img/products/p4_2.jpeg'), (4, 'img/products/p4_3.jpeg'), 
(5, 'img/products/trousers1-trousers-f1.jpg'), (5, 'img/products/trousers1-trousers-f2.jpg'), (5, 'img/products/trousers1-trousers-f3.jpg'), (5, 'img/products/trousers1-trousers-f4.jpg'),  (5, 'img/products/trousers1-trousers-f5.jpg'),
(6, 'img/products/p6_1.jpeg'), (6, 'img/products/p6_2.jpeg'), (6, 'img/products/p6_3.jpeg'),
(7, 'img/products/p7_1.gif'), (7, 'img/products/p7_2.jpeg'),
(8, 'img/products/trousers2-trousers-f1.jpg'), (8, 'img/products/trousers2-trousers-f2.jpg'), (8, 'img/products/trousers2-trousers-f3.jpg'), (8, 'img/products/trousers2-trousers-f4.jpg'), (8, 'img/products/trousers2-trousers-f5.jpg'),
(9, 'img/products/shoe1-shoe-f1.jpg'), (9, 'img/products/shoe1-shoe-f3.jpg'), (9, 'img/products/shoe1-shoe-f4.jpg'), (9, 'img/products/shoe1-shoe-f5.jpg'),
(10, 'img/products/black1-tshirt-f1.jpg'), (10, 'img/products/black1-tshirt-f2.jpg'),
(11, 'img/products/dress1-dress-f1.jpg'), (11, 'img/products/dress1-dress-f2.jpg'), (11, 'img/products/dress1-dress-f3.jpg'), (11, 'img/products/dress1-dress-f4.jpg'), (11, 'img/products/dress1-dress-f5.jpg'),
(12, 'img/products/trousers3-trouser-f1.jpg'), (12, 'img/products/trousers3-trouser-f2.jpg'), (12, 'img/products/trousers3-trouser-f3.jpg'), (12, 'img/products/trousers3-trouser-f4.jpg'), (12, 'img/products/trousers3-trouser-f5.jpg'),
(13, 'img/products/shoe2-shoe-f1.jpg'), (13, 'img/products/shoe2-shoe-f2.jpg'), (13, 'img/products/shoe2-shoe-f3.jpg'), (13, 'img/products/shoe2-shoe-f4.jpg'), (13, 'img/products/shoe2-shoe-f5.jpg'),
(14, 'img/products/nyc-tshirt-f1.jpg'), (14, 'img/products/nyc-tshirt-f2.jpg'),
(15, 'img/products/dress2-dress-f1.jpg'), (15, 'img/products/dress2-dress-f2.jpg'), (15, 'img/products/dress2-dress-f3.jpg'), (15, 'img/products/dress2-dress-f4.jpg'), (15, 'img/products/dress2-dress-f5.jpg'),
(16, 'img/products/trousers4-trousers-f1.jpg'), (16, 'img/products/trousers4-trousers-f2.jpg'), (16, 'img/products/trousers4-trousers-f3.jpg'), (16, 'img/products/trousers4-trousers-f4.jpg'), (16, 'img/products/trousers4-trousers-f5.jpg'),
(17, 'img/products/shoe3-shoe-f1.jpg'), (17, 'img/products/shoe3-shoe-f2.jpg'), (17, 'img/products/shoe3-shoe-f3.jpg'), (17, 'img/products/shoe3-shoe-f4.jpg'), (17, 'img/products/shoe3-shoe-f5.jpg'),
(18, 'img/products/vintage1-tshirt.jpg'),
(19, 'img/products/dress3-dress-f1.jpg'), (19, 'img/products/dress3-dress-f2.jpg'), (19, 'img/products/dress3-dress-f3.jpg'), (19, 'img/products/dress3-dress-f4.jpg'), (19, 'img/products/dress3-dress-f5.jpg'),
(20, 'img/products/trousers5-trousers-f1.jpg'), (20, 'img/products/trousers5-trousers-f2.jpg'), (20, 'img/products/trousers5-trousers-f3.jpg'), (20, 'img/products/trousers5-trousers-f4.jpg'), (20, 'img/products/trousers5-trousers-f5.jpg'),
(21, 'img/products/shoe4-shoe-f1.jpg'), (21, 'img/products/shoe4-shoe-f2.jpg'), (21, 'img/products/shoe4-shoe-f3.jpg'), (21, 'img/products/shoe4-shoe-f4.jpg'), (21, 'img/products/shoe4-shoe-f5.jpg'),
(22, 'img/products/polo1-tshirt-f1.jpg'), (22, 'img/products/polo1-tshirt-f2.jpg'), (22, 'img/products/polo1-tshirt-f3.jpg'),
(23, 'img/products/dress4-dress-f1.jpg'), (23, 'img/products/dress4-dress-f2.jpg'), (23, 'img/products/dress4-dress-f3.jpg'), (23, 'img/products/dress4-dress-f4.jpg'), (23, 'img/products/dress4-dress-f5.jpg'),
(24, 'img/products/trousers6-trousers-f1.jpg'), (24, 'img/products/trousers6-trousers-f2.jpg'), (24, 'img/products/trousers6-trousers-f3.jpg'), (24, 'img/products/trousers6-trousers-f4.jpg'), (24, 'img/products/trousers6-trousers-f5.jpg'),
(25, 'img/products/shoe5-shoe-f1.jpg'), (25, 'img/products/shoe5-shoe-f2.jpg'), (25, 'img/products/shoe5-shoe-f3.jpg'), (25, 'img/products/shoe5-shoe-f4.jpg'),
(26, 'img/products/vneck1-tshirt-f3.jpeg'), (26, 'img/products/vneck1-tshirt-f2.jpeg'),
(27, 'img/products/dress5-dress-f1.jpg'), (27, 'img/products/dress5-dress-f2.jpg'), (27, 'img/products/dress5-dress-f3.jpg'), (27, 'img/products/dress5-dress-f4.jpg'), (27, 'img/products/dress5-dress-f5.jpg'),
(28, 'img/products/trousers7-trousers-f1.jpg'), (28, 'img/products/trousers7-trousers-f2.jpg'), (28, 'img/products/trousers7-trousers-f3.jpg'), (28, 'img/products/trousers7-trousers-f4.jpg'), (28, 'img/products/trousers7-trousers-f5.jpg'),
(29, 'img/products/shoe6-shoe-f1.jpg'), (29, 'img/products/shoe6-shoe-f2.jpg'), (29, 'img/products/shoe6-shoe-f3.jpg'), (29, 'img/products/shoe6-shoe-f4.jpg'), (29, 'img/products/shoe6-shoe-f5.jpg'),
(30, 'img/products/redstripe-tshirt-f1.jpg'), (30, 'img/products/redstripe-tshirt-f2.jpg'), (30, 'img/products/redstripe-tshirt-f3.jpg'),
(31, 'img/products/skeleton-tshirt-f1.jpg'), (31, 'img/products/skeleton-tshirt-f2.jpg'), (31, 'img/products/skeleton-tshirt-f3.jpg');



INSERT INTO messages (productId, buyerId, fromBuyer, message, date) VALUES
(1, 2, 1, 'Olá! Estou interessado neste produto.', '2024-04-22 15:30'),
(1, 2, 0, 'Boa tarde! Obrigado pelo seu interesse.', '2024-04-23 10:45'),
(1, 2, 1, 'Gostaria de saber mais detalhes sobre a entrega.', '2024-04-24 08:20'),
(1, 2, 0, 'Claro, posso fornecer as informações.', '2024-04-25 14:10'),
(1, 2, 1, 'Ótimo! Aguardo sua resposta.', '2024-04-26 11:55'),

(1, 3, 1, 'Olá! Estou interessado neste produto.', '2024-04-22 15:30'),
(1, 3, 0, 'Boa tarde! Obrigado pelo seu interesse.', '2024-04-23 10:45'),
(1, 3, 1, 'Gostaria de saber mais detalhes sobre a entrega.', '2024-04-24 08:20'),
(1, 3, 0, 'Claro, posso fornecer as informações.', '2024-04-25 14:10'),
(1, 3, 1, 'Ótimo! Aguardo sua resposta.', '2024-04-26 11:55');


insert into discounts values ('1234', 30, 15, 50);

insert into featured values (1, "2024-05-29 11:22:05");
insert into featured values (2, "2024-06-14 11:24:05");
