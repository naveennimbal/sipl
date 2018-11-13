create  table purchase_items(
item_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    part_no varchar(15) not null,
    name varchar(30),
    price int not null ,
    date_added timestamp default current_timestamp,
    status tinyint(1) not null default 1
);

CREATE TABLE `purchase_order` (
  `po_id` int(11) NOT NULL AUTO_INCREMENT,
  `po_date` date not null  ,
  `vendor_id` int(11) DEFAULT NULL,
  `vendor_bank_id` int(11) DEFAULT NULL,
  `po_no` varchar(100) DEFAULT NULL,
  `site_address` varchar(500) DEFAULT NULL,
  `tax_id` int(11) DEFAULT NULL,
  `shipping_address` int(11) DEFAULT NULL,
  `remarks` varchar(500) DEFAULT NULL,
  `bill_attachments` varchar(500) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`po_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1


create table po_items (
id int auto_increment primary key,
po_id int  not null,
part_no varchar(30) not null,
description varchar(100),
quantity tinyint(3) default 1 ,
price int(10) not null
);

