<?php

namespace App\View;

final class LegalNotice extends Component
{
    public function render(): string
    {
        return <<<HTML
        <div class="legal_notice">
            <h2>Mentions Légales</h2>
            <h3>Editeurs</h3>
            <ul>
                <li>BAYEUX Tristan</li>
                <li>CHARDONNET Kyle</li>
                <li>GAYDON Mathieu</li>
                <li>LIU Wanfu</li>
            </ul>
            <p>Adresse de contact : project.sae708@gmail.com</p>
            <h3>Hébergement</h3>
            <ul>
                <li>Alwaysdata (https://www.alwaysdata.fr)</li>
                <li>SARL au capital de 200 000 €</li>
                <li>492 893 490 R.C.S. Paris</li>
                <li>Code APE 6311Z</li>
                <li>N° TVA : FR66492893490</li>
                <li>Siège social : 91 RUE DU FAUBOURG SAINT-HONORE - 75008 PARIS - France</li>
            </ul>
            <h3>Données personnelles</h3>
            <ul>
                <li>Les données personnelles collectées sur ce site sont traitées sous la responsabilité des étudiants concepteurs du projet dans le cadre du projet académique du BUT Informatique de l'IUT d'Aix-Marseille Université.</li>
                <li>Dans le cadre de l'utilisation du site, nous pouvons être amenés à collecter et traiter les données suivantes : Formulaire d'inscription / Connexion : Nom, prénom, adresse e-mail, mot de passe. Numéro de téléphone pour l’authentification à double facteurs.</li>
                <li>Les données recueillies sont strictement nécessaires à la gestion des comptes utilisateurs et l’accès aux services du site.</li>
                <li>Les données collectées sont exclusivement destinées à l'équipe projet et à l'encadrement pédagogique. Aucune donnée personnelle n'est transmise, vendue ou cédée à des tiers à des fins commerciales.</li>
            </ul>
            <p>Conformément au Règlement Général sur la Protection des Données (RGPD) et à la loi « Informatique et Libertés », vous disposez des droits suivants concernant vos données :</p>
            <ul>
                <li>Droit d'accès : Obtenir la confirmation que vos données sont traitées et en obtenir une copie.</li>
                <li>Droit de rectification : Demander la correction de données inexactes ou incomplètes.</li>
                <li>Droit à l'effacement (« droit à l'oubli ») : Demander la suppression de vos données personnelles.</li>
                <li>Droit d'opposition : Vous opposer à tout moment au traitement de vos données.</li>
            </ul>
        </div>
        HTML;
    }
}