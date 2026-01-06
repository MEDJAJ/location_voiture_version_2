
<?php
require_once '../../../includes/config.php';
require_once '../../../includes/function.php';
require_once '../../../includes/classes/client.php';



$message="";

if($_SERVER["REQUEST_METHOD"]=="POST"){
$nom=trim($_POST['nom']);
$prenom=trim($_POST['prenom']);
$email=trim($_POST['email']);
$password=trim($_POST['password']);

   if (
        !validation($nom, "/^[a-zA-ZÀ-ÿ\s]{2,50}$/") ||
          !validation($prenom, "/^[a-zA-ZÀ-ÿ\s]{2,50}$/") ||
        !validation($email, "/^[^\s@]+@[^\s@]+\.[^\s@]+$/") ||
        !validation($password, "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/") 
        
    ){
        $message="error";
    }else{

        $password_hash=password_hash($password,PASSWORD_DEFAULT);

        $client=new Client(
            $nom,
            $prenom,
            $email,
            $password_hash,
            'client'
        );

        if($client->register($conn)){
            $message="sucess";
        }else{
            $message="error";
        }

    }
    
}


?>







<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Premium Membership - CarRental</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: { 
                        "primary": "#137fec",
                        "luxury": "#0f172a"
                    },
                    fontFamily: { "display": ["Plus Jakarta Sans", "sans-serif"] },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' },
                        }
                    }
                },
            },
        }
    </script>
    <style>
        .glass-effect {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }
        .input-focus-effect:focus {
            box-shadow: 0 0 0 4px rgba(19, 127, 236, 0.15);
        }
    </style>
</head>
<body class="font-display antialiased bg-slate-950 overflow-x-hidden">

<div class="relative min-h-screen w-full flex items-center justify-center p-4 ">
    <div class="fixed inset-0 z-0 ">
        <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&q=80&w=1920" 
             class="w-full h-full object-cover scale-105" alt="Luxury car background">
        <div class="absolute inset-0 bg-slate-950/60 backdrop-blur-[1px]"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent"></div>
    </div>

    <div class="relative z-10 w-full max-w-[520px] animate-float">
        <div class="glass-effect dark:bg-slate-900/90 shadow-[0_20px_50px_rgba(0,0,0,0.3)] rounded-[2.5rem] overflow-hidden border border-white/30">
            
            <div class="p-8 sm:p-12">
                <div class="text-center mb-10">
                    <div class="relative inline-flex mb-6">
                        <div class="absolute inset-0 bg-primary/40 blur-2xl rounded-full"></div>
                        <?php
if($message=='error'){


                        ?>
                        <div class="relative inline-flex items-center justify-center size-16 bg-red-600 rounded-2xl shadow-xl shadow-primary/40 transform rotate-3 hover:rotate-0 transition-transform duration-300">
                            <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </div>
                    <?php  }elseif($message=="sucess"){ 
                    ?>
<div class="relative inline-flex items-center justify-center size-16 bg-green-600 rounded-2xl shadow-xl shadow-primary/40 transform rotate-3 hover:rotate-0 transition-transform duration-300">
                            <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </div>
                    <?php }else{

                    ?>
<div class="relative inline-flex items-center justify-center size-16 bg-blue-600 rounded-2xl shadow-xl shadow-primary/40 transform rotate-3 hover:rotate-0 transition-transform duration-300">
                            <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </div>
                    <?php   }  ?>
                    </div>
                    <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight sm:text-4xl">
                        Rejoignez le <span class="text-primary">Cercle</span>
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400 mt-3 font-medium text-lg leading-relaxed">
                        Accédez à une flotte d'exception en quelques secondes.
                    </p>
                </div>

                <form action="#" class="space-y-5" method="POST">
                    <div class="grid grid-cols-2 gap-5">
                        <div class="space-y-2">
                            <label class="text-[11px] font-black uppercase tracking-[0.15em] text-slate-400 ml-1">Prénom</label>
                            <input type="text" placeholder="Ex: John"  name="prenom" 
                                   class="w-full px-5 py-4 rounded-2xl border-2 border-slate-100/50 bg-white/50 dark:bg-slate-800/50 dark:text-white focus:border-primary focus:bg-white transition-all outline-none input-focus-effect font-medium">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[11px] font-black uppercase tracking-[0.15em] text-slate-400 ml-1">Nom</label>
                            <input type="text" placeholder="Ex: Doe"   name="nom" 
                                   class="w-full px-5 py-4 rounded-2xl border-2 border-slate-100/50 bg-white/50 dark:bg-slate-800/50 dark:text-white focus:border-primary focus:bg-white transition-all outline-none input-focus-effect font-medium">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[11px] font-black uppercase tracking-[0.15em] text-slate-400 ml-1">Adresse Email</label>
                        <div class="relative group">
                            <input type="email" placeholder="nom@exemple.com"  name="email" 
                                   class="w-full px-5 py-4 rounded-2xl border-2 border-slate-100/50 bg-white/50 dark:bg-slate-800/50 dark:text-white focus:border-primary focus:bg-white transition-all outline-none input-focus-effect font-medium">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[11px] font-black uppercase tracking-[0.15em] text-slate-400 ml-1">Mot de passe sécurisé</label>
                        <input type="password" placeholder="••••••••••••"  name="password" 
                               class="w-full px-5 py-4 rounded-2xl border-2 border-slate-100/50 bg-white/50 dark:bg-slate-800/50 dark:text-white focus:border-primary focus:bg-white transition-all outline-none input-focus-effect font-medium">
                    </div>

                    <button type="submit" class="group relative w-full mt-4 overflow-hidden rounded-2xl bg-primary px-8 py-5 font-bold text-white shadow-2xl shadow-primary/30 transition-all hover:scale-[1.02] active:scale-95">
                        <div class="absolute inset-0 flex h-full w-full justify-center [transform:skew(-12deg)_translateX(-100%)] group-hover:duration-1000 group-hover:[transform:skew(-12deg)_translateX(100%)]">
                            <div class="relative h-full w-10 bg-white/20"></div>
                        </div>
                        <span class="relative flex items-center justify-center gap-2 text-lg">
                            Créer mon profil <i class="fas fa-arrow-right"></i>
                        </span>
                    </button>
                </form>

                <div class="mt-10 pt-8 border-t border-slate-200/60 dark:border-slate-700 text-center">
                    <p class="text-slate-500 dark:text-slate-400 font-medium">
                        Déjà parmi nous ? 
                        <a href="login.php" class="inline-flex items-center text-primary font-extrabold hover:text-blue-700 transition-colors ml-1">
                            Se connecter 
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <p class="text-center text-white/40 text-[10px] mt-6 uppercase tracking-widest font-bold">
            © 2025 CarRental Premium Experience — Sécurité SSL 256-bit
        </p>
    </div>
</div>

</body>
</html>