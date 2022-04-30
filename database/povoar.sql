INSERT INTO Photo (path) VALUES ('https://s3.amazonaws.com/blog.dentrodahistoria.com.br/wp-content/uploads/2020/07/24172038/papinhas-de-beb%C3%AA-scaled.jpg');

INSERT INTO RestaurantPhoto (id_restaurant, id_photo) VALUES (1, 1);
INSERT INTO RestaurantPhoto (id_restaurant, id_photo) VALUES (2, 1);
INSERT INTO RestaurantPhoto (id_restaurant, id_photo) VALUES (3, 1);
INSERT INTO RestaurantPhoto (id_restaurant, id_photo) VALUES (4, 1);

INSERT INTO Customer (username, name, mail, password, address, phone) VALUES ('joaoteixeira', 'João Teixeira', 'joaoteixeira@gmail.com', 't73indfm9nc205c', '', '935497249');
INSERT INTO Customer (username, name, mail, password, address, phone) VALUES ('afonsobaldo', 'Afonso Baldo', 'afonsobaldo@gmail.com', 'rvh2m53r3', '', '914352559');
INSERT INTO Customer (username, name, mail, password, address, phone) VALUES ('inescardoso', 'Inês Cardoso', 'inescardoso@gmail.com', '424s6784', '', '962643176');
INSERT INTO Customer (username, name, mail, password, address, phone) VALUES ('andrerestivo', 'André Restivo', 'andrerestivo@gmail.com', '0l3394ov13rtc5', '', '910546926');

INSERT INTO FavoriteRestaurant (id_customer, id_restaurant) VALUES (1, 1);
INSERT INTO FavoriteRestaurant (id_customer, id_restaurant) VALUES (2, 2);
INSERT INTO FavoriteRestaurant (id_customer, id_restaurant) VALUES (3, 3);

INSERT INTO FavoriteDish (id_customer, id_dish) VALUES (1, 27);
INSERT INTO FavoriteDish (id_customer, id_dish) VALUES (2, 40);
INSERT INTO FavoriteDish (id_customer, id_dish) VALUES (3, 56);

INSERT INTO Reviews (review, customer_id, points, restaurant_id) VALUES ('NHOM NHOM NHOM', 1, 5, 1);
INSERT INTO Reviews (review, customer_id, points, restaurant_id) VALUES ('NHOM NHOM NHOM', 2, 4, 2);
INSERT INTO Reviews (review, customer_id, points, restaurant_id) VALUES ('NHOM NHOM NHOM', 3, 3, 3);

INSERT INTO Owner(username, name, mail, password, address, phone) VALUES ('osvaldoteixeira', 'Osvaldo Teixeira', 'osvaldoteixeira@gmail.com', '25w774a858ag94u', '', '932368189');
INSERT INTO Owner(username, name, mail, password, address, phone) VALUES ('adelinobaldo', 'Adelino Baldo', 'adelinobaldo@gmail.com', '73673233k210e5', '', '963592065');
INSERT INTO Owner(username, name, mail, password, address, phone) VALUES ('sergiocalado', 'Sérgio Calado', 'sergiocalado@gmail.com', '3b7573f0', '', '911816913');

INSERT INTO State (state) VALUES ('Being prepared');
INSERT INTO State (state) VALUES ('Picked up');
INSERT INTO State (state) VALUES ('Arrived');
INSERT INTO State (state) VALUES ('Delivered');

INSERT INTO Order (state_id, customer_id) VALUES (1, 1);
INSERT INTO Order (state_id, customer_id) VALUES (2, 2);
INSERT INTO Order (state_id, customer_id) VALUES (3, 3);

INSERT INTO OrderDishQuantity (id_order, id_dish, quantity) VALUES (1, 27, 1);
INSERT INTO OrderDishQuantity (id_order, id_dish, quantity) VALUES (2, 40, 2);
INSERT INTO OrderDishQuantity (id_order, id_dish, quantity) VALUES (3, 56, 1);

INSERT INTO Category (name) VALUES ('Asian');
INSERT INTO Category (name) VALUES ('American');
INSERT INTO Category (name) VALUES ('Mexican');
INSERT INTO Category (name) VALUES ('Fast Food');
INSERT INTO Category (name) VALUES ('Taiwanese');
INSERT INTO Category (name) VALUES ('Thailandese');
INSERT INTO Category (name) VALUES ('Indian');
INSERT INTO Category (name) VALUES ('Pizza');

