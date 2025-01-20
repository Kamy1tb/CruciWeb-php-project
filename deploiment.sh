#!/bin/bash

# Variables
PROJECT_ZIP="projet.zip"  # Nom du fichier zip du projet
DEPLOY_DIR="/var/www/html"  # Répertoire de déploiement
DB_SCRIPT="configure_database.sh"  # Nom du script de configuration de la BDD

# Vérification des droits root
if [ "$(id -u)" -ne 0 ]; then
    echo "Ce script doit être exécuté avec les droits root (sudo)."
    exit 1
fi

# Mise à jour des paquets
echo "Mise à jour des paquets..."
apt update

# Installation des dépendances nécessaires
echo "Installation de curl..."
apt install curl -y

echo "Installation de Composer..."
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/bin/composer

echo "Installation de zip..."
apt install zip -y

# Vérifier si le fichier zip existe
if [ ! -f "$PROJECT_ZIP" ]; then
    echo "Erreur : Le fichier $PROJECT_ZIP est introuvable."
    exit 1
fi

# Décompresser le fichier zip
echo "Décompression de $PROJECT_ZIP..."
unzip -o "$PROJECT_ZIP" -d temp_project

if [ $? -ne 0 ]; then
    echo "Erreur : Échec de la décompression de $PROJECT_ZIP."
    exit 1
fi
echo "Décompression réussie."

# Inclure les fichiers cachés dans le transfert
shopt -s dotglob

# Transférer le contenu dans /var/www/html
echo "Transfert du projet dans $DEPLOY_DIR..."
rm -rf "$DEPLOY_DIR/*"
mv temp_project/* "$DEPLOY_DIR"

if [ $? -ne 0 ]; then
    echo "Erreur : Échec du transfert du projet."
    exit 1
fi
echo "Transfert réussi."

# Nettoyer les fichiers temporaires
rm -rf temp_project

# Redémarrer Apache
echo "Redémarrage d'Apache..."
systemctl restart apache2

if [ $? -ne 0 ]; then
    echo "Erreur : Échec du redémarrage d'Apache."
    exit 1
fi
echo "Apache redémarré avec succès."

# Exécuter Composer dans le répertoire de déploiement
echo "Exécution de 'composer dump-autoload'..."
cd "$DEPLOY_DIR"
composer dump-autoload

if [ $? -ne 0 ]; then
    echo "Erreur : Échec de l'exécution de 'composer dump-autoload'."
    exit 1
fi
echo "Autoload de Composer généré avec succès."


echo "Déploiement terminé avec succès."
