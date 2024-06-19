<?php

namespace App\Report;

use App\Services\Campaign\AdSetsService;
use App\Services\Campaign\CampaignService;
use App\Services\Campaign\PublicationConfigurationService;
use App\Services\Campaign\PublicationService;
use App\Services\Services\MetaService;
use App\Services\System\CompanyService;
use Codedge\Fpdf\Fpdf\Fpdf;

class CampaignReport extends Fpdf
{
    protected $fpdf;

    public function __construct()
    {
        $this->fpdf = new Fpdf('P', 'mm', 'letter');
    }

    public function generate($campaign)
    {
        $this->fpdf->header('Content-type: application/pdf');
        $this->fpdf->header('Content-Disposition: inline; filename="Reporte de estado.pdf"');
        $metaService = new MetaService();
        $campaign = CampaignService::getOne($campaign);
        $publications = PublicationService::getAllByCampaign($campaign->id);
        $publicationConfiguration = PublicationConfigurationService::getOneByCampaign($campaign->id);
        $adsets = AdSetsService::getAllByCampaign($campaign->id);
        $company = CompanyService::getOne(1);
        $insights = $metaService->getInsightsByCampaign($publicationConfiguration->identificador, $campaign->id);
        $dateNow = date('Y-m-d H:i:s');

        $this->fpdf->AddPage();
        $this->fpdf->SetFont('Arial', 'B', 14);
        // $this->fpdf->Image(public_path() . '/imgs/logo2.jpg', 10, 10, 45, 0, 'JPG');
        $extension = pathinfo($company->logo, PATHINFO_EXTENSION);
        $this->fpdf->Image($company->logo, 10, 10, 20, 0, $extension);
        $this->fpdf->Ln();
        $this->fpdf->Cell(188, 6, $company->nombre, 0, 1, 'C');
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(188, 6, $company->direccion, 0, 1, 'C');
        $this->fpdf->Cell(188, 6, utf8_decode($dateNow), 0, 1, 'C');
        $this->fpdf->Ln();
        $this->fpdf->Ln();

        //cuerpo del reporte
        $this->fpdf->SetFont('Arial', 'B', 12);
        $this->fpdf->Cell(188, 10, utf8_decode('Datos de la campaña - ' . $campaign->codigo), 0, 1);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(80, 6, 'Tematica:', 1, 0);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Cell(108, 6, utf8_decode($campaign->tematica), 1, 1);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(80, 6, 'Fecha Inicio:', 1, 0);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Cell(108, 6, $campaign->fecha_inicio, 1, 1);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(80, 6, 'Fecha Final:', 1, 0);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Cell(108, 6, $campaign->fecha_final, 1, 1);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(80, 6, 'Presupuesto:', 1, 0);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Cell(108, 6, $campaign->presupuesto . ' Bs.', 1, 1);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(80, 6, 'Estado:', 1, 0);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Cell(108, 6, $campaign->estado, 1, 1);
        $this->fpdf->Ln();

        $this->fpdf->SetFont('Arial', 'B', 12);
        $this->fpdf->Cell(188, 10, utf8_decode('Datos de la campaña en facebook - ' . $publicationConfiguration->identificador), 0, 1);
        $this->fpdf->SetFont('Arial', 'B', 10);

        $this->fpdf->Cell(80, 6, 'Nombre:', 1, 0);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Cell(108, 6, utf8_decode($publicationConfiguration->nombre), 1, 1);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(80, 6, 'Objetivo:', 1, 0);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Cell(108, 6, utf8_decode($publicationConfiguration->objetivo), 1, 1);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(80, 6, 'Estado:', 1, 0);
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Cell(108, 6, $publicationConfiguration->estado, 1, 1);

        $this->fpdf->Ln();
        $this->fpdf->SetFont('Arial', 'B', 12);
        $this->fpdf->Cell(188, 10, 'Datos de las publicaciones', 0, 1);
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(108, 6, 'Titulo de la publicacion.', 1, 0);
        $this->fpdf->Cell(40, 6, 'Fecha y Hora.', 1, 0);
        $this->fpdf->Cell(40, 6, 'Estado.', 1, 1);

        $this->fpdf->SetFont('Arial', '', 10);
        foreach ($publications as $publication) {
            $this->fpdf->Cell(108, 6, utf8_decode($publication->titulo), 1, 0);
            $this->fpdf->Cell(40, 6, $publication->fecha_publicacion . ' - ' . $publication->hora_publicacion, 1, 0);
            $this->fpdf->Cell(40, 6, $publication->estado, 1, 1);
        }


        $this->fpdf->Ln();
        $this->fpdf->SetFont('Arial', 'B', 12);
        $this->fpdf->Cell(188, 10, 'Datos de los anuncios publicados', 0, 1);

        $this->fpdf->SetFont('Arial', 'B', 10);
        foreach ($adsets as $adSet) {
            $insight = $this->getData($adSet->identificador, $insights);
            $namePublicacion = $this->getNamePublication($adSet->publication_id, $publications);
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->Cell(80, 6, 'Nombre Publicacion Asociada:', 1, 0);
            $this->fpdf->SetFont('Arial', '', 10);
            $this->fpdf->Cell(108, 6, utf8_decode($namePublicacion), 1, 1);
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->Cell(80, 6, 'Identificador:', 1, 0);
            $this->fpdf->SetFont('Arial', '', 10);
            $this->fpdf->Cell(108, 6, utf8_decode($adSet->identificador), 1, 1);
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->Cell(80, 6, 'Nombre:', 1, 0);
            $this->fpdf->SetFont('Arial', '', 10);
            $this->fpdf->Cell(108, 6, utf8_decode($adSet->nombre), 1, 1);
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->Cell(80, 6, 'Objetivo de optimizacion:', 1, 0);
            $this->fpdf->SetFont('Arial', '', 10);
            $this->fpdf->Cell(108, 6, $adSet->objetivo_optimizacion, 1, 1);
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->Cell(80, 6, 'Monto de oferta:', 1, 0);
            $this->fpdf->SetFont('Arial', '', 10);
            $this->fpdf->Cell(108, 6, $adSet->monto_oferta . 'Bs.', 1, 1);
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->Cell(80, 6, 'Presupuesto Diario:', 1, 0);
            $this->fpdf->SetFont('Arial', '', 10);
            $this->fpdf->Cell(108, 6, $adSet->presupuesto_diario . ' Bs.', 1, 1);
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->Cell(80, 6, 'Estado:', 1, 0);
            $this->fpdf->SetFont('Arial', '', 10);
            $this->fpdf->Cell(108, 6, $adSet->estado, 1, 1);
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->Cell(80, 6, 'Clicks:', 1, 0);
            $this->fpdf->SetFont('Arial', '', 10);
            $this->fpdf->Cell(108, 6, $insight['clicks'] ?? 0, 1, 1);
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->Cell(80, 6, 'Impresiones:', 1, 0);
            $this->fpdf->SetFont('Arial', '', 10);
            $this->fpdf->Cell(108, 6, $insight['impressions'] ?? 0, 1, 1);
            $this->fpdf->Ln();
        }
        $this->fpdf->Ln();
        $this->fpdf->Output("I", "Reporte de Pagos.pdf");
        exit;
    }

    private function getData($adset_id, $data)
    {
        foreach ($data as $item) {
            if ($item['adset_id'] == $adset_id) {
                return $item;
            }
        }
        return null;
    }

    private function getNamePublication($publicationId, $publications)
    {
        foreach ($publications as $publication) {
            if ($publication->id == $publicationId) {
                return $publication->titulo;
            }
        }
        return '';
    }
}
