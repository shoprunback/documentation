# Gestion des retours

## Catalogue

Le [catalogue](https://dashboard.shoprunback.com/products) regroupe tous vos produits et marques.

Pour qu'un produit puisse être retourné, celui-ci **doit être présent** dans votre catalogue pour que votre client puisse facilement identifier les articles qu'il souhaite renvoyer.
Afin de générer une meilleure expérience pour votre client et pour faciliter le tri et le renvoi des articles, il est important de spécifier le maximum d'informations sur vos produits.

## Commandes

Pour créer un retour, il faut d'abord créer la [commande](https://dashboard.shoprunback.com/orders) à retourner.

Lors de la création de la commande, vous renseignez les informations sur votre client (numéro de commande, contact et adresse) ainsi que la liste des [produits](#catalogue) retournables qu'il a acheté.

## Logistique

### Pays

ShopRunBack est présent dans de nombreux pays. Par conséquent, il faut que vous indiquiez [quels pays sont éligibles au retour](https://dashboard.shoprunback.com/configuration/countries) afin d'optimiser la logistique de vos retours.

### Relocalisation

Pour vous renvoyer vos colis, nous avons besoin de savoir où vous stockez votre inventaire. Cette [adresse](https://dashboard.shoprunback.com/warehouses) peut correspondre à un entrepôt, un magasin, ou autre.

Si vous possédez plusieurs entrepôts, ShopRunBack vous laisse définir des [règles de tri](https://dashboard.shoprunback.com/relocations) auxquelles les produits retournés seront soumis. Ces règles peuvent dépendre du [pays](#pays) du client, de la [raison](#motifs-de-retour) du retour, ou des deux.

Ces règles vous permettent de vous adapter aux différentes politiques de retour dans les [pays](#pays) où vous vendez.

Par exemple, si vous possédez deux entrepôts en Angleterre, vous pouvez décider de renvoyer les articles endommagés vers l'un, et le reste vers l'autre.

![Exemple de relocalisation](images/dashboard/relocations.png)

## La demande de retour

Après avoir enregistré une [commande](#commandes) sur ShopRunBack, vous pouvez créer son retour. Vous disposez alors d'un lien à envoyer à votre client afin qu'il puisse remplir sa demande.

En plus du dashboard, ShopRunBack vous fournit une interface de retour pour vos clients. Cette interface est à votre image, **il est donc important d'ajouter le logo de votre entreprise** via l'édition de vos informations d'entreprise.

![Parcours retour](images/dashboard/return_web.png)

[Voir une démo du parcours](https://dashboard-mocker.herokuapp.com/random)

### Motifs de retour

En fonction du type de produit que vous commercialisez, les raisons pour lesquelles vous recevez des retours peuvent différer. En sélectionnant les [motifs de retour](https://dashboard.shoprunback.com/configuration/reasons) qui vous correspondent, vous ajoutez plus de précision à votre politique retour, comme par exemple refuser les retours qui ont pour motif ``Changement d'avis``.

## Sponsoring

Avec le [sponsoring](https://dashboard.shoprunback.com/sponsorings), vous pouvez créer votre politique de retour en fonction des [pays](#pays) où vous opérez et des [raisons](#motifs-de-retour) pour lesquelles vos clients veulent retourner leurs [produits](#catalogue).

Le sponsoring vous permet de répondre à ces types de scénarios :

- **Le retour est gratuit** : Vous payez 100% du retour.
- **Le retour est à 5€** : Vous payez 100% du retour et le client doit payer au minimum 5€.
- **Le retour est payant mais vous participez à hauteur de 8€** : Vous payez 100% du retour avec un maximum 8€.
- **Le retour est payant sauf pour les produits endommagés** : Vous payez 100% du retour pour le motif ``endommagé``.

Pour chaque cas d'utilisation, vous pouvez établir avec précision votre participation financière et la part payée par votre client.

Dans le cas où vous configurez un montant maximum pour vous **et** votre client, et que le retour coûte plus que la somme des maximums, vous devrez prendre en charge le reste à payer (exemple: pour un retour qui coûte 25€, avec des maximums à 10€ pour les deux partis, vous devrez prendre en charge les 5€ restants).

## Suivi des retours

### Notifications

Le système de notifications vous permet d'envoyer des e-mails quand un retour est créé ou que son statut est mis à jour.

Il y a deux types de destinataires :

- Vos clients : Ils recevront un e-mail à l'enregistrement du retour, sa mise en transit et sa redistribution.

![E-mail de notification client](images/dashboard/notification-customer.png)

- Les [managers](#collaboration) de votre équipe : Ils recevront un e-mail à chaque enregistrement d'un nouveau retour.

![E-mail de notification manager](images/dashboard/notification-retailer.png)

### Statuts

Les [retours](https://dashboard.shoprunback.com/shipbacks) ont des statuts correspondant à leur état d'avancement logistique. Ce statut est mis à jour plusieurs fois durant leur acheminement jusqu'à votre [entrepôt](#relocalisation).

Tous les retours passent par ces statuts :

- **Créé** : Vous avez créé le retour.
- **Enregistrement** : Votre client a visité au moins une fois l'interface de retour.
- **Enregistré** : Votre client a validé sa demande de retour.
- **Livraison** : Le retour est en cours de livraison vers notre centre de traitement.
- **Livré** : Le retour a été reçu dans notre centre de traitement.
- **Identifié** : Le retour a été vérifié par nos partenaires.
- **Relocalisation** : Le retour est en cours de livraison vers votre [entrepôt](#relocalisation).
- **Relocalisé** : Le retour a été reçu dans votre [entrepôt](#relocalisation).

Vous pouvez suivre l'évolution de chaque retour via un visuel affichant leur état d'avancement.

![Historique du retour](images/dashboard/timeline.png)

## Rapport visuel des données

Le [rapport visuel](https://dashboard.shoprunback.com) vous permet d'analyser et comprendre vos problématiques retour. Avec le graphique, vous pouvez voir l'évolution du nombre de commandes renvoyées, avec la possibilité de trier par période et par pays. Les classements vous montrent plus précisément quels pays, modes de retour et produits sont les plus utilisés.

![Exemple de graphique](images/dashboard/graph.png)
