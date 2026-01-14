<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SettingModel;

class Contact extends BaseController
{
    public function index()
    {
        $settingModel = new SettingModel();

        $data = [
            'title' => 'Kontak Kami',
            'contact' => [
                'email_cs' => $settingModel->getSetting('contact_email_cs', 'cs@muaratirta.co.id'),
                'email_pr' => $settingModel->getSetting('contact_email_pr', 'pdam@muaratirta.co.id'),
                'email_perumda' => $settingModel->getSetting('contact_email_perumda', 'perumda@muaratirta.co.id'),
                'email_it' => $settingModel->getSetting('contact_email_it', 'admin@muaratirta.co.id'),
                'wa_cs' => $settingModel->getSetting('contact_wa_cs', 'https://wa.me/6282292754405'),
                'wa_humas' => $settingModel->getSetting('contact_wa_humas', 'https://wa.me/6281244782662'),
                'name_humas' => $settingModel->getSetting('contact_name_humas', 'Dedi Kiayi Demak'),
                'wa_billing' => $settingModel->getSetting('contact_wa_billing', 'https://wa.me/6281244697154'),
                'name_billing' => $settingModel->getSetting('contact_name_billing', 'Recky Pianaung'),
                'address' => $settingModel->getSetting('contact_address', 'Jl. Drs. Achmad Nadjamuddin, Limba U Dua, Kota Sel., Kota Gorontalo, Gorontalo 96138'),
                'maps_url' => $settingModel->getSetting('contact_maps_url', 'https://maps.google.com/maps?q=perumda+air+minum+muara+tirta&t=k&z=16&ie=UTF8&iwloc=&output=embed'),
            ]
        ];

        return view('frontend/pages/contact', $data);
    }
}
