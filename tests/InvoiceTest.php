<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class InvoiceTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testContactReport()
    {

        $response =  new \App\Modules\Report\Http\Response\ContactReport();
        $responsedata = $response->openningBalance(2,"2017-11-01");
        $this->assertTrue($responsedata);

    }
    public function testContactReportView()
    {

    }
}