INSERT INTO Restaurant (name, address, owner_id) VALUES ("Bao's - Taiwanese Burger", 'R. de Cedofeita 263, 4050-174 Porto', 1);
INSERT INTO Restaurant (name, address, owner_id) VALUES ("AM Indiano Restaurant", 'R. do Gen. Torres 1220 piso -1 LJ 24, 4400-164 Vila Nova de Gaia', 2);
INSERT INTO Restaurant (name, address, owner_id) VALUES ("Thamel Restaurant", 'Rua da Picaria 25, 4000-407 Porto', 3);
INSERT INTO Restaurant (name, address, owner_id) VALUES ("Mexcanita", 'Rua da Nené 49, 4050-148 Porto', 1);

INSERT INTO RestaurantCategory (id_restaurant, id_category) VALUES (1, 1);
INSERT INTO RestaurantCategory (id_restaurant, id_category) VALUES (1, 5);
INSERT INTO RestaurantCategory (id_restaurant, id_category) VALUES (2, 1);
INSERT INTO RestaurantCategory (id_restaurant, id_category) VALUES (2, 7);
INSERT INTO RestaurantCategory (id_restaurant, id_category) VALUES (3, 1);
INSERT INTO RestaurantCategory (id_restaurant, id_category) VALUES (3, 6);
INSERT INTO RestaurantCategory (id_restaurant, id_category) VALUES (4, 2);
INSERT INTO RestaurantCategory (id_restaurant, id_category) VALUES (4, 3);
INSERT INTO RestaurantCategory (id_restaurant, id_category) VALUES (4, 4);

INSERT INTO Type (name) VALUES ('Noodle Soups');
INSERT INTO Type (name) VALUES ("Bao's");
INSERT INTO Type (name) VALUES ('Side Dish');
INSERT INTO Type (name) VALUES ('Sauces');
INSERT INTO Type (name) VALUES ('Desserts');
INSERT INTO Type (name) VALUES ('Drinks');
INSERT INTO Type (name) VALUES ('Appetizers');
INSERT INTO Type (name) VALUES ('Salads');
INSERT INTO Type (name) VALUES ('Indian Bread');
INSERT INTO Type (name) VALUES ('Rice');
INSERT INTO Type (name) VALUES ('Main Dishes');
INSERT INTO Type (name) VALUES ('Lassi / Indian Drinks');
INSERT INTO Type (name) VALUES ('Burritos');
INSERT INTO Type (name) VALUES ('Tacos');
INSERT INTO Type (name) VALUES ('Quesadillas');

