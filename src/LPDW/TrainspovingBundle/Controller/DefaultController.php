<?php

namespace LPDW\TrainspovingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use LPDW\TrainspovingBundle\Parser\StationParser;
use LPDW\TrainspovingBundle\Entity\SNCF\Station;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction($name)
    {
        //return array('name' => $name);
        $xml = '<?xml version="1.0" encoding="ISO-8859-1"?>
<ActionStopAreaList>
	<Params Function="api">
		<SafeMode>0</SafeMode>
		<action>PTReferential</action>
		<RequestedType>stoparealist</RequestedType>
		<mainstoparea>1</mainstoparea>
		<modeexternalcode>ocecorail intercité;ocecorail lunéa;ocetrain ter</modeexternalcode>
		<interface>1_10</interface>
		<login>opendata</login>
		<useadapted>0</useadapted>
		<isadapted>0</isadapted>
	</Params>
	<StopAreaList StopAreaCount="2679">
		<StopArea StopAreaIdx="7927" StopAreaId="7940" StopAreaName="gare de Clermont-Ferrand" StopAreaExternalCode="OCE87734004" MainStopArea="1" MultiModal="0" CarPark="0" MainConnection="0" AdditionalData="" ResaRailCode="">
			<City CityIdx="33346" CityId="25906" CityName="Clermont-Ferrand" CityExternalCode="63113" CityCode="63000">
				<Country CountryIdx="1" CountryId="0" CountryName="France" CountryExternalCode="FRA"/>
			</City>
			<Coord>
				<CoordX>659417</CoordX>
				<CoordY>2086762</CoordY>
			</Coord>
			<HangList>
				<Hang StopPointIdx="13095" Duration="0" ConnectionKind="13"/>
				<Hang StopPointIdx="13093" Duration="0" ConnectionKind="13"/>
				<Hang StopPointIdx="13092" Duration="0" ConnectionKind="2"/>
				<Hang StopPointIdx="13096" Duration="0" ConnectionKind="2"/>
				<Hang StopPointIdx="13094" Duration="0" ConnectionKind="2"/>
			</HangList>
			<ModeList ModeCount="3">
				<ModeType ModeTypeIdx="3" ModeTypeExternalCode="OCECar TER" ModeTypeName="Car TER"/>
				<ModeType ModeTypeIdx="10" ModeTypeExternalCode="OCECorail Intercité" ModeTypeName="INTERCITÉS"/>
				<ModeType ModeTypeIdx="24" ModeTypeExternalCode="OCETrain TER" ModeTypeName="Train TER"/>
			</ModeList>
		</StopArea>
		<StopArea StopAreaIdx="7928" StopAreaId="7941" StopAreaName="gare de Clermont-la-Pardieu" StopAreaExternalCode="OCE87782607" MainStopArea="1" MultiModal="0" CarPark="0" MainConnection="0" AdditionalData="" ResaRailCode=""><City CityIdx="33346" CityId="25906" CityName="Clermont-Ferrand" CityExternalCode="63113" CityCode="63000"><Country CountryIdx="1" CountryId="0" CountryName="France" CountryExternalCode="FRA"/></City><Coord><CoordX>662050</CoordX><CoordY>2085497</CoordY></Coord><HangList><Hang StopPointIdx="13099" Duration="0" ConnectionKind="2"/><Hang StopPointIdx="13097" Duration="0" ConnectionKind="2"/><Hang StopPointIdx="13098" Duration="0" ConnectionKind="2"/></HangList><ModeList ModeCount="3"><ModeType ModeTypeIdx="3" ModeTypeExternalCode="OCECar TER" ModeTypeName="Car TER"/><ModeType ModeTypeIdx="10" ModeTypeExternalCode="OCECorail Intercité" ModeTypeName="INTERCITÉS"/><ModeType ModeTypeIdx="24" ModeTypeExternalCode="OCETrain TER" ModeTypeName="Train TER"/></ModeList></StopArea>
	</StopAreaList>
	<PagerInfo ResponseCount="2679" ResponseStartIndex="0" TotalCount="2679"/>
</ActionStopAreaList>';

		//$parser = new StationParser;
		//$result=$parser->parse($xml, true);

		$station = new Station();
		$station->setExternalCode('123');
	    $station->setName('gare st jean');

	    $em = $this->getDoctrine()->getEntityManager();
	    $em->persist($station);
	    $em->flush();

	    return new Response('Produit créé avec nom '.$station->getName());
		//return array('name' => $name, 'result' => $result);
    }
}
