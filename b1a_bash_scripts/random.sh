#!/bin/sh

nbrandom=($RANDOM % 1000);
nbplayer=0;
nbtenta=0;

echo $nbrandom;
echo -e "Bienvenue sur mon jeu!\nDevinez le nombre à trouver :)";
while [ $nbplayer -ne $nbrandom ]; do
    echo -n "Votre proposition : "; read nbplayer	
    if [ "$nbplayer" -lt $nbrandom ]; then
	echo "C'est plus grand !"
    elif [ "$nbplayer" -gt $nbrandom ]; then
	echo "C'est plus petit!"
    elif [ -z "$nbplayer" ] ; then
	echo "Veuillez entrer une valeur"
    fi
    nbtenta=$(($nbtenta + 1))
done

echo "Bravo!! Vous avez trouvé $nbrandom en $nbtenta coups !"
		 
exit 0;
