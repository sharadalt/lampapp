################################################
# This SQL file to insert data
# into Region, Location, Category, SubCategory
# and Posts 
# I have created an user lamp with password '1'
# Creation of the user is not in this file
# If you want to run the following script,
# you can be logged in as root or
# create an user with respective privileges,
# or all privileges
# This creates 3 posts per subcategory
# Atleast 1 post per location
################################################

##############################################
# Inserting values into the five tables
# Region, Location, category, SubCategory 
# and Posts 
###############################################

####Regions

INSERT INTO Region (
  Region_ID,
  RegionName
)
VALUES(
 NULL,
 'USA'
);


INSERT INTO Region (
  Region_ID,
  RegionName
)
VALUES(
 NULL,
 'India'
);


INSERT INTO Region (
  Region_ID,
  RegionName
)
VALUES(
 NULL,
 'Sweden'
);

#### Category

INSERT INTO Category (
 Category_ID,
 CategoryName
)
VALUES
(
  NULL,
  'For Sale/Rent'
);
  

INSERT INTO Category (
 Category_ID,
 CategoryName
)
VALUES
(
  NULL,
  'Services'
);

 
INSERT INTO Category (
 Category_ID,
 CategoryName
)
VALUES
(
  NULL,
  'Jobs'
);

#### Locations in Region One

INSERT INTO Location (
 Location_ID,
 Region_ID,
 LocationName
)
VALUES(
 NULL,
 1,
 'Santa Clara'
);


INSERT INTO Location (
 Location_ID,
 Region_ID,
 LocationName
)
VALUES(
 NULL,
 1,
 'Chicago'
);


INSERT INTO Location (
 Location_ID,
 Region_ID,
 LocationName
)
VALUES(
 NULL,
 1,
 'Denver'
);

#### Locations in Region 2

INSERT INTO Location (
 Location_ID,
 Region_ID,
 LocationName
)
VALUES(
 NULL,
 2,
 'Bengaluru'
);

INSERT INTO Location (
 Location_ID,
 Region_ID,
 LocationName
)
VALUES(
  NULL,
  2,
 'New Delhi'
);

INSERT INTO Location (
 Location_ID,
 Region_ID,
 LocationName
)
VALUES(
 NULL,
 2,
 'Mumbai'
);

#### Locations in Region 3
INSERT INTO Location (
 Location_ID,
 Region_ID,
 LocationName
)
VALUES(
 NULL,
 3,
 'Stockholm'
);

INSERT INTO Location (
 Location_ID,
 Region_ID,
 LocationName
)
VALUES(
  NULL,
  3,
 'Gothenburg'
);

INSERT INTO Location (
 Location_ID,
 Region_ID,
 LocationName
)
VALUES(
 NULL,
 3,
 'Arboga'
);


#### SubCategories in Category 1

INSERT INTO SubCategory (
  SubCategory_ID,
  Category_ID, 
  SubCategoryName 
)
VALUES
(
 NULL,
 1,
 'Books'
);
   

INSERT INTO SubCategory (
  SubCategory_ID,
  Category_ID, 
  SubCategoryName 
)
VALUES
(
 NULL,
 1,
 'Electronics'
);

 
INSERT INTO SubCategory (
  SubCategory_ID,
  Category_ID, 
  SubCategoryName 
)
VALUES
(
 NULL,
 1,
 'Housing'
);

#### SubCategories in Category 2
 
INSERT INTO SubCategory (
  SubCategory_ID,
  Category_ID, 
  SubCategoryName 
)
VALUES
(
 NULL,
 2,
 'Computer'
);


INSERT INTO SubCategory (
  SubCategory_ID,
  Category_ID, 
  SubCategoryName 
)
VALUES
(
 NULL,
 2,
 'Financial'
);


INSERT INTO SubCategory (
  SubCategory_ID,
  Category_ID, 
  SubCategoryName 
)
VALUES
(
 NULL,
 2,
 'Lessons'
);

#### Sub Categories in Category 3

