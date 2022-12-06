/* SQL Statement 1 */
INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword, clientLevel, comment) 
    VALUES ("Tony", "Stark", "tony@starkent.com", "Iam1ronM@n", DEFAULT, "I am the real Ironman");

/* SQL Statement 2 */
UPDATE clients set clientLevel = 3 WHERE clientFirstname = "Tony";

/* SQL Statement 3 */
UPDATE inventory set invDescription = replace(invDescription,"small interior", "spacious interior")
    WHERE invMake = "GM" and invModel = "Hummer";

/* SQL Statement 4 FIX!!!*/
Select inv.invModel, car.classificationName
FROM inventory inv
INNER JOIN carclassification car
ON inv.classificationId = car.classificationId
WHERE car.classificationName = 'SUV';

/* SQL Statement 5 */
DELETE FROM inventory WHERE invMake = "Jeep" and invModel = "Wrangler";

/* SQL Statement 6 */
UPDATE inventory set invImage = Concat('/phpmotors', invImage), invThumbnail = Concat('/phpmotors', invThumbnail);






