# Comment utiliser le Dashboard ShopRunBack

## Produits

Vous pouvez accéder à vos produits en allant sur la page **Catalogue**

![Menu latéral](images/dashboard/catalog_sidebar.png)

En arrivant sur la page **Mes produits**, vous pouvez voir la liste de tous vos produits. Vous pouvez filtrer cette liste par libbelé, par référence, par EAN, ou par marque.

[Comment utiliser les produits ?](#mes-produits)

## Commandes

En arrivant sur la page **Mes commandes**, vous pouvez voir la liste de toutes vos commandes, ainsi qu'un lien pour accèder facilement au retour correspondant. Vous pouvez également filtrer via la date, le numéro de commande ou le nom du client.

### Création de commande

Pour pouvoir créer un retour, il faut d'abord avoir une commande à retourner. Une commande possède des articles qui correspondent aux produits ajoutés sur votre dashboard.

Pour créer une commande, il vous suffit d'aller sur la page **Mes commandes** et cliquer sur le bouton **+ Nouvelle commande**.

Chaque commande est définie par 2 attributs obligatoires :

- Le numéro de commande
- Le client

Chaque client est unique à la commande, vous devrez donc renseigner le champ client à chaque fois. Celui-ci correspond à :

- Le prénom
- L'email
- L'adresse complète (adresse, code postal, ville, pays).

Vous pouvez également renseigner d'autres champs tels que son nom de famille, numéro de téléphone, complément d'adresse ou des tags (exemple: Pendant la période des soldes, vous pouvez ajouter le tag `Soldes` sur vos commandes pour les retrouver plus facilement).

![Ajouter commande](images/dashboard/add_order.png)

Une fois la commande créée, vous pouvez rajouter des articles.

![Ajouter article](images/dashboard/add_item.png)

<aside class="warning">
  Attention: Une fois qu'un produit est commandé, vous ne pourrez plus le supprimer.
</aside>

À partir du moment où vous avez ajouté un article, une nouvelle action est possible : Créer le retour.

![Créer retour](images/dashboard/create_return.png)

<aside class="warning">
  Attention: Une fois le retour créé, vous ne pourrez plus supprimer la commande.
</aside>

## Retours

En arrivant sur la page, vous pouvez voir le résumé de tous vos retours créés sur ShopRunBack, vous avez la possibilité de les filtrer par état, ainsi que de chercher via le numéro de commande ou le mode.

### Le retour

Après avoir créé votre premier retour, vous serez redirigé vers sa page.

Sur cette page, vous trouverez un lien à donner à votre client pour effectuer son retour.

![Détail retour](images/dashboard/shipback_detail.png)

Toujours sur le retour, vous avez plusieurs onglets qui permettent de suivre le retour fait par votre client :

- *L'historique du retour*, avec les différents états du retour. Sur cette page vous trouverez également le lien partageable du retour.
- *Détails* vous permet de récupérer le bon de retour et le label une fois que le client a payé. Si le client ne les sauvegarde pas, vous pourrez toujours lui redonner les liens correspondants.
- *Client* regroupe les informations que vous avez renseignées sur le client.
- *Articles* regroupe les articles retournés par votre client avec leur motif de retour respectif.
- *Notifications* vous permet de voir les notifications qui sont envoyées au client. Vous avez la possibilité de choisir quelles notifications seront envoyées via vos paramètres de configuration (voir [Notifications](#notifications))

Les autres onglets vous permettent de voir plus d'informations sur votre retour, comme les modes de retours disponibles (Simulation d'itinéraires), l'historique des appels API (Logs appels API , voir [API](#api)).

![Actions retour](images/dashboard/shipback_actions.png)

Vous avez également la possibilité de re-générer le bon de retour ou de l'archiver.

<aside class="warning">
  Attention: Une fois le retour archivé, vous pouvez toujours le consulter, mais pas le modifier.
</aside>

## Statistiques

La page d'accueil du dashboard rassemble des statistiques sur vos retours. Vous pouvez également y accéder en cliquant sur **Tableau de bord** dans le menu de gauche.

La page est divisée en deux :

- Un graphique dynamique triable par période.

![Graphique de statistiques](images/dashboard/analytics_graph.png)

- Des classements tels que les pays où vous avez le plus de retours, les moyens de retours les plus utilisés etc.

![Classements des statistiques](images/dashboard/analytics_tops.png)
