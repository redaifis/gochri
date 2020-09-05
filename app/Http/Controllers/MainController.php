<?php

namespace App\Http\Controllers;

use SEO;

class MainController extends Controller
{
    public function index(){
        SEO::setTitle('Gochri - Page principal');
        SEO::setDescription('Faites vos Courses sur Gochri.com et retrouvez des milliers de produits au meilleur prix dans vos Magasins, en retrait Drive ou en Livraison à Domicile.');

        return view('app.landingPage');
    }

    public function about(){
        SEO::setTitle('Gochri - À propos de nous');
        SEO::setDescription('À propos de nous page pour Gochri.com .');

        return view('app.aboutPage');
    }

    public function contact(){
        SEO::setTitle('Gochri - Contactez nous');
        SEO::setDescription('Contactez nous page pour Gochri.com .');

        return view('app.contactPage');
    }

    public function privacyPolicy(){
        SEO::setTitle('Gochri - Politique de confidentialité');
        SEO::setDescription('Politique de confidentialité de Gochri.com .');
        return view('app.policyPage');
    }
}
