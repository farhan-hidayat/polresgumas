<?php
defined('BASEPATH') or exit('No direct script access allowed');


$route['default_controller'] = 'welcome';

// route login
$route['login'] = 'login';

// route dashboard
$route['dashboard'] = 'dashboard';

// route profil
$route['profil'] = 'welcome/profil';

// route polsek
$route['polsek'] = 'welcome/polsek';
$route['polsek/(:any)'] = 'welcome/polsek_detail/$1';

// route satker
$route['satker'] = 'welcome/satker';
$route['satker/(:any)'] = 'welcome/satker_detail/$1';

// // route untuk halaman berita
$route['berita'] = 'welcome/berita';
$route['berita/(:any)'] = 'welcome/berita_detail/$1';

// route untuk halaman kategori berita
$route['berita/kategori/(:any)'] = 'welcome/kat_berita/$1';
$route['kategori/(:any)/(:num)'] = 'welcome/kategori/$1/$s2';

// route untuk halaman gallery
$route['gallery'] = 'welcome/gallery';
$route['gallery/(:any)'] = 'welcome/kat_gallery/$1';

// route untuk halaman pengaduan
$route['pengaduan'] = 'welcome/pengaduan';

// route untuk halaman cari berita
$route['search'] = 'welcome/search';
$route['search/(:any)'] = 'welcome/search/$1';
$route['search/(:any)/(:num)'] = 'welcome/search/$1/$2';

// route untuk halaman page
$route['page/(:any)'] = 'welcome/page/$1';

// route URL SEO untuk berita
$route['(:any)'] = 'welcome/single/$1';

$route['404_override'] = 'welcome/notfound';
$route['translate_uri_dashes'] = FALSE;
