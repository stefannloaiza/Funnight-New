<?php

namespace App\Traits;

use Datetime;
use App\Event;
use App\Image;
use App\Promotion;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

trait ImagesMethods
{
    /**
     * Función que verifica si la imagen es una promocion o un evento.
     *
     * @return bool
     */
    
    public function typePublication($image)
    {
        $text = "";
        
        if (!empty($image->typePub)) {
            if ($image->typePub == 1) {
                #promocion
                
                $promotion = Promotion::where('image_id', $image->id)->first();
                $text = "Promoción valida desde: ".date_format(date_create($promotion->initial_date), 'd/M/Y')." hasta ".date_format(date_create($promotion->final_date), 'd/M/Y');
            } else {
                #evento
                $event = Event::where('image_id', $image->id)->first();
                // dd($event);
                $text = "Fecha del evento: ".date_format(date_create($event->event_date), 'd/M/Y');
            }
        }
        

        return $text;
    }

    
    /**
     * Metodo que verifica si la imagen es vigente.
     *
     * @param [type] $image_id
     * @return bool
     */
    public function isVigent($image)
    {
        if ($image->typePub != null) {
            if ($image->typePub == 1) {
                # promotion
                $promotion = Promotion::where('image_id', $image->id)->first();

                if (date_format(new DateTime($promotion->final_date), 'Y-m-d') >= date_format(new DateTime(), 'Y-m-d')) {
                    return true;
                } else {
                    return false;
                }
            } else {
                # event
                $event = Event::where('image_id', $image->id)->first();

                if (date_format(new DateTime($event->event_date), 'Y-m-d') >= date_format(new DateTime(), 'Y-m-d')) {
                    return true;
                } else {
                    return false;
                }
            }
        }
        return false;
    }
}
