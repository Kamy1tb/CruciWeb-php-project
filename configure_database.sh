#!/bin/bash

# Variables
ENV_FILE="/var/www/html/.env"
SQL_FILE="./projet.sql"

# Vérification des droits root
if [ "$(id -u)" -ne 0 ]; then
    echo "Ce script doit être exécuté avec les droits root (sudo)."
    exit 1
fi

# Demande des informations à l'utilisateur
echo "Veuillez entrer les informations suivantes :"

read -p "Hôte de la base de données (DB_HOST) utiliser 127.0.0.1 pour une bdd locale dans la vm: " DB_HOST
read -p "Port de la base de données (DB_PORT) : " DB_PORT
read -p "Nom de la base de données (DB_NAME) : " DB_NAME
read -p "Nom de l'utilisateur (DB_USER) : " DB_USER
read -p "Mot de passe de l'utilisateur (DB_PASSWORD) : " DB_PASSWORD
echo
read -p "Nom de l'utilisateur administrateur (DB_USER_ADMIN) : " DB_USER_ADMIN
read -p "Mot de passe de l'utilisateur administrateur : " DB_PASSWORD_ADMIN
echo

# Écriture dans le fichier .env
echo "Écriture des variables dans le fichier .env..."
cat <<EOF > "$ENV_FILE"
DB_HOST=$DB_HOST
DB_PORT=$DB_PORT
DB_NAME=$DB_NAME
DB_USER=$DB_USER
DB_PASSWORD=$DB_PASSWORD
DB_USER_ADMIN=$DB_USER_ADMIN
DB_PASSWORD_ADMIN=$DB_PASSWORD_ADMIN 
EOF

# Création de la base de données et des utilisateurs
echo "Configuration de la base de données..."

mysql -h "localhost" -P "$DB_PORT" -u "phpmyadmin" -p"7Zg72if4NoCaKzRv30T" <<EOF
-- Création de la base de données si elle n'existe pas
CREATE DATABASE IF NOT EXISTS $DB_NAME;

-- Utilisation de la base de données
USE $DB_NAME;

-- Exécution du fichier SQL fourni
SOURCE $SQL_FILE;

-- Création de l'utilisateur $DB_USER avec les privilèges nécessaires
CREATE USER IF NOT EXISTS '$DB_USER'@'%' IDENTIFIED BY '$DB_PASSWORD';
GRANT SELECT, INSERT ON *.* TO '$DB_USER'@'%';
GRANT SELECT, INSERT ON \`projet\`.* TO '$DB_USER'@'%';
GRANT SELECT, INSERT, UPDATE ON \`projet\`.\`sauvegarde\` TO '$DB_USER'@'%';

-- Création de l'utilisateur $DB_USER_ADMIN avec les privilèges nécessaires
CREATE USER IF NOT EXISTS '$DB_USER_ADMIN'@'%' IDENTIFIED BY '$DB_PASSWORD_ADMIN';
GRANT ALL PRIVILEGES ON $DB_NAME.* TO '$DB_USER_ADMIN'@'%';



-- Rafraîchissement des privilèges
FLUSH PRIVILEGES;
EOF

if [ $? -ne 0 ]; then
    echo "Erreur : Échec de la configuration de la base de données."
    exit 1 
fi

echo "Configuration de la base de données réussie."
