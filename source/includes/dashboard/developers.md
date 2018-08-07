# Pour vos développeurs

## API

Dans l'onglet "**API**", vous pouvez récupérer votre **API token**. Il sert à vous identifier lorsque vous exécutez des appels API, il est donc indispensable pour utiliser la plupart des appels de ShopRunBack. Pour apprendre à utiliser notre API, veuillez lire notre documentation [ici](https://shoprunback.github.io/documentation/api.html).

Dans l'onglet "**Logs**", vous pouvez voir tous les appels API qui ont été effectués. Vous pouvez afficher les détails de chaque appel en cliquant dessus.

## Webhooks

Un Webhook est un appel effectué automatiquement depuis un site vers une URL donnée lorsqu'un évènement se produit (nouveau produit créé, changement d'état d'un retour...).

Dans l'onglet "**Webhooks**", vous pouvez **modifier votre URL de webhooks** afin de recevoir les mises à jour de ShopRunBack et **voir la liste des webhooks qui ont été envoyés**.

Vous pouvez renvoyer les Webhooks qui n'ont pas été bien réceptionnés.

Les **webhooks ont un event et un body**. L'event est au format *élément.évènement* (ex: *collaborator.invited*, *product.created*...) et le body contient l'élément concerné.

Pour mieux comprendre la logique des différents éléments, veuillez lire la [documentation de notre API](https://shoprunback.github.io/documentation/api.html).

### Liste des webhooks

- collaborator
  - invited
  - created
- product
  - created
- relocation
  - created
- returned_item (les objets que le client veut renvoyer)
  - pending
  - transiting
  - relocated
  - error
  - missing
- shipback (une demande de retour)
  - created
  - registering
  - registered
  - delivering
  - delivered
  - identified
  - relocating
  - relocated
  - failed
  - closed
  - archived
- sponsoring (participation financière de l'entreprise pour les retours de ses clients)
  - created
- warehouse
  - created