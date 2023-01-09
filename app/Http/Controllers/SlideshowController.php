<?php

namespace App\Http\Controllers;

use App\Models\Building;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SlideshowController extends Controller
{
    /**
     * Display latest HTML from RoomManagement
     *
     * @return String from RoomManagement
     */
    public function roomManagement()
    {
        if (PublisherDataController::getView("room-management") != null || "")
        {
           return PublisherDataController::getView("room-management")[1];
        } else {
            return "<h3>No Data...</h3>";
        }
    }


    /**
     * Display latest HTML from MensaRolex
     *
     * @return HTML from MensaRolex
     */
    public function mensaRolex()
    {
        return null;
    }


    /**
     * Display latest HTML from IndoorLocalization
     *
     * @return HTML from IndoorLocalization
     */
    public function indoorLocalization()
    {
        return null;
    }


}
