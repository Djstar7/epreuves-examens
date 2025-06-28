# 📘 Site-Epreuves-Examens

Plateforme web qui propose aux étudiants et élèves l’accès aux **anciens sujets d’examens officiels** (BEP, CAP, Probatoire, Baccalauréat, Concours, BTS) au Cameroun.

---

## 🚀 Fonctionnalités principales

- 🎓 Accès gratuit aux sujets classés par niveau et filière
- 🔎 Recherche rapide par matière, type d’examen ou année
- 📥 Téléchargement des épreuves en un clic
- 🧑‍🏫 Gestion des enseignants et administrateurs
- 💸 Système d’achat sécurisé via MTN/Orange Money
- 📊 Statistiques sur les téléchargements

---

## 🛠️ Technologies utilisées

- **Frontend** : Vue.js 3 + Tailwind CSS
- **Backend** : Laravel 12 (API REST)
- **Base de données** : MySQL
- **Paiement** : Intégration mobile money via CinetPay ou NotchPay

---

## 🔧 Installation en local

```bash
git clone git@github.com:Djstar7/epreuves-examens.git
cd epreuves-examens
cp .env.example .env
composer install
npm install && npm run dev
php artisan key:generate
php artisan migrate --seed
php artisan serve


💬 Contact

Développé par Stael DJUNE
📍 Mbouda, Cameroun
📧 infodjstar7@gmail.com
📞 +237 674 693 625
