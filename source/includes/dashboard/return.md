# Gestion des retours

## Catalogue

Le catalogue regroupe tous vos produits et marques.

Pour qu'un produit puisse être retourné, celui-ci **doit être présent** dans votre catalogue pour que nous puissions identifier les articles qu'a commandé votre client.

[Accéder à mon catalogue](https://dashboard.shoprunback.com/products)

## Commandes

Pour créer un retour, il faut d'abord créer la [commande](https://dashboard.shoprunback.com/orders) à retourner.

C'est lors de la création de la commande que sera indiqué qui est le client et quels articles il a acheté. Vous devez lister tous les articles de la commande, car il voudra potentiellement tous les retourner.

## Logistique

### Pays de vente

ShopRunBack est présent dans de nombreux pays. Par conséquent, il faut que vous indiquiez vos [pays de vente](https://dashboard.shoprunback.com/configuration/countries) afin d'optimiser la logistique de vos retours.

### Entrepôts

Pour vous livrer vos retours, nous avons besoin de savoir où se trouve votre [entrepôt](https://dashboard.shoprunback.com/warehouses). Vous pouvez aussi renseigner l'adresse de votre magasin.

Vous avez la possibilité d'ajouter plusieurs adresses.

### Relocalisation

Si vous possédez plusieurs [entrepôts](#entrep-ts), ShopRunBack vous laisse définir des [règles de tri](https://dashboard.shoprunback.com/relocations) auxquelles les produits retournés seront soumis. Ces règles peuvent dépendre du [pays](#pays-de-vente) du client, de la [raison](#motifs) du retour, ou des deux.

Ces règles vous permettent de vous adapter aux différentes politiques de retour dans les [pays](#pays-de-vente) où vous vendez.

Par exemple, si vous possédez un entrepôt en Angleterre, vous pouvez décider de renvoyer les articles de ce pays vers celui-ci. Cela diminuera vos coûts logistiques, qui à terme vous permettra de fournir de meilleurs prix à vos clients.

![Exemple de relocalisation](images/dashboard/relocations.png)

## La demande de retour

Après avoir enregistré une [commande](#commandes) sur ShopRunBack, vous pouvez créer son retour. Vous disposez alors d'un lien à envoyer à votre client afin qu'il puisse remplir sa demande.

En plus du dashboard, ShopRunBack vous fournit une interface de retour pour vos clients. Cette interface est à votre image, **il est donc important d'ajouter le logo de votre entreprise** dans "Mon entreprise".

![Parcours retour](images/dashboard/return_web.png)

[Voir une démo du parcours](https://dashboard-mocker.herokuapp.com/random)

### Motifs

En fonction de votre secteur d'activité, les raisons pour lesquelles vous recevez des retours peuvent différer. En sélectionnant les [motifs de retour](https://dashboard.shoprunback.com/configuration/reasons) qui vous intéressent le plus, vous pourrez faciliter votre [politique de relocalisation](#relocalisation).

## Sponsoring

Avec le [sponsoring](https://dashboard.shoprunback.com/sponsorings), vous pouvez créer votre politique de retour en fonction des [pays](#pays-de-vente) où vous opérez et des [raisons](#motifs) pour lesquelles vos clients veulent retourner leurs [produits](#catalogue). Cela vous permet de mieux accompagner vos clients, améliorant votre service après-vente.

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

![E-mail de notification](images/dashboard/notification-customer.png)

### Statuts

Nous affectons un statut aux [retours](https://dashboard.shoprunback.com/shipbacks) pour témoigner de leur avancement jusqu'à leur destination. Ceux-ci vous permettent de les trier pour vérifier l'avancement des retours en cours.

Vous pouvez suivre l'évolution de chaque retour via un visuel affichant leur état d'avancement.

![Historique du retour](images/dashboard/timeline.png)

## Statistiques

Les [statistiques](https://dashboard.shoprunback.com) vous permettent d'analyser et comprendre vos problèmatiques retour. Avec le graphique, vous pouvez voir l'évolution du nombre de commandes renvoyées, avec la possibilité de trier par période et par pays. Les classements vous montrent plus précisément quels pays, modes de retour et produits sont les plus utilisés.

![Exemple de graphique](images/dashboard/graph.png)
