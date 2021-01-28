CREATE TABLE `devices`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `uid` VARCHAR(255) NOT NULL,
    `appid` VARCHAR(255) NOT NULL,
    `language` VARCHAR(255) NOT NULL,
    `os` VARCHAR(255) NOT NULL,
    `created_at` INT NOT NULL,
    `updated_at` INT NOT NULL
);
ALTER TABLE
    `devices` ADD PRIMARY KEY `devices_id_primary`(`id`);
CREATE TABLE `subscriptions`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `uid` INT NOT NULL,
    `appid` INT NOT NULL,
    `product_id` INT NOT NULL,
    `client_token_id` INT NOT NULL,
    `os` INT NOT NULL,
    `receipt` INT NOT NULL,
    `purchase_date` INT NOT NULL,
    `expiry_date` INT NOT NULL,
    `status` INT NOT NULL,
    `created_at` INT NOT NULL,
    `updated_at` INT NOT NULL
);
ALTER TABLE
    `subscriptions` ADD PRIMARY KEY `subscriptions_id_primary`(`id`);
CREATE TABLE `products`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` INT NOT NULL,
    `created_at` INT NOT NULL,
    `updated_at` INT NOT NULL
);
ALTER TABLE
    `products` ADD PRIMARY KEY `products_id_primary`(`id`);
CREATE TABLE `client_tokens`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `device_id` INT NOT NULL,
    `token` INT NOT NULL,
    `created_at` INT NOT NULL,
    `updated_at` INT NOT NULL
);
ALTER TABLE
    `client_tokens` ADD PRIMARY KEY `client_tokens_id_primary`(`id`);
CREATE TABLE `applications`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` INT NOT NULL,
    `username` INT NOT NULL,
    `password` INT NOT NULL,
    `created_at` INT NOT NULL,
    `updated_at` INT NOT NULL
);
ALTER TABLE
    `applications` ADD PRIMARY KEY `applications_id_primary`(`id`);