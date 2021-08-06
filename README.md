```sql
SET FOREIGN_KEY_CHECKS=0;

create table `addresses` (
    `id` bigint unsigned not null auto_increment primary key, 
    `city_id` bigint unsigned not null, 
    `road` varchar(255) not null, 
    `road_num` varchar(255) not null, 
    `apartment_floor` varchar(255) null, 
    `apartment_num` varchar(255) null, 
    `created_at` timestamp null, 
    `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table `addresses` add constraint `addresses_city_id_foreign` foreign key (`city_id`) references `cities` (`id`);


create table `cities` (
    `id` bigint unsigned not null auto_increment primary key, 
    `country_id` bigint unsigned not null, 
    `zipcode` varchar(255) not null, 
    `name` varchar(255) not null, 
    `created_at` timestamp null, 
    `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table `cities` add constraint `cities_country_id_foreign` foreign key (`country_id`) references `countries` (`id`);


create table `countries` (
    `id` bigint unsigned not null auto_increment primary key, 
    `sub_region_id` bigint unsigned not null, 
    `name` varchar(255) not null, 
    `native_name` varchar(255) not null, 
    `flag` varchar(255) not null, 
    `created_at` timestamp null, 
    `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table `countries` add constraint `countries_sub_region_id_foreign` foreign key (`sub_region_id`) references `sub_regions` (`id`);


create table `sub_regions` (
    `id` bigint unsigned not null auto_increment primary key, 
    `region_id` bigint unsigned not null,
    `name` varchar(255) not null, 
    `created_at` timestamp null, 
    `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table `sub_regions` add constraint `sub_regions_region_id_foreign` foreign key (`region_id`) references `regions` (`id`);


create table `regions` (
    `id` bigint unsigned not null auto_increment primary key, 
    `name` varchar(255) not null, 
    `created_at` timestamp null, 
    `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';


create table `customers` (
    `id` bigint unsigned not null auto_increment primary key, 
    `login_id` bigint unsigned not null, 
    `address_id` bigint unsigned not null, 
    `name` varchar(255) not null, 
    `created_at` timestamp null, 
    `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table `customers` add constraint `customers_login_id_foreign` foreign key (`login_id`) references `logins` (`id`);
alter table `customers` add constraint `customers_address_id_foreign` foreign key (`address_id`) references `addresses` (`id`);


create table `logins` (
    `id` bigint unsigned not null auto_increment primary key, 
    `username` varchar(255) not null, 
    `password` varchar(255) not null, 
    `created_at` timestamp null, 
    `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';


create table `locations` (
    `id` bigint unsigned not null auto_increment primary key, 
    `address_id` bigint unsigned not null, 
    `name` varchar(255) not null, 
    `created_at` timestamp null, 
    `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table `locations` add constraint `locations_address_id_foreign` foreign key (`address_id`) references `addresses` (`id`);


create table `departments` (
    `id` bigint unsigned not null auto_increment primary key, 
    `location_id` bigint unsigned not null, 
    `name` varchar(255) not null, 
    `created_at` timestamp null, 
    `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
alter table `departments` add constraint `departments_location_id_foreign` foreign key (`location_id`) references `locations` (`id`)


create table `employees` (
    `id` bigint unsigned not null auto_increment primary key, 
    `department_id` bigint unsigned not null, 
    `address_id` bigint unsigned not null, 
    `login_id` bigint unsigned not null, 
    `name` varchar(255) not null, 
    `created_at` timestamp null, 
    `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table `employees` add constraint `employees_department_id_foreign` foreign key (`department_id`) references `departments` (`id`);
alter table `employees` add constraint `employees_address_id_foreign` foreign key (`address_id`) references `addresses` (`id`);
alter table `employees` add constraint `employees_login_id_foreign` foreign key (`login_id`) references `logins` (`id`);


create table `orders` (
    `id` bigint unsigned not null auto_increment primary key, 
    `customer_id` bigint unsigned not null, 
    `extra_info` varchar(255) null, 
    `status` enum('NOT ORDERED', 'ORDER PLACED', 'ORDER ACCEPTED', 'ORDER SEND') not null, 
    `created_at` timestamp null, 
    `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table `orders` add constraint `orders_customer_id_foreign` foreign key (`customer_id`) references `customers` (`id`);


create table `order_items` (
    `id` bigint unsigned not null auto_increment primary key, 
    `order_id` bigint unsigned not null, 
    `item_id` bigint unsigned not null, 
    `price` bigint not null, 
    `status` enum('NOT ORDERED', 'ORDER PLACED', 'ORDER ACCEPTED', 'ORDER SEND') not null, 
    `created_at` timestamp null, 
    `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table `order_items` add constraint `order_items_order_id_foreign` foreign key (`order_id`) references `orders` (`id`);
alter table `order_items` add constraint `order_items_item_id_foreign` foreign key (`item_id`) references `items` (`id`);


create table `order_discounts` (
    `id` bigint unsigned not null auto_increment primary key, 
    `order_id` bigint unsigned not null, 
    `discount` bigint not null, 
    `description` varchar(255) not null, 
    `created_at` timestamp null, 
    `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table `order_discounts` add constraint `order_discounts_order_id_foreign` foreign key (`order_id`) references `orders` (`id`);


create table `order_deliveries` (
    `id` bigint unsigned not null auto_increment primary key, 
    `order_id` bigint unsigned not null, 
    `address_id` bigint unsigned not null, 
    `order_delivery_type_id` bigint unsigned not null, 
    `carrier` varchar(255) not null, 
    `tracking_id` varchar(255) not null, 
    `status` enum('DELIVERY NOT INITIATED', 'DELIVERY INITIATED', 'DELIVERY SEND', 'DELIVERY IN-PERSON') not null, 
    `created_at` timestamp null, 
    `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table `order_deliveries` add constraint `order_deliveries_order_id_foreign` foreign key (`order_id`) references `orders` (`id`);
alter table `order_deliveries` add constraint `order_deliveries_address_id_foreign` foreign key (`address_id`) references `addresses` (`id`);
alter table `order_deliveries` add constraint `order_deliveries_order_delivery_type_id_foreign` foreign key (`order_delivery_type_id`) references `order_delivery_types` (`id`);


create table `order_delivery_types` (
    `id` bigint unsigned not null auto_increment primary key, 
    `name` varchar(255) not null, 
    `created_at` timestamp null,
    `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';


create table `items` (
    `id` bigint unsigned not null auto_increment primary key, 
    `location_id` bigint unsigned not null, 
    `product_id` bigint unsigned not null, 
    `discount_price` bigint null, 
    `status` enum('IN INVENTORY', 'RESERVED', 'ORDER PLACED', 'PURCHASED') not null, 
    `created_at` timestamp null, 
    `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table `items` add constraint `items_location_id_foreign` foreign key (`location_id`) references `locations` (`id`);
alter table `items` add constraint `items_product_id_foreign` foreign key (`product_id`) references `products` (`id`);


create table `products` (
    `id` bigint unsigned not null auto_increment primary key, 
    `product_type_id` bigint unsigned not null, 
    `manufacturer_id` bigint unsigned not null, 
    `name` varchar(255) not null, 
    `description` varchar(255) not null, 
    `price` bigint not null, 
    `status` enum('IN PRODUCTION', 'DISCONTINUED') not null, 
    `created_at` timestamp null, 
    `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table `products` add constraint `products_product_type_id_foreign` foreign key (`product_type_id`) references `product_types` (`id`);
alter table `products` add constraint `products_manufacturer_id_foreign` foreign key (`manufacturer_id`) references `manufacturers` (`id`);


create table `product_types` (
    `id` bigint unsigned not null auto_increment primary key, 
    `name` varchar(255) not null, 
    `description` varchar(255) not null, 
    `created_at` timestamp null, 
    `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';


create table `manufacturers` (
    `id` bigint unsigned not null auto_increment primary key, 
    `address_id` bigint unsigned not null, 
    `name` varchar(255) not null, 
    `created_at` timestamp null, 
    `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table `manufacturers` add constraint `manufacturers_address_id_foreign` foreign key (`address_id`) references `addresses` (`id`);

SET FOREIGN_KEY_CHECKS=1;
```
