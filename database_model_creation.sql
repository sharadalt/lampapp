##############################################################
# This file creates the database model based on HOMEWORK 3
# And catering to final Project
############################################################## 


################################################
#Dropping, creating and connecting to a database
################################################
drop database if exists lamp_final_project;
create database lamp_final_project;
connect lamp_final_project;

###################################################################
# Create Tables Region, Category, Location, subcategory and posts #
###################################################################
CREATE TABLE Region(
  Region_ID BIGINT AUTO_INCREMENT PRIMARY KEY,
  RegionName VARCHAR(32) NOT NULL
);

CREATE TABLE Category( 
  Category_ID BIGINT AUTO_INCREMENT PRIMARY KEY,
  CategoryName VARCHAR(32) NOT NULL
);

CREATE TABLE Location (
  Location_ID BIGINT AUTO_INCREMENT PRIMARY KEY,
  Region_ID BIGINT,
  LocationName VARCHAR(32) NOT NULL,
    
  FOREIGN KEY (Region_ID) 
    REFERENCES Region(Region_ID)
    ON DELETE CASCADE
);
  
CREATE TABLE SubCategory (
  SubCategory_ID BIGINT AUTO_INCREMENT PRIMARY KEY,
  Category_ID    BIGINT, 
  SubCategoryName  VARCHAR(32) NOT NULL, 

  FOREIGN KEY (Category_ID) 
    REFERENCES Category(Category_ID)
    ON DELETE CASCADE
);


CREATE TABLE Posts (
  Post_ID         BIGINT AUTO_INCREMENT PRIMARY KEY,
  Title           VARCHAR(32) NOT NULL,
  Price           DECIMAL(9,2),
  Description     VARCHAR(256) NOT NULL,
  Email           VARCHAR(64) NOT NULL,
  Agreement       TINYINT(1),
  TimeStamp       TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  Image1         VARCHAR(100),
  Image2         VARCHAR(100),
  Image3         VARCHAR(100),
  Image4         VARCHAR(100),
  SubCategory_ID  BIGINT,
  Location_ID     BIGINT,

  FOREIGN KEY (SubCategory_ID) 
    REFERENCES SubCategory(SubCategory_ID)
    ON DELETE CASCADE,
    
  FOREIGN KEY (Location_ID)
    REFERENCES Location(Location_ID)
    ON DELETE CASCADE   
);
 
CREATE TABLE users (
  id              BIGINT AUTO_INCREMENT PRIMARY KEY,
  username        VARCHAR (64) NOT NULL,
  password        VARCHAR (40) NOT NULL,
  email           VARCHAR (64) NOT NULL
);