INSERT INTO DishType (id_dish, id_type) VALUES (1, 1);
INSERT INTO DishType (id_dish, id_type) VALUES (2, 1);
INSERT INTO DishType (id_dish, id_type) VALUES (3, 2);
INSERT INTO DishType (id_dish, id_type) VALUES (4, 2);
INSERT INTO DishType (id_dish, id_type) VALUES (5, 2);
INSERT INTO DishType (id_dish, id_type) VALUES (6, 2);
INSERT INTO DishType (id_dish, id_type) VALUES (7, 3);
INSERT INTO DishType (id_dish, id_type) VALUES (8, 3);
INSERT INTO DishType (id_dish, id_type) VALUES (9, 3);
INSERT INTO DishType (id_dish, id_type) VALUES (10, 3);
INSERT INTO DishType (id_dish, id_type) VALUES (11, 4);
INSERT INTO DishType (id_dish, id_type) VALUES (12, 4);
INSERT INTO DishType (id_dish, id_type) VALUES (13, 5);
INSERT INTO DishType (id_dish, id_type) VALUES (14, 5);
INSERT INTO DishType (id_dish, id_type) VALUES (15, 5);
INSERT INTO DishType (id_dish, id_type) VALUES (16, 6);
INSERT INTO DishType (id_dish, id_type) VALUES (17, 6);
INSERT INTO DishType (id_dish, id_type) VALUES (18, 6);
INSERT INTO DishType (id_dish, id_type) VALUES (19, 7);
INSERT INTO DishType (id_dish, id_type) VALUES (20, 7);
INSERT INTO DishType (id_dish, id_type) VALUES (21, 7);
INSERT INTO DishType (id_dish, id_type) VALUES (22, 7);
INSERT INTO DishType (id_dish, id_type) VALUES (23, 8);
INSERT INTO DishType (id_dish, id_type) VALUES (24, 8);
INSERT INTO DishType (id_dish, id_type) VALUES (25, 8);
INSERT INTO DishType (id_dish, id_type) VALUES (26, 9);
INSERT INTO DishType (id_dish, id_type) VALUES (27, 9);
INSERT INTO DishType (id_dish, id_type) VALUES (28, 9);
INSERT INTO DishType (id_dish, id_type) VALUES (29, 9);
INSERT INTO DishType (id_dish, id_type) VALUES (30, 9);
INSERT INTO DishType (id_dish, id_type) VALUES (31, 9);
INSERT INTO DishType (id_dish, id_type) VALUES (32, 10);
INSERT INTO DishType (id_dish, id_type) VALUES (33, 10);
INSERT INTO DishType (id_dish, id_type) VALUES (34, 10);
INSERT INTO DishType (id_dish, id_type) VALUES (35, 11);
INSERT INTO DishType (id_dish, id_type) VALUES (36, 11);
INSERT INTO DishType (id_dish, id_type) VALUES (37, 11);
INSERT INTO DishType (id_dish, id_type) VALUES (38, 11);
INSERT INTO DishType (id_dish, id_type) VALUES (39, 11);
INSERT INTO DishType (id_dish, id_type) VALUES (40, 11);
INSERT INTO DishType (id_dish, id_type) VALUES (41, 12);
INSERT INTO DishType (id_dish, id_type) VALUES (42, 12);
INSERT INTO DishType (id_dish, id_type) VALUES (43, 12);
INSERT INTO DishType (id_dish, id_type) VALUES (44, 12);
INSERT INTO DishType (id_dish, id_type) VALUES (45, 6);
INSERT INTO DishType (id_dish, id_type) VALUES (46, 6);
INSERT INTO DishType (id_dish, id_type) VALUES (47, 6);
INSERT INTO DishType (id_dish, id_type) VALUES (48, 7);
INSERT INTO DishType (id_dish, id_type) VALUES (49, 7);
INSERT INTO DishType (id_dish, id_type) VALUES (50, 7);
INSERT INTO DishType (id_dish, id_type) VALUES (51, 11);
INSERT INTO DishType (id_dish, id_type) VALUES (52, 11);
INSERT INTO DishType (id_dish, id_type) VALUES (53, 11);
INSERT INTO DishType (id_dish, id_type) VALUES (54, 11);
INSERT INTO DishType (id_dish, id_type) VALUES (55, 11);
INSERT INTO DishType (id_dish, id_type) VALUES (56, 11);
INSERT INTO DishType (id_dish, id_type) VALUES (57, 5);
INSERT INTO DishType (id_dish, id_type) VALUES (58, 5);
INSERT INTO DishType (id_dish, id_type) VALUES (59, 5);
INSERT INTO DishType (id_dish, id_type) VALUES (60, 6);
INSERT INTO DishType (id_dish, id_type) VALUES (61, 6);
INSERT INTO DishType (id_dish, id_type) VALUES (62, 6);
INSERT INTO DishType (id_dish, id_type) VALUES (63, 13);
INSERT INTO DishType (id_dish, id_type) VALUES (64, 13);
INSERT INTO DishType (id_dish, id_type) VALUES (65, 13);
INSERT INTO DishType (id_dish, id_type) VALUES (66, 14);
INSERT INTO DishType (id_dish, id_type) VALUES (67, 14);
INSERT INTO DishType (id_dish, id_type) VALUES (68, 14);
INSERT INTO DishType (id_dish, id_type) VALUES (69, 14);
INSERT INTO DishType (id_dish, id_type) VALUES (70, 15);
INSERT INTO DishType (id_dish, id_type) VALUES (71, 15);
INSERT INTO DishType (id_dish, id_type) VALUES (72, 6);
INSERT INTO DishType (id_dish, id_type) VALUES (73, 6);
INSERT INTO DishType (id_dish, id_type) VALUES (74, 6);

INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Lu Rou Fan', 11.50, 1, 1);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Fried Veggue Rice', 11.50, 1, 1);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Tofu Bao', 6.90, 1, 1);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Pulled Soja Bao', 5.80, 1, 1);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Jack Bao', 6.50, 1, 1);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Gua Bao', 5.80, 1, 1);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Sweet Potato', 5.50, 1, 1);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Mandioca Cajun Chips', 4.50, 1, 1);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Salada Formosa', 4.50, 1, 1);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Fies 101', 4.50, 1, 1;
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Spicy Sauce', 0.70, 1, 1);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Aioli Sauce', 0.70, 1, 1);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Brownie', 6.50, 1, 1);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Peanut Ice Cream Bao', 6.00, 1, 1);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Black Sesame Ice Cream Bao', 6.00, 1, 1);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Pepsi 330ml', 2.50, 1, 1);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Seven Up 330ml', 2.50, 1, 1);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Water 50cl', 1.50, 1, 1);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Vegetable Kebab', 6.00, 1, 2);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Papad', 1.00, 1, 2);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Vegetable Pakora', 4.50, 1, 2);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Paneer Pakora', 12.00, 1, 2);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Raita Max Salad', 3.50, 1, 2);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Mix Salad', 3.50, 1, 2);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('AM Indiano Salad', 3.50, 1, 2);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Naan', 2.50, 1, 2);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Garlic Naan', 3.00, 1, 2);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Paratha', 2.50, 1, 2);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Peshwari Naan', 3.50, 1, 2);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Keema Naan', 4.00, 1, 2);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Garlic Cheese Naan', 4.00, 1, 2);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Pelau Rice', 3.00, 1, 2);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('White Rice', 2.70, 1, 2);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Rice with Eggs', 4.20, 1, 2);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Chana Masala', 10.00, 1, 2);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Navratan Korma', 12.00, 1, 2);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Palak Paneer', 12.00, 1, 2);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Dal Makhani', 11.00, 1, 2);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Malai Kofta', 11.00, 1, 2);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Dal Tadka', 11.00, 1, 2);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Mango Lassi', 2.50, 1, 2);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Salt Lassi', 2.00, 1, 2);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Jeera Lassi', 2.50, 1, 2);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Coconit Lassi', 2.50, 1, 2);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Pepsi 330ml', 2.50, 1, 2);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Seven Up 330ml', 2.50, 1, 2);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Water 50cl', 1.50, 1, 2);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Vegetable Momo', 6.50, 1, 3);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Cauliflower Pakoda', 6.00, 1, 3);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Vegetable Samosa', 6.50, 1, 3);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Vegetarian Thupka', 8.00, 1, 3);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Thupka with Vegetable Momo', 10.00, 1, 3);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Tom Yum Kung', 11.50, 1, 3);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Tofu Pad Thai', 12.50, 1, 3);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Vegan Pad Thai', 11.50, 1, 3);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Pad Kra Pao', 13.00, 1, 3);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Nepal Kheer', 4.50, 1, 3);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Chocolate Mousse with Coconut', 4.50, 1, 3);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Gulab Jamun with Natural Yoghurt', 5.00, 1, 3);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Coke 330ml', 2.50, 1, 3);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Seven Up 330ml', 2.50, 1, 3);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Water 50cl', 1.50, 1, 3);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Black Bean Quesarito', 6.30, 1, 4);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Veggie Mix Burrito', 6.30, 1, 4);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Rice Burrito', 6.30, 1, 4);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('CrunchyWrap Supreme Veggie', 7.20, 1, 4);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Quesarito', 6.00, 1, 4);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Black Bean Taco', 6.30, 1, 4);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Rice Taco', 6.30, 1, 4);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Cheese Quesadilla', 3.00, 1, 4);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Double Cheese Quesadilla', 3.00, 1, 4);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Coke 330ml', 2.50, 1, 4);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Seven Up 330ml', 2.50, 1, 4);
INSERT INTO Dish (name, price, id_photo, restaurant_id) VALUES ('Water 50cl', 1.50, 1, 4);