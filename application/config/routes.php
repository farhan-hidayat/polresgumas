<?php
defined('BASEPATH') or exit('No direct script access allowed');


$route['default_controller'] = 'welcome';

// route login
$route['login'] = 'login';

// route dashboard
$route['dashboard'] = 'dashboard';

// route profil
$route['profil'] = 'welcome/profil';

// // route untuk halaman artikel
$route['artikel'] = 'welcome/artikel';
$route['artikel/(:any)'] = 'welcome/artikel_detail/$1';

// route untuk halaman kategori artikel
$route['artikel/kategori/(:any)'] = 'welcome/kat_artikel/$1';
$route['kategori/(:any)/(:num)'] = 'welcome/kategori/$1/$s2';

// route untuk halaman gallery
$route['gallery'] = 'welcome/gallery';
$route['gallery/(:any)'] = 'welcome/kat_gallery/$1';

// route untuk halaman pengaduan
$route['pengaduan'] = 'welcome/pengaduan';

// route untuk halaman cari artikel
$route['search'] = 'welcome/search';
$route['search/(:any)'] = 'welcome/search/$1';
$route['search/(:any)/(:num)'] = 'welcome/search/$1/$2';

// route untuk halaman page
$route['page/(:any)'] = 'welcome/page/$1';

// route URL SEO untuk artikel
$route['(:any)'] = 'welcome/single/$1';

$route['404_override'] = 'welcome/notfound';
$route['translate_uri_dashes'] = FALSE;
