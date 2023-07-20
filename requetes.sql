INSERT INTO fuel (id, name) VALUES
(1, 'Essence'),
(2, 'Diesel'),
(3, 'Hybride'),
(4, 'Electrique');

INSERT INTO car (id, fuel_id, model, year, mileage, description, price, gearbox, doors, motor, equipments, picture, brand) VALUES
(1, 1, '2008', '2023', '0', 'Nouveau véhicule disponible.', '28 340', 'Manuelle 6 rapports', 5, '1.2 PureTech 100 BVM6', 'GPS, climatisation, jantes alliages, régulateur de vitesse, radar de recul, bluetooth, Apple Car Play', 'cover-r4x3w1200-5e3d7ef5df133-peugeoit-2008-64aeb915281d0.jpg', 'Peugeot '),
(2, 4, 'Zoé', '2016', '47 675', 'La Zoé est une voiture électrique moderne et élégante, idéale pour ceux qui souhaitent se déplacer de manière responsable et écologique. Avec sa batterie en location, il est facile de la recharger et de profiter de la conduite en toute tranquillité. La finition Zen offre un intérieur confortable et spacieux pour se détendre et profiter du trajet. La Zoé est le choix parfait pour ceux qui veulent se démarquer tout en étant respectueux de l\'environnement.', '7999', 'Automatique 1 rapport', 5, 'R240 - Batterie en location', 'GPS, régulateur de vitesse, bluetooth et climatisation.', '2019-essais-presse-nouvelle-renault-zoe-en-sardaigne-64b00a79e544d.jpg', 'Renault'),
(3, 1, 'C3 Aircross', '2020', '0', 'Une voiture sûre et fiable.', '18 659', 'Boîte manuelle 6 rapports', 5, '1.2 PureTech 110 BVM6', 'Climatisation, régulateur de vitesse, radar de recul, bluetooth, Apple Car Play et Android Auto', 'images-64b00d035c7f1.jpg', 'Citroën'),
(4, 1, 'Q2', '2023', '0', 'Notre plus récente acquisition, vous allez l\'adorer !', '44 999', 'Automatique 7 rapports', 5, '35 TFSI 150 S tronic 7', 'GPS, climatisation, régulateur de vitesse, radar de recul, Apple Car Play, jantes alliages, bluetooth, Android Auto.', 'audiq2-64a83094be54f-64b2db3722814.jpg', 'Audi');


INSERT INTO service (id, title, description, image) VALUES
(1, 'Révision & Vidange', 'Changement des filtres, du liquide de refroidissement, du liquide de frein et vidange de la boîte de vitesse.', 'vidange-64aebdd9695f3.jpg'),
(2, 'Pneus', 'Changement de pneus, équilibrage et parallélisme. Permutation été/hiver et répération de pneu.', 'pneu-64b2d8751c9a8.jpg'),
(3, 'Freinage', 'Changement des plaquetttes, disques et du liquide de frein. Diagnostic freinage possible.', 'frein-64b2d9490992e.jpg');



INSERT INTO comment (id, name, message, note, date_added, approuved) VALUES
(1, 'Sarah Richefeu', 'Je recommande vivement !', 5, '2023-07-13 09:12:27', 1),
(2, 'Pierre Ferdinand', 'Acceuil chaleureux, bon service.', 4, '2023-07-13 09:34:07', 1),
(3, 'Rikki Martin', 'Super acceuil, voiture chouchoutée !', 4, '2023-07-15 17:56:45', 1);

