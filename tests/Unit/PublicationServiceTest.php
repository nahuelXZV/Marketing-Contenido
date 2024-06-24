<?php

namespace Tests\Unit;

use App\Models\Publication;
use App\Services\Campaign\PublicationService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicationServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test update method of PublicationService.
     *
     * @return void
     */
    public function testUpdatePublication()
    {
        $publication = Publication::factory()->create();

        $updatedData = [
            'titulo' => 'Publicación actualizada',
            'contenido' => 'Contenido actualizado',
        ];

        $updatedPublication = PublicationService::update($publication->id, $updatedData);

        $this->assertInstanceOf(Publication::class, $updatedPublication);
        $this->assertEquals($updatedData['titulo'], $updatedPublication->titulo);
        $this->assertEquals($updatedData['contenido'], $updatedPublication->contenido);
    }

    /**
     * Test getAllByCampaign method of PublicationService.
     *
     * @return void
     */
    public function testGetAllByCampaign()
    {
        Publication::factory()->count(5)->create();

        $publications = PublicationService::getAllByCampaign(1);

        $this->assertCount(0, $publications);
        foreach ($publications as $publication) {
            $this->assertEquals(1, $publication->campaign_id);
        }
    }
}
