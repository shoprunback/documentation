# Gestion des retours

## Catalogue

Le [catalogue](https://dashboard.shoprunback.com/products) regroupe tous vos produits et marques.

Pour qu'un produit puisse être retourné, celui-ci **doit être présent** dans votre catalogue pour votre client puisse facilement identifier les articles qu'il souhaite renvoyer.
Afin de générer une meilleure expérience pour votre client et pour faciliter le tri et le renvoi des articles, il est important de spécifier le maximum d'informations sur vos produits .

## Commandes

Pour créer un retour, il faut d'abord créer la [commande](https://dashboard.shoprunback.com/orders) à retourner.

Lors de la création de la commande, vous renseignez les informations sur votre client (numéro de commande, contact et adresse) ainsi que la liste des [produits](#catalogue) retournables qu'il a acheté.

## Logistique

### Pays

ShopRunBack est présent dans de nombreux pays. Par conséquent, il faut que vous indiquiez vos [pays où les retour sont possibles](https://dashboard.shoprunback.com/configuration/countries) afin d'optimiser la logistique de vos retours.

### Relocalisation

Pour vous renvoyer vos colis, nous avons besoin de savoir où vous stockez votre inventaire. Cette [adresse](https://dashboard.shoprunback.com/warehouses) peut correspondre à un entrepôt, un magasin, ou autre.

Si vous possédez plusieurs entrepôts, ShopRunBack vous laisse définir des [règles de tri](https://dashboard.shoprunback.com/relocations) auxquelles les produits retournés seront soumis. Ces règles peuvent dépendre du [pays](#pays) du client, de la [raison](#motifs) du retour, ou des deux.

Ces règles vous permettent de vous adapter aux différentes politiques de retour dans les [pays](#pays) où vous vendez.

Par exemple, si vous possédez deux entrepôts en Angleterre, vous pouvez décider de renvoyer les articles endommagés vers l'un, et le reste vers l'autre.

![Exemple de relocalisation](images/dashboard/relocations.png)

## La demande de retour

Après avoir enregistré une [commande](#commandes) sur ShopRunBack, vous pouvez créer son retour. Vous disposez alors d'un lien à envoyer à votre client afin qu'il puisse remplir sa demande.

En plus du dashboard, ShopRunBack vous fournit une interface de retour pour vos clients. Cette interface est à votre image, **il est donc important d'ajouter le logo de votre entreprise** via l'édition de vos informations d'entreprise.

![Parcours retour](images/dashboard/return_web.png)

[Voir une démo du parcours](https://dashboard-mocker.herokuapp.com/random)

### Motifs

En fonction de votre secteur d'activité, les raisons pour lesquelles vous recevez des retours peuvent différer. En sélectionnant les [motifs de retour](https://dashboard.shoprunback.com/configuration/reasons) qui vous intéressent, vous pourrez ajouter plus de précision à votre politique retour, comme par exemple [faire des retours gratuis](#sponsoring) pour le motif *endommagé*.

## Sponsoring

Avec le [sponsoring](https://dashboard.shoprunback.com/sponsorings), vous pouvez créer votre politique de retour en fonction des [pays](#pays) où vous opérez et des [raisons](#motifs) pour lesquelles vos clients veulent retourner leurs [produits](#catalogue). Cela vous permet de mieux accompagner vos clients, améliorant votre service après-vente.

Pour chaque cas, vous pouvez établir avec précision votre participation financière et la part payée par votre client.

Le sponsoring vous permet de répondre à ces scénarios :

- **Le client ne paye pas le retour** : Vous payez 100% du retour.
- **Le client paye 5€ pour son retour** : Vous payez 100% du retour et le client doit payer au minimum 5€.
- **Le client paye le retour et vous participez à hauteur de 8€** : Vous payez 100% du retour avec un maximum 8€.
- **Vous payez 50% du retour, mais pas plus de 6€50** : Vous payez 50% du retour avec un maximum de 6€50.
- **Vous payez 50% du retour, le client paye au maximum 10€ et vous payez au maximum 10€** : Vous payez 50% du retour avec un maximum de 10€ et le client doit payer au maximum 10€. Si le retour s'avère coûter plus que la somme des maximums (20€), vous devrez payer le montant restant (si le retour coûte 25€, vous devrez payer 15€).

## Suivi des retours

### Notifications

Activez les notifications de suivi pour tenir vos clients informés sur l'avancement de leur retour par e-mail. Vous pouvez de la même façon notifier vos [managers](#collaboration) à chaque fois qu'un retour est enregistré.

Exemple de notification :

|Client|Manager|
|:---:|:---:|
|![E-mail de notification client](images/dashboard/notification-customer.png)|![E-mail de notification manager](images/dashboard/notification-retailer.png)|

### Statuts

Nous affectons un statut aux [retours](https://dashboard.shoprunback.com/shipbacks) pour témoigner de leur avancement jusqu'à leur destination. Ceux-ci vous permettent de les trier pour vérifier l'avancement des retours en cours.

Vous pouvez suivre l'évolution de chaque retour via un visuel affichant leur état d'avancement.

![Historique du retour](images/dashboard/timeline.png)

## Statistiques

Les [statistiques](https://dashboard.shoprunback.com) vous permettent d'analyser et comprendre vos problèmatiques retour. Avec le graphique, vous pouvez voir l'évolution du nombre de commandes renvoyées, avec la possibilité de trier par période et par pays. Les classements vous montrent plus précisément quels pays, modes de retour et produits sont les plus utilisés.

![Exemple de graphique](images/dashboard/graph.png)
