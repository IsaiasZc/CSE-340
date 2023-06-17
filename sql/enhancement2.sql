-- Query 1
INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword, comment) VALUES ("Tony", "Stark", "tony@starkent.com", "Iam1ronM@n","I am the real Ironman");

-- Query 2: 
UPDATE clients SET clientLevel = 3 WHERE clientId = 3;

-- Query 3
UPDATE inventory 
SET invDescription = REPLACE(invDescription, 'small interior', 'spacious interior')
WHERE invId = 12;

-- Query 4
SELECT inventory.invModel, carclassification.classificationName FROM carclassification INNER JOIN inventory ON carclassification.classificationId = inventory.classificationId WHERE carclassification.classificationId = 1;

-- Query 5
DELETE FROM inventory WHERE invId = 1;

-- Query 6
UPDATE inventory 
SET invImage = CONCAT("/phpmotors", invImage),
invThumbnail = CONCAT("/phpmotors", invThumbnail);