INSERT INTO SubCategory (
  SubCategory_ID,
  Category_ID, 
  SubCategoryName 
)
VALUES
(
 NULL,
 3,
 'Full-Time'
);

INSERT INTO SubCategory (
  SubCategory_ID,
  Category_ID, 
  SubCategoryName 
)
VALUES
(
 NULL,
 3,
 'Part-Time'
);

INSERT INTO SubCategory (
  SubCategory_ID,
  Category_ID, 
  SubCategoryName 
)
VALUES
(
 NULL,
 3,
 'Volunteering'
);

#### Posts in SubCategory 1
INSERT INTO Posts (
  Post_ID,
  Title,           
  Price,         
  Description,     
  Email,           
  Agreement,       
  TimeStamp,  
  Image1,        
  Image2,         
  Image3,         
  Image4,         
  SubCategory_ID,  
  Location_ID    
) 
VALUES (
  NULL,
  'Books Gone with the wind',
  25.00,
  'In a very good condition',    
  'xx@gmail.com',
  1,
  CURRENT_TIMESTAMP,
  NULL,
  NULL,
  NULL,
  NULL,
  1, 
  1     
);

INSERT INTO Posts (
  Post_ID,
  Title,
  Price,
  Description,
  Email,
  Agreement,
  TimeStamp,
  Image1,
  Image2,
  Image3,
  Image4,
  SubCategory_ID,
  Location_ID
)

VALUES (
  NULL,
  'Books HarryPotter 2',
  10.00,
  'Fairly good condition',
  'yy@gmail.com',
  1,
  CURRENT_TIMESTAMP,
  NULL,
  NULL,
  NULL,
  NULL,
  1,
  2
);

INSERT INTO Posts (
  Post_ID,
  Title,
  Price,
  Description,
  Email,
  Agreement,
  TimeStamp,
  Image1,
  Image2,
  Image3,
  Image4,
  SubCategory_ID,
  Location_ID
)

VALUES (
  NULL,
  'Books Starwars',
  10.00,
  'good condition',
  'zz@gmail.com',
  1,
  CURRENT_TIMESTAMP,
  NULL,
  NULL,
  NULL,
  NULL,
  1,
  3
);

#### Posts in SubCategory 2

INSERT INTO Posts (
  Post_ID,
  Title,
  Price,
  Description,
  Email,
  Agreement,
  TimeStamp,
  Image1,
  Image2,
  Image3,
  Image4,
  SubCategory_ID,
  Location_ID
)
VALUES (
  NULL,
  'Electronics:Laptop',
  1000,
  'In a very good condition',
  'xx@gmail.com',
  1,
  CURRENT_TIMESTAMP,
  NULL,
  NULL,
  NULL,
  NULL,
  2,
  4
);

INSERT INTO Posts (
  Post_ID,
  Title,
  Price,
  Description,
  Email,
  Agreement,
  TimeStamp,
  Image1,
  Image2,
  Image3,
  Image4,
  SubCategory_ID,
  Location_ID
)
VALUES (
  NULL,
  'Electronics:Android Phone',
  300,
  'In a very good condition',
  'jj@gmail.com',
  1,
  CURRENT_TIMESTAMP,
  NULL,
  NULL,
  NULL,
  NULL,
  2,
  5
);

INSERT INTO Posts (
  Post_ID,
  Title,
  Price,
  Description,
  Email,
  Agreement,
  TimeStamp,
  Image1,
  Image2,
  Image3,
  Image4,
  SubCategory_ID,
  Location_ID
)
VALUES (
  NULL,
  'Electronics:Iphone',
  650,
  'In a very good condition',
  'll@gmail.com',
  1,
  CURRENT_TIMESTAMP,
  NULL,
  NULL,
  NULL,
  NULL,
  2,
  6
);

##############Posts in Subcategory 3

