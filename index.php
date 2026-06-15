pharmafefo/
├── config/
│   ├── database.php
│   └── environment.php      # Gestion des variables d'environnement 
├── public/
│   ├── css/
│   ├── js/
│   │   ├── app.js           # Gestion globale (Sécurité, déconnexion)
│   │   └── dashboard.js     # Logique Fetch API 
│   └── index.php            # Routeur mis à jour (aiguille vers Web ou API)
├── src/
│   ├── Controller/
│   │   ├── Web/             # CONTROLEURS TRADITIONNELS (Retournent du HTML)
│   │   │   ├── AuthController.php
│   │   │   └── AdminController.php
│   │   └── Api/             # CONTROLEURS API (Retournent du JSON uniquement)
│   │       ├── ApiDashboardController.php
│   │       └── ApiStockController.php
│   ├── Entity/
│   ├── Enum/
│   ├── Service/             # NOUVEAU : Services  (partie logique)
│   │   ├── AuthService.php  # Logique de vérification des sessions et rôles
│   │   └── StockService.php # Logique métier de calcul des stocks
│   └── Repository/
└── templates/               # Contient uniquement les squelettes HTML initiaux
    ├── auth/
    │   └── login.php
    └── admin/
        └── dashboard.php