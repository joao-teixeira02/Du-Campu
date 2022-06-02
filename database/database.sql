CREATE TABLE IF NOT EXISTS "Photo" (
	"id"	INTEGER,
	"path"	TEXT NOT NULL UNIQUE,
	PRIMARY KEY("id" AUTOINCREMENT)
);

CREATE TABLE IF NOT EXISTS "User" (
	"id"	INTEGER,
	"username"	VARCHAR NOT NULL UNIQUE,
	"name"	TEXT NOT NULL,
	"mail"	TEXT NOT NULL UNIQUE,
	"password"	VARCHAR NOT NULL,
	"address"	TEXT,
	"phone"	TEXT UNIQUE,
	"photo"	INTEGER REFERENCES "Photo"("id"),
	PRIMARY KEY("id" AUTOINCREMENT)
);

CREATE TABLE IF NOT EXISTS "Owner" (
	"id" INTEGER,
	PRIMARY KEY("id"),
	FOREIGN KEY("id") REFERENCES "User"("id")
);

CREATE TABLE IF NOT EXISTS "Customer" (
	"id" INTEGER,
	PRIMARY KEY("id"),
	FOREIGN KEY("id") REFERENCES "User"("id")
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
CREATE TABLE IF NOT EXISTS "RestaurantCategory" (
	"id_restaurant" INTEGER,
	"id_category" INTEGER,
	PRIMARY KEY("id_restaurant", "id_category"),
	FOREIGN KEY("id_restaurant") REFERENCES "Restaurant"("id"),
	FOREIGN KEY("id_category") REFERENCES "Category"("id")
);


CREATE TABLE IF NOT EXISTS "RestaurantPhoto" (
	"id_restaurant"	INTEGER,
	"id_photo"	INTEGER PRIMARY KEY,
	FOREIGN KEY("id_photo") REFERENCES "Photo"("id"),
	FOREIGN KEY("id_restaurant") REFERENCES "Restaurant"("id")
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

CREATE TABLE IF NOT EXISTS "Reply" (
	"id" INTEGER,
	"text" TEXT,
	"owner_id" INTEGER NOT NULL,
	"review_id" INTEGER NOT NULL,
	PRIMARY KEY("id" AUTOINCREMENT),
	FOREIGN KEY("owner_id") REFERENCES "Owner"("id"),
	FOREIGN KEY("review_id") REFERENCES "Review"("id")
);

CREATE TABLE IF NOT EXISTS "FavoriteRestaurant" (
	"id_user"	INTEGER,
	"id_restaurant"	INTEGER,
	PRIMARY KEY("id_user","id_restaurant"),
	FOREIGN KEY("id_restaurant") REFERENCES "Restaurant"("id"),
	FOREIGN KEY("id_user") REFERENCES "User"("id")
);

CREATE TABLE IF NOT EXISTS "FavoriteDish" (
	"id_user"	INTEGER,
	"id_dish"	INTEGER,
	PRIMARY KEY("id_user","id_dish"),
	FOREIGN KEY("id_user") REFERENCES "User"("id"),
	FOREIGN KEY("id_dish") REFERENCES "Dish"("id")
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
	"date"	DATETIME NOT NULL Default CURRENT_TIMESTAMP ,
	PRIMARY KEY("id" AUTOINCREMENT),
	FOREIGN KEY("state_id") REFERENCES "State"("id"),
	FOREIGN KEY("customer_id") REFERENCES "Customer"("id")
);
CREATE TABLE IF NOT EXISTS "OrderDishQuantity" (
	"id"	INTEGER,
	"id_order"	INTEGER NOT NULL,
	"id_dish"	INTEGER NOT NULL,
	"quantity"	INTEGER NOT NULL CHECK("quantity" > 0),
	PRIMARY KEY("id" AUTOINCREMENT),
	FOREIGN KEY("id_dish") REFERENCES "Dish"("id"),
	FOREIGN KEY("id_order") REFERENCES "Order"("id")
);

CREATE TABLE IF NOT EXISTS "Dish" (
	"id"	INTEGER,
	"name"	TEXT NOT NULL,
	"price"	REAL NOT NULL,
	"id_photo"	INTEGER NOT NULL,
	"restaurant_id"	INTEGER NOT NULL,
	PRIMARY KEY("id" AUTOINCREMENT),
	FOREIGN KEY("restaurant_id") REFERENCES "Restaurant"("id")
	FOREIGN KEY("id_photo") REFERENCES "Photo"("id")
);
CREATE TABLE IF NOT EXISTS "Type" (
	"id" INTEGER,
	"name" TEXT NOT NULL,
	PRIMARY KEY("id" AUTOINCREMENT)
);
CREATE TABLE IF NOT EXISTS "DishType" (
	"id_dish" INTEGER NOT NULL,
	"id_type" INTEGER NOT NULL,
	PRIMARY KEY("id_dish","id_type"),
	FOREIGN KEY("id_dish") REFERENCES "Dish"("id"),
	FOREIGN KEY("id_type") REFERENCES "Type"("id")
);
