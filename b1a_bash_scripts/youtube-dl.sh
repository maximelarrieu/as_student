#!/bin/sh

echo "Le téléchargement va démarrer..."
youtube-dl -x $1;
echo "Le téléchargement est terminé."

exit 0;
