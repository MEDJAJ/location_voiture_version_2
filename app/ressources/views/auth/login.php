
<?php
session_start();

require_once '../../../includes/config.php';
require_once '../../../includes/function.php';
require_once '../../../includes/classes/client.php';
require_once '../../../includes/classes/admin.php';

$message="";

if($_SERVER["REQUEST_METHOD"]=="POST"){
$email=trim($_POST['email']);
$password=trim($_POST['password']);

   if (
        !validation($email, "/^[^\s@]+@[^\s@]+\.[^\s@]+$/") ||
        !validation($password, "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/")
    ){
        $message="error";
    }else{

        $user=User::seConnecter($conn,$email,$password);
        if($user===true){
            $role=$_SESSION['role'];
            switch($role){
                case 'client': header('Location: ../client/categorie.php'); 
                break;
                case 'admin': header('Location: ../admin/Statistiques.php');
                 break;
            }
        }else{
            $message="error";
        }

    }

}
?>




<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>CarRental - Premium Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#137fec",
                        "dark-card": "#0f172a",
                    },
                    fontFamily: {
                        "display": ["Plus Jakarta Sans", "sans-serif"]
                    },
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
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }
        .input-focus-effect:focus {
            box-shadow: 0 0 0 4px rgba(19, 127, 236, 0.15);
        }
    </style>
</head>
<body class="font-display antialiased bg-slate-950">

<div class="relative min-h-screen flex items-center justify-center p-4">
    <div class="fixed inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?auto=format&fit=crop&q=80&w=1920" 
             class="w-full h-full object-cover" alt="Car background">
        <div class="absolute inset-0 bg-slate-950/70 backdrop-blur-[2px]"></div>
        <div class="absolute inset-0 bg-gradient-to-br from-primary/20 via-transparent to-slate-950/80"></div>
    </div>

    <div class="relative z-10 w-full max-w-[480px] animate-float">
        <div class="flex justify-center mb-6">
            <div class="inline-flex items-center gap-3 bg-white/10 backdrop-blur-md px-6 py-3 rounded-2xl border border-white/20">
                <div class="p-2 bg-primary rounded-lg shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <span class="text-xl font-extrabold tracking-tight text-white">CarRental</span>
            </div>
        </div>

        <div class="glass-effect dark:bg-dark-card/95 shadow-[0_25px_50px_-12px_rgba(0,0,0,0.5)] rounded-[2.5rem] overflow-hidden border border-white/30">
            <div class="p-8 sm:p-12">
                <div class="mb-10 text-center sm:text-left">
                    <h1 class="text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight">Ravi de vous revoir</h1>
                    <p class="text-slate-500 dark:text-slate-400 mt-3 font-medium">Accédez à votre garage privé.</p>
                </div>

                <form action="#" class="space-y-6" method="POST">
                    <div class="space-y-2">
                        <label class="text-[11px] font-black uppercase tracking-[0.15em] text-slate-400 ml-1">Adresse Email</label>
                        <input type="email" name="email"
                               class="w-full px-5 py-4 rounded-2xl border-2 border-slate-100 bg-white/50 dark:bg-slate-800/50 dark:text-white focus:border-primary focus:bg-white transition-all outline-none input-focus-effect font-medium" 
                               placeholder="john@example.com" required>
                    </div>

                    <div class="space-y-2">
                        <div class="flex justify-between items-center ml-1">
                            <label class="text-[11px] font-black uppercase tracking-[0.15em] text-slate-400">Mot de passe</label>
                            <a href="#" class="text-xs font-bold text-primary hover:text-blue-700 transition-colors">Oublié ?</a>
                        </div>
                        <div class="relative">
                            <input type="password"  name="password"
                                   class="w-full px-5 py-4 rounded-2xl border-2 border-slate-100 bg-white/50 dark:bg-slate-800/50 dark:text-white focus:border-primary focus:bg-white transition-all outline-none input-focus-effect font-medium" 
                                   placeholder="••••••••" required>
                            <button type="button" class="absolute right-5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-primary transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </button>
                        </div>
                    </div>

                    <?php  if($message=="error"){
 ?>

<button type="submit" 
                            class="group relative w-full overflow-hidden rounded-2xl bg-red-600 px-8 py-5 font-bold text-white shadow-2xl shadow-primary/30 transition-all hover:scale-[1.02] active:scale-95">
                        <div class="absolute inset-0 flex h-full w-full justify-center [transform:skew(-12deg)_translateX(-100%)] group-hover:duration-1000 group-hover:[transform:skew(-12deg)_translateX(100%)]">
                            <div class="relative h-full w-10 bg-white/20"></div>
                        </div>
                        <span class="relative flex items-center justify-center gap-2 text-lg">
                            Se connecter <i class="fas fa-chevron-right text-sm"></i>
                        </span>
                    </button>

<?php    }else{

 ?>
  <button type="submit" 
                            class="group relative w-full overflow-hidden rounded-2xl bg-primary px-8 py-5 font-bold text-white shadow-2xl shadow-primary/30 transition-all hover:scale-[1.02] active:scale-95">
                        <div class="absolute inset-0 flex h-full w-full justify-center [transform:skew(-12deg)_translateX(-100%)] group-hover:duration-1000 group-hover:[transform:skew(-12deg)_translateX(100%)]">
                            <div class="relative h-full w-10 bg-white/20"></div>
                        </div>
                        <span class="relative flex items-center justify-center gap-2 text-lg">
                            Se connecter <i class="fas fa-chevron-right text-sm"></i>
                        </span>
                    </button>

<?php }  ?>

                    
                </form>

                <div class="mt-10 pt-8 border-t border-slate-200/60 dark:border-slate-700 text-center font-medium">
                    <p class="text-slate-500 dark:text-slate-400">
                        Nouveau conducteur ? 
                        <a href="register.php" class="text-primary font-extrabold hover:text-blue-700 underline-offset-4 hover:underline ml-1">Créer un compte</a>
                    </p>
                </div>
            </div>
        </div>
        
        <p class="text-center text-white/30 text-[10px] mt-8 font-bold uppercase tracking-[0.2em]">
            Accès sécurisé haute performance — CarRental Pro
        </p>
    </div>
</div>

</body>
</html>