INSERT INTO Posts (
  Post_ID,
  Title,
  Price,
  Description,
  Email,
  Agreement,
  TimeStamp,
  Image1,
  Image2,
  Image3,
  Image4,
  SubCategory_ID,
  Location_ID
)
VALUES (
  NULL,
  'Housing:Apartment for rent',
  2000,
  'In a very good condition',
  'ss@gmail.com',
  1,
  CURRENT_TIMESTAMP,
  NULL,
  NULL,
  NULL,
  NULL,
  3,
  7
);

INSERT INTO Posts (
  Post_ID,
  Title,
  Price,
  Description,
  Email,
  Agreement,
  TimeStamp,
  Image1,
  Image2,
  Image3,
  Image4,
  SubCategory_ID,
  Location_ID
)
VALUES (
  NULL,
  'Housing:Bedroom for rent',
  1000,
  'In a very good condition',
  'tt@gmail.com',
  1,
  CURRENT_TIMESTAMP,
  NULL,
  NULL,
  NULL,
  NULL,
  3,
  8
);

INSERT INTO Posts (
  Post_ID,
  Title,
  Price,
  Description,
  Email,
  Agreement,
  TimeStamp,
  Image1,
  Image2,
  Image3,
  Image4,
  SubCategory_ID,
  Location_ID
)
VALUES (
  NULL,
  'Housing:Studio for rent',
  1500,
  'In a very good condition',
  'rr@gmail.com',
  1,
  CURRENT_TIMESTAMP,
  NULL,
  NULL,
  NULL,
  NULL,
  3,
  9
);

##############Posts in Subcategory 4

INSERT INTO Posts (
  Post_ID,
  Title,
  Price,
  Description,
  Email,
  Agreement,
  TimeStamp,
  Image1,
  Image2,
  Image3,
  Image4,
  SubCategory_ID,
  Location_ID
)

VALUES (
  NULL,
  'Computer:Dell computer',
  2000,
  'In a very good condition',
  'pp@gmail.com',
  1,
  CURRENT_TIMESTAMP,
  NULL,
  NULL,
  NULL,
  NULL,
  4,
  2
);                                                            

INSERT INTO Posts (
  Post_ID,
  Title,
  Price,
  Description,
  Email,
  Agreement,
  TimeStamp,
  Image1,
  Image2,
  Image3,
  Image4,
  SubCategory_ID,
  Location_ID
)
VALUES (
  NULL,
  'Computer:Compaq computer',
  2800,
  'In a very good condition',
  'ff@gmail.com',
  1,
  CURRENT_TIMESTAMP,
  NULL,
  NULL,
  NULL,
  NULL,
  4,
  2
);    

INSERT INTO Posts (
  Post_ID,
  Title,
  Price,
  Description,
  Email,
  Agreement,
  TimeStamp,
  Image1,
  Image2,
  Image3,
  Image4,
  SubCategory_ID,
  Location_ID
)
VALUES (
  NULL,
  'Computer:Samsung computer',
  2000,
  'In a very good condition',
  'pp@gmail.com',
  1,
  CURRENT_TIMESTAMP,
  NULL,
  NULL,
  NULL,
  NULL,
  4,
  2
);   

######Posts in Subcategory 5

INSERT INTO Posts (
  Post_ID,
  Title,
  Price,
  Description,
  Email,
  Agreement,
  TimeStamp,
  Image1,
  Image2,
  Image3,
  Image4,
  SubCategory_ID,
  Location_ID
)
VALUES (
  NULL,
  'Financial:Turbotax software',
  100,
  'In a very good condition',
  'mm@gmail.com',
  1,
  CURRENT_TIMESTAMP,
  NULL,
  NULL,
  NULL,
  NULL,
  5,
  2
);

INSERT INTO Posts (
  Post_ID,
  Title,
  Price,
  Description,
  Email,
  Agreement,
  TimeStamp,
  Image1,
  Image2,
  Image3,
  Image4,
  SubCategory_ID,
  Location_ID
)
VALUES (
  NULL,
  'Financial:Retirement Savings Advice',
  500,
  'Reputed Accountant',
  'mm@gmail.com',
  1,
  CURRENT_TIMESTAMP,
  NULL,
  NULL,
  NULL,
  NULL,
  5,
  2
);

