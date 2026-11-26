# Document 0 – Guide général des TP 

**Cadre réglementaire, environnement de travail, logiciels, versions, règles de sécurité et modalités de compte rendu.**

### 0.1 – Présentation de la séquence pédagogique

> L'objectif de cette séquence est de faire évoluer une même application Flask, d'abord testée localement, puis conteneurisée et reliée à une base de données. Les étudiants observent ses pages HTML, ses réponses JSON et les communications entre ses composants, puis vérifient la segmentation réseau.

| TP | Thématique | Compétence principale |
| --- | --- | --- |
| TP1 | Service HTTP / Flask | Déployer un service réseau |
| TP2 | TCP / HTTP / OSI | Analyser les échanges réseau |
| TP3 | Docker | Conteneuriser une application |
| TP4 | Docker Compose | Orchestrer plusieurs services |
| TP5 | Réseaux Docker | Comprendre et vérifier la segmentation réseau |

Les cinq TP constituent une progression cumulative : chaque étape reprend l'application et les routes déjà étudiées, puis ajoute une notion sans retirer les fonctionnalités précédentes.

### 0.2 – Cadre réglementaire et éthique

> **Cadre d'usage :** Les manipulations d'analyse des communications réseau sont réalisées exclusivement à des fins pédagogiques, sur l'infrastructure fournie, dans un environnement local et isolé. Ces manipulations ne doivent jamais être effectuées sur un réseau ou un système informatique tiers sans autorisation explicite de son propriétaire. En France, les atteintes aux systèmes de traitement automatisé de données (STAD) sont notamment encadrées et réprimées par les articles 323-1 et suivants du Code pénal. L'objectif est de comprendre les communications dans l'environnement pédagogique.

Les règles suivantes doivent impérativement être respectées :

- Les manipulations sont exclusivement réalisées sur l'infrastructure pédagogique fournie.
- Vous ne devez jamais scanner ou tester un réseau extérieur à l'environnement pédagogique.
- Aucune tentative d'accès à un système tiers n'est autorisée.
- Toute modification de l'environnement doit rester maîtrisée et réversible.

> **Important :** le caractère pédagogique d'une manipulation ne constitue pas, à lui seul, une autorisation de la réaliser sur un système tiers.

### 0.3 – Environnement matériel et logiciel

Les logiciels et outils suivants sont utilisés au cours de la séquence :

| Logiciel / Outil | Utilisation |
| --- | --- |
| Python 3 | Développement de l'application Flask |
| Visual Studio Code | Édition du code et des fichiers de configuration |
| Navigateur web | Affichage des pages HTML et outils de développement réseau |
| Docker Engine | Exécution des conteneurs |
| Docker Desktop | Environnement Docker intégré, notamment sous Windows |
| Docker Compose | Orchestration des différents services |
| curl | Tests et requêtes HTTP |
| Wireshark | Analyse des communications réseau |
| tcpdump | Capture et analyse du trafic réseau |
| PostgreSQL | Système de gestion de base de données |
| psql | Client en ligne de commande pour PostgreSQL |

**Versions des logiciels :** les versions utilisées doivent être compatibles avec les consignes et les fichiers fournis pour les TP. Lorsqu'une version précise est imposée, celle-ci doit être respectée.

### 0.3.1 – Environnement d'exécution – Docker

L'environnement de référence (et recommandé) pour cette séquence de TP est une installation de Docker directement sur le poste de travail :

- **Sous Windows :** Docker Desktop, généralement configuré avec le moteur WSL 2.
- **Sous Linux :** Docker Engine et Docker Compose (plugin CLI).

**L'utilisation de Docker dans une machine virtuelle reste possible**, à condition de disposer d'un environnement compatible, correctement configuré et pleinement fonctionnel.

L'exécution de Docker dans une machine virtuelle peut nécessiter une configuration spécifique de l'hyperviseur, notamment lorsque la virtualisation imbriquée (_nested virtualization_) est nécessaire.

Il vous appartient de vérifier la compatibilité de votre environnement et de vous assurer de son bon fonctionnement avant de commencer les travaux pratiques.

**Attention :** les manipulations réseau (Wireshark, tcpdump, interfaces Docker, segmentation et communication entre conteneurs) peuvent présenter des différences selon le système d'exploitation, l'hyperviseur et le mode de configuration réseau de la machine virtuelle.

**Informations à inclure dans le compte rendu**

Vous devez préciser dans le compte rendu :

- Le système d'exploitation utilisé et sa version.
- La version de Docker.
- L'environnement utilisé : Docker Desktop ou Docker Engine.
- Le type de machine : physique ou virtuelle.
- Si vous utilisez une machine virtuelle :
  - le logiciel de virtualisation utilisé (VirtualBox, VMware, Hyper-V, etc.) ;
  - le mode de configuration réseau (NAT, pont/_bridged_, etc.).

### 0.4 – Organisation des TP

- Lire les consignes avant de commencer.
- Vérifier les résultats obtenus avant de passer à l'étape suivante.
- Reprendre le projet du TP précédent et conserver ses routes ; les nouvelles pages HTML et réponses JSON doivent rester accessibles.
- Analyser les résultats et signaler toute différence avec les résultats attendus.
- Conserver les captures d'écran utiles à la compréhension des manipulations.
- Ne pas se limiter à copier-coller les commandes : comprendre leur rôle et leur fonctionnement.
- Répondre aux questions en apportant des explications techniques précises.

### 0.5 – Consignes pour les comptes rendus

Le compte rendu doit permettre de comprendre les manipulations réalisées, de suivre la démarche adoptée et de vérifier les compétences acquises.

Pour chaque TP, vous devez sélectionner les éléments pertinents parmi les catégories suivantes :

1. Objectifs et contexte technique.
2. Manipulations et configurations significatives.
3. Commandes exécutées et résultats obtenus.
4. Captures d'écran, extraits de configuration et schémas.
5. Analyse et interprétation des résultats.
6. Réponses aux questions de synthèse.

Toutes ces catégories ne nécessitent pas obligatoirement une rubrique distincte dans le dossier. Les éléments doivent être organisés de manière cohérente et permettre de suivre votre démarche.

> **Remarque :** une capture d'écran ne constitue pas une explication. Vous devez commenter ce que vous observez et expliquer pourquoi vous obtenez ce résultat. Les illustrations doivent être lisibles, pertinentes et accompagnées d'un commentaire explicatif.

Les modalités détaillées de rédaction, les illustrations attendues et les critères d'évaluation sont précisés dans le document « COMPTE_RENDU.md ».
