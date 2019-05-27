<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Result;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
          $url = 'https://bwfsudirmancup.bwfbadminton.com/results/3445/total-bwf-sudirman-cup-2019/2019-05-23';
          $this->proses($browser, $url);     
        });
    }

    protected function proses($browser, $url)
    {
        $browser->visit($url);
        $winners = $browser->elements('.country-header .player1');
        $losers = $browser->elements('.country-header .player3');
        $scores = $browser->elements('.country-header .score');

        for($i=0;$i<count($scores);$i++)
        {
              Result::create([
                    'winner' => trim($winners[$i]->getAttribute('innerHTML')),
                    'loser' => trim($losers[$i]->getAttribute('innerHTML')),
                    'score' => trim($scores[$i]->getAttribute('innerHTML')),
                    'isCrawled' => 1
                ]);  
        }
    }
}