INSERT INTO Posts (
  Post_ID,
  Title,
  Price,
  Description,
  Email,
  Agreement,
  TimeStamp,
  Image1,
  Image2,
  Image3,
  Image4,
  SubCategory_ID,
  Location_ID
)
VALUES (
  NULL,
  'Financial:Tax Advice',
  300,
  'Very well known firm',
  'mm@gmail.com',
  1,
  CURRENT_TIMESTAMP,
  NULL,
  NULL,
  NULL,
  NULL,
  5,
  2
);


INSERT INTO Posts (
  Post_ID,
  Title,
  Price,
  Description,
  Email,
  Agreement,
  TimeStamp,
  Image1,
  Image2,
  Image3,
  Image4,
  SubCategory_ID,
  Location_ID
)
VALUES (
  NULL,
  'Financial:Tax Advice',
  300,
  'Very well known firm',
  'mm@gmail.com',
  1,
  CURRENT_TIMESTAMP,
  NULL,
  NULL,
  NULL,
  NULL,
  5,
  2
);

#### Posts in SubCategory 6
INSERT INTO Posts (
  Post_ID,
  Title,
  Price,
  Description,
  Email,
  Agreement,
  TimeStamp,
  Image1,
  Image2,
  Image3,
  Image4,
  SubCategory_ID,
  Location_ID
)
VALUES (
  NULL,
  'Lessons:Maths Coaching',
  300,
  'Very well known firm',
  'mm@gmail.com',
  1,
  CURRENT_TIMESTAMP,
  NULL,
  NULL,
  NULL,
  NULL,
  6,
  2
);


INSERT INTO Posts (
  Post_ID,
  Title,
  Price,
  Description,
  Email,
  Agreement,
  TimeStamp,
  Image1,
  Image2,
  Image3,
  Image4,
  SubCategory_ID,
  Location_ID
)
VALUES (
  NULL,
  'Lessons:Computer Training',
  500,
  'Very well known firm',
  'mm@gmail.com',
  1,
  CURRENT_TIMESTAMP,
  NULL,
  NULL,
  NULL,
  NULL,
  6,
  2
);
 
INSERT INTO Posts (
  Post_ID,
  Title,
  Price,
  Description,
  Email,
  Agreement,
  TimeStamp,
  Image1,
  Image2,
  Image3,
  Image4,
  SubCategory_ID,
  Location_ID
)
VALUES (
  NULL,
  'Lessons:Public Speaking',
  300,
  'Very well known firm',
  'mm@gmail.com',
  1,
  CURRENT_TIMESTAMP,
  NULL,
  NULL,
  NULL,
  NULL,
  6,
  2
);


#### SubCategory 7
INSERT INTO Posts (
  Post_ID,
  Title,
  Price,
  Description,
  Email,
  Agreement,
  TimeStamp,
  Image1,
  Image2,
  Image3,
  Image4,
  SubCategory_ID,
  Location_ID
)


VALUES (
  NULL,
  'Jobs-Full-Time:Childcare',
  300,
  'Very well known firm',
  'mm@gmail.com',
  1,
  CURRENT_TIMESTAMP,
  NULL,
  NULL,
  NULL,
  NULL,
  7,
  2
);

INSERT INTO Posts (
  Post_ID,
  Title,
  Price,
  Description,
  Email,
  Agreement,
  TimeStamp,
  Image1,
  Image2,
  Image3,
  Image4,
  SubCategory_ID,
  Location_ID
)
VALUES (
  NULL,
  'Jobs-Full-Time:Book Keeping',
  300,
  'Very well known firm',
  'mm@gmail.com',
  1,
  CURRENT_TIMESTAMP,
  NULL,
  NULL,
  NULL,
  NULL,
  7,
  2
);

