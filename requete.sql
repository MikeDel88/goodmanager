-- nombre de client sans téléphone
SELECT count(id) as teletelephone FROM client WHERE telephone = '' AND entreprise_id = 42

-- nombre de client sans email
SELECT count(id) as email FROM client WHERE email = '' AND entreprise_id = 42

--------------------------------------------------------------------

-- nombre client total actuelle
SELECT count(id) FROM client WHERE entreprise_id = 42

-- nombre de client crée par année et regroupé par année
SELECT YEAR(created_at), COUNT(id) FROM client WHERE entreprise_id = 42 GROUP BY YEAR(created_at)

-- nombre de client total avant une certaine année
SELECT count(id) FROM client WHERE entreprise_id = 42 AND YEAR(created_at) <= 2020

--------------------------------------------------------------------

-- nombre de fois où le client a été contacté par l'entreprise
SELECT contact.client_id, COUNT(contact.client_id) FROM contact, client WHERE contact.client_id = client.id AND client.entreprise_id = 42 GROUP BY client_id

-- nombre de fois où le client a été contacté par l'entreprise sur l'année, le total permet de connaitre le nombre de clients contacté avec distinction x fois un client
SELECT COUNT(contact.id) FROM contact, client WHERE contact.client_id = client.id AND YEAR(date) = 2020 AND client.entreprise_id = 42 GROUP BY contact.client_id

-- nombre de fois où l'utilisateur à contacté le client de l'entreprise sur l'année
SELECT COUNT(contact.id) FROM contact, client, utilisateur WHERE contact.client_id = client.id AND contact.utilisateur_id = utilisateur.id AND YEAR(date) = 2020 AND client.entreprise_id = 42 GROUP BY contact.client_id

-- nombre de contact client réalisés par l'entreprise sur l'année sans distinction client
SELECT COUNT(contact.client_id) FROM contact, client WHERE contact.client_id = client.id AND YEAR(date) = 2020 AND client.entreprise_id = 42




-- nombre de contact réalisés par un utilisateur de l'entreprise
SELECT utilisateur.nom, utilisateur.prenom, COUNT(contact.utilisateur_id) FROM contact, utilisateur WHERE contact.utilisateur_id = utilisateur.id AND YEAR(date) = 2020 AND utilisateur.entreprise_id = 42 GROUP BY utilisateur_id




--------------------------------------------------------------------

-- nombre de client par département
SELECT SUBSTRING(code_postal,1, 2) as code , COUNT(id) FROM client WHERE entreprise_id = 42 GROUP BY code

--------------------------------------------------------------------

-- nombre de rdv réalisé sur l'année pour l'entreprise
SELECT COUNT(rdv.client_id) FROM rdv, client WHERE rdv.client_id = client.id AND YEAR(date) = 2020 AND client.entreprise_id = 42

-- nombre de fois où le client a été vu en rdv sur l'année
SELECT client_id, COUNT(rdv.client_id) FROM rdv, client WHERE rdv.client_id = client.id AND YEAR(date) = 2020 AND client.entreprise_id = 42 GROUP BY client_id




-- nombre de rdv pris par un utilisateur sur l'année
SELECT rdv.utilisateur_id, COUNT(rdv.utilisateur_id) FROM rdv, utilisateur WHERE rdv.utilisateur_id = utilisateur.id AND YEAR(date) = 2020 AND utilisateur.entreprise_id = 42 GROUP BY rdv.utilisateur_id