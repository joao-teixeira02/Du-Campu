BEGIN TRANSACTION;
CREATE TABLE IF NOT EXISTS "Owner" (
	"id"	INTEGER,
	"username"	VARCHAR 20 NOT NULL UNIQUE,
	"name"	TEXT NOT NULL,
	"mail"	TEXT NOT NULL UNIQUE,
	"password"	VARCHAR 20 NOT NULL,
	"address"	TEXT,
	"phone"	TEXT UNIQUE,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "Customer" (
	"id"	INTEGER,
	"username"	VARCHAR 20 NOT NULL UNIQUE,
	"name"	TEXT NOT NULL,
	"mail"	TEXT NOT NULL UNIQUE,
	"password"	VARCHAR 20 NOT NULL,
	"address"	TEXT,
	"phone"	TEXT UNIQUE,
	PRIMARY KEY("id")
);
CREATE TABLE IF NOT EXISTS "Restaurant" (
	"id"	INTEGER,
	"name"	VARCHAR NOT NULL,
	"address"	VARCHAR NOT NULL UNIQUE,
	"owner_id"	INTEGER NOT NULL,
	PRIMARY KEY("id" AUTOINCREMENT),
	FOREIGN KEY("owner_id") REFERENCES "Owner"("id")
);
CREATE TABLE IF NOT EXISTS "Category" (
	"id"	INTEGER,
	"name"	TEXT NOT NULL UNIQUE,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "Photo" (
	"id"	INTEGER,
	"path"	TEXT NOT NULL UNIQUE,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "DishesPhoto" (
	"id_dish"	INTEGER,
	"id_photo"	INTEGER,
	PRIMARY KEY("id_dish","id_photo"),
	FOREIGN KEY("id_dish") REFERENCES "Dish"("id"),
	FOREIGN KEY("id_photo") REFERENCES "Photo"("id")
);
CREATE TABLE IF NOT EXISTS "RestaurantPhoto" (
	"id_restaurante"	INTEGER,
	"id_photo"	INTEGER,
	PRIMARY KEY("id_restaurante","id_photo"),
	FOREIGN KEY("id_photo") REFERENCES "Photo"("id"),
	FOREIGN KEY("id_restaurante") REFERENCES "Restaurant"("id")
);
CREATE TABLE IF NOT EXISTS "Reviews" (
	"id"	INTEGER,
	"review"	TEXT,
	"customer_id"	INTEGER NOT NULL,
	"points"	INTEGER NOT NULL CHECK("points" <= 5 AND "points" >= 0),
	"restaurant_id"	INTEGER NOT NULL,
	PRIMARY KEY("id" AUTOINCREMENT),
	FOREIGN KEY("customer_id") REFERENCES "Customer"("id"),
	FOREIGN KEY("restaurant_id") REFERENCES "Restaurant"("id")
);
CREATE TABLE IF NOT EXISTS "State" (
	"id"	INTEGER,
	"state"	INTEGER NOT NULL UNIQUE,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "Order" (
	"id"	INTEGER,
	"state_id"	INTEGER NOT NULL,
	"customer_id"	INTEGER NOT NULL,
	PRIMARY KEY("id"),
	FOREIGN KEY("state_id") REFERENCES "State"("id"),
	FOREIGN KEY("customer_id") REFERENCES "Customer"("id")
);
CREATE TABLE IF NOT EXISTS "OrderDishQuantity" (
	"id"	INTEGER,
	"id_order"	INTEGER NOT NULL,
	"id_dish"	INTEGER NOT NULL,
	"quantity"	INTEGER NOT NULL CHECK("quantity" > 0),
	PRIMARY KEY("id"),
	FOREIGN KEY("id_dish") REFERENCES "Dish"("id"),
	FOREIGN KEY("id_order") REFERENCES "OrderDishQuantity"("id")
);
CREATE TABLE IF NOT EXISTS "FavoriteRestaurant" (
	"id_customer"	INTEGER,
	"id_restaurant"	INTEGER,
	PRIMARY KEY("id_customer","id_restaurant"),
	FOREIGN KEY("id_restaurant") REFERENCES "Restaurant"("id"),
	FOREIGN KEY("id_customer") REFERENCES "Customer"("id")
);
CREATE TABLE IF NOT EXISTS "Dish" (
	"id"	INTEGER,
	"name"	TEXT NOT NULL,
	"price"	REAL NOT NULL,
	"category_id"	INTEGER NOT NULL,
	"restaurant_id"	INTEGER NOT NULL,
	PRIMARY KEY("id" AUTOINCREMENT),
	FOREIGN KEY("restaurant_id") REFERENCES "Restaurant"("id")
);
CREATE TABLE IF NOT EXISTS "FavoriteDish" (
	"id_customer"	INTEGER,
	"id_dish"	INTEGER,
	PRIMARY KEY("id_customer","id_dish"),
	FOREIGN KEY("id_customer") REFERENCES "Customer"("id"),
	FOREIGN KEY("id_dish") REFERENCES "Dish"("id")
);
COMMIT;
