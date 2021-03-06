<?php

/*
 * Copyright (C) 2015  Mayflower GmbH
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 */

// -------------------------------
// RESOURCE IDENTIFIER = STRING
// -------------------------------

use Bepado\SDK\Struct\Order;

$aLang = array(
    'charset'                            => 'UTF-8',
    'SHOP_MODULE_sBepadoLocalEndpoint'   => 'Bepado apiEndpointUrl',
    'SHOP_MODULE_sBepadoApiKey'          => 'Bepado apiKey',
    'SHOP_MODULE_GROUP_main'             => 'Allgemeine Parameter',
    'SHOP_MODULE_sandboxMode'            => 'Modul im Sandbox-Modus',
    'MF_BEPADO_PURCHASE_GROUP_CHAR'      => 'Händlerpreisgruppe',
    'HELP_MF_BEPADO_PURCHASE_GROUP_CHAR' => 'Wählen Sie das Preisfeld aus. Dieses wird verwendet umd dem Händler einen besonderen Preis zu gewähren.',
    'MF_BEPADO_PURCHASE_GROUP_CHAR_A'    => 'Preis A',
    'MF_BEPADO_PURCHASE_GROUP_CHAR_B'    => 'Preis B',
    'MF_BEPADO_PURCHASE_GROUP_CHAR_C'    => 'Preis C',
    'api_key_not_verified'               => 'API-Key konnte nicht verifiziert werden und wurde nicht gespeichert.',
    'ARTICLE_MAIN_BEPADO'                => 'Artikel zum Export freigeben',
    'BEPADO_SETTINGS'                    => 'Einstellungen für Bepado',
    'HELP_ARTICLE_BEPADO_SETTINGS'       => 'Hier können Sie dieses Produkt zum Export nach Bepado freigeben.',

    'BEPADO_CATEGORY'                  => 'Bepado-Kategorie',
    'HELP_BEPADO_CATEGORY'             => 'Hier stellen Sie ein, welche Bepado-Kategorie Ihrer Shop-Kategorie entspricht.',
    'BEPADO_CATEGORY_SELECT'           => '-- keine --',

    'NAVIGATION_BEPADO'                        => 'Bepado Module',
    'mf_bepado_configuration'                  => 'Konfiguration',
    'mf_bepado_products'                        => 'Produkte verwalten',
    'mf_configuration_module'                  => 'Modul',
    'mf_configuration_module_main'             => 'Main',
    'mf_configuration_category'                => 'Kategorien',
    'mf_configuration_category_main'           => 'Main',
    'mfunit'                    => 'Maßeinheiten',
    'mfunit_main'               => 'Main',
    'mf_product_export'                        => 'Export',
    'mf_product_export_main'                   => 'Main',
    'mf_product_import'                        => 'Import',
    'mf_product_import_main'                   => 'Main',
    'MF_CONFIGURATION'                         => 'Bepado Konfiguration',
    'MF_CONFIGURATION_MODULE_LIST_MENUSUBITEM' => 'Modul',
    'MF_CONFIGURATION_CATEGORY_LIST_MENUSUBITEM'=> 'Kategorie (Zuordnung)',
    'mfunit_LIST_MENUSUBITEM'   => 'Maßeinheit (Zuordnung)',
    'MF_PRODUCT_IMPORT_LIST_MENUSUBITEM'   => 'Import',
    'MF_PRODUCT_EXPORT_LIST_MENUSUBITEM'   => 'Export',
    'MF_BEPDO_SANDBOXMODE'                      => 'S',
    'MF_BEPDO_MARKETPLACE_HINT_BASKET'          => 'MP-B',
    'MF_BEPDO_MARKETPLACE_HINT_ARTICLE_DETAILS' => 'MP-A',
    'MF_BEPDO_SHOP_ID'                          => 'ShopId',
    'MF_BEPDO_SHOP_NAME'                        => 'Lieferant',
    'MF_BEPADO_CONFIGURATION_MODULE_SANDBOXMODE'=> 'Sandbox-Modus activ',
    'MF_BEPADO_CONFIGURATION_MODULE_APIKEY'     => 'Api-Key',
    'MF_BEPADO_CONFIGURATION_MODULE_SHOP_HINTS' => 'Marktplatzhinweise',
    'MF_BEPADO_CONFIGURATION_MODULE_SHOP_HINT_ARTICLE_DETAILS' => 'In den Artikeldetails',
    'MF_BEPADO_CONFIGURATION_MODULE_SHOP_HINT_BASKET' => 'Im Warenkorb',
    'HELP_MF_BEPADO_CONFIGURATION_MODULE_SHOP_HINTS'  => 'Geben Sie einen Marktplatzhinweis
                                                          für einen bestimmten Bereich frei. Damit sieht der Nutzer wenn
                                                          er bspw. einen importierten Artikel in seinem Warenkorb hat anhand
                                                          eines Hinweises über den Lieferanten-Shop.',
    'MF_BEPDO_UNIT_KEY'                               => 'Bepado Key',
    'MF_BEPDO_OXID_UNIT_KEY'                          => 'OXID Key',
    'MF_BEPDO_OXID_UNIT_LABEL'                        => 'OXID Label',
    'MF_BEPADO_OXID_UNIT_KEY'                         => 'OXID Maßeinheit',
    'MF_BEPADO_BEPADO_UNIT_KEY'                       => 'Bepado Maßeinheit',
    'HELP_MF_BEPADO_OXID_UNIT_KEY'                    => 'OXID Maßeinheit haben Sie über ihre Übersetzungen definiert. Es werden bereits verwendete heraus gefiltert.',
    'HELP_MF_BEPADO_BEPADO_UNIT_KEY'                  => 'Die Maßeinheit im Bepado Netzwerk',
    'MF_BEPADO_CONFIGURATION_UNIT_HINT_LEGEND'        => 'Hinweise zum Maßeinheiten-Mapping',
    'MF_BEPADO_CONFIGURATION_UNIT_HINT'               => '<p>In beiden Auswahlfeldern werden Ihnen immer nur die Einheiten angezeigt, die noch zu vergeben sind.</p>
        <p>Das heißt haben Sie all Ihren OXID-Einheiten eine Bepado-Einheit zugewisen, können Sie keine weitere Zuweisung vornehmen.<br />
        Außerdem ist es nur möglich folgende Bepado-Einheiten auszuwählen:</p>',
    'MF_BEPADO_UNIT_NO_SELECT'                        => 'Wählen Sie eine Einheit ...',
    'MF_BEPADO_SHOP_ID'                               => 'Shop-ID',
    'MF_BEPADO_PRODUCT_SOURCE_ID'                     => 'Product-ID',
    'MF_BEPADO_ARTICLE_TITLE'                         => 'Produktname',
    'MF_PRODUCT_IMPORT_TITLE'                         => 'Titel',
    'HELP_MF_PRODUCT_IMPORT_TITLE'                    => '<p>Titel des importierten Produkts.</p>
        <p>Wird bei jeder Syncronisation mit den Originaldaten überschrieben.</p>',
    'HELP_MF_BEPADO_PRODUCT_IMPORT_SHORTDESCRIPTION'  => '<p>Kurzbeschreibung des importierten Produkts.</p>
        <p>Wird bei jeder Syncronisation mit den Originaldaten überschrieben.</p>',
    'HELP_MF_PRODUCT_IMPORT_EAN'                      => '
        <p> Die Artikelnummer (EAN) des importierten Produkts</p>
        <p>Wird bei jeder Syncronisation mit den Originaldaten überschrieben.</p>
    ',
    'HELP_MF_BEPADO_PRODUCT_IMPORT_VENDORID'          => '
        <p>Der Hersteller bei importierten Artikeln ist immer der Shop bei dem diese aboniert wurden.</p>
    ',
    'MF_PRODUCT_IMPORT_PURCHASE_PRICE'                => 'Händlerpreis',
    'HELP_MF_PRODUCT_IMPORT_PURCHASE_PRICE'           => 'Stelle die Preisgruppe in der Modul-Konfiguration ein.',
    'MF_BEPADO_PRODUCT_IMPORT_ATTRIBUTES'             => 'Attribute',
    'MF_PRODUCT_IMPORT_LONG_DESCRIPTION'              => 'Beschreibungstext',
    'MF_BEPAPO_PRODUCT_IMPORT_CREATE_NEW'             => '<p>Neue Artikel können hier nicht erstellt werden.
                                                          Sie werden automatisch synchronisiert.<br />Wähle einfach einen aus
                                                          der Liste oder aboniere Artikel im Bepado Socialnetwork.</p>
                                                          <p>Artikel können hier auch nicht einfach gelöscht werden, da
                                                          die Abonierung ebenfalls über das Backend von Bepado erfolgt.</p>',
    'MF_PRODUCT_EXPORT_TITLE'                         => 'Titel',
    'HELP_MF_PRODUCT_EXPORT_TITLE'                    => '<p>Titel des exportierten Produkts.</p>
        <p>Entspricht dem Titel in der Artikelverwaltung des OXID eShop.</p>',
    'HELP_MF_BEPADO_PRODUCT_EXPORT_SHORTDESCRIPTION'  => '<p>Kurzbeschreibung des exportieren Produkts.</p>
        <p>Entspricht der Kurzberschreibung in der Artikelverwaltung des OXID eShop.</p>',
    'HELP_MF_PRODUCT_EXPORT_EAN'                      => '
        <p> Wird als EAN im Bepado Social network ausgegeben.</p>
    ',
    'HELP_MF_BEPADO_PRODUCT_EXPORT_VENDORID'          => '
        <p>Wähle einen Herrsteller aus oder lasse das Feld frei wenn der eigene Shop als Hersteler im
        Bepado Socialnetwork angezeigt werden soll.</p>
    ',
    'MF_PRODUCT_EXPORT_PURCHASE_PRICE'                => 'Händlerpreis',
    'HELP_MF_PRODUCT_EXPORT_PURCHASE_PRICE'           => 'Stelle die Preisgruppe in der Modul-Konfiguration ein.',
    'MF_BEPADO_PRODUCT_EXPORT_ATTRIBUTES'             => 'Attribute',
    'MF_PRODUCT_EXPORT_LONG_DESCRIPTION'              => 'Beschreibungstext',
    'HELP_MF_BEPAPO_PRODUCT_EXPORT_CREATE_NEW'        => 'In der Lister erscheinen alle Artikel, die noch nicht für
        Bepado freigegeben wurden. Vor der Freigabe werden diese konvertiert und validiert um zu überprüfen ob alle
        nötigen Werte gesetzt sind.',
    'MF_BEPAPO_PRODUCT_EXPORT_CHOSE_ARTICLE'          => 'Wähle einen Artikel aus',
    'MF_BEPADO_PRODUCT_TO_EXPORT'                     => 'Artikel',
    'MF_BEPADO_PRODUCT_EXPORT_SAVE'                   => 'Freigeben',
    'MF_BEPADO_PRODUCT_EXPORT_DELETE'                 => 'Das Löschen des Eintrages löscht nicht den Artikel sondern
        hebt dessen Eigenschaft auf ein exportierter Artikel zu sein.',
    'MF_BEPADE_PRODUCT_VERIFY_ARTICLE'                => 'Bitte passen Sie Ihren Artikel an.',

    'The purchasePrice is not allowed to be 0 or smaller.' => 'Der Artikel enthält keinen Eintrag im Feld Händlerpreis.',

    'MF_BEPADO_PRODUCT_VERIFY_ARTICLE'                     => 'Bitte passen Sie Ihren Artikel an.',
);
