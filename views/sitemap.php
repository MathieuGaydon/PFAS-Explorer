<?php
use App\View\Layout;
use App\View\SiteMap;

echo new Layout(
    title: 'PFAS-Explorer - Plan du site',
    description: 'Plan du site PFAS-Explorer.',
    enfants: [new SiteMap()],
    utilisateurs: $utilisateurs ?? null,
    smTitle: 'PFAS-Explorer - Plan du site',
    smDescription: 'Plan du site PFAS-Explorer.',
    smImage: 'http://localhost:8000/_assets/images/Logo_PFAS.webp',
    smUrl: 'http://localhost:8000/sitemap'
);