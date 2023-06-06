CREATE TABLE IF NOT EXIST `products`(
    `product_id` int(11) NOT NULL AUTO_INCREMENT,
    `product_name` varchar(100) NOT NULL,
    `product_category` varchar(100) NOT NULL,
    `product_description` varchar(255) NOT NULL,
    `product_image` varchar(255) NOT NULL,
     `product_name2` varchar(255) NOT NULL,
      `product_name3` varchar(255) NOT NULL,
       `product_name4` varchar(255) NOT NULL,
        `product_price` decimal(6,2) NOT NULL,
         `product_special_offer` integer(2) NOT NULL,
          `product_color` varchar(100) NOT NULL,

          PRIMARY KEY (`product_id`)
     )ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXIST `orders`(
    `order_id` int(11) NOT NULL AUTO_INCREMENT,
    `order_status` varchar(100) NOT NULL DEFAULT 'on_hold',
    `user_id` int(11) NOT NULL,
    `user_phone` int(11) NOT NULL,
    `user_city` varchar(255) NOT NULL,
    `user_address` varchar(255) NOT NULL,
    `order_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `order_cost` decimal(6,2) NOT NULL,

          PRIMARY KEY (`order_id`)
     )ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXIST `order_items`(
    `item_id` int(11) NOT NULL AUTO_INCREMENT,
    `order_id` int(11) NOT NULL,
    `product_id` int(11) NOT NULL,
    `user_id` int(11) NOT NULL,
    `product_name` varchar(255) NOT NULL,
    `product_image` varchar(255) NOT NULL,
    `order_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,


          PRIMARY KEY (`item_id`)
     )ENGINE=InnoDB DEFAULT CHARSET=latin1;


   
CREATE TABLE IF NOT EXIST `users`(
    `user_id` int(11) NOT NULL,
    `user_name` varchar(255) NOT NULL,
    `user_email` varchar(255) NOT NULL,
    `user_password` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
          PRIMARY KEY (`user_id`)
    UNIQUE KEY `UX_CONSTRAINT`(`user_email`)

     )ENGINE=InnoDB DEFAULT CHARSET=latin1;


        