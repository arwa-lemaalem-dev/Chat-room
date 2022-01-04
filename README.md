npm install
npm run dev


RQ:
composer require laravel/ui
php artisan ui vue
php artisan ui vue --auth
npm install && npm run dev
---
npm install bootstrap@4.0.0-alpha.6
npm i sass@^1.32.11
----
slot: ecriver dans le corps
----npm install --save vue-chat-scroll
------app.php////brodcasring.php
------php artisan event:generate
-------saut de ligne : style="white-space: pre-line;"

PDF
composer require barryvdh/laravel-dompdf

app.php->providers->Add Barryvdh\DomPDF\ServiceProvider::class,
->alisas->'PDF'=>Barryvdh\DomPDF\Facade::class,

Controller:
use PDF;

function pdf()
{
$pdf=\App::make('dompdf.wrapper');
$pdf->loadHTML($this->convert_data_to_html());
$pdf->stream();
}
function convert_data_to_html()
{
$data=$this->getData();//getmsgByID
$output='page html';
retrun $output;

}

<a href=""></a>



new URLSearchParams(window.location.search).get('id')


-enable client event pusher ==> typing