INSERT INTO Posts (
  Post_ID,
  Title,
  Price,
  Description,
  Email,
  Agreement,
  TimeStamp,
  Image1,
  Image2,
  Image3,
  Image4,
  SubCategory_ID,
  Location_ID
)
VALUES (
  NULL,
  'Jobs-Full-Time:Computer Operator',
  300,
  'Very well known firm',
  'mm@gmail.com',
  1,
  CURRENT_TIMESTAMP,
  NULL,
  NULL,
  NULL,
  NULL,
  7,
  2
);


##### Posts in SubCategory 8
INSERT INTO Posts (
  Post_ID,
  Title,
  Price,
  Description,
  Email,
  Agreement,
  TimeStamp,
  Image1,
  Image2,
  Image3,
  Image4,
  SubCategory_ID,
  Location_ID
)
VALUES (
  NULL,
  'Jobs-Part-Time:Computer Operator',
  300,
  'Very well known firm',
  'mm@gmail.com',
  1,
  CURRENT_TIMESTAMP,
  NULL,
  NULL,
  NULL,
  NULL,
  8,
  2
);

INSERT INTO Posts (
  Post_ID,
  Title,
  Price,
  Description,
  Email,
  Agreement,
  TimeStamp,
  Image1,
  Image2,
  Image3,
  Image4,
  SubCategory_ID,
  Location_ID
)
VALUES (
  NULL,
  'Jobs-Part-Time:Computer Operator',
  300,
  'Very well known firm',
  'mm@gmail.com',
  1,
  CURRENT_TIMESTAMP,
  NULL,
  NULL,
  NULL,
  NULL,
  8,
  2
);

INSERT INTO Posts (
  Post_ID,
  Title,
  Price,
  Description,
  Email,
  Agreement,
  TimeStamp,
  Image1,
  Image2,
  Image3,
  Image4,
  SubCategory_ID,
  Location_ID
)
VALUES (
  NULL,
  'Jobs-Part-Time:Computer Operator',
  300,
  'Very well known firm',
  'mm@gmail.com',
  1,
  CURRENT_TIMESTAMP,
  NULL,
  NULL,
  NULL,
  NULL,
  8,
  3
);


#######Posts in SubCategory 9
INSERT INTO Posts (
  Post_ID,
  Title,
  Price,
  Description,
  Email,
  Agreement,
  TimeStamp,
  Image1,
  Image2,
  Image3,
  Image4,
  SubCategory_ID,
  Location_ID
)
VALUES (
  NULL,
  'Jobs-Volunteering:Computer Operator',
  300,
  'Very well known firm',
  'mm@gmail.com',
  1,
  CURRENT_TIMESTAMP,
  NULL,
  NULL,
  NULL,
  NULL,
  9,
  3
);

INSERT INTO Posts (
  Post_ID,
  Title,
  Price,
  Description,
  Email,
  Agreement,
  TimeStamp,
  Image1,
  Image2,
  Image3,
  Image4,
  SubCategory_ID,
  Location_ID
)
VALUES (
  NULL,
  'Jobs-Volunteering:Data Entry',
  300,
  'Very well known firm',
  'mm@gmail.com',
  1,
  CURRENT_TIMESTAMP,
  NULL,
  NULL,
  NULL,
  NULL,
  9,
  3
);

INSERT INTO Posts (
  Post_ID,
  Title,
  Price,
  Description,
  Email,
  Agreement,
  TimeStamp,
  Image1,
  Image2,
  Image3,
  Image4,
  SubCategory_ID,
  Location_ID
)
VALUES (
  NULL,
  'Jobs-Volunteering:Child Care',
  300,
  'Very well known firm',
  'mm@gmail.com',
  1,
  CURRENT_TIMESTAMP,
  NULL,
  NULL,
  NULL,
  NULL,
  9,
  3
);

####### User Creation

INSERT INTO users (
  id,
  username,
  password,
  email
)
VALUES (
  NULL,
  'johnsmith',
  'hello123',
  'hello@gmail.com'
);

