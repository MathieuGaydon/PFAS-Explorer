<?php

use App\View\Layout;
use App\View\LegalNotice;

echo new Layout(title: 'PFAS-Explorer - Mentions Légales', description: 'Mentions Légales du site PFAS-Explorer.', enfants: [new LegalNotice()], utilisateurs: $utilisateurs ?? null, smTitle: 'PFAS-Explorer - Mentions Légales', smDescription: 'Mentions Légales du site PFAS-Explorer.', smImage: 'http://localhost:8000/_assets/images/Logo_PFAS.webp', smUrl: 'http://localhost:8000/legalnotice');