<?php

namespace Config\Routeur;
use App\Controller\AuthController;

class Routeur{
    public function Router(){   
        if(isset($_GET['page']) && !empty($_GET['page'])){
            switch($_GET['page']){
                case 'menu':
                    (new AuthController)->login();
                    break;
                case 'product':
                    (new ProductController)->index();
                    break;
                case 'product_show':
                    (new ProductController)->showOne();
                    break;
                case 'product_add':
                    (new ProductController)->createProduct();
                    break;
                case 'basket':
                    (new BasketController)->index();
                    break;
                default:
                    echo "Page not found";
            }
        }
    }
}

?>
