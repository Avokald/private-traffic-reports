<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Report;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReportTest extends TestCase
{
    public static function setUpBeforeClass() : void
    {
        shell_exec('php artisan migrate:fresh --seed');
    }

    public static function tearDownAfterClass() : void
    {
        parent::tearDownAfterClass();
        shell_exec('php artisan migrate:fresh --seed');
    }

    public function testNewReportInDatabase()
    {
        $report = Report::create([
            'title' => 'Test report',
            'description' => 'Test report description',
            'lat' => '52.261111',
            'lng' => '76.951111',
            'videos' => [
                'https://www.youtube.com/watch?v=jsYwFizhncE',
                'https://www.youtube.com/watch?v=PFDu9oVAE-g',
                'https://www.youtube.com/watch?v=aircAruvnKk',
                'https://www.youtube.com/watch?v=3d6DsjIBzJ4',
            ]
        ]);

        $dbreport = Report::all()->last();


        $this->assertEquals($dbreport->title, 'Test report');
        $this->assertEquals($dbreport->description, 'Test report description');
        $this->assertEquals($dbreport->lat, '52.261111');
        $this->assertEquals($dbreport->lng, '76.951111');
        $this->assertEquals($dbreport->videos, [
            'https://www.youtube.com/watch?v=jsYwFizhncE',
            'https://www.youtube.com/watch?v=PFDu9oVAE-g',
            'https://www.youtube.com/watch?v=aircAruvnKk',
            'https://www.youtube.com/watch?v=3d6DsjIBzJ4',
        ]);

        $dbreport->delete();

        $report = Report::create([
            'title' => 'Test report 2',
            'description' => 'Test report description 2',
            'lat' => '52.261112',
            'lng' => '76.951112',
            'videos' => [
                ''
            ],
        ]);

    }

    public function testNewReportDisplayed()
    {
        $user = \App\User::findOrFail(1);
        $report = Report::create([
            'title' => 'Test report',
            'description' => 'Test report description',
            'lat' => '52.269111',
            'lng' => '76.953111',
            'videos' => [
                'https://www.youtube.com/watch?v=jsYwFizhncE',
                'https://www.youtube.com/watch?v=PFDu9oVAE-g',
                'https://www.youtube.com/watch?v=aircAruvnKk',
                'https://www.youtube.com/watch?v=3d6DsjIBzJ4',
            ],
        ]);

        $response = $this->actingAs($user)->get('/');

        $response->assertSee('Test report');
        $response->assertSee('Test report description');
        $response->assertSee(52.269111);
        $response->assertSee(76.953111);
        $response->assertSeeInOrder([
            'jsYwFizhncE',
            'PFDu9oVAE-g',
            'aircAruvnKk',
            '3d6DsjIBzJ4',
        ]);

        $report->delete();
    }

    public function testReportEditInDatabase()
    {
        $report = Report::first();

        $report->title = 'Edited report title';
        $report->description = 'Edited report description';
        $report->lat = '52.269999';
        $report->lng = '76.959999';
        $report->videos = null;
        $report->save();

        $dbreport = Report::first();

        $this->assertEquals($dbreport->title, 'Edited report title');
        $this->assertEquals($dbreport->description, 'Edited report description');
        $this->assertEquals($dbreport->lat, '52.269999');
        $this->assertEquals($dbreport->lng, '76.959999');
        $this->assertEquals($dbreport->videos, null);
    }


    public function testNewReportWithImagesInDatabase()
    {
        $report = factory(\App\Report::class)->state('test')->create([
            'images' => [
                '/public/assets/images/auth-img.png',
                '/public/assets/images/auth-img-2.png',
                '/public/assets/images/auth-img-3.png',
                '/public/assets/images/catword.png',
                '/public/assets/images/404.png',
            ],
        ]);

        $dbreport = Report::all()->last();
        $this->assertEqualsCanonicalizing($dbreport->images, [
            '/public/assets/images/auth-img.png',
            '/public/assets/images/auth-img-2.png',
            '/public/assets/images/auth-img-3.png',
            '/public/assets/images/catword.png',
            '/public/assets/images/404.png',
        ]);
    }

    public function testReportImagesAreDisplayedOnFrontPage()
    {
        $user = \App\User::findOrFail(1);

        $report = factory(\App\Report::class)->state('test')->create([
            'images' => [
                '/public/assets/images/auth-img.png',
                '/public/assets/images/auth-img-2.png',
                '/public/assets/images/auth-img-3.png',
                '/public/assets/images/catword.png',
                '/public/assets/images/404.png',
            ],
        ]);

        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);

        $response->assertSeeInOrder([
            '/public/assets/images/auth-img.png',
            '/public/assets/images/auth-img-2.png',
            '/public/assets/images/auth-img-3.png',
            '/public/assets/images/catword.png',
            '/public/assets/images/404.png',
        ]);
    }

}
