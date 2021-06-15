/*
    Insert a client into the clients table
*/
INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword, comment) VALUES ('Tony', 'Stark', 'tony@starkent.com', 'Iam1ronM@n', 'I am the real Ironman');


/*
    Modify the Tony Stark record to change the clientLevel to 3
*/
UPDATE clients SET clientLevel = 3 WHERE clientFirstname = 'Tony' AND clientLastname = 'Stark';


/*
    Modify the "GM Hummer" record to read "spacious interior" rather than "small interior" using a single query.
*/
UPDATE inventory SET invDescription = REPLACE(invDescription, 'small', 'spacious') WHERE invMake = 'GM' AND invModel = 'Hummer';


/*
    Use an inner join to select the invModel field from the inventory table and the classificationName field from the carclassification table for inventory items that belong to the "SUV" category.
*/
SELECT i.invModel, c.classificationName FROM inventory i INNER JOIN carclassification c on i.classificationId = c.classificationId WHERE c.classificationName = 'SUV';


/*
    Delete the Jeep Wrangler from the database.
*/
DELETE FROM inventory WHERE invMake = 'Jeep' AND invModel = 'Wrangler';


/*
    Update all records in the Inventory table to add "/phpmotors" to the beginning of the file path in the invImage and invThumbnail columns using a single query.
*/
UPDATE inventory SET invImage = concat('/phpmotors', invImage), invThumbnail = concat('/phpmotors', invThumbnail);