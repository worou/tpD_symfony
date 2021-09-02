<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Product;
use App\Entity\Category;
use App\Repository\UserRepository;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    private $repoUser;
    private $repoCat;
    private $repoProd;
    public function __construct(UserRepository $repoUser, CategoryRepository $repoCat, ProductRepository $repoProd)
    {
        $this->repoUser = $repoUser;
        $this->repoCat = $repoCat;
        $this->repoProd = $repoProd;
    }
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        // $repo = $this->getDoctrine()->getRepository(User::class);
        // $users = $repo->findAll();
        // $nbUsers = count($users);
        //return parent::index();
        return $this->render('bundles/EasyAdminBundle/welcome.html.twig',[
            // 'nbUsers'=>$nbUsers
            'nbUsers' => count($this->repoUser->findAll()),
            'nbCats' => count($this->repoCat->findAll()),
            'nbProds' => $this->repoProd->findAll()
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Mon Site');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Tableau de bord', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Catégorie', 'fas fa-list', Category::class);
        yield MenuItem::linkToCrud('Produit', 'fas fa-list', Product::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
